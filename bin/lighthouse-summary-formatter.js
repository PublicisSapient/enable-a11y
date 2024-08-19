const { spawn } = require('child_process');
const fs = require('fs');
const Table = require('cli-table3');
const cliProgress = require('cli-progress');

const REPORT_PATH = 'report/lighthouse/';
const SUMMARY_PATH = 'report/lighthouse/summary.json';
const COMMAND = './node_modules/.bin/lighthouse-batch';
const COMMAND_ARGS = [
    '-f tmp/downloaded-urls.txt --params "--only-categories=accessibility"',
];
const DOWNLOADED_URLS = 'tmp/downloaded-urls.txt';
const RED_TEXT = '\x1b[31m';
const YELLOW_TEXT = '\x1b[33m';
const GREEN_TEXT = '\x1b[32m';

const getNumPages = () => {
    try {
        // Check if the file exists before reading
        if (!fs.existsSync(DOWNLOADED_URLS)) {
            throw new Error(
                `Downloaded URL's file not found: ${DOWNLOADED_URLS}`,
            );
        }

        return fs.readFileSync(DOWNLOADED_URLS).toString().split('\n').length;
    } catch (err) {
        console.log(`Error getting the number of pages: ${err.message}`);
    }
};

const sortSummary = (a, b) => {
    const scoreA = a.score;
    const scoreB = b.score;
    const errorA = a.error;
    const errorB = b.error;

    if (scoreA === scoreB) {
        return 0;
    }

    // Items with a higher score come first
    if (scoreA === 1) return -1;
    if (scoreB === 1) return 1;

    // Errors come second
    if (errorA) return -1;
    if (errorB) return 1;

    // Otherwise, failed scores come last
    return 0;
};

const runLighthouseBatch = () => {
    const numPages = getNumPages();

    // Init new instance of progress bar
    const progressBar = new cliProgress.SingleBar(
        {
            format: `Lighthouse Scan Progress ... |{bar}| {percentage}% || {value}/${numPages} Pages || ETA: {eta_formatted} || {duration_formatted}`,
            barCompleteChar: '\u2588',
            barIncompleteChar: '\u2591',
            hideCursor: false,
        },
        cliProgress.Presets.shades_classic,
    );

    // Start the progess bar
    progressBar.start(numPages, 0);
    let progress = 0;

    return new Promise((resolve, reject) => {
        const child = spawn(COMMAND, COMMAND_ARGS, { shell: true });

        // Lighthouse outputs the progress in stderr, update the progress here
        child.stderr.on('data', (data) => {
            const output = data.toString();
            const lines = output.split('\n');

            lines.forEach((line) => {
                if (line.includes('Printer json output written')) {
                    progress += 1;
                    progressBar.update(progress);
                }
            });
        });

        // On error log it
        child.on('error', (err) => {
            console.error(`Failed to run the lighthouse scan: ${err.message}`);
        });

        // On close update progress and resolve or reject the promise
        child.on('close', (code) => {
            if (code === 0) {
                progressBar.update(numPages);
                progressBar.stop();
                resolve('Lighthouse batch scan completed successfully.');
            } else {
                progressBar.stop();
                reject(
                    new Error(
                        `Lighthouse batch scan failed with exit code ${code}.`,
                    ),
                );
            }
        });
    });
};

const formatErrorReport = ({ fileName }) => {
    try {
        // Check if the file exists before reading
        if (!fs.existsSync(`${REPORT_PATH}${fileName}`)) {
            throw new Error(`Report not found: ${REPORT_PATH}${fileName}`);
        }

        // Get report file
        const report = JSON.parse(
            fs.readFileSync(`${REPORT_PATH}${fileName}`, 'utf-8'),
        );

        // Create a new table
        const table = new Table({
            head: ['Issues', 'Title', 'Selector', 'Description'],
            colWidths: [30, 30, 40, 70],
            wordWrap: true,
        });

        // Iterate through the audits and add rows where score is < 1 and not null
        for (const key in report.audits) {
            const audit = report.audits[key];
            if (audit.score < 1 && audit.score !== null) {
                table.push([
                    audit.id,
                    audit.title,
                    audit?.details?.items[0]?.node?.selector,
                    audit.description,
                ]);
            }
        }

        // Display the table in terminal
        console.log(
            `Visit https://googlechrome.github.io/lighthouse/viewer/ and upload ./${REPORT_PATH}${fileName} to see the full accessibility report.\n`,
        );
        console.log(`${table.toString()}\n`);
    } catch (err) {
        console.error(`Error processing the report: ${err.message}`);
    }
};

const formatSummary = () => {
    try {
        // Check if the file exists before reading
        if (!fs.existsSync(SUMMARY_PATH)) {
            throw new Error(`Summary not found: ${SUMMARY_PATH}`);
        }

        // Get summary file
        const summary = JSON.parse(fs.readFileSync(SUMMARY_PATH, 'utf8'));

        console.log('\nLighthouse Scan Complete ...\n');
        console.log('Lighthouse Scan Results ...\n');

        // Iterate over the results of each page and log them

        summary
            .sort((a, b) => sortSummary(a, b))
            .map((item) => {
                if (item?.detail?.accessibility === 1) {
                    return console.log(
                        GREEN_TEXT,
                        `✅ Pass: ${item.url} with a score of ${parseInt(item?.detail?.accessibility) * 100}%\n`,
                    );
                }

                if (item?.error) {
                    return console.log(
                        YELLOW_TEXT,
                        `🚫 Error scanning: ${item.url}\n`,
                    );
                }

                console.log(
                    RED_TEXT,
                    `❌ Fail: ${item.url} with a score of ${parseInt(item?.detail?.accessibility) * 100}%\n`,
                );

                // Output failed accessibility test data in table format
                formatErrorReport({ fileName: item?.file });
            });
    } catch (err) {
        console.error(`Error processing the summary: ${err.message}`);
    }
};

// Run the lighthouse script
runLighthouseBatch()
    .then(() => {
        formatSummary();
    })
    .catch((err) => {
        console.log(`Error: ${err.message}`);
    });

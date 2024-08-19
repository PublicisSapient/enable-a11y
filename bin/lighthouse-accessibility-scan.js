const { spawn } = require('child_process');
const fs = require('fs');

const REPORT_PATH = 'report/lighthouse/';
const SUMMARY_PATH = 'report/lighthouse/summary.json';
const COMMAND = './node_modules/.bin/lighthouse-batch';
const COMMAND_ARGS = [
    '-f tmp/downloaded-urls.txt --params "--only-categories=accessibility"',
];
const DOWNLOADED_URLS = 'tmp/downloaded-urls.txt';

const logger = (text, color, indent = '') => {
    if (indent) {
        indent = '\t';
    }
    switch (color) {
        case 'red':
            return console.log(indent + '\x1b[31m%s\x1b[0m', text);
        case 'green':
            return console.log(indent + '\x1b[32m%s\x1b[0m', text);
        case 'yellow':
            return console.log(indent + '\x1b[33m%s\x1b[0m', text);
        case 'white':
        default:
            return console.log(indent + '\x1b[37m%s\x1b[0m', text);
    }
};

const getNumPages = () => {
    try {
        // Check if the file exists before reading
        if (!fs.existsSync(DOWNLOADED_URLS)) {
            throw new Error(
                `Downloaded URL's file not found: ${DOWNLOADED_URLS}`,
            );
        }

        return fs
            .readFileSync(DOWNLOADED_URLS)
            .toString()
            .split('\n')
            .filter((url) => url).length;
    } catch (err) {
        logger(`Error getting the number of pages: ${err.message}`);
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

    logger(
        `\nLighthouse Scan Started on ${numPages} pages, this may take awhile ...\n`,
    );

    return new Promise((resolve, reject) => {
        const child = spawn(COMMAND, COMMAND_ARGS, { shell: true });

        // Lighthouse outputs the progress in stderr, update the progress here
        child.stderr.on('data', (data) => {
            const output = data.toString();
            const lines = output.split('\n');

            lines.map((line) => {
                if (line.includes('Printer json output written')) {
                    const match = line.match(/(?<=written to\s).*$/);
                    if (match) {
                        logger(`Report generated in ${match}\n`);
                    }
                }
            });
        });

        // On error log it
        child.on('error', (err) => {
            logger(`Failed to run the lighthouse scan: ${err.message}`);
        });

        // On close update progress and resolve or reject the promise
        child.on('close', (code) => {
            if (code === 0) {
                resolve();
            } else {
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

        if (report?.runtimeError) {
            return logger(
                `🚫 Error scanning: ${fileName} - ${report?.runtimeError?.message}\n`,
                'yellow',
            );
        }

        // Iterate through the audits and log issues where score is < 1 and not null
        for (const key in report.audits) {
            const audit = report.audits[key];
            if (audit.score < 1 && audit.score !== null) {
                logger(
                    `❌ Fail: ${item.url} with a score of ${parseInt(audit.score) * 100}%\n\nVisit https://googlechrome.github.io/lighthouse/viewer/ and upload ./${REPORT_PATH}${item?.file} to see the full accessibility report.\n\n`,
                    'red',
                );
                logger(`Issue: ${audit.id}\n`, 'white', true);
                logger(`Title: ${audit.title}\n`, 'white', true);
                logger(
                    `Selector: ${audit?.details?.items[0]?.node?.selector}\n`,
                    'white',
                    true,
                );
                logger(`Description: ${audit.description}\n\n`, 'white', true);
            }
        }
    } catch (err) {
        logger(`Error processing the report: ${err.message}`);
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

        logger('Lighthouse Scan Results ...\n');

        // Iterate over the results of each page and log them
        summary
            .sort((a, b) => sortSummary(a, b))
            .map((item) => {
                if (item?.detail?.accessibility === 1) {
                    return logger(
                        `✅ Pass: ${item.url} with a score of ${parseInt(item?.detail?.accessibility) * 100}%\n`,
                        'green',
                    );
                }

                // Output failed accessibility test data in table format
                formatErrorReport({ fileName: item?.file });
            });
    } catch (err) {
        logger(`Error processing the summary: ${err.message}`);
    }
};

// Run the lighthouse script
runLighthouseBatch()
    .then(() => {
        formatSummary();
    })
    .catch((err) => {
        logger(`Error: ${err.message}`);
    });

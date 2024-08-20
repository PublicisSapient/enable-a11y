const { spawn } = require('child_process');
const fs = require('fs');

const COMMAND = './node_modules/.bin/lighthouse-batch';
const ARGS = [
    '-f tmp/downloaded-urls.txt --params "--only-categories=accessibility"',
];
const SUMMARY_PATH = 'report/lighthouse/summary.json';
const REPORT_PATH = 'report/lighthouse/';
const DOWNLOADED_URLS = 'tmp/downloaded-urls.txt';
const RED_TXT = '\x1b[31m%s\x1b[0m';
const GREEN_TXT = '\x1b[32m%s\x1b[0m';
const YELLOW_TXT = '\x1b[33m%s\x1b[0m';
const SCORE_THRESHOLD = 1;

const readFileSync = (path, encoding = 'utf-8') => {
    try {
        return fs.readFileSync(path, encoding);
    } catch (err) {
        throw new Error(`Error reading file at ${path}: ${err.message}`);
    }
};

const fileExists = (path) => {
    if (!fs.existsSync(path)) {
        throw new Error(`File not found: ${path}`);
    }
};

const getNumPages = () => {
    fileExists(DOWNLOADED_URLS);
    return readFileSync(DOWNLOADED_URLS).split('\n').filter(Boolean).length;
};

const getReport = (fileName) => {
    fileExists(fileName);
    return JSON.parse(readFileSync(fileName));
};

const logPageStatus = ({ fileName }) => {
    const { runtimeError, requestedUrl, categories } = getReport(fileName);

    if (runtimeError) {
        console.log(
            YELLOW_TXT,
            `🚫 Error scanning: ${requestedUrl} - ${runtimeError.message}\n`,
        );
        return;
    }

    const statusText =
        categories.accessibility.score >= SCORE_THRESHOLD ? GREEN_TXT : RED_TXT;
    const statusMessage =
        categories.accessibility.score >= SCORE_THRESHOLD
            ? '✅ Pass'
            : '❌ Fail';

    console.log(statusText, `${statusMessage}: ${requestedUrl}\n`);
};

const printIssuesSummary = (audits, url, fileName, score) => {
    console.log(RED_TXT, `\n${url} failed scan with score: ${score}%:\n`);
    console.log(
        RED_TXT,
        `Visit https://googlechrome.github.io/lighthouse/viewer/ and upload ${fileName} to see the full accessibility report.\n`,
    );

    let errCount = 1;
    for (const { score, id, title, description, details } of Object.values(
        audits,
    )) {
        if (score < 1 && score !== null) {
            console.log(`  Issue ${errCount}: ${id}\n`);
            console.log(`  Title: ${title}\n`);
            console.log(`  Selector: ${details?.items[0]?.node?.selector}\n`);
            console.log(`  Description: ${description}\n\n`);
            errCount++;
        }
    }
};

const formatSummary = () => {
    fileExists(SUMMARY_PATH);
    const summary = JSON.parse(readFileSync(SUMMARY_PATH));

    let passCount = 0,
        failCount = 0,
        errorCount = 0;

    console.log('\nLighthouse Scan Summary ...\n');

    summary.forEach((item) => {
        const fileName = `${REPORT_PATH}${item.file}`;
        const report = getReport(fileName);
        const score = Number(item.score) * 100;

        if (item?.error) return errorCount++;
        if (report.categories.accessibility.score === SCORE_THRESHOLD)
            return passCount++;

        printIssuesSummary(report.audits, item.url, fileName, score);
        failCount++;
    });

    const totalCount = passCount + failCount + errorCount;
    const statusText = failCount === 0 ? GREEN_TXT : RED_TXT;
    console.log(
        statusText,
        `Scan complete: ${passCount}/${totalCount} URLs passed\n`,
    );
};

const runLighthouseBatch = () => {
    const numPages = getNumPages();

    console.log(
        `\nLighthouse Scan Started on ${numPages} pages, this may take awhile ...\n`,
    );

    return new Promise((resolve, reject) => {
        const child = spawn(COMMAND, ARGS, { shell: true });

        child.stderr.on('data', (data) => {
            data.toString()
                .split('\n')
                .filter((line) =>
                    line.includes('Printer json output written to'),
                )
                .forEach((line) => {
                    const match = line.match(
                        /(?<=Printer json output written to\s).*$/,
                    );
                    if (match) logPageStatus({ fileName: match[0] });
                });
        });

        child.on('error', (err) => {
            reject(
                new Error(`Failed to run the lighthouse scan: ${err.message}`),
            );
        });

        child.on('close', (code) => {
            if (code === 0) resolve();
            else
                reject(
                    new Error(
                        `Lighthouse batch scan failed with exit code ${code}.`,
                    ),
                );
        });
    });
};

runLighthouseBatch()
    .then(formatSummary)
    .catch((err) => {
        console.error(`Error running runLighthouseBatch: ${err.message}`);
    });

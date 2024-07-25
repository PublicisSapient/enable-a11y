const fs = require('fs');
const wget = require('wget-improved');
const { execFile } = require('child_process');
const { vnu } = require('vnu');

const htmlList = [];

async function getHTML() {
    const fileData = JSON.parse(
        fs.readFileSync('templates/data/meta-info.json', 'utf8')
    );
    const projectRoot = 'http://localhost:8888/';
    const numFiles = Object.keys(fileData).length;
    let numFilesIndexed = 0;

    for (let i in fileData) {
        const data = fileData[i];
        const { wip } = data;

        if (!wip) {
            const download = await wget.download(
                `${projectRoot}${i}`,
                `tmp/${i}`,
                {}
            );
            download.on('error', function (err) {
                console.error(err);
                return 1;
            });
            download.on('end', function (output) {
                numFilesIndexed++;
                if (numFilesIndexed === numFiles) {
                    console.log('Files downloaded.  Analyzing');
                    analyseHTML();
                } else {
                    console.log(numFilesIndexed, numFiles);
                }
            });
            htmlList.push(i);
        } else {
            numFilesIndexed++;
        }
    }
    return;
}

function analyseHTML() {
    htmlList.forEach((file) => {
        console.log('Analysing ${file}');
        vnu(`tmp/${file}`, {});
    });
}

getHTML();

#!/usr/bin/env node

const fs = require('fs');

const pageData = JSON.parse(fs.readFileSync('templates/data/meta-info.json', 'utf8'));
const { argv } = process;
if (argv.length < 2) {
    console.error(`Usage: ${argv[1]} <server-name>`)
}
const myip = process.argv[2];


for (let i in pageData) {
    if (!pageData[i].wip) {
        console.log(`http://${myip}:8888/${i}`);
    }
}
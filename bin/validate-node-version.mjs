#!/usr/bin/env node

import chalk from 'chalk';
import { execSync } from 'child_process';
import fs from 'fs';
import path from 'path';

async function getRunningVersion() {
    const terminalCmd = 'node --version';

    try {
        return  execSync(terminalCmd).toString().trim();
    } catch (e) {
        console.log(chalk.red(`Node version validation failed while running ${terminalCmd}`), e);
    }
}

async function validateVersion() {
    const directory = path.resolve();
    let runningVersion;

    try {
        const filePath = path.resolve(directory, '.nvmrc');
        const fileMetadata = await fs.promises.stat(filePath);
        const fileContent = fs.readFileSync(filePath, "utf8");
        let specVersion;

        if (fileMetadata) {
            specVersion = fileContent.startsWith("v") ? fileContent : `v${fileContent};`
            runningVersion = (await getRunningVersion()).trim();

            if (runningVersion.trim() !== specVersion.trim()) {
                console.log(chalk.red(`Your Node version ${runningVersion} does not match the specified version ${specVersion} \rfound in the .nvmrc file in your project root`)  );
                console.log('\n-------------\n');
                console.log(chalk.red('Run command "nvm use" followed by "npm ci" in your terminal before running "npm run start" again.\n'));
                process.exit(1);
            }
        }


    } catch (e) {
        if (e.code !== "ENOENT") {
            console.log(chalk.red('An unexpected error occurred while validating your Node version.\n'));
            console.error(e);
            process.exit(1);
        }
        console.log(chalk.red('Make sure the ".nvmrc" file from the Git repository is present in your project root directory\n'));
        console.error(e);
        process.exit(1);
    }
}

validateVersion();

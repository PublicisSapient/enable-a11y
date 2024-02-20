import savePage from './savePage.mjs';
import testHelpers from './test-helpers.mjs';

const { argv } = process;
let fileList = argv;



console.log(`HMMM: ${argv}`);

if (argv.length === 2) {
    fileList = testHelpers.getPageList();
} else {
    fileList.shift();
    fileList.shift();
}

console.log(`HMMM: ${fileList}`);

for (let i = 0; i < fileList.length; i++) {
    const file = fileList[i];
    await savePage(file);
    console.log('Saved page:', file);
}

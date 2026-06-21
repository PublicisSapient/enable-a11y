const fs = require('fs');
const fsExtra = require('fs-extra');

console.log('Running promote-node-modules-to-server.js');
console.log('clearing lib directory');
fsExtra.emptyDirSync('enable-node-libs');

// we must copy the needed node modules into the lib directory
const nodeFiles = [
    'node_modules/indent.js/lib/indent.min.js',
    'node_modules/glider-js/glider.js',
    'node_modules/glider-js/glider.css',
    'node_modules/text-zoom-event/dist/textZoomEvent.module.js',
    'node_modules/dialog-polyfill/index.js',
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/jquery-validation/dist/jquery.validate.min.js',
    'node_modules/accessibility-js-routines/dist/accessibility.module.js',
    'node_modules/wicg-inert/dist/inert.min.js',
    'node_modules/flatpickr/dist/flatpickr.min.js',
    'node_modules/flatpickr/dist/flatpickr.min.css',
    'node_modules/flatpickr/dist/esm/l10n/'
];

const isFileRe = /\.(js|css)$/;

nodeFiles.forEach((fullPath) => {
    
    const isDir = !(isFileRe.test(fullPath));

    const explodedPath = fullPath.split('/');
    let fileName = explodedPath.pop();
    let dir = explodedPath
        .join('/')
        .replace(/^node_modules\//, 'enable-node-libs/');
    console.log('dir', dir);

    if (!fs.existsSync(dir)) {
        fs.mkdirSync(dir, {
            recursive: true,
        });
    }

    const newPath = `${dir}/${fileName}`;
    console.log(`Copying ${isDir?"directory":"file"} ${fullPath} to ${newPath}.`);

    fs.cp(fullPath, newPath, {recursive: isDir}, (err) => {
        if (err) {
            throw err;
        } else {
            if (isDir) {
                console.log(`Directory ${fullPath} was copied to ${newPath}`);
            } else {
                console.log(`File ${fullPath} was copied to ${newPath}`);
            }
        }
    });
});

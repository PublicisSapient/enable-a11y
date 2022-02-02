const fs = require('fs');
const fsExtra = require('fs-extra')

console.log('clearing lib directory');
fsExtra.emptyDirSync('libs');


// we must copy the needed node modules into the lib directory
const nodeFiles = [
  'node_modules/indent.js/lib/indent.min.js',
  'node_modules/glider-js/glider.js',
  'node_modules/glider-js/glider.css',
  'node_modules/text-zoom-event/dist/textZoomEvent.module.js',
  'node_modules/dialog-polyfill/index.js',
  'node_modules/jquery/dist/jquery.min.js',
  'node_modules/jquery-validation/dist/jquery.validate.min.js',
  'node_modules/accessibility-js-routines/dist/accessibility.module.js'
]


nodeFiles.forEach((fullPath) => {
  const explodedPath = fullPath.split('/');
  let fileName = explodedPath.pop();
  let dir = explodedPath.join('/').replace(/^node_modules\//, 'libs/');
  console.log('dir', dir);
  
  if (!fs.existsSync(dir)) {
    fs.mkdirSync(dir, {
      recursive: true
    });
  }

  const newPath = `${dir}/${fileName}`;
  console.log(`Copying node module ${fullPath} to ${newPath}.`);

  fs.copyFile(fullPath, newPath, (err) => {
    if (err) {
      throw err;
    } else {
      console.log(`${fullPath} was copied to ${newPath}`);
    }
  })
});

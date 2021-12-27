const express = require('express');
const app = express();
const port = 8888;
const fs = require('fs');

// we must copy the needed node modules into the lib directory
const nodeFiles = [
  'node_modules/indent.js/lib/indent.min.js',
]


nodeFiles.forEach((fullPath) => {
  console.log(`Copying requireJS node module ${fullPath} to js/libs.`);

  let fileName = fullPath.split('/').pop();
  fs.copyFile(fullPath, `js/libs/${fileName}`, (err) => {
    if (err) throw err;
    console.log(`${fullPath} was not copied to js/libs`);
  })
})


// must specify options hash even if no options provided!
var phpExpress = require('php-express')({

    // assumes php is in your PATH
    binPath: 'php'
  });
  

// set view engine to php-express
app.set('views', './views');
app.engine('php', phpExpress.engine);
app.set('view engine', 'php');

// routing all .php file to php-express
app.all(/.+\.php$/, phpExpress.router);


// serve static files.
app.use(express.static('.'))

/* app.get('/', (req, res) => {
  res.send('Hello World!')
}) */

app.listen(port, () => {
  console.log(`Example app listening at http://localhost:${port}`)
})
const express = require('express');
const path = require('path')
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
var phpExpress = require('./php-express/index.js')({

    // assumes php is in your PATH
    binPath: 'php'
  });
  

// set view engine to php-express
app.set('views', './views');
app.engine('php', phpExpress.engine);
app.set('view engine', 'php');

app.get('/*.php', render)

function render(req, res) {

  phpExpress.engine(path.join(__dirname, '..', 'templates/main.php'), {
    method: req.method,
    get: req.query,
    post: req.body,
    server: {
      REQUEST_URI: req.url
    }
  }, (err, body) => {
    if (err) {
      res.status(500).send(err)
    } else {
      res.send(body);
    }
  });
}

// serve static files.
app.use(express.static('.'))

/* app.get('/', (req, res) => {
  res.send('Hello World!')
}) */

const server = app.listen(port  , function () {
  const port = server.address().port
  console.log('PHP Express server listening at http://%s:%s', 'localhost', port);
})
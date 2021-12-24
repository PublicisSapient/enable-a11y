const express = require('express');
const app = express();
const port = 8888;
var path = require('path');


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
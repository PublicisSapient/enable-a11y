const express = require('express');
const path = require('path');
const rewrite = require('express-urlrewrite');
const app = express();
const port = 8888;

let phpCmd = 'php';

// must specify options hash even if no options provided!
var phpExpress = require('./php-express/index.js')({
    // assumes php is in your PATH
    binPath: phpCmd,
});

// set view engine to php-express
app.set('views', '.');
app.engine('php', phpExpress.engine);
app.set('view engine', 'php');

// routing all things in /bin/ to phpExpress.
app.all(/\/services\/.+\.php$/, phpExpress.router);

// All things outside of bin goes through our template engine at template/main.php
app.get('/*.php', render);

/* GET home page. */
app.get('/', function (req, res) {
    res.redirect('./index.php');
});

function render(req, res) {
    phpExpress.engine(
        path.join(__dirname, '..', 'templates/main.php'),
        {
            method: req.method,
            get: req.query,
            post: req.body,
            server: {
                REQUEST_URI: req.url,
            },
        },
        (err, body) => {
            if (err) {
                res.status(500).send(err);
            } else {
                res.send(body);
            }
        },
    );
}

// redirect ~ urls to enable-node-libs
app.use(rewrite('/~*', '/enable-node-libs/$1'));

// serve static files.
app.use(express.static('.'));

const server = app.listen(port, function () {
    const port = server.address().port;
    console.log(
        'PHP Express server listening at http://%s:%s',
        'localhost',
        port,
    );
});

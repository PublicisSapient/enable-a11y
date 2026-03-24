var express = require('express'),
    http = require('http'),
    path = require('path'),

    phpExpress = require('../')({
        binPath: '/usr/bin/phpxw'
    });

var app = express();
app.set('port', process.env.PORT || 3000);

function setIsolationHeaders(res) {
  res.setHeader('Cross-Origin-Opener-Policy', 'same-origin');
  res.setHeader('Cross-Origin-Embedder-Policy', 'require-corp');
  // Often helpful for same-origin resources used under COEP
  res.setHeader('Cross-Origin-Resource-Policy', 'same-origin');
}

// Global middleware
app.use(function (req, res, next) {
  setIsolationHeaders(res);
  next();
});

app.use(express.bodyParser());

app.set('views', path.join(__dirname, 'views'));
app.engine('php', phpExpress.engine);
app.set('view engine', 'php');

// Static files
app.use(express.static(path.join(__dirname, 'public'), {
  setHeaders: function (res, filePath, stat) {
    setIsolationHeaders(res);
  }
}));

// If you serve node_modules directly, do it explicitly too
app.use('/node_modules', express.static(path.join(__dirname, 'node_modules'), {
  setHeaders: function (res, filePath, stat) {
    setIsolationHeaders(res);
  }
}));

// PHP routes
app.all(/.+\.php$/, function (req, res, next) {
  setIsolationHeaders(res);
  next();
}, phpExpress.router);

app.use(app.router);

http.createServer(app).listen(app.get('port'), function(){
  console.log('Express server listening on port ' + app.get('port'));
});
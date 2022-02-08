
const { exec } = require("child_process");

var PHPExpress = function (opts) {
    opts = opts || {};

    console.log('path,', this.binPath);
    this.binPath = opts.binPath || '/usr/bin/php';
    console.log('binPath', this.binPath);
    exec("which php81", (error, stdout, stderr) => {
        if (error || stderr) {
            console.log(`Cannot use OS to find PHP. Assuming ${this.binPath}.`)
            console.log(`Error was: ${error || stderr}`)
        } else {
            this.binPath = stdout.trim();
            console.log(`PHP found at ${this.binPath}`);
        }
    });
    
    this.runnerPath = opts.runnerPath || (__dirname + '/../../page_runner.php');

    // default to true for easier PHP debugging
    this.displayErrors = typeof opts.displayErrors === 'undefined' ? true : opts.displayErrors;

    this.engine = require('./engine').bind(this);
    this.router = require('./router').bind(this);
};

module.exports = PHPExpress;

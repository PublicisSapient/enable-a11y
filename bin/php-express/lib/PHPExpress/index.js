
const { exec } = require("child_process");

var PHPExpress = function (opts) {
    opts = opts || {};

    console.log('path,', this.binPath);
    this.binPath = opts.binPath || '/usr/bin/php';
    console.log('binPath', this.binPath);
    exec(`${__dirname}/../../../findPHP.sh`, (error, stdout, stderr) => {
        if (error || stderr) {
            console.log(`Cannot use OS to find PHP. Bailing.`)
            console.log(`Error was: ${error || stderr}`)
            process.exit(1);
        } else {
            const stdoutVal = stdout.trim();
            if (stdoutVal !== '') {
                this.binPath = stdoutVal;
            }
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

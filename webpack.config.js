const path = require('path');

module.exports = {
  entry: './js/webpack-modules/input-mask.js',
  output: {
    filename: 'input-mask.js',
    path: path.resolve(__dirname, './js/uswds/'),
    library: {
      type: 'module'
    },
  },
  optimization: {
    minimize: true
  },
  experiments: {
    outputModule: true
  }
};
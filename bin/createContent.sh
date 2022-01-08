const HTMLParser = require('node-html-parser');
const fs = require('fs');


const testFolder = '.';
fs.readdir(testFolder, (err, files) => {
  files.forEach(file => {
    if (file.match(/^[a-z]*.php$/)) {


      fs.readFile(file, 'utf8', function(err, data) {

        console.log(`File is ${file}`);
        if (err) throw err;
        
        try {
          const root = HTMLParser.parse(data);
          const head = root.querySelector('head');
          fs.writeFile(`content/head/${file}`, head, () => {
            if (err) return console.log(err);
            console.log(`writing head of ${file}`)
          });

          const body = root.querySelector('body');
          fs.writeFile(`content/body/${file}`, body, () => {
            if (err) return console.log(err);
            console.log(`writing body of ${file}`)
          });

        return
        } catch (ex) {
          console.log(`File ${file} is invalid.`);
        };
      });
    }
    



  });
});



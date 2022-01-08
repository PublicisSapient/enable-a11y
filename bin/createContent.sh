const HTMLParser = require('node-html-parser');
const fs = require('fs');


const testFolder = '.';
fs.readdir(testFolder, (err, files) => {
  files.forEach(file => {
    if (file.match(/^[a-zA-Z][\S]*.php$/)) {


      fs.readFile(file, 'utf8', function(err, data) {

        console.log(`File is ${file}`);
        if (err) throw err;
        
        try {
          const root = HTMLParser.parse(data);

          const links = root.querySelectorAll('head link, head style');
          const linkHTML = [];
          links.forEach((el) => {
            linkHTML.push(el.outerHTML);
          });
          fs.writeFile(`content/head/${file}`, linkHTML.join('\n'), () => {
            if (err) return console.log(err);
            console.log(`writing head of ${file}`)
          });

          try {
            console.log('MAIN:', root.querySelector('main').classList.length);
          } catch (ex) {
            console.log('ERROR', file);
          }

          const mainClass = root.querySelector('main').classList;
          console.log(`mainClass: ${mainClass}`);
          let body = root.querySelector('main').innerHTML.replace('<?php include "includes/pause-anim-control.php" ?>', '');
          
          if (mainClass.length > 0) {
            body = body.replace(/<h1>[\s\S]*<\/h1>/g, '<h1><?= $title ?></h1>  ');
            body = `<main class="${mainClass}">${body}</main>`;
          } else {

            body = body.replace(/<h1>[\s\S]*<\/h1>/g, '');
            body = `<main>${body}</main>`;
          }
          
          
          fs.writeFile(`content/body/${file}`, body, () => {
            if (err) return console.log(err);
            console.log(`writing body of ${file}`)
          }); 

          const scripts = root.querySelectorAll('body script:not([type="application/json"])');
          const scriptHTML = [];
          scripts.forEach((el) => {
            scriptHTML.push(el.outerHTML);
          });
          fs.writeFile(`content/bottom/${file}`, scriptHTML.join('\n'), () => {
            if (err) return console.log(err);
            console.log(`writing bottom of ${file}. Script elements ${scripts.length}`)
          });

        return
        } catch (ex) {
          console.log(ex  );
        };
      });
    }
    



  });
});



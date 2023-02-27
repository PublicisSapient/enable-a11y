# enable-a11y

A list of demos to show how aria roles function with screen readers.

## Set up

nvm: https://github.com/nvm-sh/nvm#usage  
npm: https://docs.npmjs.com/downloading-and-installing-node-js-and-npm  
vnu: https://www.npmjs.com/package/vnu-jar  
lynx: https://etc.usf.edu/techease/4all/web-accessibility/the-lynx-text-web-browser/  
php: https://www.php.net/downloads.php  
less: `npm install -g less-watch-compiler`  
MAMP (OSX) or Apache: https://www.mamp.info/en/mac/  
LAMP (Linux): https://www.linux.com/training-tutorials/easy-lamp-server-installation/

## Style Notes

1. All font-sizes are converted to rems. This is done via less.  If you want a font-size of 20px, then you would do the following:

```css
div {
    font-size: (20/@px);
}
```

The `@px` variable is set to 16rem, which is also the base font size

2. If we hide custom components and use CSS to create custom facades for them, we must ensure that these facades will be discoverable to users navigating by touch. For more information about being inclusive of users navigating by touch, please read Inclusively Hiding & Styling Checkboxes and Radio Buttons by Sara Soueidan. https://www.sarasoueidan.com/blog/inclusively-hiding-and-styling-checkboxes-and-radio-buttons/

## Tests

```bash
sudo npm install axe-cli -g
sudo npm install -g chromedriver
```

If there is a problem with running Chromedriver, because you have an error like "SessionNotCreatedError: session not created: This version of ChromeDriver only supports Chrome version XXX", then you should ensure your chromedriver is installed with the right version.

```bash
sudo npm install chromedriver --chromedriver_filepath=/path/to/chromedriver_mac64.zip
```

You can install the right zip file from here:

https://chromedriver.storage.googleapis.com/index.html

(you may need to change the `path` variable)

https://stackoverflow.com/questions/71859550/session-not-created-this-version-of-chromedriver-only-supports-chrome-version-9

## Adding An External NPM Module To The Front-End Code

If you are adding examples to this repository and need support of an external NPM module for the front-end (like a JS library), then you should add the library to the `nodeFiles` array in the file `promote-node-modules-to-server.js`.  

For example, when I added the `glider-js` library to Enable so I can use it in the Carousel demos, I added the files I needed for the front-end to `nodeFiles` with these two lines:

<pre>
const nodeFiles = [
  'node_modules/indent.js/lib/indent.min.js',
  <b>'node_modules/glider-js/glider.js',
  'node_modules/glider-js/glider.css',</b>
  'node_modules/text-zoom-event/dist/textZoomEvent.module.js',
  'node_modules/dialog-polyfill/index.js',
  'node_modules/jquery/dist/jquery.min.js',
  'node_modules/jquery-validation/dist/jquery.validate.min.js',
  'node_modules/accessibility-js-routines/dist/accessibility.module.js',
  'node_modules/wicg-inert/inert.min.js'
]
</pre>

When you start the project with `npm run server`, the files in the `nodeFiles` array will be placed in the `enable-node-libs` directory in the project root.  Use this directory to load the files in your scripts, css, or HTML files.


## References

https://www.nvaccess.org/files/nvda/documentation/userGuide.html  
https://dequeuniversity.com/screenreaders/survival-guide

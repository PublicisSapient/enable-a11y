'use strict'

import config from './test-config.mjs';
import fs from 'fs';
import puppeteer from 'puppeteer';

const browser = await puppeteer.launch();

function getContentsOfFile(filename) {
  let r;
  try {
    const data = fs.readFileSync(filename, 'utf8');
    r = data;
  } catch (err) {
    console.error(err);
    r = '';
  }
}

const changeImgTagSVGsTOSVGTags = (domEl) => {
  const svgImgEls = document.querySelectorAll('img[src$=".svg"]');
  const parser = new DOMParser();

  svgImgEls.forEach((el) => {
    const svgTag = document.createElement('svg');
    svgTag.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
    const file = el.getAttribute('href');
    const svgContent = svgTag.getContentsOfFile(file);
    const svgDOM = parser.parseFromString(svgContent, "text/html");
    const svgInnerHTML = svgDOM.innerHTML;
    svgTag.innerHTML = svgInnerHTML;
    
    el.replaceWith(svgTag);
  });

  return domEl;
} 

async function savePage(phpFilename) {
  let domInfo;
  const filename = phpFilename.split('.')[0] + '.html';

  // Load page and all its assets.
  const page = await browser.newPage();
  await page.goto(`${config.BASE_URL}/${phpFilename}`, {
    waitUntil: 'networkidle0',
  });
  
  domInfo = await page.evaluate((config, changeImgTagSVGsTOSVGTags) => {
    const htmlEl = document.querySelector('html');
    const headEl = document.querySelector('head');
    const bannerEl = document.querySelector('[role="banner"]');
    
    // Let's remove all stylesheets for no

    headEl.innerHTML += `
    <meta name="subject" content="PDF/UA all-in-one"/>
    <meta name="author" content="openhtmltopdf.com team"/>
    <meta name="description" content="An example containing everything for easy testing"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <style>
    body, body * {
      font-family: "Noto Sans" !important;
    }
    
    @page {
      body, body * {
        font-family: "Noto Sans" !important;
      }

      .enable-example {
        margin: 48px 0 !important;
      }
    }

    template, [role="banner"], footer, .  play-pause-anim__checkbox-container {
      display: none;
    }
    </style>`;

    bannerEl.parentNode.removeChild(bannerEl);
    changeImgTagSVGsTOSVGTags(htmlEl);

    return {
      html: htmlEl.outerHTML,
      imgs: document.querySelectorAll('img[src$=".svg"]').length
    }
  }, config, changeImgTagSVGsTOSVGTags);
  const { html, imgs } = domInfo;

  console.log('images', imgs);

  fs.writeFileSync(`tmp/${filename}`, `<!DOCTYPE html>\n${html}`);
}

export default savePage;
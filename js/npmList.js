"use strict";

import { interpolate } from "./modules/interpolate.js";

const getNPMModules = function () {
    const $npmList = document.getElementById('npm-list'); 
    const $npmListItemTemplate = document.getElementById('npm-list__list-item');
    const $npmListTemplate = document.getElementById('npm-list__list')
    let result = fetch('templates/data/meta-info.json');

    result.then(response => response.json()).then(function (response) {
        const listItemsHTML = [];
        console.log(response);
        for (let url in response) {
          const item = response[url];
          item.url = url;

          if (item.isNPM) {
            listItemsHTML.push(
              interpolate(
                $npmListItemTemplate.innerHTML,
                item
              )
            )
          }
        };

        $npmList.innerHTML = listItemsHTML.join('');

    }).catch(function (ex) {
       $npmList.innerHTML += `<span>Failed to get NPM module information.</span>.<pre>${ex}</pre></span>`;
       console.error(ex);
    });
}

getNPMModules();
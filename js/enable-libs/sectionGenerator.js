'use strict';

import { interpolate } from '../modules/interpolate.js';

const sectionGenerator = new function () {
    const page=location.href.split('/').pop().replace('-section.php', '').split('#')[0];
    const $sectionContent = document.getElementById("section-content");

    const getTemplates = () => {
        const r = [];
        const $templates = document.getElementsByTagName('template');
        Array.prototype.forEach.call(
            $templates,
            ((el) => {
                r[el.id] = el.innerHTML;
            })
        );

        return r;
    }

    const isOnPage = (item) => {
        const { sectionPages } = item;
        let r = false;

        if (sectionPages) {
            for (let i in sectionPages) {
                if (sectionPages[i][page]) {
                    r = true;
                    break;
                }
            }
        }
        return r;
    } 

    this.writeHTML = () => {
        let result = fetch('templates/data/meta-info.json');
        const templates = getTemplates();

        result
            .then((response) => response.json())
            .then((response) => {
                const itemsOnPage = [];
                const sectionPages = {};
                
                let subsectionsHTML = [];
                let sectionTOCHTML = '';
                let pageListHTML = '';
                let pageListItemsHTML = [];
                let pageListItemsContentHTML = [];
                let sectionLinksHTML = [];

                for (let url in response) {
                    const item = response[url];
                    item.url = url;
                    item.slug = url.replace('.php', '');
                    item.visibleTitle = item.shortTitle || item.title;

                    if (isOnPage(item)) {
                        itemsOnPage.push(item);

                        for (let i=0; i<item.sectionPages.length; i++) {
                            const section = item.sectionPages[i][page];
                            if (section !== undefined) {
                                if (!sectionPages[section]) {
                                    sectionPages[section] = [];
                                }

                                sectionPages[section].push(item);
                            }
                        }

                    }



                }

                /* For each section, write the pages on screen */
                for (let i in sectionPages) {

                    for (let j=0; j<sectionPages[i].length; j++) {
                        const { title, shortTitle, thumbFileType } = sectionPages[i][j];

                        sectionPages[i][j].page = page;
                        sectionPages[i][j].visibleTitle = shortTitle || title;
                        sectionPages[i][j].thumbFileType = thumbFileType || 'svg';
                        
                        pageListItemsContentHTML.push(interpolate(
                            templates['page-list-item'],
                            sectionPages[i][j],
                            {
                                entifyParams: false
                            }
                        ));


                        /* sectionLinksHTML.push(interpolate(
                            templates['section-link'], 
                            sectionPages[i][j], 
                            {
                                entifyParams: false
                            }
                        )); */
                    }

                    /* subsectionsHTML.push(interpolate(
                        templates['section-subsection'],
                        {  
                            subsectionTitle: i,
                            subsectionLinks: sectionLinksHTML.join('')
                        }, {
                            entifyParams: false
                        }
                    )) */


                    pageListItemsHTML.push(interpolate(
                        templates['page-list__heading'],
                        {  
                            headingText: i,
                            content: pageListItemsContentHTML.join('')
                        }, {
                            entifyParams: false,
                        }
                    ));
                    sectionLinksHTML = [];
                    pageListItemsContentHTML = [];
                }
                /* sectionTOCHTML = interpolate(
                    templates['section-table-of-contents'],
                    {
                        subsections: subsectionsHTML.join('')
                    }, {
                        entifyParams: false
                    }
                ); */
                pageListHTML = interpolate(
                    templates['page-list'],
                    {
                        content: pageListItemsHTML.join('')
                    },
                    {
                        entifyParms: false
                    }
                );

                $sectionContent.innerHTML = sectionTOCHTML + pageListHTML;


                // If callback exists, call it
                if (this.callback) {
                    this.callback();
                }
            })
            .catch(function (ex) {
                $sectionContent.innerHTML += `<span>Failed to get NPM module information.</span>.<pre>${ex}</pre></span>`;
                console.error(ex);
            });

        }


    this.init = (callback) => {
        this.callback = callback;
        this.writeHTML();
    }
}


export default sectionGenerator;
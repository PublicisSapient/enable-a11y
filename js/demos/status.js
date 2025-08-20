import showcode from '../enable-libs/showcode.js';

const dictLookup = new (function () {
    const baseURL = './services/lookupWord.php?word=';

    const $pageTitle = document.querySelector('.wiktionary-lookup__page-title');
    const $wikiInfo = document.querySelector('.wiktionary-lookup__content');
    const $wikiInfoContainer = document.querySelector(
        '.wiktionary-lookup__content-container',
    );

    const $licenceInfo = document.querySelector(
        '.wiktionary-lookup__license-info',
    );
    const $lookupForm = document.querySelector('.wiktionary-lookup__form');
    const $word = document.querySelector('.wiktionary-lookup__word');
    const $pageStatus = document.querySelector('.wiktionary-lookup__page-status');

    function showPage(page, text) {
        $pageTitle.innerHTML = page;
        $wikiInfo.innerHTML = text;
        $licenceInfo.style.display = 'block';
        $pageStatus.innerHTML = `Now displaying information about the word "${page}".`;

        // now you can modify content of #wikiInfo as you like

        document
            .querySelectorAll('.wiktionary-lookup__content a')
            .forEach((el) => {
                const href = el.getAttribute('href');
                if (href.indexOf('/wiki/') === 0) {
                    el.href = 'https://en.wiktionary.org' + href;
                }
            });
        // ...
    }

    function showMessage(msg) {
        $wikiInfo.innerHTML = msg;
        $pageStatus.innerHTML = msg;
        $licenceInfo.style.display = 'block';
        $pageTitle.innerHTML = 'Not Found';
    }

    this.init = () => {
        $pageTitle.style.display = 'none';
        $lookupForm.addEventListener('submit', function (e) {
            const word = $word.value;
            const $msg = `<p>Please wait .. looking up "${word}".</p>`;
            e.preventDefault();
            $wikiInfo.innerHTML = $msg;
            $pageStatus.innerHTML = $msg;
            fetch(baseURL + word).then((response) => {
                if (response.status === 200) {
                    $wikiInfoContainer.classList.add(
                        'wiktionary-lookup__content-container--is-loaded',
                    );
                    response.json().then((json) => {
                        console.log(json)
                        if (json ) {
                            if (json.error) {
                                showMessage(`<p>Unable to lookup word.  An error has occured.</p>
                                    <!--
                                        ${json.error.trim()}
                                    -->
                                `);
                            } else if (json.parse && json.parse.revid > 0) {
                                showPage(word, json.parse.text['*']);
                            }
                        } else {
                            showMessage(`<p>Unable to find any information about "${word}".</p>`);
                            
                            
                        }
                    });
                }
            });
        });
    };
})();

dictLookup.init();

showcode.addJsObj('dictLookup', dictLookup);

<div role="banner" id="website-banner">

    <!-- Links ouside of the hamburger menu -->
    <div id="non-hamburger-ctas">
      <!-- Skip Link -->
      <div class="enable-mobile-visible-on-focus__container enable-skip-link--begin">
          <a href="#main" id="beginning-of-nav" class="enable-mobile-visible-on-focus enable-skip-link">
              Skip to Main Content
          </a>
      </div>

      <!-- Enable Logo (link to homepage) -->
      <?php include "includes/logo-link.php"; ?>
    </div>


    <!-- Main search bar -->
    <div id="search-example-2" class="search-example-2">
        <form autocomplete="off" class="search-bar" role="search" tabindex="-1">
            <div class="search">
            <label for="search-input" class="sr-only">Search:</label>
            <input id="search-input" autocomplete="off" type="text" class="search-input" placeholder="What are you looking for?">
    
            <button type="submit" class="search-button">
                <img class="search__icon" src="images/search.svg" alt="Search">
            </button>

            <ul id="search-results" class="autocomplete-list" role="listbox" aria-labelledby="search-input">
            </ul>
            

            <!-- <div id="autocomplete" class="autocomplete" style="width:300px;">
                <input id="search-input" type="text" class="search__term" placeholder="What are you looking for?">
                <div id="autocomplete-items" class="autocomplete-items"></div>
            </div> -->
        </div>
        </form>
        
    </div>


        <!-- <div class="stork-wrapper">
            <input data-stork="federalist" class="stork-input" />
            <div data-stork="federalist-output" class="stork-output"></div>
            </div>
         -->


    <!-- Here is the main menu will be placed by our global.js Javascript -->
    <div id="enable-flyout-menu" data-component="EnableFlyout" data-props-id="flyout-props">

    </div>

    <!--  HTML Templates that the Flyout menu uses  -->
    
    <template id="flyout__root">
        <ul class="enable-flyout__list">
            ${html:content}
        </ul>
    </template>

    <template id="flyout__submenu">
        <ul class="enable-flyout__list  enable-flyout__list--photo-layout">
            <li class="enable-flyout__menu-item enable-flyout__menu-item--close">
                <button class="enable-flyout__close-level-button">
                    Go Back
                </button>
            </li>

            ${html:content}
        </ul>
    </template>

    <template id="flyout__button">
        <li class="enable-flyout__menu-item">
            <!-- Begin section ${sectionName} -->
            <button aria-expanded="false" aria-controls="${id}-section" class="enable-flyout__open-level-button">
                ${sectionName}
            </button>
            <div id="${id}-section" aria-label="${sectionName}" role="group"
                class="enable-flyout enable-flyout__level enable-flyout__dropdown">
                <button class="enable-flyout__hamburger-icon-facade">
                    <span class="sr-only">
                        close mobile flyout
                    </span>
                </button>
                <ul class="enable-flyout__list my-custom-list__layout ${classes}">
                    <li class="enable-flyout__menu-item enable-flyout__menu-item--close">
                        <button class="enable-flyout__close-level-button">
                            Go Back
                        </button>
                    </li>

                    <!-- Start menu items for section ${sectionName} -->
                    ${html:content}
                </ul>
            </div>
        </li>
    </template>

    <template id="flyout__home-mobile-only">
        <li class="enable-flyout__menu-item">
            <a href="index.php" class="enable-flyout__link enable-flyout__with-home-icon mobile-and-tablet">
                Home
            </a>
        </li>
    </template>

    <template id="flyout__link">
        <li class="enable-flyout__menu-item">
            <a href="${url-slug}.php" class="enable-flyout__link">
                <picture>
                    <source srcset="images/main-menu/${url-slug}.webp" type="image/webp">
                    <img src="${url-slug}.png" alt="${alt}" class="enable-flyout__link-image" />
                </picture>
                ${label}
            </a>
        </li>
    </template>

    <template id="flyout__link--no-image">
        <li class="enable-flyout__menu-item ${listItemClasses}">
            <a href="${url}" class="enable-flyout__link">
                ${label}
            </a>
        </li>
    </template>

    <template id="flyout__link--with-icon">
        <li class="enable-flyout__menu-item">
            <a href="${url}" class="enable-flyout__link">
                <img alt="${alt}" src="${src}">
                ${label}
            </a>
        </li>
    </template>

    <template id="flyout__heading">
        <div class="enable-flyout__level-heading">${label}</div>
    </template>

    <template id="flyout__subsection">
        <li class="enable-flyout__menu-item">
            <!-- Begin section ${sectionName} -->
            <button aria-expanded="false" aria-controls="${id}-subsection" class="enable-flyout__open-level-button">
                ${sectionName}
            </button>
            <div class="enable-flyout__level-heading">${sectionName}</div>
            <div id="${id}-subsection" aria-label="${sectionName}" role="group"
                class="enable-flyout enable-flyout__level enable-flyout__dropdown">
                <button class="enable-flyout__hamburger-icon-facade">
                    <span class="sr-only">
                        close mobile flyout
                    </span>
                </button>
                <ul class="enable-flyout__list enable-flyout__list--photo-layout">
                    <li class="enable-flyout__menu-item enable-flyout__menu-item--close">
                        <button class="enable-flyout__close-level-button">
                            Go Back
                        </button>
                    </li>

                    <!-- Start menu items for section ${sectionName} -->
                    ${html:content}
                </ul>
            </div>
        </li>
    </template>

    <template id="flyout__container">
        <nav class="site__nav enable-flyout__container" aria-label="main">
            <button aria-label="main menu" class="enable-flyout__open-menu-button" aria-expanded="false"
                aria-controls="mobile-menu">

                <!-- This is the hamburger menu icon -->

                <span class="enable-flyout__hamburger-icon">
                    <span>
                    </span>
                    <span>
                    </span>
                    <span>
                    </span>
                    <span>
                    </span>
                </span>
            </button>
            <div id="mobile-menu" class="enable-flyout enable-flyout__top-level enable-flyout__level">
                <button class="enable-flyout__hamburger-icon-facade">
                    <span class="sr-only">
                        close mobile flyout
                    </span>
                </button>

                <!-- Here is where the content is placed -->
                ${html:content}

            </div>
        </nav>
        <span class="enable-flyout__overlay-screen">
        </span>
    </template>

    <style>


    .search-button {
        width: 28px;
        height: 100%;
        border: 1px solid #4e7963;
        background: #4e7963;
        text-align: center;
        color: #fff;
        border-radius: 0 5px 5px 0;
        cursor: pointer;
        margin: 0 !important;
        position: relative;
        left: -4px;
    }

    .search {


    }

    .search-input {
        padding: 5px;

    }

    .search-bar{
        display: flex;
    }

    .search-bar-home {
        padding: 1ex .5em;
        width: 20em;
        font-size: 1.3rem;
        line-height: 1;
        background: #fff;
        border: 1px solid #d5d5d5;
        border-radius: 2px;
        box-shadow: inset 0 5px 5px -5px rgba(0, 0, 0, 0.2);
        box-sizing: border-box;

    }
        
   .autocomplete {
    /*the container must be positioned relative:*/
    position: relative;
    
    }

    .search-example-2{
        position: relative;
        left: 0;
        width:20em;
    }

    .autocomplete-items {
        position: absolute;
        border: 1px solid #d4d4d4;
        border-bottom: none;
        border-top: none;
        z-index: 999999999999999999999999999999999;
        /*position the autocomplete items to be the same width as the container:*/
        top: 100%;
        left: 0;
        right: 0;
    }

    .autocomplete-list{
        
        position: absolute;
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        /* border-bottom: 1px solid #d5d5d5; */
        border-top: none;
        background-color: #fff;
        list-style: none;
        width: 12.5em;
        z-index: 999999999999999999999999999999999;
    }

    .autocomplete-list li {
        color: black;
        padding: 10px;
        border-bottom: 1px solid #d5d5d5;
    }

    #search-results{
        /* display: none; */
    }

    .search-results {
        
        padding:50;
        border-top: 1px solid red;
        border-top: none;
        max-height: 200px;
        overflow-y: auto;
        position: relative;
        background-color: #fff;
        z-index: 99999999999999999999999;
        top: 100%; /* Position directly below the search input */
        left: 0; /* Align with the left edge of the search input */
        width: 100%; /* Match the width of the search input */
        list-style: none; /* Remove default list styling */
        border-radius: 5px 0 0 5px;
    }



    .autocomplete-list a {
        text-decoration: none;
    }
    
    .autocomplete-items div {
    padding: 10px;
    cursor: pointer;
    background-color: #fff;
    border-bottom: 1px solid #d4d4d4;
    }
    .autocomplete-list a:hover {
    /*when hovering an item:*/
    background-color: #e9e9e9;
    }
    .autocomplete-active {
    /*when navigating through the items using the arrow keys:*/
    background-color: DodgerBlue !important;
    color: #ffffff;
    }

    
</style>

    <!-- id, props, content -->
    <script src="node_modules/flexsearch/dist/flexsearch.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/minisearch@7.1.0/dist/umd/index.min.js"></script>
    <!-- <script src="https://files.stork-search.net/releases/v1.6.0/stork.js"></script>
            <script>
            stork.register(
                'federalist',
                'https://files.stork-search.net/releases/v1.6.0/federalist.st'
            ) -->
            </script>
    <!-- <script type = "module">

        /// Step 1: Example data this needs to be extracted from website in this form final result is shown here
        const documents = [
            { id: '1', title: 'Sample Title 1', description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' },
            { id: '2', title: 'Sample Title 2', description: 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.' },
            // Add more documents as needed
        ];

        // Step 2: Adding index/document to the library
        var index = new FlexSearch.Document({
            tokenize: "forward",
            cache: 100,
            document: {
                id: 'id',
                store: [
                    "title", "description"
                ],
                index: ["title", "description"]
            }
        });
    
        documents.forEach(item => {
            index.add({
                id: item.id,
                title: item.title,
                description: item.description
            });
        });
    
        
        // Step 3: Searching
        const query = 'sample'; // Example search query
        const results = index.search(query);

        console.log('Results here')
    
        // Step 4: Display search results
        console.log(results);

    </script> -->
    <script src="js/demos/search.js" type="module"></script>
    <script id="flyout-props" type="application/json">
    {
        "content": [{
            "id": "flyout__container",
            "content": [{
                "id": "flyout__root",
                "content": [{
                        "id": "flyout__home-mobile-only"
                    },
                    {
                        "id": "flyout__link--no-image",
                        "props": {
                            "label": "FAQ",
                            "url": "faq.php"
                        }
                    },
                    {
                        "id": "flyout__link--no-image",
                        "props": {
                            "label": "Accessible Code Quality",
                            "url": "code-quality.php"
                        }
                    },
                    {
                        "id": "flyout__link--no-image",
                        "props": {
                            "label": "Credits",
                            "url": "acknowledgements.php"
                        }
                    },
                    {
                        "id": "flyout__link--no-image",
                        "props": {
                            "label": "Bookmarklets",
                            "url": "bookmarklets.php",
                            "listItemClasses": "enable-flyout__last-top-level-link"
                        }
                    },

                    {
                        "id": "flyout__button",
                        "props": {
                            "id": "forms",
                            "sectionName": "Forms"
                        },
                        "content": [{
                                "id": "flyout__subsection",
                                "props": {
                                    "id": "form-controls",
                                    "sectionName": "Form Elements"
                                },
                                "content": [{
                                        "id": "flyout__link",
                                        "props": {
                                            "label": "Button",
                                            "url-slug": "button",
                                            "alt": ""
                                        }
                                    },
                                    {
                                        "id": "flyout__link",
                                        "props": {
                                            "label": "Checkboxes",
                                            "url-slug": "checkbox",
                                            "alt": ""
                                        }
                                    },
                                    {
                                        "id": "flyout__link",
                                        "props": {
                                            "label": "Radio Button Group",
                                            "url-slug": "radiogroup",
                                            "alt": ""
                                        }
                                    },
                                    {
                                        "id": "flyout__link",
                                        "props": {
                                            "label": "Select Box / Listbox",
                                            "url-slug": "listbox",
                                            "alt": ""
                                        }
                                    },
                                    {
                                        "id": "flyout__link",
                                        "props": {
                                            "label": "Textbox",
                                            "url-slug": "textbox",
                                            "alt": ""
                                        }
                                    },
                                    {
                                        "id": "flyout__link",
                                        "props": {
                                            "label": "Autocomplete Combobox",
                                            "url-slug": "combobox",
                                            "alt": ""
                                        }
                                    },
                                    {
                                        "id": "flyout__link",
                                        "props": {
                                            "label": "Slider / Range Input",
                                            "url-slug": "slider",
                                            "alt": ""
                                        }
                                    },
                                    {
                                        "id": "flyout__link",
                                        "props": {
                                            "label": "Accessible Numeric Fields",
                                            "url-slug": "spinner",
                                            "alt": ""
                                        }
                                    }
                                ]
                            },
                            {
                                "id": "flyout__subsection",
                                "props": {
                                    "id": "form-ux-patterns",
                                    "sectionName": "Form UX Patterns"
                                },
                                "content": [{
                                        "id": "flyout__link",
                                        "props": {
                                            "label": "Accessible Form Structure",
                                            "url-slug": "form",
                                            "alt": ""
                                        }
                                    }, {
                                        "id": "flyout__link",
                                        "props": {
                                            "label": "Accessible Form Validation",
                                            "url-slug": "form-error-checking",
                                            "alt": ""
                                        }
                                    }, {
                                        "id": "flyout__link",
                                        "props": {
                                            "label": "Search Forms",
                                            "url-slug": "search",
                                            "alt": ""
                                        }
                                    },
                                    {
                                        "id": "flyout__link",
                                        "props": {
                                            "label": "Input Masking",
                                            "url-slug": "input-mask",
                                            "alt": ""
                                        }
                                    }

                                ]

                            }
                        ]
                    }, {
                        "id": "flyout__button",
                        "props": {
                            "id": "controls",
                            "sectionName": "Controls"
                        },
                        "content": [{
                                "id": "flyout__subsection",
                                "props": {
                                    "id": "simple-controls",
                                    "sectionName": "Simple Controls"
                                },
                                "content": [{
                                        "id": "flyout__link",
                                        "props": {
                                            "label": "Link",
                                            "url-slug": "link",
                                            "alt": ""
                                        }
                                    },
                                    {
                                        "id": "flyout__link",
                                        "props": {
                                            "label": "Dropdown / Drawer / Expando",
                                            "url-slug": "dropdown",
                                            "alt": ""
                                        }
                                    },
                                    {
                                        "id": "flyout__link",
                                        "props": {
                                            "label": "Tooltip",
                                            "url-slug": "tooltip",
                                            "alt": ""
                                        }
                                    },
                                    {
                                        "id": "flyout__link",
                                        "props": {
                                            "label": "Switch / Toggle",
                                            "url-slug": "switch",
                                            "alt": ""
                                        }
                                    },
                                    {
                                        "id": "flyout__link",
                                        "props": {
                                            "label": "Skip Links",
                                            "url-slug": "skip-link",
                                            "alt": ""
                                        }
                                    }
                                ]
                            },
                            {
                                "id": "flyout__subsection",
                                "props": {
                                    "id": "complex-controls",
                                    "sectionName": "Complex Controls"
                                },
                                "content": [

                                    {
                                        "id": "flyout__link",
                                        "props": {
                                            "label": "Carousel",
                                            "url-slug": "carousel",
                                            "alt": ""
                                        }
                                    },
                                    {
                                        "id": "flyout__link",
                                        "props": {
                                            "label": "Flyout Hamburger Menu",
                                            "url-slug": "multi-level-hamburger-menu",
                                            "alt": ""
                                        }
                                    },
                                    {
                                        "id": "flyout__link",
                                        "props": {
                                            "label": "Modal Dialog",
                                            "url-slug": "dialog",
                                            "alt": ""
                                        }
                                    },
                                    {
                                        "id": "flyout__link",
                                        "props": {
                                            "label": "Tablist",
                                            "url-slug": "tabs",
                                            "alt": ""
                                        }
                                    }, {
                                        "id": "flyout__link",
                                        "props": {
                                            "label": "Video Player",
                                            "url-slug": "video-player",
                                            "alt": ""
                                        }
                                    }
                                ]
                            }
                        ]
                    },
                    {
                        "id": "flyout__button",
                        "props": {
                            "id": "content",
                            "sectionName": "Content",
                            "classes": "enable-flyout__list--photo-layout"
                        },
                        "content": [{
                            "id": "flyout__subsection",
                            "props": {
                                "id": "static-content",
                                "sectionName": "Static Content"
                            },
                            "content": [{
                                    "id": "flyout__link",
                                    "props": {
                                        "label": "Description List",
                                        "url-slug": "description-list",
                                        "alt": ""
                                    }
                                },
                                {
                                    "id": "flyout__link",
                                    "props": {
                                        "label": "Image",
                                        "url-slug": "img",
                                        "alt": ""
                                    }
                                }, {
                                    "id": "flyout__link",
                                    "props": {
                                        "label": "Infographic",
                                        "url-slug": "infographic",
                                        "alt": ""
                                    }
                                }, {
                                    "id": "flyout__link",
                                    "props": {
                                        "label": "Figure",
                                        "url-slug": "figure",
                                        "alt": ""
                                    }
                                }, {
                                    "id": "flyout__link",
                                    "props": {
                                        "label": "Headings",
                                        "url-slug": "heading",
                                        "alt": ""
                                    }
                                }, {
                                    "id": "flyout__link",
                                    "props": {
                                        "label": "Meter",
                                        "url-slug": "meter",
                                        "alt": ""
                                    }
                                },
                                {
                                    "id": "flyout__link",
                                    "props": {
                                        "label": "Progress Bar",
                                        "url-slug": "progress",
                                        "alt": ""
                                    }
                                }, {
                                    "id": "flyout__link",
                                    "props": {
                                        "label": "Screen Reader Only Text",
                                        "url-slug": "screen-reader-only-text",
                                        "alt": ""
                                    }
                                }, {
                                    "id": "flyout__link",
                                    "props": {
                                        "label": "Reflow Content",
                                        "url-slug": "reflow",
                                        "alt": ""
                                    }
                                }

                            ]
                        }, {
                            "id": "flyout__subsection",
                            "props": {
                                "id": "animated-content",
                                "sectionName": "Animated Content"
                            },
                            "content": [{
                                "id": "flyout__link",
                                "props": {
                                    "label": "Animated GIF/WEBP",
                                    "url-slug": "animated-gif-with-pause-button",
                                    "alt": ""
                                }
                            }, {
                                "id": "flyout__link",
                                "props": {
                                    "label": "Pause All Animations Control",
                                    "url-slug": "pause-anim-control",
                                    "alt": ""
                                }
                            }, {
                                "id": "flyout__link",
                                "props": {
                                    "label": "Mulitmedia Content",
                                    "url-slug": "multimedia-content",
                                    "alt": ""
                                }
                            }]
                        }, {
                            "id": "flyout__subsection",
                            "props": {
                                "id": "tables",
                                "sectionName": "Tables"
                            },
                            "content": [{
                                "id": "flyout__link",
                                "props": {
                                    "label": "Simple Table Examples",
                                    "url-slug": "table",
                                    "alt": ""
                                }
                            }, {
                                "id": "flyout__link",
                                "props": {
                                    "label": "Sortable Table",
                                    "url-slug": "sortable-table",
                                    "alt": ""
                                }
                            }, {
                                "id": "flyout__link",
                                "props": {
                                    "label": "Pagination Table",
                                    "url-slug": "pagination-table",
                                    "alt": ""
                                }
                            }]
                        }]
                    },
                    {
                        "id": "flyout__button",
                        "props": {
                            "id": "code-patterns",
                            "sectionName": "Code Patterns"
                        },
                        "content": [{
                            "id": "flyout__subsection",
                            "props": {
                                "id": "focus-management",
                                "sectionName": "Focus Management"
                            },
                            "content": [{
                                "id": "flyout__link",
                                "props": {
                                    "label": "Accessible Form Validation",
                                    "url-slug": "form-error-checking",
                                    "alt": ""
                                }
                            }, {
                                "id": "flyout__link",
                                "props": {
                                    "label": "Focus Styling Tips",
                                    "url-slug": "focus-styling",
                                    "alt": ""
                                }
                            }]
                        }, {
                            "id": "flyout__subsection",
                            "props": {
                                "id": "typography",
                                "sectionName": "Typography"
                            },
                            "content": [{
                                    "id": "flyout__link",
                                    "props": {
                                        "label": "Basic Resizable Text",
                                        "url-slug": "text-resize",
                                        "alt": ""
                                    }
                                }, {
                                    "id": "flyout__link",
                                    "props": {
                                        "label": "Accessible Text Spacing",
                                        "url-slug": "text-spacing",
                                        "alt": ""
                                    }
                                }, {
                                    "id": "flyout__link",
                                    "props": {
                                        "label": "Resizing Text in Hero Images",
                                        "url-slug": "hero-image-text-resize",
                                        "alt": ""
                                    }
                                }, {
                                    "id": "flyout__link",
                                    "props": {
                                        "label": "Accessible Text in SVGs",
                                        "url-slug": "accessible-text-svg",
                                        "alt": ""
                                    }
                                }, {
                                    "id": "flyout__link",
                                    "props": {
                                        "label": "Exposing Style Information To Screen Readers",
                                        "url-slug": "exposing-style-info-to-screen-readers",
                                        "alt": ""
                                    }
                                }

                            ]
                        }, {
                            "id": "flyout__subsection",
                            "props": {
                                "id": "aria-live-regions",
                                "sectionName": "ARIA Live Regions"
                            },
                            "content": [{
                                "id": "flyout__link",
                                "props": {
                                    "label": "Alert",
                                    "url-slug": "alert",
                                    "alt": ""
                                }
                            }, {
                                "id": "flyout__link",
                                "props": {
                                    "label": "Log",
                                    "url-slug": "log",
                                    "alt": ""
                                }
                            }, {
                                "id": "flyout__link",
                                "props": {
                                    "label": "Timer",
                                    "url-slug": "timer",
                                    "alt": ""
                                }
                            }, {
                                "id": "flyout__link",
                                "props": {
                                    "label": "Marquee / Auto-Scrolling Content",
                                    "url-slug": "marquee",
                                    "alt": ""
                                }
                            }, {
                                "id": "flyout__link",
                                "props": {
                                    "label": "Status",
                                    "url-slug": "status",
                                    "alt": ""
                                }
                            }]
                        }]
                    }
                ]
            }]
        }]
    }
    </script>


</div>

    
        
            <div class="wiktionary-lookup__page-alert sr-only" role="alert" aria-live="polite">

            </div>
            <div class="wiktionary-lookup__content"></div>
            <div class="wiktionary-lookup__license-info" style="font-size: small; display: none">
                Modified original content <a class="wiktionary-lookup__source-url">from Wiktionary</a>. Content is
                available
                under the
                <a href="http://creativecommons.org/licenses/by-sa/3.0/">Creative Commons Attribution/Share-Alike
                    License</a>.
            </div>
        </div>


        <?php includeShowcode("visually-hidden-example")?>

        <script type="application/json" id="visually-hidden-example-props">
        {
            "replaceHtmlRules": {
                "this": "that"
            },
            "steps": [{
                    "label": "Add role of alert",
                    "highlight": "role",
                    "notes": ""
                },
                {
                    "label": "Add aria-live level",
                    "highlight": "aria-live",
                    "notes": "This should be set to <strong>polite</strong> if you want it to be announced after the screen reader is finished announcing other things, or <strong>assertive</strong> if you want the screen reader to interrupt what it is currently saying to state the message inside.  The latter should only be used sparingly."
                },
                {
                    "label": "Hide the alert with <code>sr-only</code> class",
                    "highlight": "sr-only",
                    "notes": "This is a standard class that hides items visually but allows screen readers to access them."
                },
                {
                    "label": "CSS for sr-only",
                    "highlight": "%CSS%all-css ~ .sr-only",
                    "notes": "This is the sr-only class we use in the Enable project. There are several variations of this available on the web."
                },
                {
                    "label": "use .innerHTML to update the live region",
                    "highlight": "%JS% dictLookup ||| const \\$pageAlert[^;]*; ||| \\$pageAlert.innerHTML[^;]*;",
                    "notes": ""
                }

            ]
        }
        </script>

    
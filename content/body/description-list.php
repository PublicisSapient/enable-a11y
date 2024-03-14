
    
        

       

        <p>Description lists used to be called definition lists.  They used to be used when defining a list of related items (e.g. like the list of movie monsters below).  In the HTML5 era, its semantic definition is a lot more broad and is now used to give descriptions to a list of related items.</p>

        <h2>A HTML Description List</h2>

        <p>Definition lists are just name/value pairs, marked up with the <code>&lt;dt&gt;</code> and <code>&lt;dd</code> tags, respectively.
        Note that, unlike the ARIA version, there is no group tag around the name value pairs.</p>

        <?php includeStats(array('isForNewBuilds' => true)) ?>
        
        <div id="html5-def-list-example" class="enable-example">
            <dl>
                <dt>Gojira:</dt>
                <dd>A japanese kaiju monster created in the 1960s.</dd>

                <dt>Frankenstein:</dt>
                <dd>A fictional doctor that created a fictional being out of the spare parts of dead people.</dd>

                <dt>8-man:</dt>
                <dd>A manga featuring a robot whose brain is filled of the memories of a cop gunned down in action. Predates Robocop
                    by at least 20 years.</dd>
            </dl>
        </div>

        <?php includeShowcode("html5-def-list-example")?>

        <script type="application/json" id="html5-def-list-example-props">
        {
            "replaceHtmlRules": {
            },
            "steps": [{
                "label": "Use <code>dl</code> tag to encapsulate the whole list",
                "highlight": "%OPENCLOSETAG%dl",
                "notes": "The <code>dl</code> stands for <strong>description list</strong>.  It was changed from <a href=\"http://html5doctor.com/the-dl-element/\">its previous name of definition list in HTML4</a>"
            },
            {
                "label": "Each description term is encapsulated in a <code>dt</code> ",
                "highlight": "%OPENCLOSECONTENTTAG%dt",
                "notes": ""
            },
            {
                "label": "All of a description term's detail is encapsulated in the <code>dd</code> tag.",
                "highlight": "%OPENCLOSECONTENTTAG%dd",
                "notes": ""                
            }]
        }
        </script>

        <h2>Aria Roles example</h2>

        <?php includeStats(array('isForNewBuilds' => false)) ?>

        <p>This is the ARIA equivalent of the definition list.  While I do like the semantic addition of the <code>listitem</code> role to group the name/value pairs, it is still best to use the native HTML5 definition lists.</p>

        <div id="aria-def-list-example" class="enable-example">
            <div class="dl" role="list">
                <div role="listitem">
                    <div role="term">Gojira:</div>
                    <div role="definition">A japanese kaiju monster created in the 1960s.</div>
                </div>

                <div role="listitem">
                    <div role="term">Frankenstein:</div>
                    <div role="definition">A fictional doctor that created a fictional being out of the spare parts of dead people.</div>
                </div>

                <div role="listitem">
                    <div role="term">8-man:</div>
                    <div role="definition">A manga featuring a robot whose brain is filled of the memories of a cop gunned down in action. Predates
                        Robocop by at least 20 years.</div>
                </div>
            </div>
        </div>

        <?php includeShowcode("aria-def-list-example")?>

        <script type="application/json" id="aria-def-list-example-props">
        {
            "replaceHtmlRules": {
            },
            "steps": [{
                "label": "Use <code>list</code> role to encapsulate the whole list",
                "highlight": "role=\"list\"",
                "notes": ""
            },
            {
                "label": "Each description term is encapsulated in a tag with the <code>term</code> role",
                "highlight": "role=\"term\"",
                "notes": ""
            },
            {
                "label": "All of a description term's detail is encapsulated in a tag with the role of <code>definition</code>.",
                "highlight": "role=\"definition\"",
                "notes": ""                
            }]
        }
        </script>
    
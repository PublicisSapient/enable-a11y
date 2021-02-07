        <p>
            Below is the HTML of the above example.  Use the dropdown
            to hilight each of the individual steps that makes the 
            example accessible.
        </p>
        
        <div id="<?php echo $id ?>__steps" class="showcode__steps"></div>

        <div
            id="<?php echo $id ?>__notes"
            class="showcode__notes"
            role="alert"
            aria-live="assertive"
        ></div>

        <pre class="showcode__example"><code
                data-showcode-id="<?php echo $id ?>"
                data-showcode-props="<?php echo $id ?>-props"
                
            >
            </code>
        </pre>
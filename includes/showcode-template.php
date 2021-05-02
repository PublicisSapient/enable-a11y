        
        <p>
            Below is the HTML of the above example.  Use the dropdown
            to highlight each of the individual steps that makes the 
            example accessible.
        </p>
        
        <div class="showcode">
            <form class="showcode__ui">
                <div id="<?php echo $id ?>__steps" class="showcode__steps"></div>

                <div
                    id="<?php echo $id ?>__notes"
                    class="showcode__notes"
                    role="alert"
                    aria-live="assertive"
                ></div>

                <div class="showcode__example--desc">
                    ☜ Swipe to see full source  ☞
                </div>
            </form>
            <pre class="showcode__example"><code
                    data-showcode-id="<?php echo $id ?>"
                    data-showcode-props="<?php echo $id ?>-props"
                    
                >
                </code>
            </pre>
        </div>

    



        

        <p>
            Many developers may not be aware of the new <a                 href="https://www.w3.org/WAI/WCAG21/Understanding/text-spacing.html">text spacing requirement in WCAG
                2.1</a>. In order to satisfy this requirement, it is important to:
        </p>

        <ol>
            <li>Test for issues when text spacing is altered in a document.</li>
            <li>Fix the issues that come up.</li>
        </ol>

        <h2>How To Test</h2>

        <p>
            The best way to test for this requirement is by using <a                 href="http://www.html5accessibility.com/tests/tsbookmarklet.html">the text resizing bookmarklet on
                HTML5Accessibility.com</a>. I have included this bookmarklet on this page to
            illustrate how it works. Click on it and you will see that:
        </p>

        <a class="bookmarklet"
            href="javascript:(function(){var d=document,id='phltsbkmklt',el=d.getElementById(id),f=d.querySelectorAll('iframe'),i=0,l=f.length;if(el){function removeFromShadows(root){for(var el of root.querySelectorAll('*')){if(el.shadowRoot){el.shadowRoot.getElementById(id).remove();removeFromShadows(el.shadowRoot);}}}el.remove();if(l){for(i=0;i<l;i++){try{f[i].contentWindow.document.getElementById(id).remove();removeFromShadows(f[i].contentWindow.document);}catch(e){console.log(e)}}}removeFromShadows(d);}else{s=d.createElement('style');s.id=id;s.appendChild(d.createTextNode('*{line-height:1.5 !important;letter-spacing:0.12em !important;word-spacing:0.16em !important;}p{margin-bottom:2em !important;}'));function applyToShadows(root){for(var el of root.querySelectorAll('*')){if(el.shadowRoot){el.shadowRoot.appendChild(s.cloneNode(true));applyToShadows(el.shadowRoot);}}}d.getElementsByTagName('head')[0].appendChild(s);for(i=0;i<l;i++){try{f[i].contentWindow.document.getElementsByTagName('head')[0].appendChild(s.cloneNode(true));applyToShadows(f[i].contentWindow.document);}catch(e){console.log(e)}}applyToShadows(d);}})();">
            Change the text spacing on this page
        </a>
    
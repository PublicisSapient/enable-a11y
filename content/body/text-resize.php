<main>
    
        

        <h2>Replace Pixels With Ems</h2>

        <p>
            Developers should use relative units like rems or ems for the majority of their text:
        </p>

        <ol>
            <li>Pixels are an absolute unit.</li>
            <li>Rems are responsive. If the font-size of the parent of an element sized in rems changes, than the
                font-size of the element changes.
            </li>
        </ol>

        <p>
            People who use their browser functionality to resize text will not be able to resize text measured in
            pixels,
            since pixels are absolute. Text sized in rems, however, will resize, becuase the browsers' text resize
            functionality
            <strong>should</strong> change the base font of the document.
        </p>

        <p>
            All the pages on the Enable project are designed to resize by using rems, but we use a dead-simple
            LESS mixin to convert pixels to rems.
        </p>

        <div id="less-px-to-rem">
            
        </div>

        <?php includeShowcode("less-px-to-rem", "", "", "", false)?>
        <script type="application/json" id="less-px-to-rem-props">
        {
            "replaceHtmlRules": {},
            "steps": [{
                "label": "LESS markup",
                "highlight": "%INLINE%px-to-rem__less",
                "notes": ""
            }]
        }
        </script>

        <template id="px-to-rem__less">
// 1. Define a base font size. For example,
// 16px for the html root would translate to @px: 16rem;

@px: 16rem;

// 2. Set your pixel values as fractions. For example,
// 16px would be 16/@px, 200px would be 200/@px, and so on.

.example {
font-size: 16/@px;
margin: 20/@px 0;
padding: 20/@px 10/@px;
}

// Compiled output

// .example {
// font-size: 1rem;
// margin: 1.25rem 0;
// padding: 1.25rem 0.625rem;
// }

// http://lesscss.org/features/#features-overview-feature-operations
        </template>

        

        <h2>How to Resize Text in Modern Browsers</h2>
        <p>
            Many developers get confused about what it means to conform to WCAG AA 1.4.4 - Text Resize.
        </p>

        <h3>Safari:</h3>
        <ol>
            <li><strong>Desktop (OSX):</strong> To increase the font size, press Option-Command-Plus sign (+). To
                decrease the font size, press Option-Command-Minus sign (-)</li>
            <li><strong>Mobile (iOS):</strong> When first writing this article, it looked like there was no way to
                actually resize text in iOS Safari natively. The only way to resize text is at the operating system
                level (by opening the iOS <strong>Settings</strong> app and under <strong>Accessibility</strong>
                choosing <strong>Larger Text</strong> and using the slider). By default, however, most web pages
                don’t
                respect the size that is set. However, after doing a lot of research for this article, I found that
                if
                you put the following CSS into your page, you can get Safari to resize the text according to the
                system
                settings:<br>

<div id="apple-css">
</div>

<?php includeShowcode("apple-css", "", "", "", false)?>
<script type="application/json" id="apple-css-props">
{
    "replaceHtmlRules": {
    },
    "steps": [{
        "label": "CSS markup",
        "highlight": "%INLINE%apple-css__code",
        "notes": ""
    }]
}
</script>

<template id="apple-css__code">
body {
    /*
     * This tells Safari to use the OS's base font and
     * the size set in the iOS Accessibility settings.
     */
    font: -apple-system-body;

    /*
     * Put whatever font you want to use here.  The font
     * size will still be grabbed by the iOS Accessibility
     * settings.
     */
    font-family: "Times New Roman", serif;
}
</template>
                <p> I encourage everyone to put these styles in their base styles. It will make visually impaired
                    iOS
                    users happy. The only caveat here is that the font resize will not happen until after the user
                    refreshes the browser. Thanks to the user “clshortf…@gmail.com” in <a                         href="https://bugs.chromium.org/p/chromium/issues/detail?id=779409">this Chromium bug
                        report</a>
                    for sharing this info.
                </p>
            </li>
        </ol>

        <h3>Chrome:</h3>
        <ol>
            <li><strong>Desktop:</strong>
                <ul>
                    <li>At the top right, click More <span aria-hidden="true">⋮</span> and then Settings.</li>
                    <li>Under “Appearance,” next to “Font size,” click the Down arrow <span aria-hidden="true">▾</span>.
                        Then select the font size you want (you have a choice
                        of
                        very small, small, medium, large and very large). You can have a little bit more
                        granular
                        control by clicking “Customize fonts” and moving the “Font Size” range widget.</li>
                </ul>
                <p><em>Note that Chrome will <strong>not</strong> resize text that is sized in <code>px</code>
                        units.</em></p>
            </li>
            <li><strong>Mobile (Android):</strong>
                <ul>
                    <li>Go to Settings, and then Accessibility. You can change the font-size by using the “Text
                        Scaling” slider.</li>
                </ul>
                <p><strong><em>Please note that Chrome for Android has some serious differences than all other
                            browsers. Text is only resized inside HTML element has more than 217 characters in
                            it,
                            and only if they have a dynamic height. This is not useful as an accessibility
                            feature,
                            since it is not guaranteed to resize all the content on the page. Because of this,
                            text-zoom-resize does not support Chrome for Android.</em></strong></p>
                <p><a href="https://bugs.chromium.org/p/chromium/issues/detail?id=779409">A bug has been filed a
                        year and a half ago with Google on this issue</a>, and I have submitted my own comments
                    to
                    it. Hopefully this will be resolved soon.</p>
            </li>
        </ol>

        <h3>Firefox:</h3>
        <ul>
            <li><strong>Desktop:</strong>
                <ol>
                    <li>On the menu at the top of your browser, click View, then go to Zoom (if you are using
                        Windows or Linux, you may have to press the “Alt” key in order to make this menu
                        visible).
                    </li>
                    <li>Select Zoom Text Only (This makes the controls only change the size of text; not
                        images).
                    </li>
                    <li>Click on the hamburger menu <span aria-hidden="true">☰</span> in the upper top-right
                        corner
                        of the browser’s chrome.</li>
                    <li>Click on the plus and minus icons in the “Zoom” option.</li>
                </ol>
            </li>
            <li><strong>Mobile (Android):</strong>
                <ol>
                    <li>You first need to set up Firefox to use the operating system text zoom settings. To do
                        this,
                        click on the More menu, denoted by three vertical dots ⋮, and then Settings. Then go to
                        the
                        Accessibility Menu. Make sure the “Use System font size” slider is on. Also make sure
                        the
                        “Always enable zoom” slider is on as well.</li>
                    <li>Now, that you have set up Firefox right, you can now zoom the font. Launch Android’s
                        “Settings” app and choose “Display”. Then click on “Font size”. Use the slider to change
                        the
                        text zoom font size value. Click OK and then go back to Firefox (Note: You may need to
                        reload the web page in order for the text zoom to take effect).</li>
                </ol>
                <p>(A more visual representation of the second step above can be found at <a                         href="https://www.howtogeek.com/268754/how-to-change-the-size-of-text-icons-and-more-in-android-nougat/">How
                        to Change the Size of Text, Icons, and More in Android</a> at the <a                         href="https://www.howtogeek.com">How To Geek</a> website).</p>
            </li>
        </ul>

        <h3>Internet Explorer:</h3>
        <p> Go to the menu bar, click “View” and choose the “Text Size” menu
            item.
            <em>Note that like Chrome, Internet Explorer will <strong>not</strong> resize text that is sized in
                <code>px</code> units.</em>
        </p>
        <h3>Microsoft Edge:</h3>
        <ul>
            <li><strong>For Edge &lt;= 18 (which is based on the EdgeHTML rendering engine):</strong> the only
                information I found about text zooming is outlined in this <a                     href="https://mcmw.abilitynet.org.uk/microsoft-edge-making-text-larger/">article</a>, but I
                couldn’t get it to work (I think Microsoft may have removed this feature).</li>
            <li><strong>For Edge &gt; 18 (which is based on the Blink rendering engine):</strong> go to
                Settings,
                and choose the “Appearance” tab. You can change the “Font size” select box value, or have more
                fine
                grained control by clicking “Custom fonts” and moving the “Font size” slider.</li>
        </ul>

        <p>(This list was lifted from <a                 href="https://usability.yale.edu/web-accessibility/articles/zoom-resizing-text">Zoom &amp; Resizing
                Text</a> from <a href="https://usability.yale.edu/">Yale University’s Usability &amp; Web
                Accessibility
                site</a>). </p>
    </main>
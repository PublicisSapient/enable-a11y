<p>
    Some websites have forms that will not allow users to input text into form fields unless they match a certain
    pattern. For example, a phone number in the United States and Canada is usually three digits (<a
        href="https://www.phonescoop.com/glossary/term.php?gid=300">the area code, or the NPA</a>), followed by three
    more digits (what people in the telecom world call <a
        href="https://www.phonescoop.com/glossary/term.php?gid=301">the central office code, or an NXX</a>), followed by
    four more digits (<a
        href="https://linkedphone.com/blog/what-are-the-different-parts-of-a-phone-number-called/#what-is-the-line-number-in-a-phone-number">the
        line number</a>). Here is an example:
</p>




<figure>
    <table aria-labelledby="phone-number-table"
        class="enable-table enable-table--centered-data enable-table--with-borders">
        <thead>
            <tr>
                <th scope="col">Area Code</th>
                <th scope="col">Central Office Code</th>
                <th scope="col">Line Number</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>416</td>
                <td>555</td>
                <td>1212</td>
            </tr>
        </tbody>
    </table>
    <figcaption id="phone-number-table">The breakdown of the phone number 416-555-1212</figcaption>
</figure>


<p>
    While we want users to be able to input just the numbers into a form, it would be nice to be able to format the
    input with dashes as users type so they can keep track of which digits have already been entered. This is especially
    nice when users are given an even larger set of characters to enter, such as a credit card, a Windows Activation
    Licence key:
</p>

<figure>
    <img src="images/input-mask/windows-product-key.jpg"
        alt="A picture of a Microsoft Proof of License Certificate of Authenticity.  It has a barcode on top and text on bottom that reads 'Product Key: GTP8H-HBD8D-DDTKD-MT8W6-', followed by five more letters that are blurred out.">

    <figcaption>An example of a Windows Product Key. Note how it is divided into groups of five characters with dashes
        in between to make it easier for the user to type in.</figcaption>
</figure>

<p>
    In order to deal with this problem, there exist many input masking JavaScript libraries that will mask input as the
    user types. The problem is that a lot of them have quirks that make them hard for all users, especially those with
    disabilities. I have spent a lot of time playing with input masking, and I have found that in order for an input
    mask to be truly accessible, it should have the following features:
</p>

<ol>
    <li><strong>Visually only masking:</strong> The masking should only affect how the data input looks visually. For
        example, if spaces appear in the masked data, it's just for presentational purposes; the data submitted to the
        server in the end should not have the spaces in it.
    <li><strong>Flexable input of data:</strong> If the input field has data in it, the user should be able to move the
        cursor inside the input field with a keybord or mouse and edit the data anywhere the cursor can move (i.e. not
        just at the end of the data). They should also be able to paste data anywhere into the field as well as select
        multiple characters that can be replaced or erased. <em>It should be the same behavior as an unmaked input
            field.</em></li>
    <li><strong>Keyboard friendly:</strong> Keyboard users should be able to access the masked field with the TAB key,
        <em>just like an unmaked input field.</em>
    </li>
    <li><strong>Screen reader friendly:</strong> Screen reader users should be able to use the masked input field
        <em>just like an unmasked input field.</em>
    </li>
    <li><strong>Screen reader alerts:</strong> If the user pauses while typing the data, screen readers will announce
        <strong>all</strong> the characters in the input field individually instead of reading the data as a word. This
        is because the data used in masking (e.g. phone numbers, credit cards, product keys, etc) are not words, and it
        is better UX to have the data read out character by character.
    </li>
</ol>

<p>
    When I searched for "Accessible input mask" in Google in Oct 2023, the following three libraries were the most
    commonly cited, so I tested for these features:
</p>

<?php
    $check = '<img class="compliance-table__icon" src="images/checkmark.svg" alt=""> Yes.';
    $uncheck = '<img class="compliance-table__icon" src="images/error.svg" alt="No">';
?>

<div class="footnote__content">
<div class="comparison-table__caption" id="comparison-table-caption">Comparison of input masking libraries</div>
<div class="sticky-table__container " tabindex="0">
    <table class="comparison-table" aria-labelledby="comparison-table__caption">
        
        <thead>
            <tr>
                <th scope="col"><span class="sr-only">Library</span></th>
                <th scope="col">Can access with keyboard</th>
                <th scope="col">Screen reader friendly</th>
                <th scope="col">Visually only masking</th>
                <th scope="col">Flexible Input of data</th>

                <th scope="col">Screen reader alerts</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row"><a href="https://designsystem.digital.gov/components/input-mask/">USWDS Input Mask</a></th>
                <td><?= $check ?>
                <td><?= $check ?>
                <td><?= $check ?></td>
                <td rowspan="2">No <sup><a id="reference-1" class="footnote__button" href="#comparison-table__note-1" aria-label="Read footnote 1">1</a></sup></td>
                <td>No</td>
            </tr>
            <tr>
                <th scope="row"><a href="https://github.com/estelle/input-masking">Accessible input masking by Estelle</a>
                </th>
                <td><?= $check ?></td>
                <td><?= $check ?></td>
                <td><?= $check ?></td>
                <td>No</td>
            </tr>
            <tr>
                <th scope="row"><a href="https://nosir.github.io/cleave.js/">Cleave.js</a></th>
                <td><?= $check ?></td>
                <td><?= $check ?><sup><a id="reference-2" class="footnote__button" href="#comparison-table__note-3" aria-label="Read footnote 3">3</a></td>
                <td>No</td>
                <td>No <sup><a id="reference-3" class="footnote__button" href="#comparison-table__note-2" aria-label="Read footnote 2">2</a></sup></td>
                <td>No</td>
            </tr>

        </tbody>
    </table>

   
</div>

<ol class="footnote__list comparison-table__footnote-list">
        <li tabindex="-1" id="comparison-table__note-1">Typing in the middle of data results in cursor being moved to end of string. <a class="footnote__link-to-ref" href="#reference-1" aria-label="Back to content">↩</a></li>
        <li tabindex="-1" id="comparison-table__note-2">Typing an invalid character (e.g. a letter in a numeric field) causes the cursor to move up one character. <a class="footnote__link-to-ref" href="#reference-2" aria-label="Back to content">↩</a></li>
        <li tabindex="-1" id="comparison-table__note-3">Note that the demo page doesn't use proper labels. <a class="footnote__link-to-ref" href="#reference-3" aria-label="Back to content">↩</a></li>
    </ol>
    </div>

<p>Since none of them really fit the bill (and I do think that these features are 100% needed to be truly accessible) I
    created Enable's Input Making library. You can test it out with a screen reader and keyboard youself.</p>

<h2>Example 1: Static Input Masking</h2>

<div class="enable-example" id="input-mask-example">
    <form class="enable-form-example" onSubmit="alert('form submitted'); return false;">
        <fieldset>
            <legend>Contact Information</legend>

            <p class="form-instructions"><span class="required-symbol">*</span> denotes a required field.</p>

            <div class="enable-form-example__fieldset-inner-container">

                <div class="field-block">
                    <label class="example__label" for="tel">Canadian Telephone Number: </label>

                    <!-- BEGIN-INPUT-MASK -->
                    <div class="enable-input-mask">
                        <input id="tel" type="tel" inputmode="numeric" name="tel" data-mask="999-999-9999"
                            pattern="[0-9]{10}" class="enable-input-mask__input" aria-describedby="tel__desc"
                            maxlength="10" />
                        <div class="enable-input-mask__mask" aria-hidden="true"></div>
                        <div id="tel__alert" aria-live="polite" class="enable-input-mask__alert sr-only"></div>
                    </div>
                    <!-- END-INPUT-MASK -->

                    <div class="desc" id="tel__desc">For example, 123-456-7890</div>
                </div>



                <div class="field-block">
                    <label class="example__label" for="winkey">Windows Product Key: </label>

                    <!-- BEGIN-INPUT-MASK -->
                    <div class="enable-input-mask">
                        <input id="winkey" type="text" name="cc" data-mask="CCCCC-CCCCC-CCCCC-CCCCC-CCCCC"
                            pattern="[a-zA-Z0-9]{25}" class="enable-input-mask__input" aria-describedby="winkey__desc"
                            maxlength="25" />
                        <div class="enable-input-mask__mask" aria-hidden="true"></div>
                        <div id="winkey__alert" aria-live="assertive" class="enable-input-mask__alert sr-only"></div>
                    </div>
                    <!-- END-INPUT-MASK -->

                    <div class="desc" id="winkey__desc">This key should have been included with either your computer or
                        on the media used to install Windows. <a
                            href="https://softwarekeep.com/help-center/how-to-find-your-windows-10-product-key">More
                            information about Windows Product Keys</a></div>
                </div>
            </div>

            <input value="Submit" type="submit">
        </fieldset>



    </form>
</div>

<?php includeShowcode("input-mask-example")?>
<script type="application/json" id="input-mask-example-props">
{
    "replaceHtmlRules": {},
    "steps": [{
            "label": "Ensure each input field's HTML has this specific format",
            "highlight": "%BEGINENDCOMMENTTAG% INPUT-MASK",
            "notes": "This DOM structure must be maintained.  The container class must be <code>enable-input-mask</code>."
        },
        {
            "label": "Mark up the input field's data-mask",
            "highlight": "data-mask",
            "notes": [
                "<p>The <code>data-mask</code> attribute must match the format that you want the data to appear visually in the input field. More information in the <a href=\"#data-mask-format\">How to set the data-mask attribute</a> part of this page"
            ]
        }
    ]
}
</script>

<h2 id="data-mask-format" tabindex="-1">How to Set the data-mask Attribute</h2>

<p>For the phone number field, you will note it is <code>999-999-9999</code>. The <code>9</code> characters are what we
    call <strong>input characters</strong> and represent where inputted data (in this case digits) should appear. The
    dash characters are what we call <strong>format characters</strong> and will be automatically put in the visual
    field as the user types the numbers in. Users don't need to add them manually.</p>
<p>Note that spaces, dashes and round brackets (i.e. <code>" "</code>, <code>"-"</code>, <code>"("</code> and
    <code>")"</code>)can be used as format characters. Possible input characters are:
<dl>
    <dt><code>"_"</code> (underscore)</dt>
    <dd>Represents any character that isn't a format character</dd>
    <dt><code>"U"</code>
    <dt>
    <dd>Any non-numeric character that we want to change to uppercase, if possible.</dd>
    <dt><code>"C"</code>
    <dt>
    <dd>Any character that we want to change to uppercase, if possible.</dd>
    <dt><code>"X"</code>
    <dt>
    <dd>Any letter</dd>
    <dt><code>"9"</code>
    <dt>
    <dd>Any number</dd>
</dl>

<h2>How Does the Library Work?</h2>

<p>
    If you just want to implement input masking and don't care how it works, just skip this section. If you are
    interested in the technical details of how this all works, click the button below.
</p>

<details class="enable-drawer">
    <summary class="enable-drawer__button">
        I want to read the gory technical details.
    </summary>
    <div class="content">

        <h3>How the DOM and CSS is Set Up.</h3>

        <p>We don't change the data inside the input field. Instead, we create an absolutely positioned HTML block
            (which we call a facade) that, using a higher z-index than the input field, sits on top of it. This contains
            the formatted input field data and covers the input field so it is no longer visible to the user (We also
            make the input field's text transparent and ensure the facade and the input field are the same pixel-size).
        </p>
    </div>

    <figure>
        <img src="images/input-mask/input-mask-dom.webp"
            alt="A digram of the input mask's DOM, which is described fully below.">

        <figcaption>A 3D representation of the DOM of the input mask component.</figcaption>
    </figure>

    <p>The diagram above shows that the input field is stacked underneath a facade that contains the visually formatted
        input with the data mask applied. The input field contains the phone number 212-312-1231, without dashes, in it
        and the numbers 3121, which is in the middle of the phone number, is selected (presumably because the user wants
        to cut, copy or erase it). The facade has the same phone number as the input field, but is formatted with dashes
        in the standard places for a North American phone number. The mask's visual data is divided into the three
        areas: the text before the selected area (212), the selected text (-3121) and the text after the selected area
        (231). This was done so we can mimic the input field's blinking cursor as well as show what data has been
        selected by a mouse (more on this below).</p>

    <h3>Keyboard UX</h3>
    <p>The input field is keyboard accessible, and keyboard users can type in data just as they normally would. Keyboard
        focus, when applied to the input field, is visible since the input field and the facade are the same size. When
        the user types into the input field, javascript updates the facade with the same data, except it has format
        information. The user can even select text (via the usual SHIFT+arrow keys) and the equivalent text is selected
        in the input field underneath. Data can also be cut, copied and pasted from the input field, and the facade will
        be appropriately updated.</p>

    <h3>Mouse UX</h3>
    <p>For mouse users, when the click on what they think is the input field, they are actually clicking on the facade
        stacked on top. Javascript figures out where in the input data they are clicking and ensure the cursor in the
        input field stacked underneath is placed in the right area. Because all mouse events are basically passed on to
        the input field underneath, the user can select text with a mouse and the appropriate text is selected in the
        input field so that is updated correctly. </p>

    <h3>Screen-reader UX</h3>
    <p>If the user stops typing for a while, the "formatted value" of the input field is announced (i.e. the input
        field's value announced character by character). This is done via an ARIA live region which is described in the
        code walkthrough above. So, instead of the screen reader reading the input field as a large integer (in this
        case "two billion one hundred twenty three million one hundred twenty one thousand two hundred thirty one"), it
        will read it as the phone number one digit at a time (i.e. two one two three one two one two three one). This
        makes it easy for screen reader users to know what they just typed in.</p>
</details>


<h2>Example 2: Dynamic Masking of Credit Card Fields</h2>


<p>
    Credit card fields are a little different. At the time of this writing, the format characters (i.e. the spaces) are
    put into different places depending if it's an American Express (a.k.a. AMEX) Card or another credit card type:
</p>

<figure>
    <table aria-labelledby="credit-card-format-table"
        class="enable-table enable-table--centered-data enable-table--with-borders">
        <thead>
            <tr>
                <th scope="col">American Express</th>
                <th scope="col">Others</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>9999 999999 99999</td>
                <td>9999 9999 9999 9999</td>
            </tr>
        </tbody>
    </table>
    <figcaption id="credit-card-format-table">The spacing of a American Express cards vs their competitors</figcaption>
</figure>

<p>
    Luckily, we know what American Express cards always begin with the digits <code>34</code>, so we just ensure that
    when the user inputs a string beginning with <code>34</code> we change the <code>data-mask</code> attribute from
    <code>9999 9999 9999 9999</code> (the mask of the non-American Express credit cards) to
    <code>9999 999999 99999</code> (the format for American Express cards). Below is an example of this in action.
</p>

<div class="enable-example" id="credit-card-example">
    <form class="enable-form-example" onSubmit="alert('form submitted'); return false;">
        <fieldset>
            <legend>Payment Information</legend>

            <p class="form-instructions"><span class="required-symbol">*</span> denotes a required field.</p>

            <div class="enable-form-example__fieldset-inner-container">



                <div class="field-block">

                    <label class="example__label" for="cc">Credit Card Number: </label>

                    <!-- BEGIN-INPUT-MASK -->
                    <div class="enable-input-mask">
                        <input id="cc" type="text" inputmode="numeric" name="cc" pattern="[0-9]{15,16}"
                            class="enable-input-mask__input" aria-describedby="cc__desc" />
                        <div class="enable-input-mask__mask" aria-hidden="true"></div>
                        <div aria-live="polite" class="enable-input-mask__alert sr-only"></div>
                    </div>
                    <!-- END-INPUT-MASK -->

                    <div class="desc" id="cc__desc">Input just the numbers on your credit card number. Spaces will be
                        added automatically to match the spacing on your card</div>
                    
                </div>




                <input value="Submit" type="submit">
            </div>
        </fieldset>



    </form>
</div>

<?php includeShowcode("credit-card-example")?>
<script type="application/json" id="credit-card-example-props">
{
    "replaceHtmlRules": {},
    "steps": [{
            "label": "Ensure each input field's HTML has this specific format",
            "highlight": "%BEGINENDCOMMENTTAG% INPUT-MASK",
            "notes": "This DOM structure must be maintained.  The container class must be <code>enable-input-mask</code>."
        },
        {
            "label": "Mark up the input field's data-mask",
            "highlight": "data-mask",
            "notes": [
                "<p>The <code>data-mask</code> attribute must match the format that you want the data to appear visually in the input field. More information in the <a href=\"#data-mask-format\">How to set the data-mask attribute</a> part of this page"
            ]
        },
        {
            "label": "Test the credit card type on input and apply proper mask",
            "highlight": "%INLINE% credit-card-example-script ||| //[^E]*Ensure[\\s\\S]*",
            "notes": "Note that if you look at the script in detail, you will note that we not only set the credit card mask, but also set the <code>maxlength</code> of the form field."
        }
    ]
}
</script>

<?= includeNPMInstructions('input-mask', array(''), '', false , array()) ?>
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
        <table aria-labelledby="phone-number-table" class="enable-table enable-table--centered-data enable-table--with-borders">
          <thead>
            <th scope="col">Area Code</th>
            <th scope="col">Central Office Code</th>
            <th scope="col">Line Number</th>
          </thead>
          <tbody>
            <td>416</td>
            <td>555</td>
            <td>1212</td>
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
        in between to make it easier for the user to type in.</figcatpion>
</figure>

<p>
    In order to deal with this problem, there exist many input masking JavaScript libraries that will mask input as the
    user types. However, a lot of them have accessibility issues that <a href="https://giovanicamara.com">Giovani
        Camara</a> outlines in his blog post <a
        href="https://giovanicamara.com/blog/accessible-input-masking/">Accessible Input Masking</a>. You should read
    his post for more detail, but to sum up:
</p>

<ol>
    <li><span data-preserver-spaces="true">Confusing for screen reader: When items inject on the screen without warning
            a screen reader user, it can be a confusing experience.</span></li>
    <li><span data-preserver-spaces="true">Difficulties fixing typos: When a user makes a mistake in their values, often
            fixing those errors can be complex when masking is applied.</span></li>
    <li>Sometimes complex: Input masks can also make it more difficult for users to enter data, especially if the mask
        is complex or the user is not familiar with the format.</li>
    <li>Less flexible: Users have preferences. Input masks may limit input flexibility, preventing someone from entering
        data in a way that feels most comfortable to them.</li>
</ol>

<p>

</p>

<div class="enable-example" id="input-mask-example">
    <form>

        <div class="example__field-seperator">
            <label class="example__label" for="tel">Canadian Telephone Number</label>
                <div class="enable-input-mask">
                    <input id="tel" type="tel" inputmode="numeric" name="tel" data-mask="999-999-9999" pattern="\d{3}-\d{3}-\d{4}"
                        class="enable-input-mask__input" aria-describedby="telHint" />
                    <div class="enable-input-mask__mask"></div>
                </div>
                <div class="enable-input-mask__hint" id="telHint">For example, 123-456-7890</div>
            </div>
        </div>

    </form>
</div>
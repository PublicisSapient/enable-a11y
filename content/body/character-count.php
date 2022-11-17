<p>
  <strong>This is a test page that isn't linked into the rest of the Enable website.</strong>
  This page contains two different versions
  of an accessible character-counter. Both variations do the same basic things:</p>

<ol>
  <li>When a keyboard user focuses into a textarea with a character-counter, screen readers will announce how many
    characters the user has typed in and how many characters they are allowed to type.</li>
  <li>If the user is close to maxing out the number of characters in the text box (within 20 characters), screen readers
    will announce the character count info in point #1 after every keystroke (or if they delete some of the content so
    the textbox content length is not within that threshold any more).</li>
</ol>

<p>The main difference between the two is:</p>

<ul>
  
  <li>The top variation will announce to screen reader users this information if the types a Space (i.e. when the user finishes typing a word).  This announcement is delayed by half a second so that it is not announced if the user is typing quickly.</li>
  <li>The bottom variation will announce to screen reader users the character count information if the user presses Escape.</li>
</ul>

<p>
  Which do you like better? Or do you think these two variations should be combined? Should the developer be able to configure which of these two features will be activated? Would you add anything?  Or should we do something else?   Please feel free to contact me via either <a href="https://mastodon.social/@zoltandulac">my Mastodon account</a> or <a href="https://twitter.com/zoltandulac">my Twitter account</a> and let me know. <strong>Whatever we end up implementing will be released as an open source JavaScript library via github and NPM, so the community that helps out here will definitely benefit!</strong> 
</p>

<h2>First Variation: Count Announced After Typing A Word.</h2>

<div id="charcount-example" class="enable-example">
  <form class="enable-form-example">
    <fieldset>
      <legend>Payment information</legend>

      <div class="enable-form-example__fieldset-inner-container">
        <div>
          <label for="ccinfo--example2">Billing Address:</label>
          <input type="text" name="ccinfo--example2" id="ccinfo--example2">
        </div>

        <div>
          <label for="notes--example2" class="textarea-label">Delivery Notes:</label>
          <textarea id="notes--example2" data-has-character-count="true" name="notes--example2" maxlength="100"
            data-announce-after-space="true"></textarea>
        </div>

      </div>
    </fieldset>

    <!--
      Help:
         VO/OSX: CAPSLOCK+SHIFT+H
    -->

    <button type="submit">Submit</button>
  </form>

</div>



<h2>Second Variation: Count Announced After Pressing Escape.</h2>



<div id="charcount-example" class="enable-example">
  <form class="enable-form-example">
    <fieldset>
      <legend>Payment information</legend>

      <div class="enable-form-example__fieldset-inner-container">
        <div>
          <label for="ccinfo--example2">Billing Address:</label>
          <input type="text" name="ccinfo--example2" id="ccinfo--example2">
        </div>


        <div>
          <label for="gift-card-text--example2" class="textarea-label">Gift Card Message:</label>
          <textarea id="gift-card-text--example2" data-has-character-count="true" name="gift-card-text--example2"
            maxlength="150" data-screen-reader-text="${charsRemaining} characters remaining."
            aria-describedby="gift-card__desc" data-announce-after-escape="true"></textarea>
          <label id="gift-card__desc" class="desc">Write a personalized message on the gift card for the
            recipient.</label>
        </div>
      </div>
    </fieldset>

    <!--
      Help:
         VO/OSX: CAPSLOCK+SHIFT+H
    -->

    <button type="submit">Submit</button>
  </form>

</div>


<!--
<script type="application/json" id="charcount-example-props">
{
  "replaceHtmlRules": {},
  "steps": [

    {
      "label": "Place an aria-describedby for instructions",
      "highlight": "%INLINE%charcount-example ||| aria-describedby"
    },
    {
      "label": "Code the instructions for this component.",
      "highlight": "%INLINE%enable-character-count__global ||| id=\"character-count__desc\"",
      "notes": "This is the target of the <code>aria-describedby</code> in the previous step."
    },
    {
      "label": "Have an ARIA live region to announce when user starts approaching character count limit",
      "highlight": "%INLINE%enable-character-count__global ||| %OPENCLOSECONTENTTAG%output",
      "notes": ""
    }
  ]
}
</script>
-->

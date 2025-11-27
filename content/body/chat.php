<p>
Creating an accessible chat interface is not a trivial task (as witnessed by the multitude of inaccessible examples in the wild on the web today). A modern chat window is effectively a non-modal dialog with the following features operating simultaneously:</p>

<ul>
  <li><strong>an interactive messaging feed</strong> that shows message history.</li>
  <li><strong>a form</strong> that allows the user to type in queries.</li>
  <li><strong>an assistive navigation system</strong> that contains buttons and links to queries the site operator thinks will be asked a lot.</li>
</ul>

<p>
  What is on this page is a demo example of a chat interface that has all of the above (like many websites today), but ensures the chat interface is fully usable by:
</p>

<ul>
  <li>keyboard-only users</li>
  <li>screen reader users</li>
  <li>speech input users</li>
  <li>users with cognitive and motor impairments</li>
</ul>

<p>This code was intially built by <a href="https://github.com/kweaver00" target="_blank">Keith Weaver</a>.   Please <a href="#chat-button">jump to the chat interface to try it out</a>.  You can read about the UX choices we made as well as how we coded it to follow these UX decisions.</p>


<h2>UX Description</h2>

<p>Let's first walk through how the UX for this chat interface below is accessible and why its design decisions are considered best practice.</p>

<h3>Opening the Chat Interface</h3>
    <ul>
      <li>When the user activates a <b>floating “Chat with us”
      button</b> (with either mouse or keyboard):
        <ul>
          <li>The chat opens as a <b>dialog overlay</b>.</li>
          <li><b>Keyboard focus moves directly to the dialog’s Close
          button</b>.</li>
          <li>A screen reader user immediately hears:
            <ul>
              <li>The dialog’s title (e.g., “Chat with us”),</li>
              <li>The instructions (“Choose one of the items you want
              information on or ask any accessibility related question in
              the form below.”),</li>
              <li>Then the fact that they are on the “Close this dialog”
              button.</li>
            </ul>
          </li>
          <li>
            Keyboard user can then tab into the questions immediately, since focus is above the questions.
          </li>
          <li>
            Screen reader users will know the context of the buttons when they tab into them becuse of what was announced.
          </li>
          <li>
            The questions are rendered as buttons (not links) since they are actions on a page.
          </li>
        </ul>
        </li>
    </ul>

<h3>Using The Chat Interface</h3>

    <p>After the interface is opened, users can now:</p>
    <ul >
      <li>Take a <b>guided path</b> by activating one of the two
      buttons, or</li>
      <li>Skip them and write any question they want in the
      <b>Message</b> textarea.</li>
    </ul>

<h3>Activating links/buttons in the chat.</h3>
    <p>If the user presses any button options given by that chatbot:</p>
    <ul>
      <li>The chat “reply” area updates with a <b>new message from
      the bot</b>:
      <ul>
        <li>It explains that there are some helpful links about the
        chosen topic.</li>
      </ul></li>
      <li>Below that explanation, the user sees a <b>list of
      links</b> related to that topic (web or mobile
      accessibility).</li>
      <li><b>Keyboard focus moves to the first link</b> in that
      list.</li>
      <li>A screen reader user:
      <ul>
        <li>Hears the new instruction text,</li>
        <li>Then the label of the first link,</li>
        <li>And can TAB or arrow through all of the links,</li>
        <li>Then continue on to the input field if they want to ask
        a follow-up question.</li>
      </ul></li>
    </ul>
    <p>This design gives:</p>
    <ul>
      <li>Immediate, concrete resources for common needs,</li>
      <li>A clear focus target for keyboard and AT users (first
      link),</li>
      <li>A logical reading order (instruction → links →
      input).</li>
    </ul>


<h3>Typing a Free Form Query</h3>

<p>When the user types a query and the chatbot has an answer that includes interactive elements (like links or buttons), the UX should behave similarly to clicking the corresponding initial button:</p>
    <ul>
      <li>The user's message appears as an outgoing chat bubble.</li>
      <li>The bot briefly shows a “Thinking…” message while it comes up with an answer.</li>
      <li>When it is done, that thinking message is replaced by the answer with the interactive elements (e.g. links) that are part of the answer:</li>
      <li>Focus moves to the <b>first link in the new list</b>.</li>
      <li>Screen readers will announce the answer and read the element that has focus. They can then discover the other interactive elements by using the TAB key.</li>
      <li>Anyone can then either user the interactive elements to get the answer they want, or ask another question using the message input field.
    </ul>

    <p>From the user’s perspective:</p>
    <ul>
      <li>Whether they <b>click a button</b> or <b>type a
      keyword</b>, they get a guided, topic-specific set of
      resources.</li>
      <li>Screen reader users get consistent behavior: new content
      + predictable focus movement.</li>
    </ul>

<p>When the user types a question that just requires a text-only answer:</p>

    <ul>
      <li>The user's message appears as an outgoing chat bubble.</li>
      <li>The bot briefly shows a “Thinking…” message while it comes up with an answer.</li>
      <li>The bot then responds with the text-only answer.</li>
      <li><b>Focus stays in the Message textarea</b> so the user
      can continue the conversation without focus jumping
      elsewhere.</li>
      <li>Screen reader will announce what the bot responded (using an ARIA live region)</li>
    </ul>


<?php includeShowcode("chat-example")?>
<script type="application/json" id="chat-example-props">
{
  "replaceHtmlRules": {
  },
  "steps": [
  {
    "label": "Create the button to open the chat interface",
    "highlight": "%OPENCLOSECONTENTTAG%button aria-haspopup",
    "notes": "The button that opens the modal has <code>aria-haspopup=\"dialog\"</code> set so screen reader users know it opens a dialog"
  },
  {
    "label": "Code the chat interface as a non-modal dialog",
    "highlight": "%OPENTAG%div role=\"dialog\"",
    "notes": "The dialog is <code>non-modal</code> because it doesn't prevent the content behind it from being in focus. We don't use <code>aria-modal</code> here."
  },
  {
    "label": "Code a group as a direct child inside the dialog that will announce the modal title when focus is within it.",
    "highlight": "aria-labelledby ||| role=\"group\"",
    "notes": "When focus is applied to a control inside of this group, the <code>aria-labelledby</code> will announce the name of the modal (i.e. \"Chat with us\")."
  },
  {
    "label": "Create an aria-live region to announce chat messages to screen readers",
    "highlight": "%OPENCLOSECONTENTTAG%div aria-live",
    "notes": "The script will duplicate the contents of the last visual message displayed here to ensure screen readers announce it to screen reader users, no matter what element on the page is focused."
  },
  {
    "label": "Make avatar icons inside of chat interface decorative",
    "highlight": "alt=\"\"",
    "notes": ""
  },
  {
    "label": "Form input field used to write questions must be marked up with visible label",
    "highlight": "for",
    "notes": ""
  },
  {
    "label": "Form submit button must exist",
    "highlight": "%OPENCLOSECONTENTTAG%button type=\"submit\"",
    "notes": "Note the <a href=\"http://localhost:8888/screen-reader-only-text.php#show-me-the-css-that-i-can-use-to-make-screen-reader-only-text--heading\">sr-only class</a> is used to generate the screen reader label for this button."
  }
]}
</script>
    


<p class="bottom-label text-center"> Modify it by forking the <a href="https://github.com/kweaver00/eliza" target="_blank">repo</a>.
</p>

<div id="chat-example" class="enable-example">
  <div class="chatbot-container no-permalink-headings">
    <div class="chatbot" role="dialog">
      <div role="group" aria-labelledby="chatbot-heading">
        <button id="cancel" class="chatbot-close" >
          <img class="a11y-modal__button--close-image" src="images/close-window.svg" alt="close this dialog">
        </button>
        <div class="chatbot-heading" id="chatbot-heading">
          <h2>Chat with us</h2>

        </div>
        <ul class="chatbot-dialogue">
          <li id="chatbot-instructions" class="chatbot-dialogue-chat chatbot-dialogue-incoming"><img alt=""
              aria-hidden="true" class="chat-message-icon" src="images/eliza/guy.png"><span class="sr-only">Chatbot
              says:</span>
            <p>Choose one of the items you want information on or ask any accessibility related question in the form below.
            </p>
          </li>


        </ul>
        <div class="chatbot-sr-dialog sr-only" aria-live="polite"></div>
        <form class="chatbot-input">
          <label for="chat-textarea">Message:</label>
          <textarea id="chat-textarea"></textarea>
          <button type="submit">
            <span class="sr-only">Submit your chat dialogue.</span>
            <span aria-hidden="true" class="material-symbols-outlined">send</span>
          </button>
        </form>
      </div>
    </div>
  </div>

  <button id="chat-button" class="chatbot-btn" aria-haspopup="dialog">
    <span class="chatbot-btn-label sr-only">Open the chat dialogue.</span>
    <span aria-hidden="true" class="material-symbols-outlined">mode_comment</span>
    <span aria-hidden="true" class="material-symbols-outlined">close</span>
  </button>
</div>
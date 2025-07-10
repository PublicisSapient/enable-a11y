<p class="bottom-label text-center">Built by <a href="https://github.com/kweaver00" target="_blank">Keith
    Weaver</a>. Modify it by forking the <a href="https://github.com/kweaver00/eliza" target="_blank">repo</a>.
</p>

<div class="chatbot-container">
  <div aria-labelledby="chatbot-heading" class="chatbot" role="dialog">
    
    <button id="cancel" class="chatbot-close" autofocus>
        <img class="a11y-modal__button--close-image" src="images/close-window.svg" alt="close this dialog">
      </button>
    <div class="chatbot-heading" id="chatbot-heading">
      <h2>Chat with us</h2>
      
    </div>
    <div class="chatbot-desc">Let us know what you want to talk about in the form below</div>
    <ul class="chatbot-dialogue" tabindex="0"></ul>
    <div class="chatbot-sr-dialog sr-only" aria-live="polite" ></div>
    <form class="chatbot-input">
      <label for="chat-textarea">Message:</label>
      <textarea id="chat-textarea"></textarea>
      <button type="submit">
        <span class="sr-only">Submit your chat dialogue.</span>
        <span aria-hidden="true" class="material-symbols-outlined">send</span>
      </button>
    </form>
  </div>

  <button class="chatbot-btn">
    <span class="chatbot-btn-label sr-only">Open the chat dialogue.</span>
    <span aria-hidden="true" class="material-symbols-outlined">mode_comment</span>
    <span aria-hidden="true" class="material-symbols-outlined">close</span>
  </button>
</div>
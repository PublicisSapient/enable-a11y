<p class="bottom-label text-center">Built by <a href="https://github.com/kweaver00" target="_blank">Keith
    Weaver</a>. Modify it by forking the <a href="https://github.com/kweaver00/eliza" target="_blank">repo</a>.
</p>

<div class="chatbot-container">
  <div aria-labelledby="chatbot-heading" class="chatbot" role="region">
    <div class="chatbot-heading" id="chatbot-heading">
      <h2>Chatbot Heading</h2>
    </div>
    <ul aria-live="polite" class="chatbot-dialogue" tabindex="0"></ul>
    <form class="chatbot-input">
      <label class="sr-only" for="chat-textarea">Chat dialogue:</label>
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
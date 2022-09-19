<!-- 
Credit:
http://www.flaticon.com/free-icon/doctor_194824
-->

<!-- 
Chat Content goes here 
It's loaded in dynamically with JS
-->
<div class="eliza">
  <div class="container">
    <div class="row chat-row">
      <div class="col-md-8 col-md-offset-2">

        <div id="chat-area"></div>
        <div id="sr-announce" class="sr-only" role="alert" aria-live="assertive"></div>
      </div>
    </div>
  </div>

  <!-- Area to send a message and ownership info -->
  <div class="container send-wrapper">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 send-inner-wrapper">
        <label for="eliza-input" class="send-message-help-text">Talk to Eliza by typing into the textbox below:</label>
        <input type="text" class="send-textbox" id="eliza-input" />
        <p class="send-message-help-below-text text-right">Send your message by pressing "Enter"</p>
        <p class="bottom-label text-center">Built by <a href="https://github.com/kweaver00" target="_blank">Keith
            Weaver</a>. Modify it by forking the <a href="https://github.com/kweaver00/eliza" target="_blank">repo</a>.
        </p>
      </div>
    </div>
  </div>

  <!-- notifications.js appends notification html elements to this -->
  <span id="notification-area">
  </span>

  <div id="sr-announce" class="sr-only"></div>

  <template id="user-message-template">
    <div class="chat-message-outter-wrapper text-right">
      <div class="chat-message-wrapper you-message">
        <p class="chat-user-text">You (${time}): </p>
        <p class="chat-message-text text-left">${message}</p>
      </div><img src="images/eliza/laptop.png" class="chat-message-icon">
    </div>
  </template>

  <template id="eliza-message-template">
    <div class="chat-message-outter-wrapper"><img src="images/eliza/guy.png" class="chat-message-icon">
      <div class="chat-message-wrapper eliza-message">
        <p class="chat-user-text">Eliza (${time}): </p>
        <p class="chat-message-text text-left">${message}</p>
      </div>
    </div>
  </template>

  <template id="screen-reader-message-template">
    <div>${user}: ${message}</div>
  </template>
</div>
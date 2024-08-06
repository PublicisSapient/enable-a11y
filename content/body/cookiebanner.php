<p>
  Cookie banners are ubiquitous and are often the first element on a page demanding your attention. They appear almost
  instantaneously and requires a prompt decision to a lengthy explanation as to why cookies are necessary for the
  webpage.
</p>

<p>
  Unfortunately, many cookie banner implementations do not have the explanation interactive as text, nor do they
  automatically announce that the user is now interacting with a cookie banner. Instead, screen reader users are often
  guided immediately to one of the buttons—accept or reject—without knowing what it is they are accepting or rejecting.
</p>

<p>
  The instructions on this page walk through how to implement an accessible cookie banner using the
  <code>dialog</code> HTML element.
</p>

<h2>Modal Cookie Banner</h2>

<p>
  Using a modal dialog for cookie banners causes the contents of the webpage to be unavailable—often covered by a dark
  overlay—until the visitor of the webpage makes a decision on their cookie preferences. The contents of the webpage
  cannot be interacted with until the modal dialog is dismissed, this is true for both sighted users and screen readers.
</p>

<br />

<button id="show-modal-button" aria-haspopup="dialog">Show Modal Banner</button>

<div id="cookie-banner-example" class="enable-example--no-border">
  <dialog id="cookie-banner" class="cookie-banner">
    <form method="dialog" aria-labelledby="cookie-banner-title">
      <button id="cookie-banner-close-button" class="cookie-banner__close-button" autofocus>
        <img class="cookie-banner__close-button__icon" src="images/close-window.svg" alt="close cookie notice">
      </button>

      <div role="document">
        <h2 id="cookie-banner-title" class="cookie-banner__title">Cookie Notice</h2>
        <p id="cookie-banner-message">
          We use strictly necessary cookies to make our Sites work. In addition, if you consent, we will use optional
          functional, performance and targeting cookies to help us understand how people use our website, to improve your
          user experience and to provide you with targeted advertisements. You can accept all cookies, or click to review
          your cookie preferences.
        </p>
      </div>

      <div class="cookie-banner__action-buttons">
        <button id="cookie-banner-accept-button" class="cookie-banner__accept-button">Accept</button>
        <button id="cookie-banner-reject-button" class="cookie-banner__reject-button">Reject</button>
      </div>
    </form>
  </dialog>
</div>

<?php includeShowcode("cookie-banner-example"); ?>

<script type="application/json" id="cookie-banner-example-props">
  {
    "replaceHtmlRules": {},
    "steps": [
      {
        "label": "Use the HTML dialog tag",
        "highlight": "%OPENCLOSECONTENTTAG%dialog",
        "notes": "The dialog tag comes with handy functionality such as a <code>.showModal()</code> method."
      },
      {
        "label": "Use a form to encapsulate the contents of the cookie banner",
        "highlight": "%OPENCLOSECONTENTTAG%form",
        "notes": "Using a form is good practice—<a href=\"https://developer.mozilla.org/en-US/docs/Web/HTML/Element/dialog#usage_notes\">MDN docs</a>—to have the dialog close automatically when a button within it is pressed."
      },
      {
        "label": "Ensure the form element has \"aria-labelledby\" set",
        "highlight": "%INLINE%aria-labelledby=\"cookie-banner-title\"",
        "notes": "Using aria-labelledby along with a div element with a role of document ensures it's read out when the dialog is opened."
      },
      {
        "label": "Use the document role to enclose the cookie explanation",
        "highlight": "%INLINE%role=\"document\"",
        "notes": "This presents the content in reading mode for screen readers."
      }
    ]
  }
</script>

<p>
  With the HTML set up, use the built-in method <code>.showModal()</code> of the <code>dialog</code> HTML tag to show
  the cookie banner.
</p>

<h2>Non-Modal Cookie Banner</h2>

<p>
  Using a non-modal dialog for cookie banners allows the contents of the webpage to still be interactive. However, focus
  often immediately shifts to the action buttons—accept or reject—without first announcing the contents of the dialog.
  The implementation below announces the contents while also automatically focuses on the action buttons.
</p>

<br />

<button id="show-non-modal-button" aria-haspopup="dialog">Show Non-Modal Banner</button>

<div id="cookie-banner-example2" class="enable-example--no-border">
  <aside id="non-modal-cookie-banner-example" class="non-modal-cookie-banner__example" aria-labelledby="non-modal-cookie-banner-title">
    <button id="non-modal-cookie-banner-close-button-example" class="cookie-banner__close-button" autofocus>
      <img class="cookie-banner__close-button__icon" src="images/close-window.svg" alt="close cookie notice">
    </button>

    <div role="document">
      <h2 id="non-modal-cookie-banner-title-example" class="cookie-banner__title">Cookie Notice</h2>
      <p id="non-modal-cookie-banner-message-example">
        We use strictly necessary cookies to make our Sites work. In addition, if you consent, we will use optional
        functional, performance and targeting cookies to help us understand how people use our website, to improve your
        user experience and to provide you with targeted advertisements. You can accept all cookies, or click to review
        your cookie preferences.
      </p>
    </div>

    <div class="cookie-banner__action-buttons">
      <button id="non-modal-cookie-banner-accept-button-example" class="cookie-banner__accept-button">Accept</button>
      <button id="non-modal-cookie-banner-reject-button-example" class="cookie-banner__reject-button">Reject</button>
    </div>
  </aside>
</div>

<?php includeShowcode("cookie-banner-example2"); ?>

<script type="application/json" id="cookie-banner-example2-props">
  {
    "replaceHtmlRules": {},
    "steps": [
      {
        "label": "Use the HTML aside tag",
        "highlight": "%OPENCLOSECONTENTTAG%aside",
        "notes": ""
      },
      {
        "label": "Ensure the aside element has \"aria-labelledby\" set",
        "highlight": "%INLINE%aria-labelledby=\"non-modal-cookie-banner-title\"",
        "notes": "Using aria-labelledby along with a div element with a role of document ensures it's read out when the dialog is opened."
      },
      {
        "label": "Use the document role to enclose the cookie explanation",
        "highlight": "%INLINE%role=\"document\"",
        "notes": "This presents the content in reading mode for screen readers."
      }
    ]
  }
</script>

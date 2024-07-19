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

<button id="show-modal-button">Show Modal Banner</button>

<h2>Non-Modal Cookie Banner</h2>

<p>
  Using a non-modal dialog for cookie banners allows the contents of the webpage to still be interactive. However, focus
  often immediately shifts to the action buttons—accept or reject—without first announcing the contents of the dialog.
  The implementation below announces the contents while also automatically focuses on the action buttons.
</p>

<br />

<button id="show-non-modal-button">Show Non-Modal Banner</button>

<div id="cookie-banner-container">
  <dialog id="cookie-banner" class="cookie-banner">
    <form class="cookie-banner-form" method="dialog" aria-labelledby="cookie-banner-title">
      <button id="cookie-banner-close-button" class="cookie-banner-close-button" autofocus>
        <img class="a11y-modal__button--close-image" src="images/close-window.svg" alt="close dialog">
      </button>

      <div role="document" tabindex="0">
        <h2 id="cookie-banner-title">Cookie Notice</h2>
        <p id="cookie-banner-message">
          We use strictly necessary cookies to make our Sites work. In addition, if you consent, we will use optional
          functional, performance and targeting cookies to help us understand how people use our website, to improve your
          user experience and to provide you with targeted advertisements. You can accept all cookies, or click to review
          your cookie preferences.
        </p>
      </div>

      <div class="cookie-banner-action-buttons">
        <button id="cookie-banner-accept-button">Accept</button>
        <button id="cookie-banner-reject-button" class="cookie-banner-reject-button">Reject</button>
      </div>
    </form>
  </dialog>
</div>

<?php includeShowcode("cookie-banner-container"); ?>

<p>
  With the HTML set up, use the built-in methods <code>.showModal()</code> or <code>.show()</code> for the
  <code>dialog</code> HTML tag to show a modal or a non-modal dialog, respectively.
</p>

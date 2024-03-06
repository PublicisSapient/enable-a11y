'use strict'

/*******************************************************************************
 * enableVisibleOnFocus - a library to implement CTAs that are not
 * visible until focused, even in mobile browsers where focus() 
 * events aren't fired when users are employing a screen reader.
 * 
 * Written by Zoltan Hawryluk <zoltan.dulac@gmail.com>
 * Part of the Enable accessible component library.
 * Version 1.0 written May 17, 2021
 *
 * More information about this script available at:
 * https://www.useragentman.com/enable/38-skip-link.php
 * 
 * Released under the MIT License.
 ******************************************************************************/

const enableVisibleOnFocus = new (function () {
  const containerSelector = ".enable-mobile-visible-on-focus__container";
  const showEvent = new CustomEvent('enable-focus-show');
  const hideEvent = new CustomEvent('enable-focus-hide');
  let lastEventFiredAt = 0;

  this.init = function () {
    document.addEventListener("click", this.clickEvent, true);
    document.addEventListener("scroll", this.scrollEvent, true);
    window.addEventListener("resize", this.hideAll);
    window.addEventListener("orientationchange", this.hideAll);
    document.addEventListener("blur", this.blurEvent, true);

    // Firefox will cache the scroll location of all scrollable
    // containers, so we want to reset our skip links onload.
    this.hideAll();

  };

  /**
   * isElementInViewport(): return whether a given element is viewable
   * inside the current viewport.
   *
   * @param { HTMLElement } el
   * @returns { boolean } true if el is viewable in viewport, false otherwise.
   */
  this.isElementInViewport = el => {
    var rect = el.getBoundingClientRect();

    return (
      rect.top >= 0 &&
      rect.left >= 0 &&
      rect.bottom <=
        (window.innerHeight || document.documentElement.clientHeight) &&
      rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
  };

  /**
   * scrollEvent(): this event handler is fired when the enable-mobile-visible-on-focus__container
   * scrolls.  This should happen only when the CTA inside gains focus, since the CTA
   * has a margin-left that is the same as the with of the container (and the
   * width of the CTA itself).
   * 
   * @param { Event } e - scroll event object.
   */
  this.scrollEvent = e => {
    const { target } = e;

    if (!target.closest) {
      return;
    }
    const skipLinkContainer = target.closest(containerSelector);

    if (skipLinkContainer) {
      if (skipLinkContainer.scrollLeft !== 0) {
        const eventFiredAt = new Date().getTime();
        skipLinkContainer.classList.add(
          "enable-mobile-visible-on-focus__container--visible"
        );
        const link = skipLinkContainer.querySelector('a');
        const destinationLink = skipLinkContainer.querySelector(
          ".enable-mobile-visible-on-focus"
        );
        const top = destinationLink.getBoundingClientRect().top;
        const htmlEl = document.querySelector("html");

        if (htmlEl.scrollTop > top) {
          htmlEl.scrollTop = top - 100;
        } else if (htmlEl.scrollTop + window.innerHeight < top) {
          htmlEl.scrollTop = top - 100;
        }

        if (!this.isElementInViewport(skipLinkContainer)) {
          skipLinkContainer.scrollIntoView({ block: "center" });
        }


        if (eventFiredAt - lastEventFiredAt > 100) {
          link.dispatchEvent(
            showEvent,
            {
              bubbles: true
            }
          );
          lastEventFiredAt = new Date().getTime();
        }
      }

    }
  };

  /**
   * hideAll(): will hide all the .enable-visible-of-focus__container elements on the page
   */
  this.hideAll = () => {
    const containers = document.querySelectorAll(containerSelector);
    for (let i = 0; i < containers.length; i++) {
      const container = containers[i];
      const link = container.querySelector('a');
      this.hide(container);
      link.dispatchEvent(
        hideEvent,
        {
          bubbles: true
        }
      );
    }
  };

  /**
   * hide(): Hides a specific .enable-mobile-visible-on-focus__container element.
   * 
   * @param { HTMLElement } el 
   */
  this.hide = function (el) {
    el.scrollLeft = 0;
    el.scrollTop = 0;
    el.classList.remove("enable-mobile-visible-on-focus__container--visible");
  };

  this.blurEvent = (e) => {
    const { target } = e;

    if (target.classList && target.classList.contains("enable-skip-link")) {
      const containerEl = target.closest(containerSelector);
      requestAnimationFrame(() => {

        if (document.activeElement !== target) {
          this.hide(containerEl);
        }
      })
    }
  }

  /**
   * clickEvent(): fires when a CTA is clicked.  If the CTA is an enable-skip-link,
   * then it should focus on the target hash coded.  This function is needed since
   * Firefox doesn't focus the <a>'s target like other browsers do by default.
   * 
   * @param { Event } e - click handler fired 
   */
  this.clickEvent = e => {

    const { target } = e;

    if (target.classList.contains("enable-skip-link")) {
      e.preventDefault();
      let { href } = target;
      href = href.split("#");
      const destinationLink = document.getElementById(href[href.length - 1]);
      this.hideAll();
      destinationLink.focus();
    }
  };
})();

export default enableVisibleOnFocus;
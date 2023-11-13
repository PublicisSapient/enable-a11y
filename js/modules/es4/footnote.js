'use strict'
/*******************************************************************************
 * footnote.js - Accessible footnotes
 * 
 * Coded by Zoltan Hawryluk <zoltan.dulac@gmail.com>
 * Part of the Enable accessible component library.
 * Version 1.0 released Nov 7. 2023
 *
 * More information about this script available at:
 * https://www.useragentman.com/enable/footnotes.php
 * 
 * Released under the MIT License.
 ******************************************************************************/

const footnote = new function () {
    const rootClass = 'footnote'
    const buttonClass = `${rootClass}__button`;
    const listClass = `${rootClass}__list`;
    const instructionsId = `${rootClass}__instructions`;
    let instructionsEl;

    // We make this public so it can be internationalized.
    this.instructionsText = 'Click to go back to footnoted item.'
    this.readAriaLabel = 'Read footnote ';

    const init = () => {
        if (!this.method) {
            this.method = announce;
        }

        this.setAriaLabels();

        document.addEventListener('click', clickEvent);
    }

    this.setAriaLabels = () => {
        const buttons = document.getElementsByClassName(buttonClass);

        Array.prototype.forEach.call(buttons, (el) => {
            const { innerText } = el;
            console.log(el);
            el.setAttribute('aria-label', `${this.readAriaLabel} ${innerText}.`)
        });
    }

    const clickEvent = (e) => {
        const { target } = e;
        const { innerText } = target;
        const index = parseInt(innerText);

        if (index <= 0) {
            throw `"${innerText}" is an illegal identifier for a footnote (must be an integer greater than 0)`;
        }

        const listEl = document.querySelector(`.${listClass}`);
        const listItem = listEl.querySelectorAll('li')[index - 1];

        console.log('index', index);
        if (e.target.classList.contains(buttonClass)) {
            this.method(target, listItem);
        }
    }

    const showAlert = (target, listItem) => {
        const message = listItem.innerText;

        if (!instructionsEl) {
            instructionsEl = document.createElement('div');
            instructionsEl.className = 'sr-only';
            instructionsEl.id = instructionsId;
            instructionsEl.innerHTML = this.instructions;
            document.body.appendChild(instructionsEl);
        }

        listItem.tabIndex = "-1";
        listItem.role = 'note';
        listItem.setAttribute('aria-describedby', instructionsId);

        window.alert(message);    
    }

    init();
}


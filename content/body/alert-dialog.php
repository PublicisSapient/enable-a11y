<!-- File WIP -->
    
            <!-- <aside class="notes">
                <h2>Notes:</h2>
                <ul>
                    <li>This page uses is an example of how to use the <code>dialog</code> and <code>alertdialog</code> ARIA roles.</li>
                    
                    <li>When opened:
                        <ul>
                            <li>
                                Focus should go to the first element in the modal (usually the close button). If the modal is marked up like in this example,
                                the screen reader will anounce that the user is inside a modal.
                            </li>
                            <li>Focus can never be tabbed into anything outside the modal</li>
                        </ul>
                    </li>
                    <li>When closed:
                        <ul>
                            <li>Focus should go back to the element that opened the modal.</li>
                        </ul>
                    </li>
                </ul>
            </aside> -->


            <p>We have two examples of dialogs on this page:</p>

            <ul>
                <li>A
                    <a href="https://developer.mozilla.org/en-US/docs/Web/Accessibility/ARIA/ARIA_Techniques/Using_the_dialog_role">dialog</a> is used to mark up an HTML based application dialog or window that separates content or UI
                    from the rest of the web application or page.
                    <button data-modal-function="show" data-modal-button-for="dialog-example">Show me an example of a dialog</button>
                </li>
                <li>An
                    <a href="https://developer.mozilla.org/en-US/docs/Web/Accessibility/ARIA/ARIA_Techniques/Using_the_alertdialog_role">alertdialog</a> is like a dialog, except it is used to notify the user of urgent information that demands
                    the user's immediate attention.
                    <button data-modal-function="show" data-modal-button-for="alertdialog-example">Show me an example of an alertdialog</button></li>
            </ul>
            
        
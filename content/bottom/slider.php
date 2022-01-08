<script>
    var rangeInputEvent = new function() {
        this.init = () => {
            document.addEventListener('input', e => {
                const {
                    target
                } = e;
                const {
                    form,
                    parentNode
                } = target
                const {
                    type,
                    nodeName
                } = target;
                const isMultiContainer = parentNode.classList.contains('html-slider__multi--container');

                if (isMultiContainer && nodeName === 'INPUT' && type === 'range') {
                    const {
                        elements
                    } = form;

                    // This sets the variables for --a amd --b to their
                    // respective slider's value
                    parentNode.style.setProperty('--a', elements.a.value);
                    parentNode.style.setProperty('--b', elements.b.value);

                    // This sets each of the output elements innerHTML to display
                    // the slider value (prefixed with a dollar sign).
                    elements.output_a.innerHTML = `$${elements.a.value}`;
                    elements.output_b.innerHTML = `$${elements.b.value}`;
                }
            }, false);
        }
    }

    rangeInputEvent.init();
    </script>
<script src="js/modules/enable-slider.js" type="module"></script>
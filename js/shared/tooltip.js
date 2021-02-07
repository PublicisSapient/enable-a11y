const tooltip = new function () {
    const bodyEl = document.body;
    const tooltipEl = document.createElement('div');
    const tooltipStyle = tooltipEl.style;

    this.init = () => {
        create();

        bodyEl.addEventListener('mouseover', this.show);
        bodyEl.addEventListener('mouseleave', this.hide);

        // equivalent keyboard events
        bodyEl.addEventListener('focus', this.show, true);
        bodyEl.addEventListener('blur', this.hide, true);
        
        bodyEl.addEventListener('keydown', onKeydown);
    }

    const create = () => {
        tooltipEl.className = 'tooltip';
        tooltipEl.id = 'tooltip';
        tooltipEl.setAttribute('role', 'tooltip')
        bodyEl.appendChild(tooltipEl);
    }

    const onKeydown = (e) => {
        // check if escape is pressed
        if (e.which ==27)  {
            this.hide();
            e.preventDefault(); 
        }
    }

    this.hide = (e) => {
        const target = e.target;
        const text = target.dataset.tooltip;

        if (text) {
            const target = e ? e.target : null;
            //tooltipEl.setAttribute('aria-hidden', "true");
            tooltipEl.classList.add('tooltip--hidden');
            
            //target && target.removeAttribute('aria-describedby');
        }
    }

    this.show = (e) => {
        const target = e.target;
        const text = target.dataset.tooltip;

        if (text) {
            const targetRect = target.getBoundingClientRect();

            target.setAttribute('aria-describedby', 'tooltip');

            tooltipEl.innerHTML = text;
            tooltipEl.setAttribute('aria-hidden', "false");
            tooltipEl.classList.remove('tooltip--hidden');
            
            const tooltipRect = tooltipEl.getBoundingClientRect();

            console.log(tooltipRect.width);
            tooltipStyle.top = 'calc(' + targetRect.bottom + 'px + 1em)';
            tooltipStyle.left = (targetRect.left) + 'px';
        }
    }
}

tooltip.init();
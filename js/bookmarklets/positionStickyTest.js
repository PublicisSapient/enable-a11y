function positionStickyTest(el) {
    let x = el.parentNode;

    const { position, top, left, bottom, right } =
        document.defaultView.getComputedStyle(el, null);
    if (currentStyle.position !== 'sticky') {
        console.log(`This note has a position of ${position}`);
    }

    if (
        top === 'auto' &&
        left === 'auto' &&
        right === 'auto' &&
        bottom === 'auto'
    ) {
        console.log(
            `This node must have top, left, right or bottom set to something other than auto.`
        );
    }

    while (x.nodeName !== 'HTML') {
        const { overflow } = document.defaultView.getComputedStyle(x, null);

        if (
            overflow === 'hidden' ||
            overflow === 'scroll' ||
            overflow === 'auto'
        ) {
            console.error(`Ancestor has overflow set to ${overflow}`, x);
        }

        x = x.parentNode;
    }
}

const ariaLinkShim = new function () {
    const sap = {ui:{keycodes:{SPACE:32, ENTER:13 }}};

    this.navigateLink = (evt) => {
        if (evt.type=="click" ||
            evt.keyCode == sap.ui.keycodes.SPACE ||
            evt.keyCode == sap.ui.keycodes.ENTER) {
            const ref = evt.target != null ? evt.target : evt.srcElement;
           if (ref && ref.getAttribute('role') === 'link') {
                window.location.href = ref.getAttribute("href");
            }
        }
    }

    document.addEventListener('click', this.navigateLink);
    document.addEventListener('keydown', this.navigateLink);
}
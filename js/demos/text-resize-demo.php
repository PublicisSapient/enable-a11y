const body = document.body;

function setCssTextZoomFactor() {
    console.log(textZoomEvent.resizeFactor());
    if (textZoomEvent.resizeFactor() > 1) {
        body.classList.add('text-zoom');
    } else {
        body.classList.remove('text-zoom');
    }
}
// It is better if you give this the value of 
// parseFloat(getComputedStyle(document.documentElement).fontSize
// when the doc is not zoomed.
textZoomEvent.init(16);
setCssTextZoomFactor();
document.addEventListener('textzoom', setCssTextZoomFactor);
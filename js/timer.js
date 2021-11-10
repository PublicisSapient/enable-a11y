
const timerExample = new function () {

    this.init = function () {
        setInterval(displayTime, 5000);

        displayTime();
    }

    const displayTime = function() {
        const now = new Date();
        const hours = now.getHours();
        const minutes = ("0"+now.getMinutes()).substr(-2);
        const secs = ("0"+now.getSeconds()).substr(-2);
        const $clock = document.getElementById('clock');

        $clock.innerHTML = `The time now is ${hours}:${minutes}:${secs}`;
    }
}

timerExample.init();
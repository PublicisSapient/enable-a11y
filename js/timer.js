
const timerExample = new function () {

    this.init = function () {
        setInterval(displayTime, 60000);

        setTimeout(displayTime, 2000);
    }

    const displayTime = function() {
        var now = new Date();
        document.getElementById('clock').innerHTML = "The time now is " + now.getHours() + ":" + ("0"+now.getMinutes()).substr(-2);
    }
}

timerExample.init();
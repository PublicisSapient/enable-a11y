import accessibility from "../../enable-node-libs/accessibility-js-routines/dist/accessibility.module.js";

new (function () {

    let interval; 
    const sysLogEl = document.getElementById('syslog');
    const logButton =  document.querySelector('.log-example__button');
    let isLogActive = false;
    const stopLoggingLabel = 'Stop Logging';
    const startLoggingLabel = 'Start Logging'

    const reportCPUUsage = function () {
        const result = fetch('services/sysinfo.php');
        result
            .then(function (response) {
                return response.text();
            })
            .then(function (text) {
                sysLogEl.innerHTML += `<span>${text}</span>`;
            })
            .catch(function () {
                sysLogEl.innerHTML += '<span>Failed to get system info.</span>';
            });
    };

    const startLogging = () => {
        setTimeout(() => {
            sysLogEl.innerHTML = `<span>Initializing.  Please wait …</span>`;

            interval = window.setInterval(reportCPUUsage, 5000);

            isLogActive = true;
        }, 1000);

        logButton.innerHTML = stopLoggingLabel;
        accessibility.refocusCurrentElement();
    }

    const stopLogging = () => {
        window.clearInterval(interval);
        logButton.innerHTML = startLoggingLabel;
        accessibility.refocusCurrentElement();
        isLogActive = false;

        setTimeout(() => {
            sysLogEl.innerHTML += `\n<span>Stopped log.</span>`;
        }, 1000)
    }

    function clickEvent(e) {
        if (isLogActive) {
            stopLogging(e);
        } else {
            startLogging(e);
        }
    }

    logButton.addEventListener('click', clickEvent);

    
})();

new (function () {
    const sysLogEl = document.getElementById('syslog');

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

    window.setInterval(reportCPUUsage, 5000);
})();

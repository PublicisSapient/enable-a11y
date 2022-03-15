const logExample = new function () {
    const sysLogEl = document.getElementById('syslog');

    const reportCPUUsage = function () {
        var result = fetch('services/sysinfo.php');
        result.then(function (response) {
            return response.text();
        }).then(function (text) {
            sysLogEl.innerHTML += `<span>${text}</span>`;
        }).catch(function (ex) {
            sysLogEl.innerHTML += "<span>Failed to get system info.</span>"
        });
    }

    window.setInterval(reportCPUUsage, 5000);
}
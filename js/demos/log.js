const logExample = new function () {
    const sysLogEl = document.getElementById('syslog');

    const reportCPUUsage = function () {
        var result = fetch('bin/sysinfo.php');
        result.then(function (response) {
            console.log('response', response);
            console.log('header', response.headers.get('Content-Type'));
            return response.text();
        }).then(function (text) {
            sysLogEl.innerHTML += `<span>${text}</span>`;
        }).catch(function (ex) {
            sysLogEl.innerHTML += "<span>Failed to get system info.</span>"
        });
    }

    window.setInterval(reportCPUUsage, 5000);
}
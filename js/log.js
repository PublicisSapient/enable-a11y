const logExample = new function () {
    const sysLogEl = document.getElementById('syslog');

    const reportCPUUsage = function () {
        var result = fetch('bin/sysinfo.php');
        result.then(function (response) {
            console.log('response', response);
            console.log('header', response.headers.get('Content-Type'));
            return response.text();
        }).then(function (text) {
            sysLogEl.innerHTML += `<div>${text}</div>`;
        }).catch(function (ex) {
            sysLogEl.innerHTML += "<div>Failed to get system info.</div>"
        });
    }

    window.setInterval(reportCPUUsage, 5000);
}
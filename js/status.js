const statusExample = new function () {
    const statusEl = document.getElementById('myStatus');

    const reportCPUUsage = function () {
        var result = fetch('bin/sysinfo.php');
        result.then(function (response) {
            return response.text();
        }).then(function (text) {
            const cpuLoad = parseInt(text.split(':')[2].replace('%', ''));
            console.log(cpuLoad);
            let statusClass ;

            if (cpuLoad < 30) {
                statusClass = 'low';
            } else if (cpuLoad < 60) {
                statusClass = 'medium';
            } else {
                statusClass = 'high';
            }

            statusEl.className= statusClass;
            statusEl.innerHTML = `<div>${text}</div>`;
        }).catch(function (ex) {
            statusEl.innerHTML = "<div>Failed to get system info.</div>"
        });
    }

    reportCPUUsage();
    window.setInterval(reportCPUUsage, 5000);
}
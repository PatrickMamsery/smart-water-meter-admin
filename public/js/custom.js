if (window.location.href.includes('/admin/meter-trends/')) {
    // Set the desired interval for the page reload
    setInterval(function() {
        location.reload();
    }, 20000); // 2 minutes = 120000 milliseconds
}


document.addEventListener('DOMContentLoaded', function() {
    //progress bar onload
    let progressBar = document.getElementById('loading-progress');
    let width = 0;
    let interval = setInterval(function() {
        if (width >= 100) {
            clearInterval(interval);
        } else {
            width += 80; // Menambahkan progress 10% setiap interval
            progressBar.style.width = width + '%';
            progressBar.setAttribute('aria-valuenow', width);
        }
    }, 100);
});
window.onload = function() {
    // tutup progress bar setelah selesai load
    let loadingContainer = document.getElementById('loading-container');
    setTimeout(function() {
        loadingContainer.style.display = 'none'; // Sembunyikan progress bar setelah 1 detik
    }, 500);
};

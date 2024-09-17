document.addEventListener('DOMContentLoaded', function () {
  setTimeout(function () {
    var alert = document.getElementById('success-alert');
    if (alert) {
      alert.style.display = 'none';
    }
    var alert2 = document.getElementById('error-alert');
    if (alert2) {
      alert2.style.display = 'none';
    }
  }, 3000); // 3000 ms = 3 detik
});
function previewPhoto() {
  var file = document.getElementById('photo').files[0];
  var reader = new FileReader();

  reader.onload = function (e) {
    document.getElementById('photo-preview').src = e.target.result;
    document.getElementById('photo-preview').style.display = 'block';
  };

  reader.readAsDataURL(file);
}
function showimg() {
  document.getElementById('showimg').style.display = '';
}
function release() {
  document.getElementById('showimg').style.display = 'none';
}
function RP(value) {
    // Konversi nilai ke string dan tambahkan pemisah ribuan
    let formattedValue = value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    
    // Tambahkan prefix "Rp." dan suffix ",-"
    return `Rp.${formattedValue},-`;
}
function rptoint(num) {
  // Hapus simbol 'Rp. ', koma, dan tanda minus
let cleanedString = num.replace('Rp.', '').replace(/,/g, '').replace(/-/g, '');
return parseInt(cleanedString);
}
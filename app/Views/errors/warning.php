<html>

<head>
    <style>
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        background-color: #00573bd4;
        /* Warna latar belakang dengan transparansi */
        z-index: 1000;
        /* Z-index tinggi agar berada di atas elemen lain */
        display: flex;
        justify-content: center;
        align-items: center;
    }
    </style>

</head>
<div class="overlay">
    <?php if (session()->getFlashdata('error')): ?>
    <div id="error-alert" style="font-size: 60px;" role="alert">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

</div>



</html>
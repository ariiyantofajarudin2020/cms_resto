<?= $this->extend('layout/p_layout') ?>
<?php $this->section('content'); ?>
<?php include APPPATH.'Views/layout/u_function.php';?>
<?php
$f1=$f2=$f3='null.php';
$f3 = 'bayar_only.php';
foreach ($fiturs as $key => $v) {
    switch ($v['id_fitur']) {    
        case 'k3f26':
            $f1 = 'pembayaran_nontunai.php';
            break;    
        case 'k3f24':
            $f2 = 'cetak_tagihan.php';
            break;
        case 'k3f12':
            $f3 = 'cetak_faktur.php';
            break;          
        default:
            break;
    }
}
?>

<main>
    <div id="loading-container" class="progress mt-3"
        style="position: fixed; top: 35; left: 0; width: 100%;height:10px;z-index: 1000;">
        <div id="loading-progress" class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
            role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <section>
        <!-- body -->
        <div class="row" style="margin-left:10px;margin-right:10px;margin-top:60px">
            <div class="col-3">
                <h5 class="card-title">Pembayaran<span> <br>|<?=$induk['induk_perusahaan']?></span>
                </h5>
            </div>

            <div class="col-6">

            </div>
            <div class="col-3">
                <?php include 'date.php';?>
            </div>

            <!-- Pembayaran -->
            <div class="col-6 tbl-sm">
                <div class="card info-card sales-card" style="height:auto;margin-top:4px">
                    <div class="card-body">
                        <form id="form_proses" action="<?=base_url('/pos/post/up_bayar')?>" method="post">
                            <input type="hidden" name="cetak" id="cetak">
                            <input type="hidden" name="wc" value="<?=$wc?>">
                            <input type="hidden" name="id_init" value="<?=$id_init?>">
                            <input type="hidden" name="id_trx" value="<?=$id_trx?>">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Transaksi</th>
                                    <td><?php if (!empty($refund)){echo'Refund';}else{echo 'Pembelian';}?></td>
                                </tr>
                                <tr>
                                    <th>Total Harga</th>
                                    <td><?=rp($trx['transaksi_harga'])?></td>
                                </tr>
                                <tr>
                                    <th>Pajak</th>
                                    <td><?=rp($trx['transaksi_pajak'])?></td>
                                </tr>
                                <tr>
                                    <th>Service Charga</th>
                                    <td><?=rp($trx['transaksi_sc'])?></td>
                                </tr>
                                <tr>
                                    <th>Total Tagihan</th>
                                    <td>
                                        <?=rp($trx['transaksi_total_harga'])?>
                                        <input type="hidden" id="tagihan" value="<?=$trx['transaksi_total_harga']?>">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Jumlah Bayar</th>
                                    <td>
                                        <input id="bayar" type="number" name="nominal_bayar" class="form-control"
                                            required>
                                        <div class="invalid-feedback">Tidak boleh kosong</div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Kembalian</th>
                                    <td>
                                        <span id="display_kembalian"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="margin:0px;padding:0px">
                                        <hr>
                                    </td>
                                </tr>
                                <?php include $f1?>
                            </table>
                        </form>
                        <div class="d-flex justify-content-around align-items-center" style="width:100%">
                            <?php include $f3?>
                            <?php include $f2?>
                            <a href="<?=base_url('u/'.$wc.'?menu=penjualan&submenu=k3f3&open=yes')?>"
                                style="width:150px" class="btn btn-md btn-danger">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Informasi transaksi -->
            <div class="col-6 tbl-sm">
                <div class="card info-card sales-card" style="height:auto;margin-top:4px">
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th>Tanggal</th>
                                <td><?=date('d/m/Y')?></td>
                            </tr>
                            <tr>
                                <th>Tipe Transaksi</th>
                                <td><?=$trx['type_trans']?></td>
                            </tr>
                            <tr>
                                <th>Nama Customer</th>
                                <td><?=$trx['transaksi_nama_cus']?></td>
                            </tr>
                            <tr>
                                <th>Meja</th>
                                <td><?=$trx['meja_nama']?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>
</main><!-- End #main -->

<!-- script fitur POS -->
<script>
const bayar = document.getElementById('bayar');
const tagihan = document.getElementById('tagihan');
const dis_kembalian = document.getElementById('display_kembalian');

bayar.addEventListener('input', function() {
    kembali = parseInt(bayar.value) - parseInt(tagihan.value);
    dis_kembalian.innerHTML = RP(kembali);
});

function bayar_cetak() {
    document.getElementById('cetak').value = 'yes';
    if (document.getElementById('bayar').value == '') {
        alert('Nilai tidak boleh kosong');
        return false;
    }
    if (document.getElementById('bayar').value < 0) {
        alert('Nilai tidak boleh mines (-)');
        return false;
    }
    document.getElementById('form_proses').submit();
}

function bayar_only() {
    if (document.getElementById('bayar').value == '') {
        alert('Nilai tidak boleh kosong');
        return false;
    }
    if (document.getElementById('bayar').value < 0) {
        alert('Nilai tidak boleh mines (-)');
        return false;
    }
    document.getElementById('cetak').value = 'no';
    document.getElementById('form_proses').submit();
}

function updateClock() {
    var now = new Date();
    var hours = String(now.getHours()).padStart(2, '0');
    var minutes = String(now.getMinutes()).padStart(2, '0');
    var seconds = String(now.getSeconds()).padStart(2, '0');

    var timeString = hours + ':' + minutes + ':' + seconds;
    document.getElementById('time').textContent = timeString;
}

// Update jam setiap detik
setInterval(updateClock, 1000);

// Set awal untuk jam saat halaman dimuat
updateClock();
</script>
<?= $this->endSection() ?>
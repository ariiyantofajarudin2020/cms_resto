<?= $this->extend('layout/p_layout') ?>
<?php $this->section('content'); ?>
<?php include APPPATH.'Views/layout/u_function.php';?>

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
                <h5 class="card-title">Refund<span> <br>|<?=$induk['induk_perusahaan']?></span>
                </h5>
            </div>

            <div class="col-6">

            </div>
            <div class="col-3">
                <?php include 'date.php';?>
            </div>

            <!-- Pembayaran -->
            <div class="col-8 tbl-sm">
                <div class="card info-card sales-card" style="height:auto;margin-top:4px">
                    <div class="card-body">
                        <h5 class="card-title text-center">Daftar Menu Transaksi</h5>
                        <form id="form_proses" action="<?=base_url('/pos/post/up_refund')?>" method="post">
                            <input type="hidden" name="wc" value="<?=$wc?>">
                            <input type="hidden" name="id_init" value="<?=$init['id_initial']?>">
                            <input type="hidden" name="id_trx_lama" value="<?php if(!empty($id_trx)){echo $id_trx;}?>">
                            <input type="hidden" name="refund" value="yes">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Menu</th>
                                        <th>Harga</th>
                                        <th>Qty Order</th>
                                        <th>Qty Refund</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($menu)) {
                                        foreach ($menu as $i => $v) {$i++;?>
                                    <tr>
                                        <td><?=$i?></td>
                                        <td><?=$v['menu_nama']?></td>
                                        <td><?=RP($v['menu_harga_jual'])?></td>
                                        <td style="display:none" class="harga"><?=$v['menu_harga_jual']?></td>
                                        <td class="qty_awal"><?=$v['transaksi_menu_qty']?></td>
                                        <td>
                                            <input type="hidden" name="id_menu[]" value="<?=$v['id_menu']?>">
                                            <input class="form-control qty" type="number" name="menu_qty_refund[]"
                                                value="0" required>

                                        </td>
                                    </tr>
                                    <?php }}?>
                                    <tr>
                                        <th>Alasan Refund</th>
                                        <td colspan="5">
                                            <input class="form-control" type="text" name="alasan" required>
                                            <div class="invalid-feedback">Harap di isi</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                        <?php if(!empty($trx)) {?>
                        <hr>
                        <div class="text-left d-flex justify-content-left align-items-center">
                            <h5><strong>Total Nominal Refund :</strong>&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                            <h5 id="total"></h5>
                        </div>
                        <?php }?>
                        <hr>
                        <div class="d-flex justify-content-around align-items-center" style="width:100%">
                            <button onclick="submit_refund()" class="btn btn-success btn-md"
                                <?php if(empty($menu)) {echo 'style="display:none"';}?>>Proses</button>
                            <a href="<?=base_url('u/'.$wc.'?menu=penjualan&submenu=k3f3&open=yes')?>"
                                style="width:150px" class="btn btn-md btn-danger">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Informasi transaksi -->
            <div class="col-4 tbl-sm">
                <div class="card info-card sales-card" style="height:auto;margin-top:4px">
                    <div class="card-body">
                        <h5 class="card-title text-center">Cari ID Transaksi</h5>
                        <form id="form_proses" action="<?=base_url('/pos/post/get_trx_refund')?>" method="post">
                            <div class="d-flex justify-content-center align-items-center">
                                <input id="id_trx" class="form-control" type="number" name="id_trx" value="">
                                <input type="hidden" name="wc" value="<?=$wc?>">
                                <button type="submit" class="btn btn-md btn-success">Cari</button>
                            </div>
                        </form>
                        <?php if(!empty($trx)) {?>
                        <div>
                            <table class="table table-borderless">
                                <tr>
                                    <th>ID Transaksi</th>
                                    <td><?=$trx['id_transaksi']?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Transaksi</th>
                                    <td><?=$trx['initial_tanggal']?></td>
                                </tr>
                                <tr>
                                    <th>Nama Customer</th>
                                    <td><?=$trx['transaksi_nama_cus']?></td>
                                </tr>
                                <tr>
                                    <th>Tipe Transaksi</th>
                                    <td><?=$trx['type_trans']?></td>
                                </tr>
                                <tr>
                                    <th>Jumlah Menu</th>
                                    <td><?php if(!empty($menu)){ echo count($menu);}else{echo '0';} ?></td>
                                </tr>
                            </table>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>

        </div>
    </section>
</main><!-- End #main -->

<!-- script fitur POS -->
<script>
const qtys = document.querySelectorAll('.qty');

function submit_refund() {
    let class_qty = document.getElementsByClassName('qty');
    for (let i = 0; i < class_qty.length; i++) {
        let qty_value = parseFloat(class_qty[i].value);
        if (isNaN(qty_value) || class_qty[i].value === '') {
            alert('QTY Tidak boleh NaN, Masukkan angka !!');
            return false;
        }
    }
    document.getElementById('form_proses').submit();
}

function hitung_total() {
    const hargas = document.querySelectorAll('.harga');
    const qtys = document.querySelectorAll('.qty');
    const qtys_awal = document.querySelectorAll('.qty_awal');

    let total = 0;

    // Looping semua baris
    hargas.forEach((hargaEl, i) => {
        const harga = parseFloat(hargaEl.textContent);

        const qty = parseFloat(qtys[i].value);
        const qty_awal = parseFloat(qtys_awal[i].textContent);
        if (qty > qty_awal) {
            alert('Qty refund tidak boleh melebihi qty beli !!');
            qtys[i].value = qty_awal;
            qty = qty_awal;
        }
        if (qty < 0) {
            alert('Qty refund tidak boleh mines (-) !!');
            qtys[i].value = 0;
            qty = 0;
        }
        total += harga * qty;
    });

    document.getElementById('total').textContent = RP(total);
}

// Tambahkan event listener ke semua input qty
document.querySelectorAll('.qty').forEach(input => {
    input.addEventListener('input', hitung_total);
});

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
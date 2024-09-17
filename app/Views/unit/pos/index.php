<?= $this->extend('layout/p_layout') ?>
<?php $this->section('content'); ?>
<?php include APPPATH.'Views/layout/u_function.php';?>
<?php
$f1=$f1_2=$f4=$f5=$f6=$f6=$f7='null.php';
$f2=$f3 ='none';
foreach ($fiturs as $key => $v) {
    switch ($v['id_fitur']) { 
        case 'k3f14':
            $f1 = 'daftar_menu.php';
            $f1_2 = 'daftar_katmenu.php';
            break;    
        case 'k3f20':
            $f2 = '';
            break;    
        case 'k3f21':
            $f3 = '';
            break;    
        case 'k3f22':
            $f4 = 'note.php';
            break;    
        case 'k3f23':
            $f5 = 'cetak_pesanan.php';
            break;
        case 'k3f25':
            $f6 = 'refund.php';
            break;   
        case 'k3f27':
            $f7 = 'daftar_meja.php';
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
                <h5 class="card-title">Point of Sales (POS Transaksi)<span> <br>|<?=$induk['induk_perusahaan']?></span>
                </h5>
            </div>
            <div class="col-6"></div>
            <div class="col-3">
                <?php include 'date.php';?>
            </div>

            <!-- Daftar Menu Transaksi -->
            <div class="col-6 tbl-sm">
                <div class="card info-card sales-card" style="height:290px;margin-bottom:10px;margin-top:4px">
                    <div class="card-body">
                        <h5 class="card-title text-center" style="padding-top:5px;padding-bottom:0px">
                            DAFTAR MENU PESANAN</h5>
                        <table class="table tbl-stripped tbl-sm" style="margin-bottom:0px">
                            <colgroup>
                                <col style="width:5px">
                                <col style="width:300px">
                                <col style="width:150px">
                                <col style="width:120px">
                                <col style="width:150px">
                                <col style="width:auto">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Menu</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                        <div style="height:200px;overflow:auto">
                            <table class="table tbl-stripped tbl-sm">
                                <colgroup>
                                    <col style="width:5px">
                                    <col style="width:300px">
                                    <col style="width:150px">
                                    <col style="width:120px">
                                    <col style="width:150px">
                                    <col style="width:auto">
                                </colgroup>
                                <tbody>
                                    <?php
                                    if (!empty($menu_new)) { 
                                    foreach ($menu_new as $i => $v) {$i++;?>
                                    <tr style="margin:0px">
                                        <td><?=$i?></td>
                                        <td><?=$v['menu_nama']?></td>
                                        <td><?=rp($v['menu_harga_jual'])?></td>
                                        <td><?=$v['transaksi_menu_qty']?></td>
                                        <td><?=rp($v['transaksi_menu_qty']*$v['menu_harga_jual'])?></td>
                                        <td>
                                            <form action="<?=base_url('/pos/post/del_menu')?>" method="post">
                                                <div class="" role="group"
                                                    style="display:flex;align-items:center;justify-content:center;padding:0px;margin:0px">
                                                    <button type="button" id="btn_edit_qty_<?=$v['id_transaksi_menu']?>"
                                                        style="display:<?=$f3?>"
                                                        class="btn btn-success btn-sm btn_edit_qty"
                                                        onclick="edit_menu('<?=$v['id_menu']?>','<?=$v['menu_nama']?>','<?=$v['transaksi_menu_qty']?>')">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                    &nbsp
                                                    <button type="submit" class="btn btn-sm btn-danger btn_hapus_menu"
                                                        style="display:<?=$f2?>"><i class="fa fa-trash"></i></button>
                                                    <input type="hidden" name="id_transaksi_menu"
                                                        value="<?=$v['id_transaksi_menu']?>">
                                                    <input type="hidden" name="wc" value="<?=$wc?>">
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php }}?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Menu -->
            <div class="col-3 tbl-sm">
                <?php include $f1?>
            </div>

            <!-- Daftar Kategori Menu -->
            <div class="col-3">
                <?php include $f1_2?>
            </div>

            <!-- Transaksi -->
            <div class="col-6">
                <div class="card info-card sales-card" style="height:250px;margin-bottom:0px">
                    <div class="card-body">
                        <table class="table table-borderless tbl-pos tbl-sm">
                            <colgroup>
                                <col class="pos-col1">
                                <col class="pos-col2">
                                <col class="pos-col1">
                                <col class="pos-col3">
                            </colgroup>
                            <tr>
                                <th>Total</th>
                                <td>: <?php if (!empty($trx_new)) { echo rp($trx_new['transaksi_harga']);}?></td>
                                <th>Nama Customer</th>
                                <td><input class="form-control btn-pos" type="text" name="nama" id="nama_input"
                                        value="<?php if (!empty($trx_new)) { echo $trx_new['transaksi_nama_cus'];}?>">
                                </td>
                            </tr>
                            <tr>
                                <th>Pajak</th>
                                <td>: <?php if (!empty($trx_new)) { echo rp($trx_new['transaksi_pajak']);}?></td>
                                <?php include $f4?>
                            </tr>
                            <tr>
                                <th>Service Charge</th>
                                <td>: <?php if (!empty($trx_new)) { echo rp($trx_new['transaksi_sc']);}?></td>
                                <th></th>
                            </tr>
                            <tr>
                                <th>Total Harga</th>
                                <td>: <?php if (!empty($trx_new)) { echo rp($trx_new['transaksi_total_harga']);}?></td>
                                <?php include $f5?>
                                <?php include $f6?>
                            </tr>
                            <tr>
                                <th>Type Trans <button id="btn_tiptrans" class="btn btn-sm btn-success"
                                        data-bs-toggle="modal" data-bs-target="#typetrans_modal">Pilih</button></th>
                                <td>: <?php if (!empty($trx_new)) { echo $trx_new['type_trans'];}?></td>
                                <th>
                                    <form action="<?=base_url('/pos/post/bayar')?>" method="POST">
                                        <input type="hidden" name="mode" id="mode">
                                        <!-- mode bayar only / bayar+cetak, dari javascript -->
                                        <input type="hidden" name="wc" value="<?=$wc?>">
                                        <input type="hidden" name="id_init" value="<?=$init['id_initial']?>">
                                        <input type="hidden" name="id_trx"
                                            value="<?php if (!empty($trx_new)) { echo $trx_new['id_transaksi'];}?>">
                                        <input type="hidden" name="nama" class="namacs"
                                            value="<?php if (!empty($trx_new)) { echo $trx_new['transaksi_nama_cus'];}?>">
                                        <input type="hidden" name="note" class="note"
                                            value="<?php if (!empty($trx_new)) { echo $trx_new['note'];}?>">
                                        <button type="button" onclick="pay(this.form,'pending')" id="btn_bayar_nanti"
                                            class="btn btn-pos btn-sm btn-secondary" style="display:none">Bayar
                                            Nanti</button>
                                        <button type="button" onclick="pay(this.form,'bayar')" id="btn_bayar"
                                            class="btn btn-pos btn-sm btn-warning" style="display:none">Bayar</button>
                                        </td>
                                    </form>

                                </th>
                                <td>
                                    <!-- tombol batal / kembali -->
                                    <form id="form_batal" action="/pos/post/trx_batal" method="post"
                                        style="display:none">
                                        <input type="hidden" name="id_trx"
                                            value="<?php if (!empty($trx_new)) { echo $trx_new['id_transaksi'];}?>">
                                        <input type="hidden" name="wc" value="<?=$wc?>">
                                    </form>
                                    <button id="btn_batal" type="button" class="btn btn-pos btn-sm btn-danger"
                                        style="display:<?=$f2?>" onclick="submit_batal()">Batal</button>

                                    <a href="<?=base_url('u/'.$wc.'?menu=penjualan&submenu=k3f3&open=yes')?>"
                                        id="btn_batal_pending" class="btn btn-pos btn-sm btn-outline-danger"
                                        style="display:none">Kembali</a>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>

            <!-- Transaksi belum bayar -->
            <div class="col-3">
                <div class="card info-card sales-card" style="margin-bottom:0px;height:250px;">
                    <div class="card-body">
                        <h5 class="card-title text-center" style="padding-top:5px;padding-bottom:0px">
                            TRANSAKSI BELUM BAYAR</h5>
                        <table class="table tbl-stripped tbl-sm" style="margin-bottom:0px">
                            <tr>
                                <th style="padding:2px;width:50px">Lihat</th>
                                <th style="padding:2px">Nama</th>
                                <th style="padding:2px">Meja</th>
                            </tr>
                        </table>
                        <div style="height:180px;overflow:auto">
                            <table class="table tbl-stripped tbl-sm">
                                <tbody>
                                    <?php
                                    if (!empty($trx_pending)) {
                                    foreach ($trx_pending as $i => $v) { ?>
                                    <tr>
                                        <td style="padding:2px;width:50px">
                                            <a href="<?=base_url('u/'.$wc.'?menu=penjualan&submenu=k3f3&open=yes&pending='.$v['id_transaksi'])?>"
                                                class="btn btn-sm btn-success"
                                                style="height:25px;display:flex;align-items:center">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                        <td style="padding:2px"><?=$v['transaksi_nama_cus']?></td>
                                        <td style="padding:2px"><?=$v['meja_nama']?></td>
                                    </tr>
                                    <?php }}?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Meja -->
            <div class="col-3">
                <?php include $f7; ?>
            </div>

        </div>
    </section>
</main><!-- End #main -->
<?php include 'fitur_lain.php'?>
<!-- Script Umum -->
<script>
document.addEventListener('DOMContentLoaded', function() {

    <?php if (empty($trx_new)){?>
    // disable beberapa button jika ada tidak ada transaksi
    try {
        document.getElementById('btn_cetak_pesanan').style.display = 'none';
        document.getElementById('btn_batal').style.display = 'none';
    } catch (error) {}
    <?php }?>

    // jika ada transaksi
    <?php if (!empty($trx_new)) { ?>

    // (aman)
    // Highlight meja yang dipilih
    try {
        new_meja('<?=$trx_new['id_meja']?>');
    } catch (error) {}

    <?php 
    // (aman)
    // hidden button batal jika status transaksi adalah pending
    // transaksi ter pending artinya pesanan sudah dibuat, tidak bisa dibatalkan
    if ($trx_new['transaksi_status']=='pending') {?>
    try {
        trx_new_pending();
    } catch (error) {}
    <?php
    }?>



    // jika menu belum ada
    <?php if (empty($menu_new)){?>
    try {
        document.getElementById('btn_cetak_pesanan').style.display = 'none';
    } catch (error) {}
    <?php }else{?>
    <?php
    // (aman)
    // Jika type trans = dine-in maka tombol bayar = Bayar Nanti
    if ($trx_new['type_trans'] == 'dine in') { ?>
    try {
        dinein();
    } catch (error) {}

    <?php } else { ?>
    try {
        not_dinein();
    } catch (error) {}
    <?php }?>
    <?php }}?>

    <?php 
    // (aman)
    // Disable meja yang dipakai oleh trx ter-pending
    foreach ($trx_pending as $v) {
        if ($v['id_meja'] !== $id_meja_default) { ?>
    pending_meja('<?=$v['id_meja']?>');
    <?php } } ?>
    // (aman)
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
</script>
<!-- Script fitur menu -->
<script>
function hidemenu() {
    <?php foreach ($katmenu as $v) { ?>
    document.getElementById('kat-<?=$v['id_menu_kategori']?>').style.display = 'none';
    document.getElementById('katmenu-<?=$v['id_menu_kategori']?>').className = 'btn btn-outline-dark btn-katmenu-pos';
    <?php } ?>
}

function show_menu(v) {
    hidemenu();
    document.getElementById('kat-' + v).style.display = '';
    document.getElementById('katmenu-' + v).className = 'btn btn-dark btn-katmenu-pos';

}

function select_menu(id, menu) {
    let in_menu = document.getElementById('menu');
    let in_id = document.getElementById('id_menu');
    let in_qty = document.getElementById('qty_menu');

    if (id != in_id.value) {
        in_qty.value = 1;
        in_menu.value = menu;
        in_id.value = id;
    } else {
        in_qty.value = parseInt(in_qty.value) + 1;
    }
    document.getElementById('menu_mode').value = 'add';
    document.getElementById('btn_tambah').innerHTML = 'Tambah';
    document.getElementById('btn_tambah').className = 'btn btn-success btn-sm';
}

function edit_menu(id, menu, qty) {
    document.getElementById('id_menu').value = id;
    document.getElementById('menu').value = menu;
    document.getElementById('qty_menu').value = qty;
    document.getElementById('menu_mode').value = 'edit';
    document.getElementById('btn_tambah').innerHTML = 'Ubah';
    document.getElementById('btn_tambah').className = 'btn btn-warning btn-sm';
}

function notmines() {
    let v = document.getElementById('qty_menu');
    if (parseInt(v.value) < 0) {
        alert('Nilai tidak boleh mines !');
        v.value = 1;
        return false;
    }
}
</script>
<!-- script fitur POS -->
<script>
function submit_batal() {
    <?php if (!empty($trx_new)) {?>
    document.getElementById('form_batal').submit();
    return;
    <?php }?>
    alert('Belum ada transaksi');
    return;
}

function submit_cetak_pesanan() {
    <?php if (!empty($trx_new)) {?>
    document.getElementById('form_cetak_pesanan').submit();
    return;
    <?php }?>
    alert('Belum ada transaksi');
    return;
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
<!-- script fitur note -->
<script>
document.getElementById('note_input').addEventListener('input', function() {
    var value = this.value;
    var notes = document.querySelectorAll('.note');
    notes.forEach(function(note) {
        note.value = value;
    });
});
</script>
<!-- Script fitur meja -->
<script>
function new_meja(v) {
    if (v) {
        document.getElementById('meja-' + v).className = 'btn btn-primary btn-meja-pos';
    }
}

function pending_meja(v) {
    if (v) {
        document.getElementById('meja-' + v).className = 'btn btn-secondary btn-meja-pos';
        document.getElementById('meja-' + v).disabled = true;
    }
}
</script>
<!-- script fitur lain lain -->
<script>
// sinkron data nama ke setiap input
document.getElementById('nama_input').addEventListener('input', function() {
    var value = this.value;
    var nama = document.querySelectorAll('.namacs');
    nama.forEach(function(namacs) {
        namacs.value = value;
    });
});
// penyesuaian tombol bayar berdasarkan type trans
function dinein() {
    <?php 
    if (!empty($trx_new)) {
    if ($trx_new['transaksi_status']=='pending') {?>
    document.getElementById('btn_bayar').style.display = '';
    document.getElementById('btn_bayar_nanti').style.display = 'none';
    return;
    <?php }} ?>

    document.getElementById('btn_bayar').style.display = 'none';
    document.getElementById('btn_bayar_nanti').style.display = '';
}

function not_dinein() {
    document.getElementById('btn_bayar').style.display = '';
    document.getElementById('btn_bayar_nanti').style.display = 'none';
}
// select pending trx
function trx_new_pending() {
    let btn_batal = document.getElementById('btn_batal');
    if (btn_batal) {
        btn_batal.style.display = 'none';
    }

    let btn_batal_pending = document.getElementById('btn_batal_pending');
    if (btn_batal_pending) {
        btn_batal_pending.style.display = '';
    }

    let daftar_meja = document.getElementById('daftar_meja');
    if (daftar_meja) {
        daftar_meja.style.display = 'none';
    }

    let btn_tiptrans = document.getElementById('btn_tiptrans');
    if (btn_tiptrans) {
        btn_tiptrans.disabled = true;
    }

    let nama_input = document.getElementById('nama_input');
    if (nama_input) {
        nama_input.disabled = true;
    }

    let note_input = document.getElementById('note_input');
    if (note_input) {
        note_input.disabled = true;
    }

    let btn_refund = document.getElementById('btn_refund');
    if (btn_refund) {
        btn_refund.disabled = true;
    }

    let class_btn_edit_qty = document.getElementsByClassName('btn_edit_qty');
    let class_btn_hapus_menu = document.getElementsByClassName('btn_hapus_menu');
    // cek apakah ada fitur edit qty
    if (class_btn_edit_qty) {
        // eksekusi disable edit_qty
        for (let i = 0; i < class_btn_edit_qty.length; i++) {
            class_btn_edit_qty[i].disabled = true;
        }
    }
    // cek apakah ada fitur hapus menu
    if (class_btn_hapus_menu) {
        // eksekusi disable btn_hapus_menu
        for (let i = 0; i < class_btn_hapus_menu.length; i++) {
            class_btn_hapus_menu[i].disabled = true;
        }
    }
}
</script>
<!-- script fitur pembayaran -->
<script>
function pay(form, data) {
    document.getElementById('mode').value = data;
    form.submit();
}
</script>
<?= $this->endSection() ?>
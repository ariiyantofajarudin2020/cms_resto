<?= $this->extend('layout/u_layout') ?>
<?php $this->section('content'); ?>
<main id="main" class="main">
    <div class="container">

        <section class="section dashboard">
            <div class="row">

                <!-- Sales Card -->
                <div class="col-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h4 class="card-title">Pembelian Order (PO)</h4>

                            <!--tabel unit-->
                            <table class="table table-bordered datatable" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Supplier</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach ($suppliers as $key => $u) : ?>
                                    <tr>
                                        <td><text><?=$key+1?></text>
                                        </td>
                                        <td><?= $u['supplier_nama'] ?></td>
                                        <td><?= $u['supplier_alamat'] ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <!--tombol detail-->
                                                <button class="btn btn-outline-primary btn-sm"
                                                    onclick="use_supplier(<?='`'.$u['id_supplier'].'`,`'.$u['supplier_nama'].'`'?>)">
                                                    <i class="fa fa-plus"></i> pilih
                                                </button>&nbsp
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End Sales Card -->

                <!-- Halaman Detail Unit -->
                <!-- Sales Card -->
                <div class="col-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">

                            <div class="pt-12 pb-2">
                                <h5 id="judul" class="card-title text-center pb-0 fs-4">Detail info</h5>
                            </div>
                            <form class="row g-3 needs-validation" novalidate
                                action="<?= base_url('/unit/post/up_po') ?>" enctype="multipart/form-data" method="post"
                                onsubmit="return simpan()">
                                <input type="hidden" name="id_induk" value="<?= $induk['id_induk'] ?>">
                                <input type="hidden" name="wc" value="<?= $wc ?>">
                                <input type="hidden" name="id_supplier" id="id_supplier">
                                <input type="hidden" name="id_po" id="id_po"
                                    value="<?='PO'.$induk['id_induk'].'-'.date('dmyHis')?>">

                                <div class="col-6">
                                    <label for="id" class="form-label">NO PO / PO ID</label>
                                    <input type="text" name="id" class="form-control" id="id"
                                        value="<?='PO'.$induk['id_induk'].'-'.date('dmyHis')?>" disabled required>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>

                                <div class="col-6">
                                    <label for="supplier" class="form-label">Supplier</label>
                                    <input type="text" name="supplier" class="form-control" id="supplier" disabled
                                        required>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>

                                <div class="col-6">
                                    <label for="harga" class="form-label">Total Harga</label>
                                    <input type="text" name="totalharga" class="form-control" id="totalharga" disabled
                                        required>
                                    <input type="hidden" name="harga" class="form-control" id="harga">
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>

                                <div class="col-6">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea name="keterangan" class="form-control" id="keterangan"></textarea>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>

                                <div class="col-12">
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#additem" id="btn_tambah_item">Tambah
                                        item</button>
                                    <br>
                                    <table id="tableitem" class="table table-sm tbl-sm">
                                        <thead>
                                            <tr>
                                                <th><span>No</span></th>
                                                <th width="30%">Item</th>
                                                <th><span>Harga</span></th>
                                                <th></th>
                                                <th><span>Qty</span></th>
                                                <th><span>Sub total</span></th>
                                                <th><span>A/n</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>

                                </div>

                                <div class="col-12">

                                    <!--tombol simpan-->
                                    <button id="btn_simpan" class="btn btn-primary btn-sm" type="submit"><i
                                            class="fa fa-save"></i>
                                        Proses
                                    </button>
                                    <!--tombol batal-->
                                    <button type="button" id="btn_batal" class="btn btn-danger btn-sm"
                                        onclick="batal()">
                                        <i class="fa fa-back"></i> Batal
                                    </button>&nbsp

                                    <script>
                                    function use_supplier(id, supplier) {
                                        document.getElementById('id_supplier').value = id;
                                        document.getElementById('supplier').value = supplier;
                                    }

                                    function simpan() {
                                        let idsupplier = document.getElementById('supplier').value;
                                        let total = document.getElementById('totalharga').value;
                                        let class_qty = document.getElementsByClassName('qty');
                                        for (let i = 0; i < class_qty.length; i++) {
                                            let qty = parseInt(class_qty[i].value);
                                            if (qty < 0) {
                                                alert('Qty tidak boeleh mines (-) !!');
                                                return false;
                                            }
                                        }
                                        if (idsupplier === "") {
                                            alert("Mohon pilih supplier !");
                                            return false;
                                        } else if (total === "") {
                                            alert("Mohon pilih item !");
                                            return false;
                                        } else {
                                            return confirm('Pastikan data sudah sesuai !, apakah data sudah sesuai ?');
                                        }
                                    }

                                    function resetvalue() {
                                        document.getElementById('supplier').value = '';
                                        document.getElementById('totalharga').value = '';
                                        document.getElementById('harga').value = '';
                                        document.getElementById('keterangan').value = '';
                                    }

                                    function batal() {
                                        resetvalue();
                                        reset_item();
                                    }
                                    const tbody = document.getElementById('tableitem').getElementsByTagName(
                                        'tbody')[0];


                                    function additem(iditem, item, satuan, harga) {

                                        const rows = tbody.getElementsByTagName('tr');
                                        let trcount = rows.length;

                                        const tr = document.createElement('tr');

                                        trcount++;
                                        tr.className = 'list_item';
                                        //no
                                        const td1 = document.createElement('td');
                                        td1.innerHTML = trcount;
                                        tr.appendChild(td1);
                                        //hidden
                                        const td2 = document.createElement('td');
                                        td2.innerHTML =
                                            '<input class="form-control" type="text" name="iditem[]" value="' + iditem +
                                            '" readonly>';
                                        td2.style = 'display:none';
                                        tr.appendChild(td2);
                                        //nama
                                        const td3 = document.createElement('td');
                                        td3.innerHTML = item;
                                        tr.appendChild(td3);
                                        //harga
                                        const td4 = document.createElement('td');
                                        td4.className = 'harga';
                                        td4.innerHTML = RP(harga);
                                        tr.appendChild(td4);

                                        //satuan
                                        const td5 = document.createElement('td');
                                        td5.innerHTML = '/' + satuan;
                                        tr.appendChild(td5);

                                        //qty
                                        const td6 = document.createElement('td');
                                        td6.innerHTML =
                                            '<input class="qty" type="number" name="qty[]" value="1" style="width:50px" onchange="total()" required>';
                                        tr.appendChild(td6);
                                        //sub total
                                        const td7 = document.createElement('td');
                                        td7.className = 'sub';
                                        td7.innerHTML = harga;
                                        tr.appendChild(td7);
                                        //button
                                        const td8 = document.createElement('td');
                                        td8.innerHTML =
                                            '<button type="button" onclick="hapus_item(this);" class="btn btn-danger btn-sm cur btn_hapus_item"><i class="bi bi-trash"></i></button>';
                                        tr.appendChild(td8);

                                        // Menambahkan tr baru ke tbody
                                        tbody.appendChild(tr);
                                        total();
                                    }

                                    function total() {
                                        let trcount = document.getElementsByClassName('harga');
                                        let qtys = document.getElementsByClassName('qty');
                                        let subs = document.getElementsByClassName('sub');
                                        let total = 0;
                                        for (let i = 0; i < trcount.length; i++) {
                                            let harga = rptoint(trcount[i].innerHTML);
                                            let qty = parseInt(qtys[i].value);

                                            let subTotal = harga * qty;
                                            total = total + subTotal;
                                            subs[i].innerHTML = RP(subTotal);

                                        }
                                        document.getElementById('totalharga').value = RP(total);
                                        document.getElementById('harga').value = total;
                                    }

                                    function hapus_item(button) {
                                        if (confirm(`Apakah anda yakin ingin menghapus ?`)) {
                                            var row = button.closest('tr');
                                            row.remove();
                                            total();
                                        }
                                    }

                                    function reset_item() {
                                        //jika list item tersedia maka di reset menjadi 0
                                        let row = document.getElementsByClassName('list_item');
                                        if (row) {
                                            let tbody = document.querySelector('#tableitem tbody');
                                            while (tbody.firstChild) {
                                                tbody.removeChild(tbody.firstChild);
                                            }
                                        }
                                    }
                                    </script>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- modal -->
    <!-- Daftar item Modal -->
    <div class="modal fade" id="additem" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="card-title">Pilih item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <table class="table datatable tbl-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Barcode</th>
                                    <th>Item</th>
                                    <th>Kategori</th>
                                    <th>Satuan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($items as $key=> $v) {
                            ?>
                                <tr>
                                    <td><?=$key+1?></td>
                                    <td><?=$v['item_barcode']?></td>
                                    <td><?=$v['item_nama']?></td>
                                    <td><?=$v['item_kategori']?></td>
                                    <td><?=$v['item_satuan']?></td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm"
                                            onclick="additem(<?=$v['id_item']?>,'<?=$v['item_nama']?>','<?=$v['item_satuan']?>',<?=$v['item_harga']?>)"
                                            data-bs-dismiss="modal">Tambah</button>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main><!-- End #main -->


<?= $this->endSection() ?>
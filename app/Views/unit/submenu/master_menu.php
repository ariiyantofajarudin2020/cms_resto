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
                            <h4 class="card-title">Master menu</h4>

                            <!--tabel unit-->
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Menu</th>
                                        <th>Kategori</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach ($menu as $key => $u) : ?>
                                    <tr>
                                        <td><text><?=$key+1?></text>
                                        </td>
                                        <td><?= $u['menu_nama'] ?></td>
                                        <td><?= $u['menu_kategori'] ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <!--tombol detail-->
                                                <button class="btn btn-outline-primary btn-sm"
                                                    onclick="lihat<?=$key?>()">
                                                    <i class="fa fa-eye"></i> lihat
                                                </button>&nbsp
                                            </div>
                                        </td>
                                    </tr>
                                    <script>
                                    function lihat<?=$key?>() {
                                        disabledform();
                                        document.getElementById('unique_old').value = '<?=$u["menu_nama"]?>';
                                        document.getElementById('nama').value = '<?=$u["menu_nama"]?>';
                                        document.getElementById('keterangan').value = '<?=$u["menu_keterangan"]?>';
                                        document.getElementById('harga_pokok').value = '<?=$u["menu_harga_pokok"]?>';
                                        document.getElementById('biaya_waste').value = '<?=$u["menu_biaya_waste"]?>';
                                        document.getElementById('biaya_lain').value = '<?=$u["menu_biaya_lain"]?>';
                                        document.getElementById('biaya_total').value = '<?=$u["menu_biaya_total"]?>';
                                        document.getElementById('harga_jual').value = '<?=$u["menu_harga_jual"]?>';
                                        document.getElementById('gross').value = '<?=$u["menu_gross"]?>';

                                        document.getElementById('menu_kategori_selected').value =
                                            '<?=$u["id_menu_kategori"]?>';
                                        document.getElementById('menu_kategori_selected').innerHTML =
                                            '<?=$u["menu_kategori"]?>';

                                        document.getElementById('mode').value = 'lihat';
                                        document.getElementById('id_menu').value = '<?=$u["id_menu"]?>';
                                        document.getElementById('judul').innerHTML = 'Detail info menu';
                                        document.getElementById('btn_tambah_item').style.display = 'none';
                                        document.getElementById('btn_edit').style.display = '';
                                        document.getElementById('btn_hapus').style.display = '';
                                        document.getElementById('btn_tambah').style.display = '';
                                        document.getElementById('btn_simpan').style.display = 'none';
                                        document.getElementById('btn_batal').style.display = 'none';

                                        //hapus tabel isi item
                                        reset_item();

                                        //menampilkan daftar item
                                        <?php foreach ($item_menu[$key] as $key2=> $v) {
                                        $no = $key2+1;
                                        $id = $v['id_item'];
                                        $item = $v['item_nama'];
                                        $satuan = $v['item_satuan'];
                                        $qty = $v['menu_item_qty'];
                                        ?>
                                        getitem(<?=$no?>, <?=$id?>, '<?=$item?>', '<?=$satuan?>', <?=$qty?>, );
                                        <?php } ?>
                                    }

                                    function getitem(no, id, item, satuan, qty) {
                                        const tbody = document.getElementById('tableitem').getElementsByTagName(
                                            'tbody')[0];
                                        const tr = document.createElement('tr');
                                        tr.className = 'list_item';

                                        const td1 = document.createElement('td');
                                        td1.innerHTML = no;
                                        tr.appendChild(td1);

                                        const td2 = document.createElement('td');
                                        td2.innerHTML =
                                            '<input class="form-control" type="text" name="iditem[]" value="' + id +
                                            '" readonly>';
                                        td2.style = 'display:none';
                                        tr.appendChild(td2);

                                        const td3 = document.createElement('td');
                                        td3.innerHTML = item;
                                        tr.appendChild(td3);

                                        const td4 = document.createElement('td');
                                        td4.innerHTML = satuan;
                                        tr.appendChild(td4);

                                        const td5 = document.createElement('td');
                                        td5.innerHTML =
                                            '<input class="form-control qty" type="number" name="qty[]" value="' + qty +
                                            '" required disabled>';
                                        tr.appendChild(td5);

                                        const td6 = document.createElement('td');
                                        td6.innerHTML =
                                            '<button type="button" onclick="hapus_item(this);" class="btn btn-danger btn-sm cur btn_hapus_item" style="display:none">hapus</button>';
                                        tr.appendChild(td6);

                                        // Menambahkan tr baru ke tbody
                                        tbody.appendChild(tr);

                                    }
                                    </script>
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
                                <h5 id="judul" class="card-title text-center pb-0 fs-4">Detail info menu</h5>
                            </div>
                            <form class="row g-3 needs-validation" novalidate
                                action="<?= base_url('/unit/post/up_menu') ?>" enctype="multipart/form-data"
                                method="post" onsubmit="return simpan()">
                                <input type="hidden" name="id_induk" value="<?= $induk['id_induk'] ?>">
                                <input type="hidden" name="wc" value="<?= $wc ?>">
                                <input id="id_menu" type="hidden" name="id_menu">
                                <input id="mode" type="hidden" name="mode">
                                <input id="unique_old" type="hidden" name="unique_old">

                                <div class="col-4">
                                    <label for="nama" class="form-label">Nama menu</label>
                                    <input type="text" name="menu_nama" class="form-control" id="nama" disabled
                                        required>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>

                                <div class="col-4">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select name="id_menu_kategori" id="kategori" class="form-select cur" disabled
                                        required>
                                        <option selected value="" id="menu_kategori_selected"></option>
                                        <?php
                                            foreach($katmenu as $v) {
                                        ?>
                                        <option value="<?=$v['id_menu_kategori']?>">
                                            <?=$v['menu_kategori']?>
                                        </option>
                                        <?php
                                            }
                                        ?>

                                    </select>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>

                                <div class="col-4">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <input type="text" name="menu_keterangan" class="form-control" id="keterangan"
                                        disabled required>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>

                                <div class="col-4">
                                    <label for="harga_pokok" class="form-label">Harga pokok</label>
                                    <input type="number" name="menu_harga_pokok" class="form-control" id="harga_pokok"
                                        oninput="total()" disabled required>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>

                                <div class="col-4">
                                    <label for="biaya_waste" class="form-label">Biaya waste</label>
                                    <input type="number" name="menu_biaya_waste" class="form-control" id="biaya_waste"
                                        oninput="total()" disabled required>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>

                                <div class="col-4">
                                    <label for="biaya_lain" class="form-label">Biaya lain - lain</label>
                                    <input type="number" name="menu_biaya_lain" class="form-control" id="biaya_lain"
                                        oninput="total()" disabled required>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>

                                <div class="col-4">
                                    <label for="biaya_total" class="form-label">Biaya total</label>
                                    <input type="number" name="menu_biaya_total" class="form-control" id="biaya_total"
                                        disabled>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>

                                <div class="col-4">
                                    <label for="harga_jual" class="form-label">Harga jual</label>
                                    <input type="number" name="menu_harga_jual" class="form-control" id="harga_jual"
                                        oninput="total()" disabled>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>

                                <div class="col-4">
                                    <label for="gross" class="form-label">Keuntungan</label>
                                    <input type="number" name="menu_gross" class="form-control" id="gross" disabled>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>

                                <div class="col-12">
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#additem" id="btn_tambah_item" style="display:none">Tambah
                                        item</button>
                                    <br>
                                    <table id="tableitem" class="table datatable datatable-table tbl-sm datatable-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th width="30%">Item</th>
                                                <th>Satuan</th>
                                                <th>Qty</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>

                                </div>

                                <div class="col-12">

                                    <!--tombol tambah-->
                                    <button id="btn_tambah" type="button" class="btn btn-primary btn-sm"
                                        onclick="tambah()">
                                        <i class="fa fa-plus"></i>
                                        Tambah menu
                                    </button>
                                    <!--tombol simpan-->
                                    <button id="btn_simpan" class="btn btn-primary btn-sm" type="submit"
                                        style="display:none"><i class="fa fa-save"></i>
                                        Simpan
                                    </button>
                                    <!--tombol edit-->
                                    <button type="button" id="btn_edit" class="btn btn-success btn-sm" onclick="edit()"
                                        style="display:none">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>
                                    <!--tombol batal-->
                                    <button type="button" id="btn_batal" class="btn btn-danger btn-sm" onclick="batal()"
                                        style="display:none">
                                        <i class="fa fa-back"></i> Batal
                                    </button>&nbsp
                                    <!--tombol hapus-->
                                    <button type="submit" class="btn btn-danger  btn-sm" id="btn_hapus"
                                        style="display:none"
                                        onclick="return confirm('Apakah anda yakin ingin menghapus ?')">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>

                                    <script>
                                    function simpan() {
                                        let pokok = parseInt(document.getElementById('harga_pokok').value);
                                        let waste = parseInt(document.getElementById('biaya_waste').value);
                                        let lain = parseInt(document.getElementById('biaya_lain').value);
                                        let total = parseInt(document.getElementById('biaya_total').value);
                                        let jual = parseInt(document.getElementById('harga_jual').value);
                                        let untung = parseInt(document.getElementById('gross').value);

                                        let class_qty = document.getElementsByClassName('qty');
                                        for (let i = 0; i < class_qty.length; i++) {
                                            let qty = parseInt(class_qty[i].value);
                                            if (qty < 0) {
                                                alert('Qty tidak boeleh mines (-) !!');
                                                return false;
                                            }
                                        }
                                        if (pokok < 0 || waste < 0 || lain < 0 || total < 0 || jual < 0 ||
                                            untung < 0) {
                                            alert('Tidak boleh ada nilai mines (-) !!');
                                            return false;
                                        } else if (confirm(
                                                'Pastikan data sudah sesuai !!, Apakah data sudah sesuai ?')) {
                                            document.getElementById('biaya_total').disabled = false;
                                            document.getElementById('gross').disabled = false;
                                        } else {
                                            return false;
                                        }
                                    }

                                    function enabledform() {
                                        document.getElementById('nama').disabled = false;
                                        document.getElementById('kategori').disabled = false;
                                        document.getElementById('keterangan').disabled = false;

                                        document.getElementById('harga_pokok').disabled = false;
                                        document.getElementById('biaya_waste').disabled = false;
                                        document.getElementById('biaya_lain').disabled = false;
                                        document.getElementById('harga_jual').disabled = false;

                                        let qty = document.getElementsByClassName('qty');
                                        for (let i = 0; i < qty.length; i++) {
                                            qty[i].disabled = false;
                                        }
                                    }

                                    function disabledform() {
                                        document.getElementById('nama').disabled = true;
                                        document.getElementById('kategori').disabled = true;
                                        document.getElementById('keterangan').disabled = true;

                                        document.getElementById('harga_pokok').disabled = true;
                                        document.getElementById('biaya_waste').disabled = true;
                                        document.getElementById('biaya_lain').disabled = true;
                                        document.getElementById('harga_jual').disabled = true;

                                        let qty = document.getElementsByClassName('qty');
                                        for (let i = 0; i < qty.length; i++) {
                                            qty[i].disabled = true;
                                        }
                                    }

                                    function resetvalue() {
                                        document.getElementById('nama').value = '';
                                        document.getElementById('keterangan').value = '';

                                        document.getElementById('harga_pokok').value = '';
                                        document.getElementById('biaya_waste').value = '';
                                        document.getElementById('biaya_lain').value = '';
                                        document.getElementById('biaya_total').value = '';
                                        document.getElementById('harga_jual').value = '';
                                        document.getElementById('gross').value = '';
                                        document.getElementById('menu_kategori_selected').value = '';
                                        document.getElementById('menu_kategori_selected').innerHTML = '';
                                    }

                                    function tambah() {
                                        reset_item();
                                        resetvalue();
                                        enabledform();
                                        document.getElementById('mode').value = 'create';
                                        document.getElementById('id_menu').value = '';
                                        document.getElementById('judul').innerHTML = 'Tambah menu baru';
                                        document.getElementById('btn_tambah').style.display = 'none';
                                        document.getElementById('btn_simpan').style.display = '';
                                        document.getElementById('btn_edit').style.display = 'none';
                                        document.getElementById('btn_batal').style.display = '';
                                        document.getElementById('btn_hapus').style.display = 'none';
                                        document.getElementById('btn_tambah_item').style.display = '';

                                        let btn_hapus_item = document.getElementsByClassName('btn_hapus_item');
                                        for (let i = 0; i < btn_hapus_item.length; i++) {
                                            btn_hapus_item[i].style.display = 'none';
                                        }
                                    }

                                    function edit() {
                                        enabledform();
                                        document.getElementById('mode').value = 'edit';
                                        document.getElementById('judul').innerHTML = 'Ubah data menu';
                                        document.getElementById('btn_tambah').style.display = 'none';
                                        document.getElementById('btn_simpan').style.display = '';
                                        document.getElementById('btn_edit').style.display = 'none';
                                        document.getElementById('btn_batal').style.display = '';
                                        document.getElementById('btn_hapus').style.display = 'none';
                                        document.getElementById('btn_tambah_item').style.display = '';

                                        let btn_hapus_item = document.getElementsByClassName('btn_hapus_item');
                                        for (let i = 0; i < btn_hapus_item.length; i++) {
                                            btn_hapus_item[i].style.display = '';
                                        }
                                    }

                                    function batal() {
                                        resetvalue();
                                        disabledform();
                                        reset_item();
                                        document.getElementById('mode').value = 'lihat';
                                        document.getElementById('judul').innerHTML = 'Detail info menu';
                                        document.getElementById('btn_tambah').style.display = '';
                                        document.getElementById('btn_simpan').style.display = 'none';
                                        document.getElementById('btn_edit').style.display = 'none';
                                        document.getElementById('btn_batal').style.display = 'none';
                                        document.getElementById('btn_hapus').style.display = 'none';
                                        document.getElementById('btn_tambah_item').style.display = 'none';

                                        let btn_hapus_item = document.getElementsByClassName('btn_hapus_item');
                                        for (let i = 0; i < btn_hapus_item.length; i++) {
                                            btn_hapus_item[i].style.display = 'none';
                                        }
                                    }

                                    function total() {
                                        var biaya_total =
                                            parseInt(document.getElementById('harga_pokok').value) +
                                            parseInt(document.getElementById('biaya_waste').value) +
                                            parseInt(document.getElementById('biaya_lain').value);
                                        var gross = parseInt(document.getElementById('harga_jual').value) - biaya_total
                                        document.getElementById('biaya_total').value = biaya_total;
                                        document.getElementById('gross').value = gross;
                                    }

                                    function additem(iditem, item, satuan) {
                                        const tbody = document.getElementById('tableitem').getElementsByTagName(
                                            'tbody')[0];

                                        const rows = tbody.getElementsByTagName('tr');
                                        let trcount = rows.length;
                                        const tr = document.createElement('tr');

                                        trcount++;
                                        tr.className = 'tr-' + trcount;

                                        const td1 = document.createElement('td');
                                        td1.innerHTML = trcount;
                                        tr.appendChild(td1);

                                        const td2 = document.createElement('td');
                                        td2.innerHTML =
                                            '<input class="form-control" type="text" name="iditem[]" value="' + iditem +
                                            '" readonly>';
                                        td2.style = 'display:none';
                                        tr.appendChild(td2);

                                        const td3 = document.createElement('td');
                                        td3.innerHTML = item;
                                        tr.appendChild(td3);

                                        const td4 = document.createElement('td');
                                        td4.innerHTML = satuan;
                                        tr.appendChild(td4);

                                        const td5 = document.createElement('td');
                                        td5.innerHTML =
                                            '<input class="form-control qty" type="number" name="qty[]" value="" required>';
                                        tr.appendChild(td5);

                                        const td6 = document.createElement('td');
                                        td6.innerHTML =
                                            '<button type="button" onclick="hapus_item(this);" class="btn btn-danger btn-sm cur btn_hapus_item">hapus</button>';
                                        tr.appendChild(td6);

                                        // Menambahkan tr baru ke tbody
                                        tbody.appendChild(tr);
                                    }

                                    function hapus_item(button) {
                                        if (confirm(`Apakah anda yakin ingin menghapus ?`)) {
                                            var row = button.closest('tr');
                                            row.remove();
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
                        <table class="table datatable datatable-table tbl-sm datatable-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
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
                                    <td><?=$v['item_nama']?></td>
                                    <td><?=$v['item_kategori']?></td>
                                    <td><?=$v['item_satuan']?></td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm"
                                            onclick="additem(<?=$v['id_item']?>,'<?=$v['item_nama']?>','<?=$v['item_satuan']?>')"
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
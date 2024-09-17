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
                            <h4 class="card-title">Master Shift</h4>

                            <!--tabel unit-->
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Shift</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($shift as $key => $u) : ?>
                                    <tr>
                                        <td><text><?= ++$key ?></text>
                                        </td>
                                        <td><?= $u['shift'] ?></td>
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
                                        document.getElementById('unique_old').value = '<?=$u["shift"]?>';
                                        document.getElementById('shift').value = '<?=$u["shift"]?>';
                                        document.getElementById('mulai').value = '<?=$u["jam_mulai"]?>';
                                        document.getElementById('selesai').value = '<?=$u["jam_selesai"]?>';
                                        document.getElementById('mode').value = 'lihat';
                                        document.getElementById('id_shift').value = '<?=$u["id_shift"]?>';
                                        document.getElementById('judul').innerHTML = 'Detail info shift';
                                        document.getElementById('btn_edit').style.display = '';
                                        document.getElementById('btn_hapus').style.display = '';
                                        document.getElementById('btn_tambah').style.display = '';
                                        document.getElementById('btn_simpan').style.display = 'none';
                                        document.getElementById('btn_batal').style.display = 'none';
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
                                <h5 id="judul" class="card-title text-center pb-0 fs-4">Detail info shift</h5>
                            </div>
                            <form class="row g-3 needs-validation" novalidate
                                action="<?= base_url('/unit/post/up_shift') ?>" enctype="multipart/form-data"
                                method="post" onsubmit="return simpan()">
                                <input type="hidden" name="id_induk" value="<?= $induk['id_induk'] ?>">
                                <input type="hidden" name="wc" value="<?= $wc ?>">
                                <input id="id_shift" type="hidden" name="id_shift">
                                <input id="mode" type="hidden" name="mode">
                                <input id="unique_old" type="hidden" name="unique_old">

                                <div class="col-12">
                                    <label for="shift" class="form-label">Shift</label>
                                    <input type="text" maxlength="1" pattern="[0-9]" name="shift" class="form-control"
                                        id="shift" disabled required>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>
                                <div class="col-6">
                                    <label for="mulai" class="form-label">Jam Mulai</label>
                                    <input type="text" name="mulai" class="form-control" id="mulai" disabled required>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>
                                <div class="col-6">
                                    <label for="selesai" class="form-label">Jam Selesai</label>
                                    <input type="text" name="selesai" class="form-control" id="selesai" disabled
                                        required>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>

                                <div class="col-12">

                                    <!--tombol tambah-->
                                    <button id="btn_tambah" type="button" class="btn btn-primary btn-sm"
                                        onclick="tambah()">
                                        <i class="fa fa-plus"></i>
                                        Tambah shift
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
                                        let shift = parseInt(document.getElementById('shift').value);
                                        if (shift < 0) {
                                            alert('Tidak boleh ada nilai mines (-) !!');
                                            return false;
                                        }
                                    }

                                    function enabledform() {
                                        document.getElementById('shift').disabled = false;
                                        document.getElementById('mulai').disabled = false;
                                        document.getElementById('selesai').disabled = false;
                                    }

                                    function disabledform() {
                                        document.getElementById('shift').disabled = true;
                                        document.getElementById('mulai').disabled = true;
                                        document.getElementById('selesai').disabled = true;
                                    }

                                    function resetvalue() {
                                        document.getElementById('shift').value = '';
                                        document.getElementById('mulai').value = '';
                                        document.getElementById('selesai').value = '';
                                    }

                                    function tambah() {
                                        resetvalue();
                                        enabledform();
                                        document.getElementById('mode').value = 'create';
                                        document.getElementById('id_shift').value = '';
                                        document.getElementById('judul').innerHTML = 'Tambah shift baru';
                                        document.getElementById('btn_tambah').style.display = 'none';
                                        document.getElementById('btn_simpan').style.display = '';
                                        document.getElementById('btn_edit').style.display = 'none';
                                        document.getElementById('btn_batal').style.display = '';
                                        document.getElementById('btn_hapus').style.display = 'none';
                                    }

                                    function edit() {
                                        enabledform();
                                        document.getElementById('mode').value = 'edit';
                                        document.getElementById('judul').innerHTML = 'Ubah data shift';
                                        document.getElementById('btn_tambah').style.display = 'none';
                                        document.getElementById('btn_simpan').style.display = '';
                                        document.getElementById('btn_edit').style.display = 'none';
                                        document.getElementById('btn_batal').style.display = '';
                                        document.getElementById('btn_hapus').style.display = 'none';
                                    }

                                    function batal() {
                                        resetvalue();
                                        disabledform();
                                        document.getElementById('mode').value = 'lihat';
                                        document.getElementById('judul').innerHTML = 'Detail info shift';
                                        document.getElementById('btn_tambah').style.display = '';
                                        document.getElementById('btn_simpan').style.display = 'none';
                                        document.getElementById('btn_edit').style.display = 'none';
                                        document.getElementById('btn_batal').style.display = 'none';
                                        document.getElementById('btn_hapus').style.display = 'none';
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
</main><!-- End #main -->
<?= $this->endSection() ?>
<!-- modal -->
<!-- Unit Insert Modal -->
<div class="modal fade" id="tambahunit" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="card-title">Tambah Unit Aplikasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <!-- Vertical Form -->
                    <form class="row" action="<?= base_url('insert_unit/') ?>" method="POST" id="tambahunitform"
                        enctype="multipart/form-data">
                        <div class="col-6">
                            <img src="#" alt="Profile Photo" width="100" height="100" id="photo-preview"
                                class="rounded-circle">
                            <input type="file" name="photo" id="photo" onchange="previewPhoto()" required>
                        </div>
                        <div class="col-6">
                            <div class="col">
                                <div class="row-6">
                                </div>
                                <div class="row-6">
                                    <br>
                                    <label for="wildcard" class="form-label">Wildcard URL | <span>Contoh :
                                            (coffe)</span> </label>
                                    <input type="text" class="form-control" name="wildcard" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="unit_nama" class="form-label">Nama Unit</label>
                            <input type="text" class="form-control" name="unit_nama" required>
                        </div>
                        <div class="col-6">
                            <label for="unit_alamat" class="form-label">Alamat
                                Lengkap</label>
                            <input type="text" class="form-control" name="unit_alamat" required>
                        </div>
                        <div class="col-6">
                            <label for="unit_telpon" class="form-label">Nomor
                                Telpon</label>
                            <input type="text" class="form-control" name="unit_telepon" required>
                        </div>
                        <div class="col-6">
                            <label for="unit_email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="unit_email" required>
                        </div>
                        <div class="col-6">
                            <label for="unit_induk" class="form-label">Unit Induk</label>
                            <select id="unit_induk" name="unit_induk" class="form-select cur"
                                aria-label="Default select example" required>
                                <?php foreach ($getinduk as $key => $u): ?>
                                <option value="<?=$u['id_induk']?>"><?=$u['induk_nama']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="unit_deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="unit_deskripsi" cols="30" rows="3"></textarea>
                        </div>
                        <div class="col-12">
                            <br>
                            <h5>Pilih Fitur : </h5>
                            <!--input daftar fitur-->
                            <div class="row">
                                <?php include 'tab_fitur_2.php'; ?>
                                <?php include 'tab_fitur_3.php'; ?>
                                <?php include 'tab_fitur_4.php'; ?>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="btn_simpan">Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
            </form><!-- Vertical Form -->
        </div>
    </div>
</div>
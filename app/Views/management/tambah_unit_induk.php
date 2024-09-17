<!-- modal -->
<!-- Unit Induk Insert Modal -->
<div class="modal fade" id="tambahinduk" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="card-title">Tambah Unit Induk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <!-- Vertical Form -->
                    <form class="row" action="<?= base_url('insert_induk/') ?>" method="POST">
                        <div class="col-6">
                            <label for="induk_nama" class="form-label">Nama Unit</label>
                            <input type="text" class="form-control" name="induk_nama" required>
                        </div>
                        <div class="col-6">
                            <label for="induk_perusahaan" class="form-label">Nama Perusahaan</label>
                            <input type="text" class="form-control" name="induk_perusahaan" required>
                        </div>
                        <div class="col-6">
                            <label for="induk_alamat" class="form-label">Alamat Lengkap</label>
                            <input type="text" class="form-control" name="induk_alamat" required>
                        </div>
                        <div class="col-6">
                            <label for="induk_jenis" class="form-label">Jenis Usaha</label>
                            <input type="text" class="form-control" name="induk_jenis" required>
                        </div>
                        <div class="col-6">
                            <label for="induk_pic" class="form-label">PIC</label>
                            <input type="text" class="form-control" name="induk_pic" required>
                        </div>
                        <div class="col-6">
                            <label for="induk_pic_telepon" class="form-label">Nomor Telepon PIC</label>
                            <input type="text" class="form-control" name="induk_pic_telepon" required>
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
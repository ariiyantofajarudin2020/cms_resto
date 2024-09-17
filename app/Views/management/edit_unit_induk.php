                        <!--Edit Unit Induk-->
                        <?php if (isset($edits)): ?>
                        <h5 class="card-title">Ubah Data Unit Induk</h5>
                        <form class="row" action="/?menu=induk" method="POST">
                            <input type="hidden" name="updateid" value="<?= $edits['id_induk'] ?>">
                            <div class="col-6">
                                <label for="induk_nama" class="form-label">Nama Unit Induk</label>
                                <input type="text" value="<?= $edits['induk_nama'] ?>" class="form-control"
                                    name="induk_nama" required>
                            </div>
                            <div class="col-6">
                                <label for="induk_perusahaan" class="form-label">Nama Perusahaan</label>
                                <input type="text" value="<?= $edits['induk_perusahaan'] ?>" class="form-control"
                                    name="induk_perusahaan" required>
                            </div>
                            <div class="col-6">
                                <label for="induk_alamat" class="form-label">Alamat Lengkap</label>
                                <input type="text" value="<?= $edits['induk_alamat'] ?>" class="form-control"
                                    name="induk_alamat" required>
                            </div>
                            <div class="col-6">
                                <label for="induk_jenis" class="form-label">Jenis Usaha</label>
                                <input type="text" value="<?= $edits['induk_jenis'] ?>" class="form-control"
                                    name="induk_jenis" required>
                            </div>
                            <div class="col-6">
                                <label for="induk_pic" class="form-label">PIC</label>
                                <input type="text" value="<?= $edits['induk_pic'] ?>" class="form-control"
                                    name="induk_pic" required>
                            </div>
                            <div class="col-6">
                                <label for="induk_pic_telpon" class="form-label">Nomor
                                    Telpon PIC</label>
                                <input type="text" value="<?= $edits['induk_pic_telepon'] ?>" class="form-control"
                                    name="induk_pic_telepon" required>
                                <br>
                            </div>
                            <div class="col-3">
                                <button type="submit" class="btn btn-success btn-sm">
                                    Simpan
                                </button>
                            </div>
                            <div class="col-3">
                                <a href="/?menu=induk">
                                    <button type="button" class="btn btn-danger btn-sm">
                                        Batal
                                    </button></a>
                            </div>
                        </form><!-- Vertical Form -->
                        <?php endif;?>
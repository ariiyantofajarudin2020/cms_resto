<?= $this->extend('layout/m_layout') ?>
<?php $this->section('content') ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Unit Aplikasi</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Management</li>
          <li class="breadcrumb-item active"><a href="index.php">Unit Aplikasi</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

            <!-- Sales Card -->
            <div class="col-12">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Selamat datang di Aplikasi POS<span>| PT.Nama Perusahaan</span></h5>
                  
                  <!--tombol tambah-->
                  <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahunit">
                  <i class="fa fa-plus"></i>
                  Tambah Unit Aplikasi
                  </button>

                  <br><br>
                  
                  <!--tabel daftar unit-->
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Unit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($unit as $key => $u) : ?>
                        <tr>
                            <text style="visibility: hidden;"><?= ++$key ?></text>
                            <td><?= $u['id_unit'] ?></td>
                            <td><?= $u['unit_nama'] ?></td>
                            <td>
                                <!--tombol detail-->
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                  data-bs-target="#unitfitur" onclick="loadFiturs(<?= $u['id_unit']; ?>)">
                                  <i class="fa fa-eye"></i>
                                  Detail
                                </button>
                                <!--tombol edit-->
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editunit-<?= $u['id_unit'] ?>">
                                    <i class="fa fa-edit"></i>
                                    Edit
                                </button>
                                <!--tombol hapus-->
                                <a href="<?= base_url('management/deleteunit/'.$u['id_unit']) ?>"
                                    class="btn btn-danger  btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus ?')">
                                    <i class="fa fa-trash"></i>
                                    Hapus
                                </a>
                            </td>

                        </tr>
                            <!-- Edit Unit Modal -->
                          <div class="modal fade" id="editunit-<?= $u['id_unit'] ?>" tabindex="-1">
                                      <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="card-title">Edit Unit Aplikasi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                          <div class="col-lg-12">
                                                <!-- Vertical Form -->
                                                <form class="row" action="<?= base_url('management/editunit/'.$u['id_unit']) ?>" method="POST" id="editunitform-<?= $u['id_unit'] ?>">
                                                  <div class="col-6">
                                                    <label for="unit_nama" class="form-label">Nama Unit</label>
                                                    <input type="text" value="<?= $u['unit_nama'] ?>" class="form-control" name="unit_nama" required >
                                                  </div>
                                                  <div class="col-6">
                                                    <label for="unit_alamat" class="form-label">Alamat Lengkap</label>
                                                    <input type="text" value="<?= $u['unit_alamat'] ?>" class="form-control" name="unit_alamat" required >
                                                  </div>
                                                  <div class="col-6">
                                                    <label for="unit_telpon" class="form-label">Nomor Telpon</label>
                                                    <input type="number" value="<?= $u['unit_telepon'] ?>" class="form-control" name="unit_telepon" required >
                                                  </div>
                                                  <div class="col-6">
                                                    <label for="unit_email" class="form-label">Email</label>
                                                    <input type="email" value="<?= $u['unit_email'] ?>" class="form-control" name="unit_email" required >
                                                  </div>     
                                                  <div class="col-12">
                                                    <label for="unit_deskripsi" class="form-label">Deskripsi</label>
                                                    <textarea class="form-control" name="unit_deskripsi" cols="30" rows="3"><?= $u['unit_deskripsi'] ?></textarea>
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
                        <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
              </div>
            </div><!-- End Sales Card -->
      </div>
    </section>
  </main><!-- End #main -->

<!-- modal -->
    <!-- Detail Unit Modal -->
    <div class="modal fade" id="unitfitur" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="card-title">Detail Unit Aplikasi</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="col-lg-12">
                          <!-- Vertical Form -->
                            <div class="col-12" id="detail_unit">
                            </div>               
                    </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
    </div>
    <!-- Unit Insert Modal -->
    <div class="modal fade" id="tambahunit" tabindex="-1">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="card-title">Tambah Unit Aplikasi</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="col-lg-12">
                          <!-- Vertical Form -->
                          <form class="row" action="<?= base_url('management/insertunit/') ?>" method="POST" id="tambahunitform">
                            <div class="col-6">
                              <label for="unit_nama" class="form-label">Nama Unit</label>
                              <input type="text" class="form-control" name="unit_nama" required >
                            </div>
                            <div class="col-6">
                              <label for="unit_alamat" class="form-label">Alamat Lengkap</label>
                              <input type="text" class="form-control" name="unit_alamat" required >
                            </div>
                            <div class="col-6">
                              <label for="unit_telepon" class="form-label">Nomor Telepon</label>
                              <input type="number" class="form-control" name="unit_telepon" required >
                            </div>
                            <div class="col-6">
                              <label for="unit_email" class="form-label">Email</label>
                              <input type="email" class="form-control" name="unit_email" required >
                            </div>     
                            <div class="col-12">
                              <label for="unit_deskripsi" class="form-label">Deskripsi</label>
                              <textarea  class="form-control" name="unit_deskripsi" cols="30" rows="5"></textarea>
                            </div>

                            <div class="col-12">
                              <br>
                              <h5>Pilih Fitur : </h5>
                            </div>
                            
                            
                            <div class="col-3">
                              <input class="form-check-input cur" type="checkbox" name="fitur[]" value="f1" id="f1"  >
                              <label for="f1" class="form-label cur">fitur 1</label>
                            </div>     
                            <div class="col-3">
                              <input class="form-check-input cur" type="checkbox" name="fitur[]" value="f2" id="f2">
                              <label for="f2" class="form-label cur">fitur 2</label>
                            </div>     
                            <div class="col-3">
                              <input class="form-check-input cur" type="checkbox" name="fitur[]" value="f3" id="f3">
                              <label for="f3" class="form-label cur">fitur 3</label>
                            </div>     
                            <div class="col-3">
                              <input class="form-check-input cur" type="checkbox" name="fitur[]" value="f4" id="f4">
                              <label for="f4" class="form-label cur">fitur 4</label>
                            </div>     
                            <div class="col-3">
                              <input class="form-check-input cur" type="checkbox" name="fitur[]" value="f5" id="f5">
                              <label for="f5" class="form-label cur">fitur 5</label>
                            </div>     
                            <div class="col-3">
                              <input class="form-check-input cur" type="checkbox" name="fitur[]" value="f6" id="f6">
                              <label for="f6" class="form-label cur">fitur 6</label>
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
    <script>
    function loadFiturs(idUnit) {
        // Lakukan request AJAX ke server untuk mendapatkan data fitur
        fetch('<?= base_url('management/getFiturs'); ?>/' + idUnit)
            .then(response => response.text())
            .then(data => {
                document.getElementById('detail_unit').innerHTML = data;
            });
    }
    </script>
  <?= $this->endSection()?>
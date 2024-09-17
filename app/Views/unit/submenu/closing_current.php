<?= $this->extend('layout/u_layout') ?>
<?php $this->section('content'); ?>
<?php include APPPATH.'Views/layout/u_function.php';?>
<main id="main" class="main">
    <div class="container">

        <section class="section dashboard">
            <div class="row">

                <!-- Sales Card -->
                <div class="col-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h4 class="card-title">Tutup Shift</h4>

                            <table class="table table-borderless tbl-sm " width="100%" cellspacing="0">
                                <tr>
                                    <th>Tanggal</th>
                                    <td><?=$init_current['initial_tanggal']?></td>
                                </tr>
                                <tr>
                                    <th>Jam Initial</th>
                                    <td><?=$init_current['initial_jam']?></td>
                                </tr>
                                <tr>
                                    <th>Shift</th>
                                    <td><?=$init_current['shift']?></td>
                                </tr>
                                <tr>
                                    <th>Kasir</th>
                                    <td><?=$init_current['user_nama']?></td>
                                </tr>
                                <tr>
                                    <th>Modal</th>
                                    <td><?=rp($init_current['initial_modal'])?></td>
                                </tr>
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
                                <h4 id="judul" class="card-title text-center">Input KAS</h4>
                            </div>
                            <form class="needs-validation" novalidate action="<?= base_url('/unit/post/up_closing') ?>"
                                method="POST" onsubmit="return simpan()">
                                <input type="hidden" name="id_induk" value="<?= $induk['id_induk'] ?>">
                                <input type="hidden" name="wc" value="<?=$wc?>">
                                <input type="hidden" name="id_init" value="<?=$init_current['id_initial']?>">
                                <!--tabel aktual kas-->
                                <table class="table tbl-sm" width="100%" cellspacing="0">
                                    <tr>
                                        <th>Uang Tunai</th>
                                        <td>
                                            <input type="number" name="tunai" id="tunai" class="form-control" value="0"
                                                required>
                                            <div class="invalid-feedback">Data tidak boleh kosong</div>
                                        </td>
                                    </tr>
                                    <?php foreach ($kartu as $key => $v) {$key++ ?>
                                    <tr>
                                        <th><?=$v['kartu_nama']?></th>
                                        <td>
                                            <input type="number" name="non[]" class="form-control non" value="0"
                                                required>
                                            <div class="invalid-feedback">Data tidak boleh kosong</div>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </table>
                                <button type="submit" class="btn btn-danger">Proses tutup shift</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main><!-- End #main -->
<script>
function simpan() {
    let tunai = parseInt(document.getElementById('tunai').value);
    if (tunai < 0) {
        alert('Nilai tidak boleh mines (-) !!');
        return false;
    }
    let class_non = document.getElementsByClassName('non');
    for (let i = 0; i < class_non.length; i++) {
        let non = parseInt(class_non[i].value);
        if (non < 0 || harga < 0) {
            alert('Nilai tidak boleh mines (-) !!');
            return false;
        }
    }
    return confirm('Pastikan data sudah sesuai !, apakah data sudah sesuai ?');
}
</script>
<?= $this->endSection() ?>
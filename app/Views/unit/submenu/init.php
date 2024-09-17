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
                            <h4 class="card-title">Initial Shift | <span>Mulai</span></h4>
                            <form class="needs-validation" novalidate action="<?= base_url('/unit/post/up_initial') ?>"
                                method="POST" onsubmit="return simpan()">
                                <input type="hidden" name="id_induk" value="<?= $induk['id_induk'] ?>">
                                <input type="hidden" name="wc" value="<?=$wc?>">

                                <table class="table table-borderless tbl-sm " width="100%" cellspacing="0">
                                    <tr>
                                        <th>Tanggal</th>
                                        <td><?=date('d/m/Y')?></td>
                                        <input type="hidden" name="tanggal" value="<?=date('d/m/Y')?>">
                                    </tr>
                                    <tr>
                                        <th>Shift</th>
                                        <td>
                                            <select name="id_shift" class="form-select cur" required>
                                                <?php foreach($shift as $v) {?>
                                                <option value="<?=$v['id_shift']?>">
                                                    <?=$v['shift']?>
                                                </option>
                                                <?php }?>
                                            </select>
                                            <div class="invalid-feedback">Mohon masukkan data</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Kasir</th>
                                        <td>
                                            <?=$user['user_nama']?>
                                            <input type="hidden" name="id_user" value="<?=$user['id_user']?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Modal</th>
                                        <td>
                                            <input type="number" name="modal" class="form-control" id="modal" required>
                                            <div class="invalid-feedback">Tidak boleh kosong !!</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><button type="submit" class="btn btn-primary btn-sm">Mulai</button></th>
                                    </tr>
                                </table>
                            </form>
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
                                <tial id="judul" class="card-title text-center">Daftar initial aktif</h4>
                            </div>
                            <!--tabel initial aktif-->
                            <table class="table datatable tbl-sm" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>User</th>
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                        <th>Shift</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($init_active as $key => $v) : ?>
                                    <tr>
                                        <td><text><?= ++$key ?></text>
                                        </td>
                                        <td><?= $v['user_nama'] ?></td>
                                        <td><?= $v['initial_tanggal'] ?></td>
                                        <td><?= $v['initial_jam'] ?></td>
                                        <td><?= $v['shift'] ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main><!-- End #main -->
<script>
function simpan() {
    let modal = parseFloat(document.getElementById('modal').value);
    if (modal < 0) {
        alert('Nilai modal tidak boleh mines (-) !!');
        return false;
    }
    confirm('Pastikan data sudah benar !!, Apakah data sudah benar ?');
}
</script>
<?= $this->endSection() ?>
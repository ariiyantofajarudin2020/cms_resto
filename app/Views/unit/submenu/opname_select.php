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
                            <h4 class="card-title">Stock Opname | <span>Pilih Item</span></h4>
                            <form class="needs-validation" novalidate
                                action="<?= base_url('/u/'.$wc.'?menu=stok&submenu=k4f4') ?>" method="post">
                                <button class="btn btn-success btn-sm" type="submit">Mulai Stock Opname</button>
                                <!--tabel unit-->
                                <table class="table datatable tbl-sm" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Item</th>
                                            <th>Satuan</th>
                                            <th>Kategori</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($item as $key => $u) : ?>
                                        <tr>
                                            <td><text><?= ++$key ?></text>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input name="item[]" type="checkbox" class="form-check-input cur"
                                                        id="item<?=$key?>" value="<?= $u['id_item'] ?>">
                                                    <label class="form-check-lable cur"
                                                        for="item<?=$key?>"><?= $u['item_nama'] ?></label>
                                                </div>
                                            </td>
                                            <td><?= $u['item_satuan'] ?></td>
                                            <td><?= $u['item_kategori'] ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Sales Card -->
            </div>
        </section>
    </div>
</main><!-- End #main -->
<?= $this->endSection() ?>
<!--Edit Unit Aplikasi-->
<?php
$editmode='';
$edit_set21 = '';
$edit_set22 = 'style="display:none;"';
$edit_set31 = '';
$edit_set32 = 'style="display:none;"';
$edit_set41 = '';
$edit_set42 = 'style="display:none;"';

foreach ($getall as $key => $v) :
    $varname = 'v'.$v['id_fitur'];
    $$varname = '';
endforeach;

if (isset($edits)):
    foreach ($fiturs as $key => $v) :
        $varname = 'v'.$v['id_fitur'];
        $$varname = 'checked';
        if (strpos($v['id_fitur'], 'k2') !== false) {
            $edit_set21 = 'checked';
            $edit_set22 = 'style="display:;"';
        }
        if (strpos($v['id_fitur'], 'k3') !== false) {
            $edit_set31 = 'checked';
            $edit_set32 = 'style="display:;"';
        }
        if (strpos($v['id_fitur'], 'k4') !== false) {
            $edit_set41 = 'checked';
            $edit_set42 = 'style="display:;"';
        }
    endforeach;
    ?>
<h5 class="card-title">Ubah Data Unit Aplikasi</h5>
<form class="row" action="/?menu=unit" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="updateid" value="<?= $edits['id_unit'] ?>">
    <div class="col-6">
        <img src="<?=base_url('images/'. $edits['photo']) ?>" alt="Profile Photo" width="100" height="100"
            id="photo-preview" class="rounded-circle">
        <input type="file" name="photo" id="photo" src="<?=base_url('images/'. $edits['photo']) ?>"
            onchange="previewPhoto()">
    </div>
    <div class="col-6">
        <div class="col">
            <div class="row-6">
                <button type="submit" class="btn btn-success btn-sm">
                    Simpan
                </button>
                <a href="<?=base_url('/?menu=unit')?>">
                    <button type="button" class="btn btn-danger btn-sm">
                        Batal
                    </button>
                </a>
            </div>
            <div class="row-6">
                <br>
                <label for="wildcard" class="form-label">Wildcard URL</label>
                <input type="text" value="<?= $edits['wildcard'] ?>" class="form-control" name="wildcard" required>
            </div>
        </div>
    </div>
    <div class="col-6">
        <label for="unit_nama" class="form-label">Nama Unit</label>
        <input type="text" value="<?= $edits['unit_nama'] ?>" class="form-control" name="unit_nama" required>
    </div>
    <div class="col-6">
        <label for="unit_alamat" class="form-label">Alamat
            Lengkap</label>
        <input type="text" value="<?= $edits['unit_alamat'] ?>" class="form-control" name="unit_alamat" required>
    </div>
    <div class="col-6">
        <label for="unit_telpon" class="form-label">Nomor
            Telpon</label>
        <input type="text" value="<?= $edits['unit_telepon'] ?>" class="form-control" name="unit_telepon" required>
    </div>
    <div class="col-6">
        <label for="unit_email" class="form-label">Email</label>
        <input type="email" value="<?= $edits['unit_email'] ?>" class="form-control" name="unit_email" required>
    </div>
    <div class="col-6">
        <label for="unit_deskripsi" class="form-label">Deskripsi</label>
        <textarea class="form-control" name="unit_deskripsi" cols="30"
            rows="3"><?= $edits['unit_deskripsi'] ?></textarea>
    </div>
    <div class="col-12">
        <label for="daftar_fitur" class="form-label">Pilih Fitur :</label>
        <div id="daftar_fitur" class="row">
            <?php include 'tab_fitur_2.php';?>
            <?php include 'tab_fitur_3.php';?>
            <?php include 'tab_fitur_4.php';?>
        </div>
    </div>
</form><!-- Vertical Form -->
<?php endif;?>
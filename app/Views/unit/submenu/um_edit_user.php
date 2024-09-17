<?php
if (isset($edit)){
    
    foreach ($unit_by_induk as $key => $u) :
    $varname = 'u'.$u['id_unit'];
    $$varname = '';
    endforeach;
    foreach ($userakses as $key => $u) :
        $varname = 'u'.$u['id_unit'];
        $$varname = 'checked';
    endforeach;
    ?>

<div class="pt-12 pb-2">
    <h5 class="card-title text-center pb-0 fs-4">Edit Data User</h5>
</div>
<form class="row g-3 needs-validation" novalidate action="<?= base_url('/unit/post/up_um') ?>"
    enctype="multipart/form-data" method="post">

    <input type="hidden" name="wc" value="<?= $wc ?>">
    <input type="hidden" name="id" value="<?= $userdata['id_user'] ?>">
    <input type="hidden" name="id_induk" value="<?= $induk['id_induk'] ?>">
    <input type="hidden" name="unique_old" value="<?= $userdata['user_nama']; ?>">

    <div class="col-6">
        <label for="username" class="form-label">Nama / Username</label>
        <input type="text" name="user_nama" class="form-control" id="username" value="<?= $userdata['user_nama']; ?>">
        <div class="invalid-feedback">Mohon masukkan username kamu</div>
    </div>

    <div class="col-6">
        <label for="alamat" class="form-label">Alamat Lengkap</label>
        <input type="text" name="user_alamat" class="form-control" id="alamat" value="<?= $userdata['user_alamat']; ?>"
            required>
        <div class="invalid-feedback">Mohon masukkan alamat kamu</div>
    </div>

    <div class="col-6">
        <label for="telepon" class="form-label">Nomor Telepon</label>
        <input type="text" name="user_telepon" class="form-control" id="telepon"
            value="<?= $userdata['user_telepon']; ?>" required>
        <div class="invalid-feedback">Mohon masukkan nomor telepon kamu</div>
    </div>

    <div class="col-6">
        <label for="yourEmail" class="form-label">Email</label>
        <input type="email" name="user_email" class="form-control" id="yourEmail"
            value="<?= $userdata['user_email']; ?>" required>
        <div class="invalid-feedback">Mohon masukkan email kamu</div>
    </div>
    <div class="col-6">
        <label class="form-label">Pilih Unit :</label>

        <table class="table table-sm table-bordered" width="100%">
            <tbody id="table_unit">
                <?php foreach ($unit_by_induk as $key => $u) :  $varname = 'u'.$u['id_unit'];?>
                <tr>
                    <td>
                        <div class="form-check form-switch">
                            <input name="units[]" class="form-check-input cur" type="checkbox"
                                id="unit<?= $u['id_unit'] ?>" value="<?= $u['id_unit'] ?>" <?= $$varname;?>>
                            <label class="form-check-label cur"
                                for="unit<?= $u['id_unit'] ?>"><?= $u['unit_nama'] ?></label>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="col-12">
        <button class="btn btn-primary w-100" type="submit">Simpan</button>
    </div>
</form>

<?php }
?>
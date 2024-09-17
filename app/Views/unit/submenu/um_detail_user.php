<?php
if (isset($detail)){?>
<div id="showimg" class="overlay" onclick="release()" style="display:none">
    <img src="<?= base_url('images/' . $userdata['user_photo']) ?>" alt="photo profil" width="500" height="auto">
</div>
<div class="pt-12 pb-2 text-center">
    <h5 class="card-title text-center pb-0 fs-4">Detail User</h5>
    <img class="rounded-circle cur" src="/images/<?=$userdata['user_photo']?>" alt="Profile Photo" width="100px"
        height="auto" onclick="showimg()">
</div>

<table class="table">
    <thead>
        <tr>
            <th>Username</th>
            <td><?=$userdata['user_nama']?></td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td><?=$userdata['user_alamat']?></td>
        </tr>
        <tr>
            <th>No Telepon</th>
            <td><?=$userdata['user_telepon']?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?=$userdata['user_email']?></td>
        </tr>
    </thead>
</table>

<!-- Detail Induk -->
<div class="card-body">
    <h4 class="card-title">Daftar Unit yang dapat diakses</h4>
    <table class="table table-sm">
        <tbody>
            <?php foreach($userakses as $u):?>
            <tr>
                <td>
                    <a href="/u/<?= $u['wildcard']; ?>?menu=profile" style="color:#03006e;font-weight:bold;">
                        <img id="img" class="rounded-circle" src="<?=base_url( 'images/' . $u['photo']) ?>" alt=""
                            width="50px" height="auto">
                        <?= $u['unit_nama']; ?>
                    </a>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<?php }
?>
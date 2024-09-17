<!--Detail Unit Aplikasi-->
<?php if (isset($details)): ?>
<h5 class="card-title">Detail Unit Aplikasi</h5>
<div id="showimg" class="overlay" onclick="release()" style="display:none">
    <img src="<?=base_url('images/'. $details['photo']) ?>" alt="photo profil" width="500" height="auto">
</div>
<table class="table table-borderless table-sm">
    <tr>
        <th>
            <img class="rounded-circle cur" src="<?=base_url('images/'. $details['photo']) ?>" alt="photo profil"
                width="100" height="auto" onclick="showimg()">
        </th>
    </tr>
    <tr>
        <th>ID Unit</th>
        <td><?= $details['id_unit']; ?></td>
    </tr>
    <tr>
        <th>Unit Induk</th>
        <td><?= $induk_detail['induk_nama']; ?>
            <a class="btn btn-sm cur" href="<?=base_url('/?=menu=induk&select='. $induk_detail['id_induk']) ?>"><i
                    class="fa fa-eye"></i></a>
        </td>
    </tr>
    <tr>
        <th>Nama Unit</th>
        <td><?= $details['unit_nama']; ?></td>
    </tr>
    <tr>
        <th>URL</th>
        <td><a href="http://localhost:8080/u/<?= $details['wildcard']; ?>"
                target="blank">localhost:8080/u/<?= $details['wildcard']; ?></a>
        </td>
    </tr>
    <tr>
        <th>Deskripsi</th>
        <td><?= $details['unit_deskripsi']; ?></td>
    </tr>
    <tr>
        <th>Alamat</th>
        <td><?= $details['unit_alamat']; ?></td>
    </tr>
    <tr>
        <th>No Telepon</th>
        <td><?= $details['unit_telepon']; ?></td>
    </tr>
    <tr>
        <th>Email</th>
        <td><?= $details['unit_email']; ?></td>
    </tr>
</table>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Kode Fitur</th>
            <th>Nama Fitur</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($fiturs as $fitur): ?>
        <tr>
            <td><?= $fitur['id_fitur']; ?></td>
            <td><?= $fitur['fitur']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>
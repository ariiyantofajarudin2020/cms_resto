<!--Detail Unit Induk-->
<?php if (isset($details)): ?>
<h5 class="card-title">Detail Unit Induk</h5>
<table class="table table-borderless table-sm">
    <tr>
        <th>ID Unit</th>
        <td><?= $details['id_induk']; ?></td>
    </tr>
    <tr>
        <th>Nama Unit Induk</th>
        <td><?= $details['induk_nama']; ?></td>
    </tr>
    <tr>
        <th>Nama Perusahaan</th>
        <td><?= $details['induk_perusahaan']; ?></td>
    </tr>
    <tr>
        <th>Alamat Lengkap</th>
        <td><?= $details['induk_alamat']; ?></td>
    </tr>
    <tr>
        <th>Jenis Usaha</th>
        <td><?= $details['induk_jenis']; ?></td>
    </tr>
    <tr>
        <th>PIC</th>
        <td><?= $details['induk_pic']; ?></td>
    </tr>
    <tr>
        <th>No Telepon PIC</th>
        <td><?= $details['induk_pic_telepon']; ?></td>
    </tr>
</table>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Unit Aplikasi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($units as $unit): ?>
        <tr>
            <td>
                <a href="/?menu=unit&select=<?= $unit['id_unit']; ?>" style="color:#03006e;font-weight:bold;">
                    <img id="img" class="rounded-circle" src="<?='images/'.$unit['photo']; ?>" alt="" width="50px"
                        height="auto">
                    <?= $unit['unit_nama']; ?>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>
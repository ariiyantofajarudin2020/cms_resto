<div class="pt-4 pb-2">
    <h5 class="card-title text-center pb-0 fs-4">Buat akun baru untuk Unit</h5>
    <p class="text-center small">Isi semua detail yang dibutuhkan</p>
</div>

<form class="row g-3 needs-validation" novalidate action="<?= base_url('/unit/post/in_user') ?>" method="post"
    enctype="multipart/form-data">
    <input type="hidden" name="from" value="<?=$from?>">
    <div class="col-6">
        <label for="photo" class="form-label">Foto Profil</label>
        <img src="" alt="Profile Photo" width="100" height="100" id="photo-preview" style="display:none" required>
        <br>
        <input id="photo" type="file" name="photo" id="photo" src="" onchange="previewPhoto()" required>
        <div class="invalid-feedback">Mohon pilih Foto Profil</div>
    </div>
    <div class="col-6">
    </div>
    <div class="col-6">
        <label for="yourName" class="form-label">Username</label>
        <input type="text" name="user_nama" class="form-control" id="yourName" required>
        <div class="invalid-feedback">Mohon masukkan nama lengkap kamu</div>
    </div>

    <div class="col-6">
        <label for="yourPassword" class="form-label">Password</label>
        <input type="password" name="user_password" class="form-control" id="yourPassword" required>
        <div class="invalid-feedback">Mohon masukkan password kamu</div>
    </div>

    <div class="col-6">
        <label for="alamat" class="form-label">Alamat Lengkap</label>
        <input type="text" name="user_alamat" class="form-control" id="alamat" required>
        <div class="invalid-feedback">Mohon masukkan alamat kamu</div>
    </div>

    <div class="col-6">
        <label for="telepon" class="form-label">Nomor Telepon</label>
        <input type="text" name="user_telepon" class="form-control" id="telepon" required>
        <div class="invalid-feedback">Mohon masukkan nomor telepon kamu</div>
    </div>

    <div class="col-6">
        <label for="yourEmail" class="form-label">Email</label>
        <input type="email" name="user_email" class="form-control" id="yourEmail" required>
        <div class="invalid-feedback">Mohon masukkan email kamu</div>
    </div>

    <div class="col-12">
        <label class="form-label">Pilih Unit : ( Hanya bisa pilih dari
            1 Induk, namun bisa beberapa unit )</label>
        <div id="daftar_unit" class="row">

            <?php
                                            //menampilkan daftar induk yang tersedia di database
                                            $i = 1;
                                            foreach ($indk as $induk):
                                                ?>

            <script>
            //jika suatu induk di ceklists
            function showunit<?= $i ?>(v) {
                if (v.checked) {
                    document.getElementById('table<?= $i ?>').style.display = '';
                    //tabel daftar menu lainnya tertutup
                    let table_unit = document.getElementsByClassName('table_unit');
                    for (let i = 0; i < table_unit.length; i++) {
                        if (i === <?= $i - 1 ?>) {
                            continue;
                        }
                        table_unit[i].style.display = 'none';
                    }
                    //input tiap induk lainnya unchecked
                    let table_induk = document.getElementsByClassName('table_induk');
                    for (let i = 0; i < table_induk.length; i++) {
                        if (i === <?= $i - 1 ?>) {
                            continue;
                        }
                        table_induk[i].checked = false;
                    }
                    //semua unit unchecked
                    let unit = document.getElementsByClassName('unit');
                    for (let i = 0; i < unit.length; i++) {
                        unit[i].checked = false;
                    }
                } else {
                    document.getElementById('table<?= $i ?>').style.display = 'none';
                    //semua unit unchecked
                    let unit = document.getElementsByClassName('unit');
                    for (let i = 0; i < unit.length; i++) {
                        unit[i].checked = false;
                    }
                }
            }
            </script>

            <!--tabel daftar unit-->
            <div class="col-6">
                <table class="table table-sm table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th colspan="2" style="text-align: center;">
                                <div class="form-check form-switch">
                                    <input class="form-check-input cur table_induk" type="checkbox" id="induk<?= $i ?>"
                                        onchange="showunit<?= $i ?>(this)" name="id_induk"
                                        value="<?= $induk['id_induk'] ?>">
                                    <label class="form-check-label cur" for="induk<?= $i ?>">
                                        <?= $induk['induk_nama'] ?>
                                    </label>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="table<?= $i ?>" class="table_unit" style="display:none">
                        <!--Menampilkan data unit yang berkaitan dengan induk-->
                        <?php if (!empty($induk['units'])): ?>
                        <?php foreach ($induk['units'] as $u): ?>
                        <tr>
                            <td>
                                <div class="form-check form-switch">
                                    <input name="unit[]" class="form-check-input cur unit" type="checkbox"
                                        id="unit<?= $u['id_unit'] ?>" value="<?= $u['id_unit'] ?>">
                                    <label class="form-check-label cur"
                                        for="unit<?= $u['id_unit'] ?>"><?= $u['unit_nama'] ?></label>
                                </div>
                                </label>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- akhir tabel -->
            <?php
                                                $i++;
                                            endforeach; ?>
        </div>
    </div>

    <div class="col-12">
        <button class="btn btn-primary w-100" type="submit">Buat akun</button>
    </div>
</form>
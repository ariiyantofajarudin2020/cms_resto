<?= $this->extend('layout/u_layout') ?>
<?php $this->section('content'); ?>
<main id="main" class="main">
    <div class="container">

        <section class="section dashboard">
            <div class="row">

                <!-- Body -->
                <div class="col-12">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h4 class="card-title">Setting Struk</h4>
                            <form action="<?= base_url('/unit/post/up_setting_struk') ?>" method="post">
                                <input type="hidden" name="wc" value="<?=$wc?>">
                                <input type="hidden" name="id_induk" value="<?=$induk['id_induk']?>">
                                <div class="row">
                                    <div class="col-4">
                                        <textarea class="form-control" id="text" name="struk_footer" id="" cols="30"
                                            rows="5" disabled><?=$pos['struk_footer']?></textarea>
                                        <br><br>
                                        <button id="ubah" type="button" class="btn btn-sm btn-success"
                                            onclick="btn_ubah()">Ubah</button>
                                        <button id="simpan" type="submit" class="btn btn-sm btn-primary"
                                            style="display:none">Simpan</button>
                                        <button id="batal" type="button" class="btn btn-sm btn-danger"
                                            onclick="btn_batal()" style="display:none">Batal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- End Body -->
            </div>
        </section>
    </div>
</main>
<script>
function btn_ubah() {
    document.getElementById('text').disabled = false;
    document.getElementById('ubah').style.display = 'none';
    document.getElementById('simpan').style.display = '';
    document.getElementById('batal').style.display = '';
}

function btn_batal() {
    document.getElementById('text').value = '<?=$pos['struk_footer']?>';
    document.getElementById('text').disabled = true;
    document.getElementById('ubah').style.display = '';
    document.getElementById('simpan').style.display = 'none';
    document.getElementById('batal').style.display = 'none';
}
</script>
<!-- End #main -->
<?= $this->endSection() ?>
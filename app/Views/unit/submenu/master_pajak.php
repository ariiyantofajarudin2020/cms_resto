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
                            <h4 class="card-title">Master Pajak (%)</h4>
                            <form action="<?= base_url('/unit/post/up_master_pajak') ?>" method="post"
                                onsubmit="return simpann()">
                                <input type="hidden" name="wc" value="<?=$wc?>">
                                <input type="hidden" name="id_induk" value="<?=$induk['id_induk']?>">
                                <div class="row">
                                    <div class="col-4">
                                        <input type="number" name="pajak" id="pajak" value="<?=$pos['pajak']?>"
                                            disabled>
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
function simpann() {
    let pajak = parseInt(document.getElementById('pajak').value);
    if (pajak < 0) {
        alert('Tidak boleh ada nilai mines (-) !!');
        return false;
    }
}

function btn_ubah() {
    document.getElementById('pajak').disabled = false;
    document.getElementById('ubah').style.display = 'none';
    document.getElementById('simpan').style.display = '';
    document.getElementById('batal').style.display = '';
}

function btn_batal() {
    document.getElementById('pajak').value = '<?=$pos['pajak']?>';
    document.getElementById('pajak').disabled = true;
    document.getElementById('ubah').style.display = '';
    document.getElementById('simpan').style.display = 'none';
    document.getElementById('batal').style.display = 'none';
}
</script>
<!-- End #main -->
<?= $this->endSection() ?>
<div class="card info-card sales-card" style="margin-bottom:0px;height:250px;">
    <div class="card-body">
        <h5 class="card-title text-center" style="padding-top:5px;padding-bottom:0px">
            DAFTAR MEJA</h5>
        <div style="height:200px;overflow:auto" id="daftar_meja">
            <div class="row" style="width:100%;padding:0px;margin:0px">
                <?php
        foreach ($meja as $i => $v) { ?>
                <form class="row" style="margin:0px" action="<?=base_url('/pos/post/up_meja')?>" method="POST">
                    <!-- data yang dibutuhkan untuk post -->
                    <input type="hidden" name="id_induk" value="<?=$induk['id_induk']?>">
                    <input type="hidden" name="wc" value="<?=$wc?>">
                    <input type="hidden" name="id_init" value="<?=$init['id_initial']?>">
                    <input type="hidden" name="id_trx"
                        value="<?php if (!empty($trx_new)) { echo $trx_new['id_transaksi'];}?>">
                    <input type="hidden" name="id_meja" value="<?=$v['id_meja']?>">
                    <input type="hidden" name="nama" class="namacs"
                        value="<?php if (!empty($trx_new)) { echo $trx_new['transaksi_nama_cus'];}?>">
                    <input type="hidden" name="note" class="note"
                        value="<?php if (!empty($trx_new)) { echo $trx_new['note'];}?>">
                    <!--  -->
                    <div class="col-6 d-flex justify-content-center align-items-center">
                        <button id="meja-<?=$v['id_meja']?>"
                            class="btn btn-outline-dark btn-meja-pos"><?=$v['meja_nama']?></button>
                    </div>
                    <div class="col-5 text-left">
                        <span class="btn-meja-pos text-left"><?=$v['status']?></span>
                    </div>
                </form>
                <?php }?>
            </div>
        </div>
    </div>
</div>
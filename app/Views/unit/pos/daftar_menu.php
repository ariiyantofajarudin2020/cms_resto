<div class="card info-card sales-card" style="height:290px;margin-bottom:10px;margin-top:4px">
    <div class="card-body">
        <h5 class="card-title text-center" style="padding-top:5px;padding-bottom:0px">
            DAFTAR MENU</h5>
        <div id="daftar_menu">
            <div style="height:190px;overflow:auto">
                <?php
                                foreach ($katmenu as $i => $v) { ?>
                <div class="row" style="width:100%;display:none" id="kat-<?=$v['id_menu_kategori']?>">
                    <?php foreach ($menu as $ii => $vv) {
                                        if ($v['id_menu_kategori']==$vv['id_menu_kategori']) {?>
                    <div class="col-12" style="display:flex;align-items:center;justify-content:center">
                        <button class="btn btn-warning btn-menu-pos"
                            onclick="select_menu('<?=$vv['id_menu']?>','<?=$vv['menu_nama']?>')"><b><?=$vv['menu_nama']?></b></button>
                    </div>
                    <?php }
                                    }?>
                </div>
                <?php }?>
            </div>
            <table>
                <tr>
                    <form action="<?=base_url('/pos/post/up_menu')?>" method="POST" onsubmit="notmines()">
                        <td>
                            <label class="form-lable tbl-sm" for="menu">Menu</label>
                            <!-- data post -->
                            <input type="hidden" name="id_induk" value="<?=$induk['id_induk']?>">
                            <input type="hidden" name="wc" value="<?=$wc?>">
                            <input type="hidden" name="id_init" value="<?=$init['id_initial']?>">
                            <input type="hidden" name="id_trx"
                                value="<?php if (!empty($trx_new)) { echo $trx_new['id_transaksi'];}?>">
                            <input type="hidden" name="nama" class="namacs"
                                value="<?php if (!empty($trx_new)) { echo $trx_new['transaksi_nama_cus'];}?>">
                            <input type="hidden" name="note" class="note"
                                value="<?php if (!empty($trx_new)) { echo $trx_new['note'];}?>">
                            <input type="hidden" name="id_menu" id="id_menu">
                            <input type="hidden" name="menu_mode" id="menu_mode">
                            <!-- ------------ -->
                            <input class="form-control btn-menu-pos" type="text" id="menu" disabled>
                        </td>
                        <td>
                            <label class="form-lable tbl-sm" for="qty">Qty</label>
                            <!-- data post -->
                            <input class="form-control" type="number" name="qty_menu" id="qty_menu"
                                style="height:30px;width:60px" onchange="notmines()" required>
                            <!-- ------------ -->
                        </td>
                        <td>
                            <br>
                            <button type="submit" class="btn btn-success btn-sm" id="btn_tambah">
                                Tambah
                            </button>
                        </td>
                    </form>
                </tr>
            </table>
        </div>
    </div>
</div>
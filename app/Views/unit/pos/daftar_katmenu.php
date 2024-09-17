<div class="card info-card sales-card" style="height:290px;margin-bottom:10px;margin-top:4px">
    <div class="card-body">
        <h5 class="card-title text-center" style="padding-top:5px;padding-bottom:0px">
            KATEGORI MENU</h5>
        <div style="height:240px;overflow:auto" id="kategori_menu">
            <div class="row" style="width:100%">
                <?php
                                    foreach ($katmenu as $i => $v) { ?>
                <div class="col-12" style="display:flex;align-items:center;justify-content:center">
                    <button onclick="show_menu('<?=$v['id_menu_kategori']?>')"
                        class="btn btn-outline-dark btn-katmenu-pos"
                        id="katmenu-<?=$v['id_menu_kategori']?>"><b><?=$v['menu_kategori']?></b></button>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>
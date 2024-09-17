<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>report - Stock Opname</title>
    <style>
    .a4 {
        width: 210mm;
        height: 297mm;
        margin: 0 auto;
        padding: 10mm;
        background-color: #f5f5f5;
        box-sizing: border-box;
    }

    @media print {
        @page {
            size: A4 portrait;
            margin: 10mm;
        }

        .no-print {
            display: none;
        }
    }
    </style>
    <?php include APPPATH.'/Views/layout/style.php'; ?>
</head>
<?php
function rp($num) {
    $res = 'Rp.'.number_format($num, 0, '.',',') . ",-";
    return $res;
}
?>

<body onload="window.print()"
    onafterprint="window.location.href = '<?= base_url('u/'.$wc.'?menu=pembelian&submenu=k4f4') ?>';">
    <div class="a4">
        <div class="card info-card sales-card">
            <div class="card-body">
                <h5 class="card-title">Hasil Stock Opname<span>| <?=$induk['induk_perusahaan']?></span>
                </h5>
                <div class="row">
                    <div class="col-6">
                        <table class="table table-borderless tbl-sm">
                            <tr>
                                <th>User SO</th>
                                <td><?=$userso['user_nama']?></td>
                            </tr>
                            <tr>
                                <th>ID SO</th>
                                <td><?=$so['id_so']?></td>
                            </tr>
                            <tr>
                                <th>(&#916;) Harga (+)</th>
                                <td><?=rp($harga_selisih_plus)?></td>
                            </tr>
                            <tr>
                                <th>(&#916;) Harga (-)</th>
                                <td><?=rp($harga_selisih_minus)?></td>
                            </tr>
                            <tr>
                                <th>(&#931;) (&#916;) Harga</th>
                                <td id="total_harga_selisih"><?=rp($total_harga_selisih)?></td>
                            </tr>
                            <tr>
                                <th>(&#931;) Qty Stock</th>
                                <td id="total_qty_data"><?=$total_qty_data?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-6">
                        <table class="table table-borderless tbl-sm">
                            <tr>
                                <th>Tanggal SO</th>
                                <td><?=$so['so_tanggal']?></td>
                            </tr>
                            <tr>
                                <th>Jumlah Item</th>
                                <td><?=$jumlah_item?></td>
                            </tr>
                            <tr>
                                <th>(&#916;) Qty (+)</th>
                                <td><?=$qty_selisih_plus?></td>
                            </tr>
                            <tr>
                                <th>(&#916;) Qty (-)</th>
                                <td><?=$qty_selisih_minus?></td>
                            </tr>
                            <tr>
                                <th>(&#931;) (&#916;) Qty</th>
                                <td id="total_qty_selisih"><?=$total_qty_selisih?></td>
                            </tr>
                            <tr>
                                <th>(&#931;) Qty Aktual</th>
                                <td id="total_qty_so"><?=$total_qty_so?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-12">
                        <h5 class="card-title">Daftar Item SO</h5>
                        <table class="table table-stripped tbl-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Item</th>
                                    <th>Satuan</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Stock</th>
                                    <th>Aktual</th>
                                    <th>(&#916;) Qty</th>
                                    <th>(&#916;) Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($soitem as $key => $v) {$key++;?>

                                <tr>
                                    <td><?=$key?></td>
                                    <td><?=$v['item_nama']?></td>
                                    <td><?=$v['item_satuan']?></td>
                                    <td><?=$v['item_kategori']?></td>
                                    <td><?=rp($v['item_harga'])?></td>
                                    <td id="stock<?=$key?>"><?=$v['qty_awal']?></td>
                                    <td id="aktual<?=$key?>"><?=$v['qty_so']?></td>
                                    <td id="selisih_qty<?=$key?>"><?=$v['qty_selisih']?></td>
                                    <td id="selisih_harga<?=$key?>"><?=rp($v['harga_selisih'])?></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
document.addEventListener("DOMContentLoaded", function() {
    let a1 = parseFloat(<?=$total_harga_selisih?>);
    let a2 = parseFloat(<?=$total_qty_selisih?>);
    let a3 = parseFloat(<?=$total_qty_data?>);
    let a4 = parseFloat(<?=$total_qty_so?>);

    if (a1 < 0) {
        document.getElementById('total_harga_selisih').style.color = 'red';
    }
    if (a2 < 0) {
        document.getElementById('total_qty_selisih').style.color = 'red';
    }
    if (a3 < 0) {
        document.getElementById('total_qty_data').style.color = 'red';
    }
    if (a4 < 0) {
        document.getElementById('total_qty_so').style.color = 'red';
    }

    <?php
        foreach ($soitem as $key => $v) {$key++;?>

    let stock<?=$key?> = <?=$v['qty_awal']?>;
    let aktual<?=$key?> = <?=$v['qty_so']?>;
    let selisih_qty<?=$key?> = <?=$v['qty_selisih']?>;
    let selisih_harga<?=$key?> = <?=$v['harga_selisih']?>;

    if (stock<?=$key?> < 0) {
        document.getElementById('stock<?=$key?>').style.color = 'red';
    }
    if (aktual<?=$key?> < 0) {
        document.getElementById('aktual<?=$key?>').style.color = 'red';
    }
    if (selisih_qty<?=$key?> < 0) {
        document.getElementById('selisih_qty<?=$key?>').style.color = 'red';
    }
    if (selisih_harga<?=$key?> < 0) {
        document.getElementById('selisih_harga<?=$key?>').style.color = 'red';
    }

    <?php }?>

});
</script>

</html>
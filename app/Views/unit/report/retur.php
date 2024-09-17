<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>report - Retur Pembelian</title>
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
    onafterprint="window.location.href = '<?= base_url('u/'.$wc.'?menu=pembelian&submenu=k2f4') ?>';">
    <div class="a4">
        <div class="card info-card sales-card">
            <div class="card-body">
                <h5 class="card-title">Retur Pembelian<span>| <?=$induk['induk_perusahaan']?></span>
                </h5>
                <div class="row">
                    <div class="col-6">
                        <table class="table table-borderless tbl-sm">
                            <tr>
                                <th>ID Receive</th>
                                <td><?=$receive['id_rec']?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Receive</th>
                                <td><?=$receive['rec_tanggal']?></td>
                            </tr>
                            <tr>
                                <th>User Receive</th>
                                <td><?=$userreceive['user_nama']?></td>
                            </tr>
                            <tr>
                                <th>Keterangan Receive</th>
                                <td><?=$receive['rec_keterangan']?></td>
                            </tr>
                            <tr>
                                <th>Supplier</th>
                                <td><?=$supplier['supplier_nama']?></td>
                            </tr>
                            <tr>
                                <th>Total Harga Beli</th>
                                <td><?=rp($rec_harga)?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-6">
                        <table class="table table-borderless tbl-sm">
                            <tr>
                                <th>ID Retur</th>
                                <td><?=$retur['id_retur']?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Retur</th>
                                <td><?=$retur['retur_tanggal']?></td>
                            </tr>
                            <tr>
                                <th>User Retur</th>
                                <td><?=$userretur['user_nama']?></td>
                            </tr>
                            <tr>
                                <th>Alasan Retur</th>
                                <td><?=$retur['retur_alasan']?></td>
                            </tr>
                            <tr>
                                <th>Alamat Supplier</th>
                                <td><?=$supplier['supplier_alamat']?></td>
                            </tr>
                            <tr>
                                <th>Total Harga Retur</th>
                                <td><?=rp($retur['retur_harga'])?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-12">
                        <h5 class="card-title">Daftar Item Retur</h5>
                        <table class="table table-stripped tbl-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Item</th>
                                    <th>Satuan</th>
                                    <th>Harga Beli</th>
                                    <th>Qty Receive</th>
                                    <th>Qty Retur</th>
                                    <th>Stock Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($poitem as $key => $v) {$key++;?>

                                <tr>
                                    <td><?=$key?></td>
                                    <td><?=$v['item_nama']?></td>
                                    <td><?=$v['item_satuan']?></td>
                                    <td><?=rp($v['rec_item_harga'])?></td>
                                    <td><?=$v['rec_item_qty']?></td>
                                    <td><?=$v['retur_item_qty']?></td>
                                    <td><?=$v['item_stock']?></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-8"></div>
                    <div class="col-4">
                        <h5><u>Pimpinan resto</u></h5>
                        <br><br>
                        <h5><u><?=$userpo['user_nama']?></u></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
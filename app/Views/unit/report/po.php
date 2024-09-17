<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>report - PO</title>
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
    onafterprint="window.location.href = '<?= base_url('u/'.$wc.'?menu=pembelian&submenu=k2f2') ?>';">
    <div class="a4">
        <div class="card info-card sales-card">
            <div class="card-body">
                <h5 class="card-title">Pembelian Order<span>| <?=$induk['induk_perusahaan']?></span>
                </h5>
                <div class="row">
                    <div class="col-6">
                        <table class="table table-borderless tbl-sm">
                            <tr>
                                <th>ID PO</th>
                                <td><?=$po['id_po']?></td>
                            </tr>
                            <tr>
                                <th>Supplier</th>
                                <td><?=$supplierpo['supplier_nama']?></td>
                            </tr>
                            <tr>
                                <th>Alamat Supplier</th>
                                <td><?=$supplierpo['supplier_alamat']?></td>
                            </tr>
                            <tr>
                                <th>No Telepon Supplier</th>
                                <td><?=$supplierpo['supplier_telepon']?></td>
                            </tr>
                            <tr>
                                <th>Email Supplier</th>
                                <td><?=$supplierpo['supplier_email']?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-6">
                        <table class="table table-borderless tbl-sm">
                            <tr>
                                <th>Tanggal</th>
                                <td><?=$po['po_tanggal']?></td>
                            </tr>
                            <tr>
                                <th>User</th>
                                <td><?=$userpo['user_nama']?></td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td><?=$po['po_keterangan']?></td>
                            </tr>
                            <tr>
                                <th>Total Harga</th>
                                <td><?=rp($po['po_harga'])?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-12">
                        <h5 class="card-title">Daftar Item</h5>
                        <table class="table table-stripped tbl-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Item</th>
                                    <th>Harga</th>
                                    <th>Satuan</th>
                                    <th>Qty</th>
                                    <th>Sub total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($poitem as $key => $v) {$key++;?>

                                <tr>
                                    <td><?=$key?></td>
                                    <td><?=$v['item_nama']?></td>
                                    <td><?=rp($v['item_harga'])?></td>
                                    <td><?=$v['item_satuan']?></td>
                                    <td><?=$v['po_item_qty']?></td>
                                    <td><?=rp($v['po_item_qty']*$v['item_harga'])?></td>
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>report - Tutup Shift</title>
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
    onafterprint="window.location.href = '<?= base_url('u/'.$wc.'?menu=pembelian&submenu=k3f1') ?>';">
    <div class="a4">
        <div class="card info-card sales-card">
            <div class="card-body">
                <h5 class="card-title">Tutup Shift<span>| <?=$induk['induk_perusahaan']?></span>
                </h5>
                <div class="row">
                    <div class="col-6">
                        <table class="table table-borderless tbl-sm">
                            <tr>
                                <th>Tanggal Initial</th>
                                <td><?=$initial['initial_tanggal']?></td>
                            </tr>
                            <tr>
                                <th>Jam Initial</th>
                                <td><?=$initial['initial_jam']?></td>
                            </tr>
                            <tr>
                                <th>Shift</th>
                                <td><?=$initial['shift']?></td>
                            </tr>
                            <tr>
                                <th>Modal</th>
                                <td><?=rp($initial['initial_modal'])?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-6">
                        <table class="table table-borderless tbl-sm">
                            <tr>
                                <th>Tanggal Tutup Shift</th>
                                <td><?=$initial['closing_tanggal']?></td>
                            </tr>
                            <tr>
                                <th>Jam Tutup Shift</th>
                                <td><?=$initial['closing_jam']?></td>
                            </tr>
                            <tr>
                                <th>Kasir</th>
                                <td><?=$initial['user_nama']?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-12">------------------------------</div>
                    <div class="col-6">
                        <table class="table table-borderless tbl-sm">
                            <tr>
                                <th>Jumlah Transaksi</th>
                                <td><?=$jumlah_transaksi?></td>
                            </tr>
                            <tr>
                                <th>Jumlah Menu</th>
                                <td><?=$total_menu_terjual?></td>
                            </tr>
                            <tr>
                                <th>Pembayaran Tunai</th>
                                <td><?=rp($pay_tunai)?></td>
                            </tr>
                            <tr>
                                <th>Total Penjualan</th>
                                <td><?=rp($initial['initial_penjualan'])?></td>
                            </tr>
                            <tr>
                                <th>Aktual Kas</th>
                                <td><?=rp($initial['initial_aktual_kas'])?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-6">
                        <table class="table table-borderless tbl-sm">
                            <tr>
                                <th>Jumlah Transaksi Refund</th>
                                <td><?=$transaksi_refund?></td>
                            </tr>
                            <tr>
                                <th>Jumlah Menu Refund</th>
                                <td><?=$menu_refund?></td>
                            </tr>
                            <tr>
                                <th>Pembayaran Non Tunai</th>
                                <td><?=rp($pay_nontunai)?></td>
                            </tr>
                            <tr>
                                <th>Total Nominal Refund</th>
                                <td><?=rp($nominal_refund)?></td>
                            </tr>
                            <tr>
                                <th>Selisih Kas</th>
                                <td id="selisih"><?=rp($initial['initial_selisih_kas'])?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-8"></div>
                    <div class="col-4">
                        <h5><u>Kasir</u></h5>
                        <br><br>
                        <h5><u><?=$initial['user_nama']?></u></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
document.addEventListener("DOMContentLoaded", function() {
    let selisih = parseFloat(<?=$initial['initial_selisih_kas']?>);

    if (selisih < 0) {
        document.getElementById('selisih').style.color = 'red';
    }
});
</script>

</html>
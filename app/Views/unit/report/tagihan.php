<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tagihan</title>
    <style>
    /* Pengaturan untuk layar (screen) */
    @media screen {
        .container {
            width: 100%;
            max-width: 58mm;
            /* Lebar maksimal untuk printer 53mm roll */
            margin: 0 auto;
            padding: 5mm;
            /* Padding agar teks tidak terlalu menempel pada tepi */
            box-sizing: border-box;
        }
    }

    /* Pengaturan untuk print */
    @media print {
        @page {
            size: 58mm auto;
            /* Mengatur ukuran kertas untuk printer kasir 53mm roll */
            margin: 0;
            /* Mengatur margin menjadi 0 untuk memaksimalkan penggunaan kertas */
        }

        body {
            width: 58mm;
            /* Lebar halaman sesuai dengan ukuran kertas printer */
            margin: 0;
            font-family: monospace;
            /* Font yang sering digunakan pada printer kasir */
            font-size: 12px;
            /* Ukuran font yang sesuai untuk kertas kecil */
        }

        .container {
            width: 100%;
            padding: 2mm;
            /* Padding yang lebih kecil untuk printer */
            box-sizing: border-box;
        }

        .no-print {
            display: none;
            /* Sembunyikan elemen yang tidak perlu dicetak */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 0px solid #000;
        }

        th,
        td {
            padding: 1mm;
            text-align: left;
            font-size: 10px;
            /* Ukuran font yang lebih kecil untuk tabel */
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
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

<body onload="window.print()" onafterprint="submit_back()">
    <form id="back" style="display:none" action="<?=base_url('/pos/post/bayar')?>" method="post">
        <input type="hidden" name="id_init" value="<?=$id_init?>">
        <input type="hidden" name="wc" value="<?=$wc?>">
        <input type="hidden" name="id_trx" value="<?=$id_trx?>">
        <input type="hidden" name="mode" value="bayar">
        <input type="hidden" name="nama" value="<?=$trx['transaksi_nama_cus']?>">
        <input type="hidden" name="note" value="<?=$trx['note']?>">
    </form>
    <div class="container">
        <div class="center">
            <strong><?=$unit['unit_nama']?></strong><br>
            <?=$unit['unit_alamat']?><br>
            No Telp. <?=$unit['unit_telepon']?>
            <hr>
            <p>( TAGIHAN )</p>
        </div>
        <hr>
        <table>
            <tr>
                <th>Nama Customer</th>
                <td># <?=$trx['transaksi_nama_cus']?></td>
            </tr>
            <tr>
                <th>Meja</th>
                <td># <?=$trx['meja_nama']?></td>
            </tr>
            <tr>
                <th>Tipe Transaksi</th>
                <td># <?=$trx['type_trans']?></td>
            </tr>
            <tr>
                <th>Note</th>
                <td># <?=$trx['note']?></td>
            </tr>
            <tr>
                <th>Jumlah Menu</th>
                <td># <?=count($menu)?></td>
            </tr>
        </table>
        <hr>
        <table>
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($menu as $v) {?>
                <tr>
                    <td><?=$v['menu_nama']?></td>
                    <td><?=rp($v['menu_harga_jual'])?></td>
                    <td><?=$v['transaksi_menu_qty']?></td>
                    <td><?=rp($v['menu_harga_jual']*$v['transaksi_menu_qty'])?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <hr>
        <table>
            <tr>
                <th>Sub Total</th>
                <td><?=rp($trx['transaksi_harga'])?></td>
            </tr>
            <tr>
                <th>Pajak</th>
                <td><?=rp($trx['transaksi_pajak'])?></td>
            </tr>
            <tr>
                <th>Service Charge</th>
                <td><?=rp($trx['transaksi_sc'])?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <th>Total Harga</th>
                <td><?=rp($trx['transaksi_total_harga'])?></td>
            </tr>
        </table>
        <hr>
    </div>
    <script>
    window.print(); // Otomatis membuka dialog print saat halaman dimuat
    function submit_back() {
        document.getElementById('back').submit();
    }
    </script>
</body>

</html>
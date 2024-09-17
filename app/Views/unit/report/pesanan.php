<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report - Pesanan</title>
    <style>
    /* Pengaturan untuk layar (screen) */
    @media screen {
        .container {
            width: 100%;
            /* Untuk tampilan layar, gunakan lebar penuh */
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
            font-size: 8px;
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
            font-size: 8px;
            /* Ukuran font yang lebih kecil untuk tabel */
        }

        .center {
            text-align: center;
        }
    }
    </style>
    <?php include APPPATH.'/Views/layout/style.php'; ?>
</head>

<body onload="window.print()"
    onafterprint="window.location.href = '<?= base_url('u/'.$wc.'?menu=pembelian&submenu=k3f3&open=yes') ?>';">
    <div class="container">
        <div class="center">
            <strong>Pesanan</strong><br>
            <?=date('d/m/Y - H:i')?><br>
            No Order :<span><?=$trx['id_transaksi']?></span>

        </div>
        <hr>
        <div>
            <table>
                <tr>
                    <th>Nama Customer</th>
                    <td># <?=$trx['transaksi_nama_cus']?></td>
                </tr>
                <tr>
                    <th>Tipe Transaksi</th>
                    <td># <?=$trx['type_trans']?></td>
                </tr>
                <tr>
                    <th>Meja</th>
                    <td># <?=$trx['meja_nama']?></td>
                </tr>
                <tr>
                    <th>Note</th>
                    <td># <?=$trx['note']?></td>
                </tr>
            </table>
        </div>
        <hr>
        <table>
            <thead>
                <tr>
                    <th style="width:40mm"># Menu</th>
                    <th># Qty</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $qty=0;
                foreach ($menu as $v){
                    $qty+=$v['transaksi_menu_qty'];
                    ?>
                <tr>
                    <td style="width:40mm"># <?=$v['menu_nama']?></td>
                    <td># <?=$v['transaksi_menu_qty']?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <hr>
        <div class="center">
            <table>
                <tr>
                    <td style="width:40mm"># Jumlah Menu</td>
                    <td># <?=$qty?></td>
                </tr>
            </table>
        </div>
        <hr>
    </div>
    <script>
    window.print(); // Otomatis membuka dialog print saat halaman dimuat
    </script>
</body>

</html>
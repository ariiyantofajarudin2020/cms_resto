<th>
    <form id="form_cetak_pesanan" action="<?=base_url('/pos/post/print_pesanan')?>" method="post"
        <?php if (empty($trx_new)) {?>onsubmit="alert('Belum ada transaksi');return false;" <?php }?>
        style="display:none">
        <input type="hidden" name="wc" value="<?=$wc?>">
        <input type="hidden" name="id_trx" value="<?php if (!empty($trx_new)) { echo $trx_new['id_transaksi'];}?>">
        <input type="hidden" name="nama" class="namacs"
            value="<?php if (!empty($trx_new)) { echo $trx_new['transaksi_nama_cus'];}?>">
        <input type="hidden" name="note" class="note" value="<?php if (!empty($trx_new)) { echo $trx_new['note'];}?>">
        <?php if (!empty($trx_new)) { 
         if ($trx_new['transaksi_status']=='pending') {?>

        <input type="hidden" name="pending" value="<?php if (!empty($trx_new)) { echo $trx_new['id_transaksi'];}?>">
        <?php }}?>
    </form>
    <button id="btn_cetak_pesanan" type="submit" class="btn btn-pos btn-sm btn-primary"
        onclick="submit_cetak_pesanan()">Cetak Pesanan</button>
</th>
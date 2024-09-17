    <form id="cetak_tagihan" action="<?=base_url('/pos/post/print_tagihan')?>" method="post" style="display:none">
        <input type="hidden" name="wc" value="<?=$wc?>">
        <input type="hidden" name="id_trx" value="<?=$id_trx?>">
        <input type="hidden" name="id_init" value="<?=$id_init?>">
    </form>
    <button style="width:150px" class="btn btn-md btn-warning" onclick="cetak_tagihan()">Cetak Tagihan</button>
    <script>
function cetak_tagihan() {
    document.getElementById('cetak_tagihan').submit();
}
    </script>
  <!-- Pilih type trans Modal -->
  <div class="modal fade" id="typetrans_modal" tabindex="-1">
      <div class="modal-dialog modal-md modal-dialog-scrollable">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="card-title">Pilih tipe transaksi</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="col-lg-12">
                      <table class="table table-stripped">
                          <tr>
                              <th>No</th>
                              <th>Pilih</th>
                              <th>Tipe Transaksi</th>
                          </tr>
                          <?php foreach ($tiptrans as $i => $v) {$i++;?>
                          <form class="row" action="<?=base_url('/pos/post/up_tiptrans')?>" method="POST">
                              <input type="hidden" name="id_induk" value="<?=$induk['id_induk']?>">
                              <input type="hidden" name="wc" value="<?=$wc?>">
                              <input type="hidden" name="id_init" value="<?=$init['id_initial']?>">
                              <input type="hidden" name="id_trx"
                                  value="<?php if (!empty($trx_new)) { echo $trx_new['id_transaksi'];}?>">
                              <input type="hidden" name="tiptrans" value="<?=$v['id_typetrans']?>">
                              <input type="hidden" name="nama" class="namacs"
                                  value="<?php if (!empty($trx_new)) { echo $trx_new['transaksi_nama_cus'];}?>">
                              <input type="hidden" name="note" class="note"
                                  value="<?php if (!empty($trx_new)) { echo $trx_new['note'];}?>">
                              <tr>
                                  <td><?=$i?></td>
                                  <td><button type="submit" class="btn btn-primary">Pilih</button></td>
                                  <td><?=$v['type_trans']?></td>
                              </tr>
                          </form>
                          <?php }?>
                      </table>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              </div>
              </form><!-- Vertical Form -->
          </div>
      </div>
  </div>
  <!-- End type trans fitur -->
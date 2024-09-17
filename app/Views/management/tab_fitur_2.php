                            <!--tabel kategori pembelian-->
                            <div class="col-4">
                                <table class="table table-sm table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th colspan="2" style="text-align: center;">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input cur" type="checkbox" id="kat2_in"
                                                        onchange="select_kat2(this)" <?=$edit_set21?>>
                                                    <label class="form-check-label cur" for="kat2_in">Pembelian</label>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_kat2" <?=$edit_set22?>>
                                        <?php foreach ($getk2 as $key => $v) :  $varname = 'v'.$v['id_fitur'];?>
                                        <tr>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input name="fitur[]" class="form-check-input cur" type="checkbox"
                                                        id="<?= $v['id_fitur'] ?>" value="<?= $v['id_fitur'] ?>" <?=
                                                        $$varname;?>>
                                                    <label class="form-check-label cur"
                                                        for="<?= $v['id_fitur'] ?>"><?= $v['fitur'] ?></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
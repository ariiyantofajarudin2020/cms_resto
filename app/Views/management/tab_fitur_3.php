                            <!--tabel kategori pembelian-->
                            <div class="col-4">
                                <table class="table table-sm table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th colspan="2" style="text-align: center;">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input cur" type="checkbox" id="kat3_in"
                                                        onchange="select_kat3(this)" <?=$edit_set31?>>
                                                    <label class="form-check-label cur" for="kat3_in">Penjualan</label>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_kat3" <?=$edit_set32?>>
                                        <?php foreach ($getk3 as $key => $v) :  $varname = 'v'.$v['id_fitur'];?>
                                        <tr>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input name="fitur[]" class="form-check-input cur" type="checkbox"
                                                        id="<?= $v['id_fitur'] ?>" value="<?= $v['id_fitur'] ?>" <?=
                                                        $$varname;?> <?php
                                                        if (
                                                            $v['id_fitur']=='k3f1' ||
                                                            $v['id_fitur']=='k3f2' ||
                                                            $v['id_fitur']=='k3f3' ||
                                                            $v['id_fitur']=='k3f13' ||
                                                            $v['id_fitur']=='k3f14'
                                                            ){?> onchange="posgroup(this)" <?php }?>>
                                                    <label class="form-check-label cur"
                                                        for="<?= $v['id_fitur'] ?>"><?= $v['fitur'] ?></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
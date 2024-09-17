                            <tr>
                                <th>Non Tunai</th>
                                <td>
                                    <select name="kartu" id="kartu" class="form-select cur">
                                        <option value="default" selected>default</option>
                                        <?php foreach ($kartu as $v) {?>
                                        <option value="<?=$v['id_jeniskartu']?>"><?=$v['kartu_nama']?></option>
                                        <?php }?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Nomor</th>
                                <td><input id="no_kartu" type="number" name="no_kartu" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="margin:0px;padding:0px">
                                    <hr>
                                </td>
                            </tr>
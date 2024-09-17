<?php namespace App\Models;

use CodeIgniter\Model;

class KonversiModel extends Model

{

protected $table = 'stock_konversi';
protected $primaryKey = 'id_stockcon';
protected $useAutoIncrement = true;
protected $allowedFields = ['id_induk','id_item_awal','id_item_akhir','stockcon_qty_awal','stockcon_qty_akhir','stockcon_tanggal','stockcon_user','stockcon_keterangan'];
protected $db;
public function getall($id_induk)
    {
        $sql = "SELECT * FROM stock_konversi WHERE id_induk = $id_induk";
        return $this->db->query($sql)->getResultArray();
   }
}
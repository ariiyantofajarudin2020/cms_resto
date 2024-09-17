<?php namespace App\Models;

use CodeIgniter\Model;

class SoItemModel extends Model

{

protected $table = 'so_item';
protected $primaryKey = 'id_so_item';
protected $useAutoIncrement = true;
protected $allowedFields = ['id_induk','id_so','id_item','qty_awal','qty_so','qty_selisih','harga_selisih'];
protected $db;

public function getso($id_so) {
        $sql = "SELECT * FROM so_item s JOIN item i ON i.id_item=s.id_item JOIN master_item_kategori m ON m.id_item_kategori = i.id_item_kategori WHERE s.id_so = '$id_so'";
        return $this->db->query($sql)->getResultArray();
}
}
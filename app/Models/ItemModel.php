<?php namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model

{

protected $table = 'item';
protected $primaryKey = 'id_item';
protected $useAutoIncrement = true;
protected $allowedFields = ['item_barcode','id_induk','id_item_kategori','item_nama','item_keterangan','item_satuan','item_harga','item_stock'];
protected $db;
public function getall($id_induk)
    {
        $sql = "SELECT * FROM item i JOIN master_item_kategori m ON m.id_item_kategori = i.id_item_kategori WHERE i.id_induk = $id_induk";
        return $this->db->query($sql)->getResultArray();
   }
public function getopname($id_item)
    {
        $sql = "SELECT * FROM item i JOIN master_item_kategori m ON m.id_item_kategori = i.id_item_kategori WHERE i.id_item = $id_item";
        return $this->db->query($sql)->getRowArray();
   }
}
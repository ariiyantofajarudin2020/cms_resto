<?php namespace App\Models;

use CodeIgniter\Model;

class KatitemModel extends Model

{

protected $table = 'master_item_kategori';
protected $primaryKey = 'id_item_kategori';
protected $useAutoIncrement = true;
protected $allowedFields = ['id_induk','item_kategori'];
protected $db;
public function getall($id_induk)
    {
        $sql = "SELECT * FROM master_item_kategori WHERE id_induk = $id_induk";
        return $this->db->query($sql)->getResultArray();
   }
}
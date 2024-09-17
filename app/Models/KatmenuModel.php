<?php namespace App\Models;

use CodeIgniter\Model;

class KatmenuModel extends Model

{

protected $table = 'master_menu_kategori';
protected $primaryKey = 'id_menu_kategori';
protected $useAutoIncrement = true;
protected $allowedFields = ['id_induk','menu_kategori'];
protected $db;
public function getall($id_induk)
    {
        $sql = "SELECT * FROM master_menu_kategori WHERE id_induk = $id_induk";
        return $this->db->query($sql)->getResultArray();
   }
}
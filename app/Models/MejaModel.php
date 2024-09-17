<?php namespace App\Models;

use CodeIgniter\Model;

class MejaModel extends Model

{

protected $table = 'master_meja';
protected $primaryKey = 'id_meja';
protected $useAutoIncrement = true;
protected $allowedFields = ['id_induk','meja_nama','status'];
protected $db;
public function getall($id_induk)
    {
        $sql = "SELECT * FROM master_meja WHERE id_induk = $id_induk";
        return $this->db->query($sql)->getResultArray();
   }
public function get_pos($id_induk)
    {
        $sql = "SELECT * FROM master_meja WHERE id_induk = $id_induk AND status !='rusak'";
        return $this->db->query($sql)->getResultArray();
   }
}
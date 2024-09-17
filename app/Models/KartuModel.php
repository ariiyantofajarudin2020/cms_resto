<?php namespace App\Models;

use CodeIgniter\Model;

class KartuModel extends Model

{

protected $table = 'master_jeniskartu';
protected $primaryKey = 'id_jeniskartu';
protected $useAutoIncrement = true;
protected $allowedFields = ['id_induk','kartu_nama'];
protected $db;
public function getall($id_induk)
    {
        $sql = "SELECT * FROM master_jeniskartu WHERE id_induk = $id_induk";
        return $this->db->query($sql)->getResultArray();
   }
}
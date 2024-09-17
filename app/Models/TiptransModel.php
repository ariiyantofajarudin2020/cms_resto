<?php namespace App\Models;

use CodeIgniter\Model;

class TiptransModel extends Model

{

protected $table = 'master_typetrans';
protected $primaryKey = 'id_typetrans';
protected $useAutoIncrement = true;
protected $allowedFields = ['id_induk','type_trans'];
protected $db;
public function getall($id_induk)
    {
        $sql = "SELECT * FROM master_typetrans WHERE id_induk = $id_induk";
        return $this->db->query($sql)->getResultArray();
   }
}
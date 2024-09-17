<?php namespace App\Models;

use CodeIgniter\Model;

class ShiftModel extends Model

{

protected $table = 'master_shift';
protected $primaryKey = 'id_shift';
protected $useAutoIncrement = true;
protected $allowedFields = ['id_induk','shift','jam_mulai','jam_selesai'];
protected $db;
public function getall($id_induk)
    {
        $sql = "SELECT * FROM master_shift WHERE id_induk = $id_induk";
        return $this->db->query($sql)->getResultArray();
   }
}
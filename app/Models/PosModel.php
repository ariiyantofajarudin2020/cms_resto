<?php namespace App\Models;

use CodeIgniter\Model;

class PosModel extends Model

{

protected $table = 'master_pos';
protected $primaryKey = 'id_masterpos';
protected $useAutoIncrement = true;
protected $allowedFields = ['id_induk','pajak','sc','struk_footer'];
protected $db;
public function getall()
    {
        $sql = "SELECT * FROM master_pos";
        return $this->db->query($sql)->getResultArray();
   }
}
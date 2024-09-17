<?php

namespace App\Models;

use CodeIgniter\Model;

class UserAksesModel extends Model
{
    protected $table = "user_akses";
    protected $primaryKey = "id_akses";
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_user','id_unit'];
    protected $db;
    public function getdetail($id_user)
    {
        $sql = "SELECT * FROM user_akses a join unit_aplikasi u ON u.id_unit = a.id_unit WHERE a.id_user=$id_user";
        return $this->db->query($sql)->getResultArray();
    }
    
}
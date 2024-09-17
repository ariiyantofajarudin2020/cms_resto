<?php

namespace App\Models;

use CodeIgniter\Model;

class UUserModel extends Model
{
    protected $table = "user";
    protected $primaryKey = "id_user";
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_induk','user_nama','user_password','user_alamat','user_telepon','user_email','user_photo'];
    protected $db;
    public function getakses($user)
    {

        $sql = "SELECT user_akses.id_unit FROM user JOIN user_akses ON user.id_user = user_akses.id_user 
            WHERE user.user_nama = '$user'";
        return $this->db->query($sql)->getResultArray();

    }
}
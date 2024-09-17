<?php
namespace App\Models;
use CodeIgniter\Model;

class MUserModel extends Model
{
    protected $table = "m_user";
    protected $primaryKey = "id_m_user";
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nama_m_user','password_m_user'];
    protected $db;
}
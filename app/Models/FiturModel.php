<?php namespace App\Models;

use CodeIgniter\Model;

class FiturModel extends Model

{

protected $table = 'fitur';
protected $primaryKey = 'id_fitur';
protected $useAutoIncrement = true;
protected $allowedFields = ['id_unit','fitur'];
protected $db;

public function getk2()
    {
        $sql = "SELECT * FROM fitur WHERE id_fitur LIKE '%k2%'";
        return $this->db->query($sql)->getResultArray();
   }
public function getk3()
    {
        $sql = "SELECT * FROM fitur WHERE id_fitur LIKE '%k3%'";
        return $this->db->query($sql)->getResultArray();
   }
public function getk4()
    {
        $sql = "SELECT * FROM fitur WHERE id_fitur LIKE '%k4%'";
        return $this->db->query($sql)->getResultArray();
   }
public function getall()
    {
        $sql = "SELECT * FROM fitur";
        return $this->db->query($sql)->getResultArray();
   }
}
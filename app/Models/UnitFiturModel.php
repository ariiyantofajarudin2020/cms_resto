<?php

namespace App\Models;

use CodeIgniter\Model;

class UnitFiturModel extends Model
{
    protected $table = 'unit_fitur';
    protected $primaryKey = 'id_unit_fitur';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_unit','id_fitur'];
    protected $db;

    public function getdetail($id_Unit)
    {
        $sql = "SELECT * FROM unit_fitur join fitur ON unit_fitur.id_fitur = fitur.id_fitur WHERE unit_fitur.id_unit=$id_Unit";
        return $this->db->query($sql)->getResultArray();
    }

}
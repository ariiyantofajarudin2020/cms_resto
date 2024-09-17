<?php namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model

{

protected $table = 'master_supplier';
protected $primaryKey = 'id_supplier';
protected $useAutoIncrement = true;
protected $allowedFields = ['id_induk','supplier_nama','supplier_alamat','supplier_telepon','supplier_email','supplier_item'];
protected $db;
public function getall($id_induk)
    {
        $sql = "SELECT * FROM master_supplier WHERE id_induk = $id_induk";
        return $this->db->query($sql)->getResultArray();
   }
}
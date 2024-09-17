<?php namespace App\Models;

use CodeIgniter\Model;

class UnitModel extends Model

{

protected $table = 'unit_aplikasi';
protected $primaryKey = 'id_unit';
protected $useAutoIncrement = true;
protected $allowedFields = ['id_induk','wildcard','unit_nama','unit_deskripsi','unit_alamat','unit_telepon','unit_email','photo'];
protected $db;
//
//public function __construct(){
//    $this->db = \Config\Database::connect();
//}
//    public function getManagement($id = false)

//    {

//    if($id === false){

//    return $this->findAll();

//    }else{

//    return $this->getWhere(['id_unit' => $id]);

//    }

//    }
    
//function get_unit()
//     { 
//      $sql = "SELECT * FROM unit_aplikasi";
//      $query = $this->db->query($sql);
//      $data_unit = $query->getResultArray();
//      return $data_unit;
//   }
//
}
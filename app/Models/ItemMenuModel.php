<?php namespace App\Models;

use CodeIgniter\Model;

class ItemMenuModel extends Model

{

protected $table = 'master_menu_item';
protected $primaryKey = 'id_menu_item';
protected $useAutoIncrement = true;
protected $allowedFields = ['id_induk','id_menu','id_item','menu_item_qty'];
protected $db;
public function getall($id_menu)
    {
        $sql = "SELECT * FROM master_menu_item mi JOIN item i ON i.id_item = mi.id_item  WHERE mi.id_menu = $id_menu";
        return $this->db->query($sql)->getResultArray();
   }
}
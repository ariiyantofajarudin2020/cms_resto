<?php namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model

{

protected $table = 'master_menu';
protected $primaryKey = 'id_menu';
protected $useAutoIncrement = true;
protected $allowedFields = ['id_induk','id_menu_kategori','menu_nama','menu_keterangan','menu_harga_pokok','menu_biaya_waste','menu_biaya_lain','menu_biaya_total','menu_harga_jual','menu_gross'];
protected $db;
public function getall($id_induk)
    {
        $sql = "SELECT * FROM master_menu i JOIN master_menu_kategori m ON m.id_menu_kategori = i.id_menu_kategori WHERE i.id_induk = $id_induk";
        return $this->db->query($sql)->getResultArray();
   }
}
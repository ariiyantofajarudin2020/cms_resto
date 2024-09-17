<?php namespace App\Models;

use CodeIgniter\Model;

class InitialModel extends Model

{

protected $table = 'initial_shift';
protected $primaryKey = 'id_initial';
protected $useAutoIncrement = true;
protected $allowedFields = ['id_induk','id_user','id_shift','initial_tanggal','initial_modal','initial_jam','closing_tanggal','closing_jam','initial_penjualan','initial_aktual_kas','initial_selisih_kas'];
protected $db;
public function get_active($id_induk) {
        $sql = "SELECT * FROM initial_shift i JOIN user u ON u.id_user = i.id_user JOIN master_shift s ON s.id_shift = i.id_shift WHERE i.closing_jam IS NULL AND i.id_induk = $id_induk";
        return $this->db->query($sql)->getResultArray();
}
public function get_current($id_user) {
        $sql = "SELECT * FROM initial_shift i JOIN user u ON u.id_user = i.id_user JOIN master_shift s ON s.id_shift = i.id_shift WHERE i.id_user = '$id_user' AND i.closing_jam IS NULL";
        return $this->db->query($sql)->getRowArray();
}
public function get_closing($id_init) {
        $sql = "SELECT * FROM initial_shift i JOIN user u ON u.id_user = i.id_user JOIN master_shift s ON s.id_shift = i.id_shift WHERE i.id_initial = '$id_init' AND i.closing_jam IS NOT NULL";
        return $this->db->query($sql)->getRowArray();
}
}
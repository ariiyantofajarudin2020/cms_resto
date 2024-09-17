<?php namespace App\Models;

use CodeIgniter\Model;

class UnitIndukModel extends Model

{

protected $table = 'unit_induk';
protected $primaryKey = 'id_induk';
protected $useAutoIncrement = true;
protected $allowedFields = ['induk_nama','induk_perusahaan','induk_alamat','induk_jenis','induk_pic','induk_pic_telepon',];
protected $db;

public function getdata()
    {
        $sql = "SELECT i.id_induk,i.induk_nama,i.induk_perusahaan,i.induk_alamat,i.induk_jenis,i.induk_pic,i.induk_pic_telepon,COUNT(a.id_induk) AS jumlah_unit FROM unit_induk i LEFT JOIN unit_aplikasi a ON i.id_induk = a.id_induk GROUP BY i.id_induk";
        return $this->db->query($sql)->getResultArray();
   }
public function getdetail($id_induk)
    {
        $sql = "SELECT * FROM unit_induk WHERE id_induk=$id_induk";
        return $this->db->query($sql)->getRowArray();
   }
public function getunit($id_induk)
    {
        $sql = "SELECT * FROM unit_aplikasi WHERE id_induk=$id_induk";
        return $this->db->query($sql)->getResultArray();
   }
}
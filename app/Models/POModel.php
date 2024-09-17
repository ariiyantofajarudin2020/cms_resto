<?php namespace App\Models;

use CodeIgniter\Model;

class POModel extends Model

{

protected $table = 'pembelian_order';
protected $primaryKey = 'id_po';
protected $useAutoIncrement = false;
protected $allowedFields = ['id_po','id_induk','id_supplier','po_user','po_tanggal','po_harga','po_keterangan'];
protected $db;
public function getall($id_induk)
    {
        $sql = "SELECT * FROM pembelian_order WHERE id_induk = $id_induk";
        return $this->db->query($sql)->getResultArray();
   }
   
public function getpo($id_po)
    {
        $sql = "SELECT * FROM pembelian_order WHERE id_po = '$id_po'";
        return $this->db->query($sql)->getRowArray();
   }
   public function get_for_receive($id_induk)
    {
        $sql = "SELECT po.* FROM pembelian_order po LEFT JOIN pembelian_penerimaan rec ON po.id_po = rec.id_po WHERE rec.id_po IS NULL AND po.id_induk = $id_induk;";
        return $this->db->query($sql)->getResultArray();
   }
   public function get_for_retur($id_induk)
    {
        $sql = "SELECT *,po.id_po as id_po FROM pembelian_order po INNER JOIN pembelian_penerimaan rec ON po.id_po = rec.id_po LEFT JOIN pembelian_retur ret ON rec.id_po = ret.id_po WHERE ret.id_po IS NULL AND po.id_induk = $id_induk;";
        return $this->db->query($sql)->getResultArray();
   }
}
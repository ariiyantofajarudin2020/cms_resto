<?php namespace App\Models;

use CodeIgniter\Model;

class POItemModel extends Model

{

protected $table = 'pembelian_item';
protected $primaryKey = 'id_pur_item';
protected $useAutoIncrement = true;
protected $allowedFields = ['id_induk','id_po','id_item','po_item_qty','rec_item_qty','rec_item_harga','retur_item_qty'];
protected $db;
public function getall($id_po)
    {
        $sql = "SELECT * FROM pembelian_item WHERE id_po = $id_po";
        return $this->db->query($sql)->getResultArray();
   }
   public function getpo($id_po)
    {
        $sql = "SELECT * FROM pembelian_item p JOIN item i ON i.id_item=p.id_item WHERE id_po = '$id_po'";
        return $this->db->query($sql)->getResultArray();
   }
}
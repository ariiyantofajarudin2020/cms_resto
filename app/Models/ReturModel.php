<?php namespace App\Models;

use CodeIgniter\Model;

class ReturModel extends Model

{

protected $table = 'pembelian_retur';
protected $primaryKey = 'id_retur';
protected $useAutoIncrement = false;
protected $allowedFields = ['id_retur','id_induk','id_po','retur_user','retur_tanggal','retur_harga','retur_alasan'];
protected $db;
}
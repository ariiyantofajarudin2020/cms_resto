<?php namespace App\Models;

use CodeIgniter\Model;

class SoModel extends Model

{

protected $table = 'stock_opname';
protected $primaryKey = 'id_so';
protected $useAutoIncrement = false;
protected $allowedFields = ['id_so','id_induk','so_tanggal','so_user','so_keterangan'];
protected $db;
}
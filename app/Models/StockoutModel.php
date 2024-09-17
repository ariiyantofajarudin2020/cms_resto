<?php namespace App\Models;

use CodeIgniter\Model;

class StockoutModel extends Model

{

protected $table = 'stock_keluar';
protected $primaryKey = 'id_stockout';
protected $useAutoIncrement = true;
protected $allowedFields = ['id_induk','id_item','stockout_tanggal','stockout_user','stockout_qty','stockout_keterangan'];
protected $db;
}
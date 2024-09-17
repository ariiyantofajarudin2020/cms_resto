<?php namespace App\Models;

use CodeIgniter\Model;

class TransMenuModel extends Model

{

protected $table = 'transaksi_menu';
protected $primaryKey = 'id_transaksi_menu';
protected $useAutoIncrement = true;
protected $allowedFields = ['id_induk','id_transaksi','id_menu','transaksi_menu_qty','refund_menu_qty'];
protected $db;
}
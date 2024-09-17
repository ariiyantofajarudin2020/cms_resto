<?php namespace App\Models;

use CodeIgniter\Model;

class PayModel extends Model

{

protected $table = 'pembayaran';
protected $primaryKey = 'id_pembayaran';
protected $useAutoIncrement = true;
protected $allowedFields = ['id_induk','id_jeniskartu','nominal_tunai','nominal_nontunai'];
protected $db;
}
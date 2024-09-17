<?php namespace App\Models;

use CodeIgniter\Model;

class ReceiveModel extends Model

{

protected $table = 'pembelian_penerimaan';
protected $primaryKey = 'id_rec';
protected $useAutoIncrement = false;
protected $allowedFields = ['id_rec','id_induk','id_po','rec_user','rec_tanggal','rec_keterangan'];
protected $db;
}
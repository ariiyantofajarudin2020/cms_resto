<?php namespace App\Models;

use CodeIgniter\Model;

class TransModel extends Model

{

protected $table = 'transaksi';
protected $primaryKey = 'id_transaksi';
protected $useAutoIncrement = true;
protected $allowedFields = ['id_induk','id_initial','id_typetrans','id_meja','id_pembayaran','transaksi_nama_cus','transaksi_harga','transaksi_pajak','transaksi_sc','transaksi_total_harga','note','transaksi_status','ref_refund'];
protected $db;
function getpay($id_init) {
    $sql = "SELECT * FROM transaksi t JOIN pembayaran p ON p.id_pembayaran = t.id_pembayaran WHERE t.id_initial = $id_init";
    return $this->db->query($sql)->getResultArray();
}
function gettrx($id_init) {
    $sql = "SELECT count(t.id_initial) as count_trx, sum(m.transaksi_menu_qty) as count_menu, count(m.refund_menu_qty) as count_refund, sum(m.refund_menu_qty) as count_menu_refund, sum(m.refund_menu_qty*mm.menu_harga_jual) AS sum_biaya_refund, sum(distinct p.nominal_tunai) AS sum_tunai, sum(distinct p.nominal_nontunai) AS sum_nontunai FROM transaksi t JOIN pembayaran p ON p.id_pembayaran = t.id_pembayaran JOIN transaksi_menu m ON m.id_transaksi = t.id_transaksi JOIN master_menu mm ON mm.id_menu = m.id_menu WHERE t.id_initial = '$id_init'";
    return $this->db->query($sql)->getRowArray();
}
function get_pending($id_init) {
    $sql = "SELECT * FROM transaksi t JOIN master_meja m ON m.id_meja = t.id_meja WHERE t.id_initial = '$id_init' AND t.transaksi_status = 'pending'";
    return $this->db->query($sql)->getResultArray();
}
function get_new($id_init) {
    $sql = "SELECT * FROM transaksi t JOIN master_typetrans mt ON mt.id_typetrans = t.id_typetrans JOIN master_meja me ON me.id_meja = t.id_meja JOIN pembayaran p ON p.id_pembayaran = t.id_pembayaran WHERE t.id_initial = '$id_init' AND t.transaksi_status = 'new'";
    return $this->db->query($sql)->getRowArray();
}
function get_new_pending($id_trx) {
    $sql = "SELECT * FROM transaksi t JOIN master_typetrans mt ON mt.id_typetrans = t.id_typetrans JOIN master_meja me ON me.id_meja = t.id_meja JOIN pembayaran p ON p.id_pembayaran = t.id_pembayaran WHERE t.id_transaksi = '$id_trx' AND t.transaksi_status = 'pending'";
    return $this->db->query($sql)->getRowArray();
}
function get_menu_new($id_init,$id_trx) {
    $sql = "SELECT * FROM transaksi t JOIN transaksi_menu m ON m.id_transaksi = t.id_transaksi JOIN master_menu mm ON mm.id_menu = m.id_menu WHERE t.id_initial = '$id_init' AND t.id_transaksi = $id_trx";
    return $this->db->query($sql)->getResultArray();
}
function get_trx_bayar($id_trx) {
    $sql = "SELECT *,sum(m.transaksi_menu_qty*mm.menu_harga_jual) as tagihan FROM transaksi t JOIN transaksi_menu m ON m.id_transaksi = t.id_transaksi JOIN master_menu mm ON mm.id_menu = m.id_menu WHERE t.id_transaksi = $id_trx";
    return $this->db->query($sql)->getRowArray();
}
function get_new_all($id_trx) {
    $sql = "SELECT * FROM transaksi t JOIN master_typetrans mt ON mt.id_typetrans = t.id_typetrans JOIN master_meja me ON me.id_meja = t.id_meja JOIN pembayaran p ON p.id_pembayaran = t.id_pembayaran WHERE t.id_transaksi = '$id_trx' AND t.transaksi_status = 'pending' OR t.transaksi_status = 'new'";
    return $this->db->query($sql)->getRowArray();
}
function get_refund($id_induk,$id_trx) {
    $sql = "SELECT * FROM transaksi t JOIN initial_shift sh ON sh.id_initial = t.id_initial JOIN master_typetrans mt ON mt.id_typetrans = t.id_typetrans JOIN master_meja me ON me.id_meja = t.id_meja JOIN pembayaran p ON p.id_pembayaran = t.id_pembayaran WHERE t.id_induk = '$id_induk' AND t.id_transaksi = '$id_trx' AND t.transaksi_status = 'selesai' AND t.ref_refund IS NULL";
    return $this->db->query($sql)->getRowArray();
}
function get_menu_refund($id_induk,$id_trx) {
    $sql = "SELECT * FROM transaksi t JOIN transaksi_menu m ON m.id_transaksi = t.id_transaksi JOIN master_menu mm ON mm.id_menu = m.id_menu WHERE t.id_induk = '$id_induk' AND t.id_transaksi = '$id_trx' AND t.transaksi_status = 'selesai' AND t.ref_refund IS NULL";
    return $this->db->query($sql)->getResultArray();
}
function get_refunded($id_induk,$id_trx) {
    $sql = "SELECT * FROM transaksi t JOIN initial_shift sh ON sh.id_initial = t.id_initial JOIN master_typetrans mt ON mt.id_typetrans = t.id_typetrans JOIN master_meja me ON me.id_meja = t.id_meja JOIN pembayaran p ON p.id_pembayaran = t.id_pembayaran WHERE t.id_induk = '$id_induk' AND t.id_transaksi = '$id_trx' AND t.transaksi_status = 'refund'";
    return $this->db->query($sql)->getRowArray();
}
function get_menu_refunded($id_induk,$id_trx) {
    $sql = "SELECT * FROM transaksi t JOIN transaksi_menu m ON m.id_transaksi = t.id_transaksi JOIN master_menu mm ON mm.id_menu = m.id_menu WHERE t.id_induk = '$id_induk' AND t.id_transaksi = '$id_trx' AND t.transaksi_status = 'refund'";
    return $this->db->query($sql)->getResultArray();
}
}
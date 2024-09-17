<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Files\File;

class Pos extends BaseController
{
    //gate filter http request post
    public function http_post($var)
    {
        switch ($var) {
            case 'up_tiptrans':
                return $this->up_tiptrans();
            case 'up_meja':
                return $this->up_meja();
            case 'up_menu':
                return $this->up_menu();
            case 'del_menu':
                return $this->del_menu();
            case 'trx_batal':
                return $this->trx_batal();
            case 'bayar':
                return $this->bayar();
            case 'up_bayar':
                return $this->up_bayar();
            case 'get_trx_refund':
                return $this->get_trx_refund();
            case 'up_refund':
                return $this->up_refund();
            case 'print_pesanan':
                return $this->print_pesanan();
            case 'print_tagihan':
                return $this->print_tagihan();
            default:
                break;
        }
    }

    //bahan untuk bagian POS, membuka pos mode kiosk, nanti saja pakainya kalau POS sudah selesai development
    public function open_pos($d)
    {
        $data[] = '';
        $data = array_merge($data, $d);
        $batch = '"C:/Program Files/Google/Chrome/Application/chrome.exe" --kiosk --start-fullscreen --disable-infobars --kiosk-printing --app="' . base_url('/u/' . $data['wc'] . '?menu=penjualan&submenu=k3f3&open=yes') . '"';
        $output = shell_exec($batch);
        echo "<pre>$output</pre><script> window.onload = function() {window.location.href = '" . base_url('/u/' . $data['wc'] . '?menu=penjualan') . "';}</script>";

    }
    // POS
    public function pos($d)
    {
        $data[] = '';
        $data = array_merge($data, $d);
        $id_user = $data['user']['id_user'];

        $data['init'] = $this->initialmodel->get_current($id_user);
        $data['trx_pending'] = $this->transmodel->get_pending($data['init']['id_initial']);
        if (!empty($this->request->getVar('pending'))) {
            $id_trx_new_pending = $this->request->getVar('pending');
            $data['trx_new'] = $this->transmodel->get_new_pending($id_trx_new_pending);
        } else {
            $data['trx_new'] = $this->transmodel->get_new($data['init']['id_initial']);
        }
        if (empty($data['trx_new']['id_transaksi'])) {
            $data['menu_new'] = '';
        } else {
            $data['menu_new'] = $this->transmodel->get_menu_new($data['init']['id_initial'], $data['trx_new']['id_transaksi']);
        }

        $data['katmenu'] = $this->katmenumodel->getall($data['induk']['id_induk']);
        $data['menu'] = $this->menumodel->getall($data['induk']['id_induk']);
        $data['meja'] = $this->mejamodel->get_pos($data['induk']['id_induk']);
        $data['id_meja_default'] = $this->mejamodel->where('id_induk', $data['induk']['id_induk'])->where('meja_nama', 'default')->first()['id_meja'];
        $data['tiptrans'] = $this->tiptransmodel->getall($data['induk']['id_induk']);
        echo view('unit/pos/index', $data);
    }
    public function up_tiptrans()
    {
        $id_induk = $this->request->getPost('id_induk');
        $wc = $this->request->getPost('wc');
        $id_trx = $this->request->getPost('id_trx');
        $id_tiptrans = $this->request->getPost('tiptrans');
        $id_meja = $this->mejamodel->where('meja_nama', 'default')->where('id_induk', $id_induk)->first()['id_meja'];
        $nama = $this->request->getPost('nama');
        $note = $this->request->getPost('note');
        if (empty($nama)) {
            $nama = 'Customer';
        }
        if (empty($note)) {
            $note = 'Tidak ada';
        }

        if (!empty($id_trx)) {
            $trx_data = [
                'id_typetrans' => $id_tiptrans,
                'transaksi_nama_cus' => $nama,
                'note' => $note,
            ];
            $this->transmodel->update($id_trx, $trx_data);
            return redirect()->to(base_url('u/' . $wc . '?menu=penjualan&submenu=k3f3&open=yes'));
        } else {
            $this->new_trx($id_tiptrans, $id_meja, $nama, $note, $wc);
            //$id_new_trx = $this->transmodel->getInsertID();
            return redirect()->to(base_url('u/' . $wc . '?menu=penjualan&submenu=k3f3&open=yes'));
        }

    }
    public function up_meja()
    {
        $id_induk = $this->request->getPost('id_induk');
        $wc = $this->request->getPost('wc'); //
        $id_trx = $this->request->getPost('id_trx'); //
        $trx = $this->transmodel->get_new_all($id_trx); //
        $id_tiptrans = $this->tiptransmodel->where('type_trans', 'take away')->where('id_induk', $id_induk)->first()['id_typetrans'];
        $id_meja = $this->request->getPost('id_meja'); //
        $nama = $this->request->getPost('nama'); //
        $note = $this->request->getPost('note'); //
        if (empty($nama)) {
            $nama = 'Customer';
        }
        if (empty($note)) {
            $note = 'Tidak ada';
        }
        if (!empty($id_trx)) {
            $trx_data = [
                'id_meja' => $id_meja,
                'transaksi_nama_cus' => $nama,
                'note' => $note,
            ];
            $this->transmodel->update($id_trx, $trx_data);
            // update status di tabel meja
            $meja_data = ['status' => 'penuh',];
            $this->mejamodel->update($id_meja,$meja_data);
            // jika sebelum nya sudah memilih meja maka ubah status nya menjadi tersedia
            if ($trx['meja_nama']!='default') {
                $meja_data = ['status' => 'tersedia',];
            $this->mejamodel->update($trx['id_meja'],$meja_data);
            }
            return redirect()->to(base_url('u/' . $wc . '?menu=penjualan&submenu=k3f3&open=yes'));
        } else {
            $this->new_trx($id_tiptrans, $id_meja, $nama, $note, $wc);
            //$id_new_trx = $this->transmodel->getInsertID();
            return redirect()->to(base_url('u/' . $wc . '?menu=penjualan&submenu=k3f3&open=yes'));
        }

    }
    public function up_nama_note($id,$nama,$note) {
        if (empty($nama)) {
            $nama = 'Customer';
        }
        if (empty($note)) {
            $note = 'Tidak ada';
        }
        $trx_data = [
                'transaksi_nama_cus' => $nama,
                'note' => $note,
            ];
        $this->transmodel->update($id, $trx_data);
    }
    public function up_menu()
    {
        $id_induk = $this->request->getPost('id_induk');
        //--------------------------
        $wc = $this->request->getPost('wc'); //
        $id_init = $this->request->getPost('id_init'); //
        $id_trx = $this->request->getPost('id_trx'); //
        $trx = $this->transmodel->get_new_all($id_trx); //
        $id_tiptrans = $this->tiptransmodel->where('type_trans', 'take away')->where('id_induk', $id_induk)->first()['id_typetrans'];
        $id_meja = $this->mejamodel->where('meja_nama', 'default')->where('id_induk', $id_induk)->first()['id_meja']; //
        $nama = $this->request->getPost('nama'); //
        $note = $this->request->getPost('note'); //
        $id_menu = $this->request->getPost('id_menu'); //
        $qty = $this->request->getPost('qty_menu'); //
        $menu_mode = $this->request->getPost('menu_mode'); //
        //inisiasi untuk redirect setelah update, jika status pending, maka redirect ke halaman pending
        $pending ='';
        if ($trx['transaksi_status']=='pending'){
            $pending = '&pending='.$id_trx;
        }
        if (empty($nama)) {
            $nama = 'Customer';
        }
        if (empty($note)) {
            $note = 'Tidak ada';
        }

        // jika sudah ada transaksi (trx dengan status new), maka eksekusi
        if (!empty($id_trx)) {
            $this->up_nama_note($id_trx,$nama,$note);

            //cek apakah menu yang di add sudah ada di trx
            $trx_menu = $this->transmodel->get_menu_new($id_init, $id_trx);
            // jika sudah ada menu di transaksi, maka eksekusi ini
            if (!empty($trx_menu)) {
                foreach ($trx_menu as $v) {
                    if ($v['id_menu'] == $id_menu) {
                        //jika menu yang dipilih ternyata sudah ada, maka lakukan ini
                        if ($menu_mode == 'edit') {
                            $trx_menu_data = [
                                'id_menu' => $id_menu,
                                'transaksi_menu_qty' => $qty,
                            ];
                            $trx_menu_id = $v['id_transaksi_menu'];
                            $this->transmenumodel->update($trx_menu_id, $trx_menu_data);
                            $this->up_total_harga($id_trx);
                            return redirect()->to(base_url('u/' . $wc . '?menu=penjualan&submenu=k3f3&open=yes'));
                        }
                        $old_qty = $v['transaksi_menu_qty'];
                        $new_qty = $old_qty + $qty;
                        $trx_menu_data = [
                            'id_menu' => $id_menu,
                            'transaksi_menu_qty' => $new_qty,
                        ];
                        $trx_menu_id = $v['id_transaksi_menu'];
                        $this->transmenumodel->update($trx_menu_id, $trx_menu_data);
                        $this->up_total_harga($id_trx);
                        return redirect()->to(base_url('u/' . $wc . '?menu=penjualan&submenu=k3f3&open=yes'.$pending));
                    }
                }
            }
            // jika belum ada menu di transaksi, maka insert menu ke table
            $trx_menu_data = [
                'id_transaksi' => $id_trx,
                'id_menu' => $id_menu,
                'transaksi_menu_qty' => $qty,
            ];
            $this->transmenumodel->insert($trx_menu_data);
            $this->up_total_harga($id_trx);
            return redirect()->to(base_url('u/' . $wc . '?menu=penjualan&submenu=k3f3&open=yes'));
        } else {
            // jika belum ada transaksi maka insert data trx dan menu_trx
            $this->new_trx($id_tiptrans, $id_meja, $nama, $note, $wc);
            $id_new_trx = $this->transmodel->getInsertID();
            $trx_menu_data = [
                'id_transaksi' => $id_new_trx,
                'id_menu' => $id_menu,
                'transaksi_menu_qty' => $qty,
            ];
            $this->transmenumodel->insert($trx_menu_data);
            $this->up_total_harga($id_new_trx);
            return redirect()->to(base_url('u/' . $wc . '?menu=penjualan&submenu=k3f3&open=yes'));
        }

    }
    public function up_total_harga($id_trx)
    {
        $id_induk = $this->request->getPost('id_induk');
        //ambil data sc dan pajak
        $pos = $this->posmodel->where('id_induk', $id_induk)->first();
        $sc = $pos['sc'] / 100;
        $pajak = $pos['pajak'] / 100;
        //ambil data total harga belanja
        $trx_update = $this->transmodel->get_trx_bayar($id_trx);
        $total_harga = $trx_update['tagihan'];
        $total_pajak = $total_harga * $pajak;
        $total_sc = $total_harga * $sc;
        $trx_data = [
            'transaksi_harga' => $total_harga,
            'transaksi_pajak' => $total_pajak,
            'transaksi_sc' => $total_sc,
            'transaksi_total_harga' => $total_harga + $total_pajak + $total_sc,
        ];
        $this->transmodel->update($id_trx, $trx_data);
    }
    public function del_menu()
    {
        $wc = $this->request->getPost('wc');
        $id = $this->request->getPost('id_transaksi_menu');
        $this->transmenumodel->delete($id);
        return redirect()->to(base_url('u/' . $wc . '?menu=penjualan&submenu=k3f3&open=yes'));
    }
    public function new_trx($id_tiptrans, $id_meja, $nama, $note, $wc)
    {
        $id_induk = $this->request->getPost('id_induk');
        $id_init = $this->request->getPost('id_init');
        $id_kartu = $this->kartumodel->where('kartu_nama', 'default')->where('id_induk', $id_induk)->first()['id_jeniskartu'];
        $id_pay = $this->paymodel->where('id_jeniskartu', $id_kartu)->first()['id_pembayaran'];
        $trx_data = [
            'id_induk' => $id_induk,
            'id_initial' => $id_init,
            'id_typetrans' => $id_tiptrans,
            'id_meja' => $id_meja,
            'id_pembayaran' => $id_pay,
            'transaksi_nama_cus' => $nama,
            'note' => $note,
            'transaksi_status' => 'new',
        ];
        $this->transmodel->insert($trx_data);
        $meja_data = ['status' => 'penuh',];
        $this->mejamodel->update($id_meja,$meja_data);
    }
    public function trx_batal()
    {
        $id_trx = $this->request->getPost('id_trx');
        $wc = $this->request->getPost('wc');
        $this->transmodel->delete($id_trx);
        return redirect()->to(base_url('u/' . $wc . '?menu=penjualan&submenu=k3f3&open=yes'));
    }
    public function print_pesanan()
    {
        $id_user = $this->usermodel->where('user_nama', session()->get('username'))->first();
        $data['init'] = $this->initialmodel->get_current($id_user['id_user']);
        $data['wc'] = $this->request->getPost('wc');
        $data['id_trx'] = $this->request->getPost('id_trx');
        $nama = $this->request->getPost('nama');
        $note = $this->request->getPost('note');
        $this->up_nama_note($data['id_trx'],$nama,$note);
        if (!empty($this->request->getPost('pending'))) {
            $id_trx_new_pending = $this->request->getPost('pending');
            $data['trx'] = $this->transmodel->get_new_pending($id_trx_new_pending);
        } else {
            $data['trx'] = $this->transmodel->get_new($data['init']['id_initial']);
        }

        if (empty($data['trx']['id_transaksi'])) {
            $data['menu'] = '';
        } else {
            $data['menu'] = $this->transmodel->get_menu_new($data['init']['id_initial'], $data['trx']['id_transaksi']);
        }
        echo view('unit/report/pesanan', $data);
    }
    public function bayar()
    {
        $data['wc'] = $this->request->getPost('wc');
        $data['id_init'] = $this->request->getPost('id_init');
        $data['id_trx'] = $this->request->getPost('id_trx');
        $mode = $this->request->getPost('mode');
        // update nama dan note
        $nama = $this->request->getPost('nama');
        $note = $this->request->getPost('note');
        $this->up_nama_note($data['id_trx'],$nama,$note);
        // jika tombol bayar nanti yang di klik, maka ubah status dari new menjadi pending
        if ($mode == 'pending') {
            $trx_data = [
                'transaksi_status' => 'pending',
            ];
            $this->transmodel->update($data['id_trx'], $trx_data);
            return redirect()->to(base_url('u/' . $data['wc'] . '?menu=penjualan&submenu=k3f3&open=yes'));
        } else if ($mode == 'bayar') {
            // jika tombol bayar yang diklik maka ke halaman pembayaran
            return $this->pembayaran($data);
        }
        return redirect()->to(base_url('u/' . $data['wc'] . '?menu=penjualan&submenu=k3f3&open=yes'))->with('error', 'Ada kesalahan !');
    }
    public function pembayaran($d)
    {
        $data[] = '';
        $data = array_merge($data, $d);
        $data['unit'] = $this->unitmodel->where('wildcard', $data['wc'])->first();
        $data['induk'] = $this->indukmodel->where('id_induk', $data['unit']['id_induk'])->first();
        $data['fiturs'] = $this->unitfiturmodel->getdetail($data['unit']['id_unit']);
        $data['trx'] = $this->transmodel->get_new_all($data['id_trx']);
        $data['menu'] = $this->transmenumodel->where('id_transaksi', $data['id_trx']);
        $data['kartu'] = $this->kartumodel->getall($data['induk']['id_induk']);
        echo view('unit/pos/pembayaran_tunai', $data);
    }
    public function print_tagihan()
    {
        $id_user = $this->usermodel->where('user_nama', session()->get('username'))->first();
        $data['init'] = $this->initialmodel->get_current($id_user['id_user']);
        $data['wc'] = $this->request->getPost('wc');
        $data['unit'] = $this->unitmodel->where('wildcard',$data['wc'])->first(); 
        $data['induk'] = $this->indukmodel->where('id_induk',$data['init']['id_induk'])->first(); 
        $data['id_trx'] = $this->request->getPost('id_trx');
        $data['id_init'] = $this->request->getPost('id_init');
        $data['trx'] = $this->transmodel->get_new_all($data['id_trx']);
        $data['menu'] = $this->transmodel->get_menu_new($data['init']['id_initial'], $data['trx']['id_transaksi']);

        echo view('unit/report/tagihan', $data);
    }
    public function up_bayar()
    {
        $wc = $this->request->getPost('wc');
        $data['wc'] = $wc;
        $data['unit'] = $this->unitmodel->where('wildcard',$wc)->first();
        $id_induk = $data['unit']['id_induk'];
        $data['pos'] = $this->posmodel->where('id_induk', $id_induk)->first();
        $id_init = $this->request->getPost('id_init');
        $id_trx = $this->request->getPost('id_trx');
        $data['trx'] = $this->transmodel->get_new_all($id_trx);
        $data['menu'] = $this->transmodel->get_menu_new($id_init,$id_trx);
        $cetak = $this->request->getPost('cetak');
        $kartu = $this->request->getPost('kartu');
        $nominal = (int)$this->request->getPost('nominal_bayar');
        //--
        $id_induk = $this->unitmodel->where('wildcard', $wc)->first()['id_induk'];
        $id_kartu_default = $this->kartumodel->where('id_induk', $id_induk)->where('kartu_nama','default')->first()['id_jeniskartu'];
        
        //-- Filter pembayaran Tunai / Non Tunai untuk perbedaan tampilan struk dan insert ke tabel pembayaran
        if ($kartu == 'default') {
            $data['transaksi'] = 'Tunai';
            $id_kartu = $id_kartu_default;
            $nominal_tunai = $nominal;
            $nominal_nontunai = 0;
        }else{
            $data['transaksi'] = 'Non Tunai';
            $id_kartu = $kartu;
            $data['kartu'] = $this->kartumodel->where('id_jeniskartu',$id_kartu)->first();
            $nominal_tunai = 0;
            $nominal_nontunai = $nominal;
        }
        $data['nominal_tunai'] = $nominal_tunai;
        $data['nominal_nontunai'] = $nominal_nontunai;
        //
        // proses insert table pembayaran
        $pay_data = [
            'id_induk' => $id_induk,
            'id_jeniskartu' => $id_kartu,
            'nominal_tunai' => $nominal_tunai,
            'nominal_nontunai' => $nominal_nontunai,
        ];
        $this->paymodel->insert($pay_data);
        $id_pay = $this->paymodel->getInsertID();
        $data['pay'] = $this->paymodel->where('id_pembayaran', $id_pay)->first();
        
        // proses update table transaksi
        $trx_data = [
            'id_pembayaran' => $id_pay,
            'transaksi_status' => 'selesai',
        ];
        $this->transmodel->update($id_trx,$trx_data);
        // update status di tabel meja
            $meja_data = ['status' => 'tersedia',];
            $this->mejamodel->update($data['trx']['id_meja'],$meja_data);
        
        // filter dari fitur cetak faktur, (tombol bayar_only / tombol bayar + cetak)
        if ($cetak == 'yes') {
            echo view('unit/report/faktur_penjualan', $data);
            return;
        }
        return redirect()->to(base_url('u/' . $wc . '?menu=penjualan&submenu=k3f3&open=yes'))->with('success','** Transaksi selesai **');
    }
    // Refund
    public function refund($d)
    {
        $data[] = '';
        $data = array_merge($data, $d);
        $id_user = $data['user']['id_user'];

        $data['init'] = $this->initialmodel->get_current($id_user);
        echo view('unit/pos/refund_page', $data);
    }
    // get transaksi refund
    public function get_trx_refund()
    {
        $data['user'] = $this->usermodel->where('user_nama', session()->get('username'))->first();
        $id_user =  $data['user']['id_user'];
        $data['induk'] = $this->indukmodel->where('id_induk',$data['user']['id_induk'])->first();
        $data['init'] = $this->initialmodel->get_current($id_user);
        $id_trx = $this->request->getPost('id_trx');
        $data['wc'] = $this->request->getPost('wc');
        $data['unit'] = $this->unitmodel->where('wildcard',$data['wc'])->first();
        $data['id_trx'] = $id_trx;
        $data['trx'] = $this->transmodel->get_refund($data['induk']['id_induk'],$id_trx);
        $data['menu'] = $this->transmodel->get_menu_refund($data['induk']['id_induk'],$id_trx);
        echo view('unit/pos/refund_page', $data);
    }
    public function up_refund() {
        $wc = $this->request->getPost('wc');
        $data['wc'] = $wc;
        $data['unit'] = $this->unitmodel->where('wildcard',$wc)->first();
        $id_induk = $data['unit']['id_induk'];
        $data['pos'] = $this->posmodel->where('id_induk', $id_induk)->first();
        $id_init = $this->request->getPost('id_init');
        $id_trx_lama = $this->request->getPost('id_trx_lama');
        $id_tiptrans = $this->tiptransmodel->where('type_trans', 'take away')->where('id_induk', $id_induk)->first()['id_typetrans'];
        $id_meja = $this->mejamodel->where('meja_nama', 'default')->where('id_induk', $id_induk)->first()['id_meja'];
        $data['trx_lama'] = $this->transmodel->get_refund($id_induk,$id_trx_lama);
        $data['menu_lama'] = $this->transmodel->get_menu_refund($id_induk,$id_trx_lama);
        $id_init_lama = $data['trx_lama']['id_initial'];
        $init = $this->initialmodel->where('id_initial',$id_init_lama)->where('id_induk',$id_induk)->first();
        $data['tanggal_trx'] = $init['initial_tanggal'];
        $alasan ='Tidak Ada';
        if ($this->request->getPost('alasan')){
        $alasan = $this->request->getPost('alasan');
        }

        $id_menu_refund = $this->request->getPost('id_menu');
        $qty_menu_refund = $this->request->getPost('menu_qty_refund');
        $nominal =0;
        foreach ($id_menu_refund as $i => $v) {
            $menu = $this->menumodel->where('id_menu',$v)->first();
            $harga = $menu['menu_harga_jual'];
            $nominal += $qty_menu_refund[$i]*$harga;
        };
        //--
        $id_induk = $this->unitmodel->where('wildcard', $wc)->first()['id_induk'];
        $id_kartu_default = $this->kartumodel->where('id_induk', $id_induk)->where('kartu_nama','default')->first()['id_jeniskartu'];

        $data['judul'] = 'REFUND';
        $data['transaksi'] = 'Tunai';
        $nominal= -$nominal;
        // proses insert table pembayaran
        $pay_data = [
            'id_induk' => $id_induk,
            'id_jeniskartu' => $id_kartu_default,
            'nominal_tunai' => $nominal,
        ];
        $this->paymodel->insert($pay_data);
        $id_pay = $this->paymodel->getInsertID();
        $data['pay'] = $this->paymodel->where('id_pembayaran', $id_pay)->first();
        
        //insert data trx baru
        $trx_data_baru = [
            'id_induk' => $id_induk,
            'id_initial' => $id_init,
            'id_typetrans' => $id_tiptrans,
            'id_pembayaran' => $id_pay,
            'id_meja' => $id_meja,
            'transaksi_harga' => $nominal,
            'transaksi_total_harga' => $nominal,
            'note' => $alasan,
            'transaksi_status' => 'refund',
            'ref_refund' => $id_trx_lama,
        ];
        $this->transmodel->insert($trx_data_baru);
        $id_trx_baru = $this->transmodel->getInsertID();
        //insert data trx menu baru
        foreach ($id_menu_refund as $i => $v) {
            $menu_data_baru = [
            'id_induk' => $id_induk,
            'id_transaksi' => $id_trx_baru,
            'id_menu' => $v,
            'refund_menu_qty' => $qty_menu_refund[$i],
        ];
        $this->transmenumodel->insert($menu_data_baru);
        };
        
        $data['trx'] = $this->transmodel->get_refunded($id_induk,$id_trx_baru);
        $data['menu'] = $this->transmodel->get_menu_refunded($id_induk,$id_trx_baru);
        //insert data trx lama
        $trx_data_lama = [
            'transaksi_status' => 'refunded',
            'ref_refund' => $id_trx_baru,
        ];
        $this->transmodel->update($id_trx_lama,$trx_data_lama);
        //
        
        echo view('unit/report/faktur_refund', $data);

    }
}
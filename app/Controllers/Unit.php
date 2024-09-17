<?php

namespace App\Controllers;

use App\Models\UnitIndukmodel;
use App\Models\Unitmodel;
use App\Models\UnitFiturmodel;
use App\Models\Fiturmodel;
use App\Models\UUsermodel;
use App\Models\UserAksesmodel;
use App\Models\Initialmodel;
use App\Controllers\Fitur;
use App\Controllers\Pos;
use CodeIgniter\Controller;

class Unit extends BaseController
{
    public $unitmodel;
    public $unitfiturmodel;
    public $fiturmodel;
    public $indukmodel;
    public $usermodel;
    public $useraksesmodel;
    public $initialmodel;
    public function __construct()
    {
        $this->unitmodel = new UnitModel();
        $this->unitfiturmodel = new UnitFiturModel();
        $this->fiturmodel = new FiturModel();
        $this->indukmodel = new UnitIndukModel();
        $this->usermodel = new UUserModel();
        $this->useraksesmodel = new UserAksesModel();
        $this->initialmodel = new InitialModel();
    }
    public function logout()
    {
        session()->remove('username');
        session()->remove('base');
        session_destroy();
        return redirect()->to(base_url('/u/'));
    }
    public function login($wc)
    {
        $data['unit'] = $this->unitmodel->where('wildcard', $wc)->first();
        $data['wc'] = $wc;
        return view('unit/login', $data);
    }
    public function index($wc = null)
    {
        //jika tidak menyertakan wildcard maka alihkan ke halaman select_wildcard untuk memilih wildcard
        $data['units'] = $this->unitmodel->findAll();

        //wc yang masuk disaring apakah terdaftar di database, jika tidak maka redirect ke pilih unit
        $res = null;
        foreach ($data['units'] as $v) {
            if ($wc != $v['wildcard']) {
                $res = null;
            } else {
                $res = 'ok';
                break;
            }
        }
        //jika wildcard khusus maka proses filter akan diskip
        switch ($wc) {
            case 'insert':
            case 'logout':
                $res = 'ok';
                break;
        }
        //proses filter
        if (empty($res)) {
            if (session()->get('base') == 'management') {
                return redirect()->to('/');
            }
            return view('unit/pilih_unit', $data);
        }

        //jika wc kosong maka pergi ke halaman pilih unit
        if (empty($wc)) {
            return view('unit/pilih_unit', $data);
        }

        //layer 1 validation (session[username] exist)
        if (!session()->has('username')) {
            //wildcard khusus diblok jika belum login :) hehe
            if ($wc == 'login' || $wc == 'create' || $wc == 'insert' || $wc == 'logout') {
                return view('unit/pilih_unit', $data);
            }
            return $this->login($wc);
        }
        //redirect jika wildcard khusus dan sudah login
        switch ($wc) {
            case 'insert':
                return $this->insert();
            case 'logout':
                return $this->logout();
            default:
                break;
        }

        //layer 2 validation (session[base] is unit) - tidak bisa ke unit jika login dari management
        if (session()->get('base') == 'management') {
            return redirect()->to(base_url('/'))->with('error', ' Maaf anda tidak punya akses ke halaman unit ');
        }

        //layer 3 validation (session[id]->user.id_induk == wildcard->unit.id_induk) - tidak bisa ke unit jika user bukan bagian dari induk unit
        $data['username'] = session()->get('username');
        $username = session()->get('username');

        $induk_by_session_user = $this->usermodel->select('id_induk')->where('user_nama', $data['username'])->first();
        $induk_by_wildcard = $this->unitmodel->select('id_induk')->where('wildcard', $wc)->first();

        if ($induk_by_session_user != $induk_by_wildcard) {
            return redirect()->to(base_url('/u/'))->with('error', '( Induk Tidak Sesuai ) - Maaf anda tidak punya akses ke sini, silahkan periksa URL anda');
        }

        //layer 4 validation (session[id]->(user_akses by id_user).id_unit == wildcard->unit.id_unit) - tidak bisa ke unit jika user bukan bagian dari induk unit
        $unit_by_session_user = $this->usermodel->getakses($username);
        $unit_by_wildcard = $this->unitmodel->select('id_unit')->where('wildcard', $wc)->first();
        $res = null;
        foreach ($unit_by_session_user as $u) {
            if ($u['id_unit'] != $unit_by_wildcard['id_unit']) {
                $res = null;
            } else {
                $res = 'ok';
                break;
            }
        }
        if (empty($res)) {
            return redirect()->to(base_url('/u/'))->with('error', '( Unit Tidak Sesuai ) - Maaf anda tidak punya akses ke sini, silahkan periksa URL anda');
        }
        //mengambil data yang terkait dengan wilcard
        $data = $this->getdata($wc);
        if (empty($data)) {
            return redirect()->to('/error');
        }
        //jika ada getGet dari url dengan variabel 'menu', maka masuk ke sini
        //terjadi jika 'menu utama' di klik
        if ($this->request->getVar('menu')) {
            $submenu = '';
            //jika ada getGet dari url dengan variabel 'submenu' maka ambil nama sub menu nya
            //terjadi jika 'sub menu' di 'menu utama' di klik
            foreach ($data['fiturs'] as $f):
                if ($this->request->getVar('submenu') != $f['id_fitur']) {
                    $submenu = '';
                } else {
                    $submenu = $this->request->getVar('submenu');
                    break;
                }
            endforeach;

            //redirect ke method masing masing sesuai menu yang dipilih dan membawa data nama submenu yang dipilih
            switch ($this->request->getVar('menu')) {
                case 'profile':
                    $this->profile($wc);
                    break;
                case 'master':
                    $this->master($wc, $submenu);
                    break;
                case 'stok':
                    $this->stok($wc, $submenu);
                    break;
                case 'pembelian':
                    $this->pembelian($wc, $submenu);
                    break;
                case 'penjualan':
                    $this->penjualan($wc, $submenu);
                    break;
                case 'laporan':
                    $this->laporan($wc, $submenu);
                    break;
                case 'tools':
                    $this->tools($wc, $submenu);
                    break;
                case 'user_profile':
                    $this->user_profile($wc);
                    break;
                case 'edit_account':
                    $this->edit_account($wc);
                    break;
                default:
                    $this->profile($wc);
                    break;
            }
        } else {
            //jika tidak ada menu yang dipilih maka redirect ke profile sebagai halaman utama
            $this->profile($wc);
        }
    }
    public function getdata($wc)
    {
        //mengecek id unit berdasarkan wildcard
        $get_id = $this->unitmodel->where('wildcard', $wc)->first();
        if (empty($get_id)) {
            $data = null;
            return $data;
        }
        //id unit ditemukan
        $id_unit = $get_id['id_unit'];
        $username = session()->get('username');
        $data['user'] = $this->usermodel->where('user_nama', $username)->first();
        $data['unit'] = $this->unitmodel->where('id_unit', $id_unit)->first();
        $data['fiturs'] = $this->unitfiturmodel->getdetail($id_unit);
        $data['induk'] = $this->indukmodel->getdetail($data['unit']['id_induk']);
        return $data;
    }
    //ke gate halaman sub menu
    //(tiap sub menu terdapat submit form dengan variabel getpost $submenu, action=index)
    //dari method index, submenu diteruskan ke tiap method menu, dari method menu diteruskan ke sini
    //dari method, variabel $submenu dibawa kesini dengan pemanggilan method to_submenu(param1,2,3) (id,wc,page)
    
    public function to_submenu($id_fitur, $wc, $page)
    {
        $data = $this->getdata($wc);
        $fitur = $this->fiturmodel->where('id_fitur', $id_fitur)->first();
        $data['fitur'] = $fitur;
        $data['page'] = $page;
        $data['wc'] = $wc;
        $fitur_controller = new Fitur();
        $pos_controller = new Pos();

        switch ($id_fitur) {
            //jika klik fitur user management
            case 'k4f10':
                $data['mode'] ='';
                //jika mode create,detail & edit
                if($this->request->getVar('mode')) {
                    $data['mode'] = $this->request->getVar('mode');
                    $data['select'] = base64_decode(hex2bin($this->request->getVar('select')));
                }
                
                return $fitur_controller->list_users($data);
            //jika klik fitur setting struk
            case 'k3f4':
                return $fitur_controller->setting_struk($data);
            //jika klik fitur master pajak
            case 'k3f16':
                return $fitur_controller->master_pajak($data);
            //jika klik fitur master sc (service charge)
            case 'k3f17':
                return $fitur_controller->master_sc($data);
            //jika klik fitur master supplier
            case 'k2f1':
                return $fitur_controller->master_supplier($data);
            //jika klik fitur master kategori menu
            case 'k3f9':
                return $fitur_controller->master_katmenu($data);
            //jika klik fitur master jenis kartu
            case 'k3f11':
                return $fitur_controller->master_kartu($data);
            //jika klik fitur master shift
            case 'k3f15':
                return $fitur_controller->master_shift($data);
            //jika klik fitur master item kategori
            case 'k4f1':
                return $fitur_controller->master_katitem($data);
            //jika klik fitur master tipe transaksi
            case 'k3f19':
                return $fitur_controller->master_tiptrans($data);
            //jika klik fitur master item
            case 'k4f2':
                return $fitur_controller->master_item($data);
            //jika klik fitur master menu
            case 'k3f10':
                return $fitur_controller->master_menu($data);
            //jika klik fitur master meja
            case 'k3f18':
                return $fitur_controller->master_meja($data);
            //jika klik fitur stock konversi
            case 'k4f3':
                return $fitur_controller->konversi($data);
            //jika klik fitur stock keluar
            case 'k4f5':
                return $fitur_controller->stockout($data);
            //jika klik fitur stock opname
            case 'k4f4':
                if ($this->request->getPost('item')) {
                    $data['items'] = $this->request->getPost('item');
                }
                return $fitur_controller->opname($data);
            //jika klik fitur PO / pembelian order
            case 'k2f2':
                return $fitur_controller->po($data);
            //jika klik fitur Penerimaan barang
            case 'k2f3':
                return $fitur_controller->receive($data);
            //jika klik fitur Retur pembelian
            case 'k2f4':
                return $fitur_controller->retur($data);
            //jika klik fitur Initial Shift
            case 'k3f2':
                return $fitur_controller->initial($data);
            //jika klik fitur Tutup Shift
            case 'k3f1':
                return $fitur_controller->closing($data);
            //jika klik fitur POS
            case 'k3f3':
                if($this->request->getVar('open')) {
                    return $pos_controller->pos($data);
                }
                return $pos_controller->open_pos($data);
            //jika klik fitur Tutup Shift
            case 'k3f25':
                return $pos_controller->refund($data);
            default:
            break;
        }

        echo view('unit/u', $data);
    }
    public function user_profile($wc)
    {
        $data = $this->getdata($wc); // array data dari function getdata()
        $username = session()->get('username');
        $data['user'] = $this->usermodel->where('user_nama', $username)->first();
        $id_user = $data['user']['id_user'];
        $data['units'] = $this->useraksesmodel->getdetail($id_user);
        $data['page'] = 'profile';
        echo view('unit/menu/u_user_profile', $data);
    }
    public function profile($wc)
    {
        $data = $this->getdata($wc); // array data dari function getdata()
        $data['page'] = 'profile';
        echo view('unit/menu/u_profile', $data);
    }
    public function edit_account($wc)
    {
        $data = $this->getdata($wc); // array data dari function getdata()
        $username = session()->get('username');
        $data['user'] = $this->usermodel->where('user_nama', $username)->first();
        $id_user = $data['user']['id_user'];
        $data['units'] = $this->useraksesmodel->getdetail($id_user);
        $data['page'] = 'profile';
        $data['wc'] = $wc;
        echo view('unit/submenu/edit_account', $data);
    }
    public function master($wc, $submenu)
    {
        $data = $this->getdata($wc); // array data dari function getdata()
        $data['page'] = 'master';
        //jika klik sub menu, maka akan diteruskan ke method to_submenu(), untuk menuju ke halaman sub menu tsb
        if ($submenu != '') {
            $this->to_submenu($submenu, $wc, $data['page']);
        } else {
            echo view('unit/menu/u_master', $data);
        }
    }
    public function stok($wc, $submenu)
    {
        $data = $this->getdata($wc); // array data dari function getdata()
        $data['page'] = 'stok';
        //jika klik sub menu, maka akan diteruskan ke method to_submenu(), untuk menuju ke halaman sub menu tsb
        if ($submenu != '') {
            $this->to_submenu($submenu, $wc, $data['page']);
        } else {
            echo view('unit/menu/u_stock', $data);
        }

    }
    public function pembelian($wc, $submenu)
    {
        $data = $this->getdata($wc); // array data dari function getdata()
        $data['page'] = 'pembelian';
        //jika klik sub menu, maka akan diteruskan ke method to_submenu(), untuk menuju ke halaman sub menu tsb
        if ($submenu != '') {
            $this->to_submenu($submenu, $wc, $data['page']);
        } else {
            echo view('unit/menu/u_pembelian', $data);
        }

    }
    public function penjualan($wc, $submenu)
    {
        $data = $this->getdata($wc); // array data dari function getdata()
        $data['page'] = 'penjualan';
        // kirim data initial untuk blok akses ke pos jika belum initial
        $id_user = $data['user']['id_user'];
        $data['init'] = $this->initialmodel->get_current($id_user);
        // ke sub menu jika klik submenu
        if ($submenu != '') {
            $this->to_submenu($submenu, $wc, $data['page']);
        } else {
            echo view('unit/menu/u_penjualan', $data);
        }

    }
    public function laporan($wc, $submenu)
    {
        $data = $this->getdata($wc); // array data dari function getdata()
        $data['page'] = 'laporan';
        //jika klik sub menu, maka akan diteruskan ke method to_submenu(), untuk menuju ke halaman sub menu tsb
        if ($submenu != '') {
            $this->to_submenu($submenu, $wc, $data['page']);
        } else {
            echo view('unit/menu/u_laporan', $data);
        }

    }
    public function tools($wc, $submenu)
    {
        $data = $this->getdata($wc); // array data dari function getdata()
        $data['page'] = 'tools';
        //jika klik sub menu, maka akan diteruskan ke method to_submenu(), untuk menuju ke halaman sub menu tsb
        if ($submenu != '') {
            $this->to_submenu($submenu, $wc, $data['page']);
        } else {
            echo view('unit/menu/u_tools', $data);
        }
    }
    public function error()
    {
        echo view('errors/html/error_404');
    }
    public function auth()
    {
        $usersModel = new UUserModel();
        $wc = $this->request->getPost('wildcard');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $user = $usersModel->where('user_nama', $username)->first();
        //cek apakah user ada di database & password sesuai
        if ($user) {
            if (md5($password) !== $user['user_password']) {
                //jika tidak ada atau password tidak sesuai maka reject dengan pesan error
                return redirect()->to(base_url('/u/' . $wc))->with('error', 'Password salah');
            }
            
            //jika berhasil lanjut ke validasi ke 2
            //cek apakah user memiliki akses ke wildcard yang dimasukkan 
            $unit_by_session_user = $this->usermodel->getakses($username);
            $unit_by_wildcard = $this->unitmodel->select('id_unit')->where('wildcard', $wc)->first();
            $res = null;
            foreach ($unit_by_session_user as $u) {
                //note
                if ($u['id_unit'] !== $unit_by_wildcard['id_unit']) {
                    $res = null;
                } else {
                    $res = 'ok';
                    break;
                }
            }
            //jika tidak punya akses maka reject ke halaman login dengan pesan error
            if ($res == null) {
                return redirect()->to(base_url('/u/' . $wc))->with('error', '( Unit tidak Sesuai ) - Maaf anda tidak punya akses ke Unit ini, silahkan periksa URL anda');
            }
            //jika sesuai maka lanjut set session, dan selamat bekerja :)
            session()->set('username', $user['user_nama']);
            session()->set('base', 'unit');
            return redirect()->to(base_url('/u/' . $wc));
        } else {
            //jika username tidak ada reject dengan pesan error
            return redirect()->to(base_url('/u/' . $wc))->with('error', 'Username tidak terdaftar');
        }
    }
}
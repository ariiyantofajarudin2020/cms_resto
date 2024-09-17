<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\Files\File;
class Fitur extends BaseController
{
    //gate filter http request post
    public function http_post($var) {
        switch ($var) {
            case 'up_setting_struk' :
                return $this->up_setting_struk();
            case 'in_user' :
                return $this->in_user();
            case 'up_user' :
                return $this->up_user();
            case 'up_um' :
                return $this->up_um();
            case 'up_master_pajak' :
                return $this->up_master_pajak();
            case 'up_master_sc' :
                return $this->up_master_sc();
            case 'up_supplier' :
                return $this->up_supplier();
            case 'up_katmenu' :
                return $this->up_katmenu();
            case 'up_kartu' :
                return $this->up_kartu();
            case 'up_shift' :
                return $this->up_shift();
            case 'up_katitem' :
                return $this->up_katitem();
            case 'up_tiptrans' :
                return $this->up_tiptrans();
            case 'up_item' :
                return $this->up_item();
            case 'up_menu' :
                return $this->up_menu();
            case 'up_meja' :
                return $this->up_meja();
            case 'up_konversi' :
                return $this->up_konversi();
            case 'up_stockout' :
                return $this->up_stockout();
            case 'up_opname' :
                return $this->up_opname();
            case 'up_po' :
                return $this->up_po();
            case 'up_receive' :
                return $this->up_receive();
            case 'up_retur' :
                return $this->up_retur();
            case 'up_initial' :
                return $this->up_initial();
            case 'up_closing' :
                return $this->up_closing();
            default :
            break;
        }
    }
    //user management
    public function list_users($var) {
        $data[] = '';
        $data = array_merge($data, $var);
        
        $data['user_by_induk'] = $this->usermodel->where('id_induk', $data['induk']['id_induk'])->findAll();
        $data['unit_by_induk'] = $this->unitmodel->where('id_induk', $data['induk']['id_induk'])->findAll();

        if ($data['mode']!='') {
            if ($data['mode']=='create') {
                $data['create']='ok';
                $data = array_merge($data, $this->create($data));
            }else{
                $id_user = $data['select'];
                $data['userdata'] = $this->usermodel->where('id_user', $id_user)->first();
                $data['userakses'] = $this->useraksesmodel->getdetail($id_user);
                switch ($data['mode']){
                    case 'detail' :
                        $data['detail'] ='ok';
                        break;
                    case 'edit' :
                        $data['edit'] = 'ok';
                        break;
                    default : 
                        break;
                }
            }
        }
        echo view('unit/submenu/management_user', $data);
    }
    public function create($var) {
        $data[] = '';
        //data $var masuk dari 2 jalur controller yaitu management, unit
        //dari management hanya mengirim string untuk konfirmasi pembeda jalur
        //dari unit mengirim array,
        //jika yang masuk dari management maka view create_account nya adalah ke halaman managemen
        //jika yang masuk dari unit maka view create_account nya adalah ke halaman unit
        if ($var == 'management') {
            //ambil data induk yang ada di database
            $indukData = $this->indukmodel->findAll();
            //ambil data unit yang terkait dengan induk nya
            foreach ($indukData as $induk) {
                $unitData = $this->unitmodel->where('id_induk', $induk['id_induk'])->findAll();
                $data['indk'][] = [
                    'id_induk' => $induk['id_induk'],
                    'induk_nama' => $induk['induk_nama'],
                    'units' => $unitData
                ];
            }
            $data['page'] = 'create_unit_account';
            return view('management/create_unit_account', $data);
        } //endif

        $data = array_merge($data, $var);
        //jika diakses dari basis unit
        //ambil data induk yang ada di database
        $id_induk = $var['induk']['id_induk'];
        $indukData = $this->indukmodel->where('id_induk', $id_induk)->first();
        //ambil data unit yang terkait dengan induk nya
        $unitData = $this->unitmodel->where('id_induk', $id_induk)->findAll();
            $data['indk'][] = [
                'id_induk' => $id_induk,
                'induk_nama' => $data['induk']['induk_nama'],
                'units' => $unitData
            ];

        //menggabungkan data array jika request berasal dari controller unit
        $data = array_merge($data, $var);
        return $data;
    }
    public function in_user()
    {
        $from = $this->request->getPost('from');
        $username = $this->request->getPost('user_nama');
        $id_induk = $this->request->getPost('id_induk');
        $units = $this->request->getPost('unit'); // Array of units
        $cek_user = null;
        $cek_user = $this->usermodel->where('user_nama', $username)->where('id_induk', $id_induk)->first();
        $last_id = $this->usermodel->orderBy('id_user', 'desc')->first();
        $file = $this->request->getFile('photo');
        $datenow = date('dmY');
        $timenow = date('His');
        if (empty($last_id)) {
            $newName = 'user-0-' . $datenow . '-' . $timenow . '.jpg';
        }else{
            $newName = 'user-' . $last_id['id_user']+1 . '-' . $datenow . '-' . $timenow . '.jpg';
        }
        

        if (empty($this->request->getPost('unit'))) {
            return redirect()->to(base_url($from))->with('error', 'Harap pilih unit.');
        }
        if (!empty($cek_user)) {
            return redirect()->to(base_url($from))->with('error', 'Username sudah digunakan, pilih yang lain.');
        } else {
            $file->move(FCPATH . 'images', $newName);
            //proses crop photo menjadi 1:1
            $filePath = FCPATH . 'images/' . $newName;

            // Load layanan manipulasi gambar
            $image = \Config\Services::image()
                        ->withFile($filePath);

            $width = $image->getWidth();
            $height = $image->getHeight();

            $minSize = min($width, $height);

            $image->crop($minSize, $minSize, ($width - $minSize) / 2, ($height - $minSize) / 2)
                  ->save($filePath);

            $data = [
                'id_induk' => $this->request->getPost('id_induk'),
                'user_nama' => $this->request->getPost('user_nama'),
                'user_password' => md5($this->request->getPost('user_password')),
                'user_alamat' => $this->request->getPost('user_alamat'),
                'user_telepon' => $this->request->getPost('user_telepon'),
                'user_email' => $this->request->getPost('user_email'),
                'user_photo' => $newName,
            ];
            // Start transaction
            $db = \Config\Database::connect();
            $db->transStart();

            // Insert unit data
            $this->usermodel->insert($data);
            $id_user = $this->usermodel->getInsertID();

            // Insert each item with the same id_toko
            foreach ($units as $u) {
                $unitdata = [
                    'id_user' => $id_user,
                    'id_unit' => $u
                ];
                $this->useraksesmodel->insert($unitdata);
            }

            // Complete transaction
            $db->transComplete();
            if ($db->transStatus() === false) {
                // Transaction failed
                return redirect()->to(base_url($from))->with('error', 'Gagal menyimpan data !.');
            } else {
                // Transaction succeeded
                return redirect()->to(base_url($from))->with('success', '## Data Berhasil ditambahkan ##');
            }
        }
    }
    public function up_user() {    
    //simpan hasil edit
            $id = $this->request->getPost('id');
            $u = $this->usermodel->find($id);
            $wc = $this->request->getPost('wc');
            
            //terpisah karena supaya form password tidak harus required
            //karna di form edit tidak boleh ditampilkan
            if (!empty($this->request->getPost('user_password'))) {
            $this->usermodel->update($id, [
                'user_password' => md5($this->request->getPost('user_password')),
            ]);
            }

            $oldPhoto = $u['user_photo'];
            $file = $this->request->getFile('user_photo');
            $datenow = date('dmY');
            $timenow = date('His');

            if ($file && $file->isValid()) {
                if (file_exists(FCPATH . 'images/' . $oldPhoto)) {
                    unlink(FCPATH . 'images/' . $oldPhoto);
                }
                $newName = 'user-'.$id.'-'.$datenow.'-'.$timenow.'.jpg';
                //proses crop photo menjadi 1:1
                $file->move(FCPATH . 'images', $newName);
                $filePath = FCPATH . 'images/' . $newName;

                // Load layanan manipulasi gambar
                $image = \Config\Services::image()
                            ->withFile($filePath);

                $width = $image->getWidth();
                $height = $image->getHeight();

                $minSize = min($width, $height);

                $image->crop($minSize, $minSize, ($width - $minSize) / 2, ($height - $minSize) / 2)
                    ->save($filePath);
            } else {
                $newName = $oldPhoto;
            }

            // Start transaction
            $db = \Config\Database::connect();
            $db->transStart();

            $this->usermodel->update($id, [
            'user_alamat' => $this->request->getPost('user_alamat'),
            'user_telepon' => $this->request->getPost('user_telepon'),
            'user_email' => $this->request->getPost('user_email'),
            'user_photo' => $newName,
            ]);

            // Complete transaction
            $db->transComplete();
            if ($db->transStatus() === false) {
                // Transaction failed
                return redirect()->back()->with('error', 'Gagal menyimpan data');
            } else {
                // Transaction succeeded
                return redirect()->to(base_url('/u/'.$wc.'?menu=user_profile'))->with('success', 'Data berhasil disimpan');
            }
    }
    public function up_um() {    
    //simpan hasil edit
            $id = $this->request->getPost('id');
            $u = $this->usermodel->find($id);
            $wc = $this->request->getPost('wc');
            $units = $this->request->getPost('units'); // Array of units
            //pengecekan data unik agar tidak duplikat
            $data_old = $this->request->getPost('unique_old');
            $cek_unique = $this->usermodel->where('user_nama', $this->request->getPost('user_nama'))->where('id_induk', $this->request->getPost('id_induk'))->first();
            if (!empty($cek_unique) && $cek_unique['user_nama']!=$data_old) {
                return redirect()->to(base_url('/u/'.$wc.'?menu=tools&submenu=k4f10&mode=detail&select='.bin2hex(base64_encode($id))))->with('error', 'Data sudah ada, harap ganti agar tidak duplikat.');
            }
            // Start transaction
            $db = \Config\Database::connect();
            $db->transStart();

            $this->usermodel->update($id, [
            'user_nama' => $this->request->getPost('user_nama'),
            'user_alamat' => $this->request->getPost('user_alamat'),
            'user_telepon' => $this->request->getPost('user_telepon'),
            'user_email' => $this->request->getPost('user_email'),
            ]);

            $this->useraksesmodel->where('id_user',$id)->delete();
            
            if (!empty($units)) {
                foreach ($units as $u) {
                    $useraksesData = [
                        'id_user' => $id,
                        'id_unit' => $u
                    ];
                    $this->useraksesmodel->insert($useraksesData);
                }
            }

            // Complete transaction
            $db->transComplete();
            if ($db->transStatus() === false) {
                // Transaction failed
                return redirect()->back()->with('error', 'Gagal menyimpan data');
            } else {
                // Transaction succeeded
                return redirect()->to(base_url('/u/'.$wc.'?menu=tools&submenu=k4f10&mode=detail&select='.bin2hex(base64_encode($id))))->with('success', 'Data berhasil disimpan');
            }
    }
    public function mu_delete($v,$wc)
    {
        $id = base64_decode(hex2bin($v));
        $user = $this->usermodel->find($id);
        $photo = $user['user_photo'];
        if (file_exists(FCPATH . 'images/' . $photo)) {
            unlink(FCPATH . 'images/' . $photo);
        }
        // Simpan data ke database
        $this->usermodel->delete($id);
        return redirect()->to(base_url('/u/'.$wc.'?menu=tools&submenu=k4f10'))->with('success', 'Data Deleted Successfully');
    }
    // setting struk
    public function setting_struk($d) {
        $data[]='';
        $data = array_merge($data, $d);
        $data['pos'] = $this->posmodel->where('id_induk',  $data['induk']['id_induk'])->first();
        echo view('unit/submenu/setting_struk',$data);
    }
    public function up_setting_struk() {
        $data[]='';
        $wc = $this->request->getPost('wc');
        $id_induk = $this->request->getPost('id_induk');
        $data['id_pos'] = $this->posmodel->where('id_induk', $id_induk)->first();
        
        $posdata = [
                'struk_footer' => $this->request->getPost('struk_footer'),
            ];
        $this->posmodel->update($data['id_pos'], $posdata);
        return redirect()->to(base_url('u/'.$wc.'?menu=tools&submenu=k3f4'))->with('success', '## Data Berhasil diganti ##');
    }
    // master pajak
    public function master_pajak($d) {
        $data[]='';
        $data = array_merge($data, $d);
        $data['pos'] = $this->posmodel->where('id_induk',  $data['induk']['id_induk'])->first();
        echo view('unit/submenu/master_pajak',$data);
    }
    public function up_master_pajak() {
        $data[]='';
        $wc = $this->request->getPost('wc');
        $id_induk = $this->request->getPost('id_induk');
        $data['id_pos'] = $this->posmodel->where('id_induk', $id_induk)->first();
        
        $posdata = [
                'pajak' => $this->request->getPost('pajak'),
            ];
        $this->posmodel->update($data['id_pos'], $posdata);
        return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f16'))->with('success', '## Data Berhasil diganti ##');
    }
    // master service charge
    public function master_sc($d) {
        $data[]='';
        $data = array_merge($data, $d);
        $data['pos'] = $this->posmodel->where('id_induk',  $data['induk']['id_induk'])->first();
        echo view('unit/submenu/master_sc',$data);
    }
    public function up_master_sc() {
        $data[]='';
        $wc = $this->request->getPost('wc');
        $id_induk = $this->request->getPost('id_induk');
        $data['id_pos'] = $this->posmodel->where('id_induk', $id_induk)->first();
        
        $posdata = [
                'sc' => $this->request->getPost('sc'),
            ];
        $this->posmodel->update($data['id_pos'], $posdata);
        return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f17'))->with('success', '## Data Berhasil diganti ##');
    }
    // master supplier
    public function master_supplier($d) {
        $data[]='';
        $data = array_merge($data, $d);
        $data['supplier'] = $this->suppliermodel->getall($data['induk']['id_induk']);
        echo view('unit/submenu/master_supplier',$data);
    }
    public function up_supplier() {
        $data[]='';
        $wc = $this->request->getPost('wc');
        $mode = $this->request->getPost('mode');
        $supplierdata = [
                'id_induk' => $this->request->getPost('id_induk'),
                'supplier_nama' => $this->request->getPost('nama'),
                'supplier_alamat' => $this->request->getPost('alamat'),
                'supplier_telepon' => $this->request->getPost('telepon'),
                'supplier_email' => $this->request->getPost('email'),
                'supplier_item' => $this->request->getPost('item'),
                ];
        //pengecekan data unik agar tidak duplikat
        $cek_unique = $this->suppliermodel->where('supplier_nama', $this->request->getPost('nama'))->where('id_induk', $this->request->getPost('id_induk'))->first();
        
        switch ($mode) {
            case 'create' :
                if (!empty($cek_unique)) {
                    return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k2f1'))->with('error', 'Data sudah ada, harap ganti agar tidak duplikat.');
                }
                $this->suppliermodel->insert($supplierdata);
                return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k2f1'))->with('success', '## Data Berhasil ditambah ##');
            case 'lihat' : //jika mode lihat maka action http request post nya adalah untuk hapus data
                $id_supplier = $this->request->getPost('id_supplier');
                $this->suppliermodel->delete($id_supplier);
                return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k2f1'))->with('success', '## Data Berhasil dihapus ##');
            case 'edit' :
                $data_old = $this->request->getPost('unique_old');
                if (!empty($cek_unique) && $cek_unique['supplier_nama']!=$data_old) {
                    return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k2f1'))->with('error', 'Data sudah ada, harap ganti agar tidak duplikat.');
                }
                $id_supplier = $this->request->getPost('id_supplier');
                $this->suppliermodel->update($id_supplier, $supplierdata);
                return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k2f1'))->with('success', '## Data Berhasil diganti ##');
            default :
            break;
        }
    }
    // master kategori menu
    public function master_katmenu($d) {
        $data[]='';
        $data = array_merge($data, $d);
        $data['katmenu'] = $this->katmenumodel->getall($data['induk']['id_induk']);
        echo view('unit/submenu/master_katmenu',$data);
    }
    public function up_katmenu() {
        $data[]='';
        $wc = $this->request->getPost('wc');
        $mode = $this->request->getPost('mode');
        $katmenudata = [
                'id_induk' => $this->request->getPost('id_induk'),
                'menu_kategori' => $this->request->getPost('menu_kategori'),
                ];
        //pengecekan data unik agar tidak duplikat
        $cek_unique = $this->katmenumodel->where('menu_kategori', $this->request->getPost('menu_kategori'))->where('id_induk', $this->request->getPost('id_induk'))->first();

        switch ($mode) {
            case 'create' :
                if (!empty($cek_unique)) {
                    return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f9'))->with('error', 'Data sudah ada, harap ganti agar tidak duplikat.');
                }
                $this->katmenumodel->insert($katmenudata);
                return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f9'))->with('success', '## Data Berhasil ditambah ##');
            case 'lihat' : //jika mode lihat maka action http request post nya adalah untuk hapus data
                $id_katmenu = $this->request->getPost('id_katmenu');
                $this->katmenumodel->delete($id_katmenu);
                return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f9'))->with('success', '## Data Berhasil dihapus ##');
            case 'edit' :
                $data_old = $this->request->getPost('unique_old');
                if (!empty($cek_unique) && $cek_unique['menu_kategori']!=$data_old) {
                    return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f9'))->with('error', 'Data sudah ada, harap ganti agar tidak duplikat.');
                }
                $id_katmenu = $this->request->getPost('id_katmenu');
                $this->katmenumodel->update($id_katmenu, $katmenudata);
                return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f9'))->with('success', '## Data Berhasil diganti ##');
            default :
            break;
        }
    }
    // master kartu
    public function master_kartu($d) {
        $data[]='';
        $data = array_merge($data, $d);
        $data['kartu'] = $this->kartumodel->getall($data['induk']['id_induk']);
        echo view('unit/submenu/master_kartu',$data);
    }
    public function up_kartu() {
        $data[]='';
        $wc = $this->request->getPost('wc');
        $mode = $this->request->getPost('mode');
        $kartudata = [
                'id_induk' => $this->request->getPost('id_induk'),
                'kartu_nama' => $this->request->getPost('kartu_nama'),
                ];
        //pengecekan data unik agar tidak duplikat
        $cek_unique = $this->kartumodel->where('kartu_nama', $this->request->getPost('kartu_nama'))->where('id_induk', $this->request->getPost('id_induk'))->first();

        switch ($mode) {
            case 'create' :
                 if (!empty($cek_unique)) {
                    return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f11'))->with('error', 'Data sudah ada, harap ganti agar tidak duplikat.');
                }
                $this->kartumodel->insert($kartudata);
                return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f11'))->with('success', '## Data Berhasil ditambah ##');
            case 'lihat' : //jika mode lihat maka action http request post nya adalah untuk hapus data
                $id_kartu = $this->request->getPost('id_kartu');
                // filter - data default tidak boleh dihapus 
                $kartu = $this->kartumodel->where('id_jeniskartu', $id_kartu)->first()['kartu_nama'];
                if ($kartu == 'default') {
                    return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f11'))->with('error', '## Mohon maaf data default tidak bisa dihapus ##');    
                } // end filter
                $this->kartumodel->delete($id_kartu);
                return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f11'))->with('success', '## Data Berhasil dihapus ##');
            case 'edit' :
                $data_old = $this->request->getPost('unique_old');
                $id_kartu = $this->request->getPost('id_kartu');
                // filter - data default tidak boleh diedit 
                $kartu = $this->kartumodel->where('id_jeniskartu', $id_kartu)->first()['kartu_nama'];
                if ($kartu == 'default') {
                    return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f11'))->with('error', '## Mohon maaf data default tidak bisa diedit ##');    
                } // end filter
                if (!empty($cek_unique) && $cek_unique['kartu_nama']!=$data_old) {
                    return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f11'))->with('error', 'Data sudah ada, harap ganti agar tidak duplikat.');
                }
                $this->kartumodel->update($id_kartu, $kartudata);
                return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f11'))->with('success', '## Data Berhasil diganti ##');
            default :
            break;
        }
    }
    // master shift
    public function master_shift($d) {
        $data[]='';
        $data = array_merge($data, $d);
        $data['shift'] = $this->shiftmodel->getall($data['induk']['id_induk']);
        echo view('unit/submenu/master_shift',$data);
    }
    public function up_shift() {
        $data[]='';
        $wc = $this->request->getPost('wc');
        $mode = $this->request->getPost('mode');
        $shiftdata = [
                'id_induk' => $this->request->getPost('id_induk'),
                'shift' => $this->request->getPost('shift'),
                'jam_mulai' => $this->request->getPost('mulai'),
                'jam_selesai' => $this->request->getPost('selesai'),
                ];
        //pengecekan data unik agar tidak duplikat
        $cek_unique = $this->shiftmodel->where('shift', $this->request->getPost('shift'))->where('id_induk', $this->request->getPost('id_induk'))->first();

        switch ($mode) {
            case 'create' :
                if (!empty($cek_unique)) {
                    return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f15'))->with('error', 'Data sudah ada, harap ganti agar tidak duplikat.');
                }
                $this->shiftmodel->insert($shiftdata);
                return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f15'))->with('success', '## Data Berhasil ditambah ##');
            case 'lihat' : //jika mode lihat maka action http request post nya adalah untuk hapus data
                $id_shift = $this->request->getPost('id_shift');
                $this->shiftmodel->delete($id_shift);
                return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f15'))->with('success', '## Data Berhasil dihapus ##');
            case 'edit' :
                $data_old = $this->request->getPost('unique_old');
                if (!empty($cek_unique) && $cek_unique['shift']!=$data_old) {
                    return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f15'))->with('error', 'Data sudah ada, harap ganti agar tidak duplikat.');
                }
                $id_shift = $this->request->getPost('id_shift');
                $this->shiftmodel->update($id_shift, $shiftdata);
                return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f15'))->with('success', '## Data Berhasil diganti ##');
            default :
            break;
        }
    }
    // master kategori item
    public function master_katitem($d) {
        $data[]='';
        $data = array_merge($data, $d);
        $data['katitem'] = $this->katitemmodel->getall($data['induk']['id_induk']);
        echo view('unit/submenu/master_katitem',$data);
    }
    public function up_katitem() {
        $data[]='';
        $wc = $this->request->getPost('wc');
        $mode = $this->request->getPost('mode');
        $katitemdata = [
                'id_induk' => $this->request->getPost('id_induk'),
                'item_kategori' => $this->request->getPost('item_kategori'),
                ];
        //pengecekan data unik agar tidak duplikat
        $cek_unique = $this->katitemmodel->where('item_kategori', $this->request->getPost('item_kategori'))->where('id_induk', $this->request->getPost('id_induk'))->first();

        switch ($mode) {
            case 'create' :
                if (!empty($cek_unique)) {
                    return redirect()->to(base_url('u/'.$wc.'?menu=stok&submenu=k4f1'))->with('error', 'Data sudah ada, harap ganti agar tidak duplikat.');
                }
                $this->katitemmodel->insert($katitemdata);
                return redirect()->to(base_url('u/'.$wc.'?menu=stok&submenu=k4f1'))->with('success', '## Data Berhasil ditambah ##');
            case 'lihat' : //jika mode lihat maka action http request post nya adalah untuk hapus data
                $id_katitem = $this->request->getPost('id_katitem');
                $this->katitemmodel->delete($id_katitem);
                return redirect()->to(base_url('u/'.$wc.'?menu=stok&submenu=k4f1'))->with('success', '## Data Berhasil dihapus ##');
            case 'edit' :
                $data_old = $this->request->getPost('unique_old');
                if (!empty($cek_unique) && $cek_unique['item_kategori']!=$data_old) {
                    return redirect()->to(base_url('u/'.$wc.'?menu=stok&submenu=k4f1'))->with('error', 'Data sudah ada, harap ganti agar tidak duplikat.');
                }
                $id_katitem = $this->request->getPost('id_katitem');
                $this->katitemmodel->update($id_katitem, $katitemdata);
                return redirect()->to(base_url('u/'.$wc.'?menu=stok&submenu=k4f1'))->with('success', '## Data Berhasil diganti ##');
            default :
            break;
        }
    }
    // master tipe transaksi
    public function master_tiptrans($d) {
        $data[]='';
        $data = array_merge($data, $d);
        $data['tiptrans'] = $this->tiptransmodel->getall($data['induk']['id_induk']);
        echo view('unit/submenu/master_tiptrans',$data);
    }
    public function up_tiptrans() {
        $data[]='';
        $wc = $this->request->getPost('wc');
        $mode = $this->request->getPost('mode');
        $tiptransdata = [
                'id_induk' => $this->request->getPost('id_induk'),
                'type_trans' => $this->request->getPost('tiptrans_nama'),
                ];
        //pengecekan data unik agar tidak duplikat
        $cek_unique = $this->tiptransmodel->where('type_trans', $this->request->getPost('tiptrans_nama'))->where('id_induk', $this->request->getPost('id_induk'))->first();

        switch ($mode) {
            case 'create' :
                 if (!empty($cek_unique)) {
                    return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f19'))->with('error', 'Data sudah ada, harap ganti agar tidak duplikat.');
                }
                $this->tiptransmodel->insert($tiptransdata);
                return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f19'))->with('success', '## Data Berhasil ditambah ##');
            case 'lihat' : //jika mode lihat maka action http request post nya adalah untuk hapus data
                $id_tiptrans = $this->request->getPost('id_tiptrans');
                // filter - data dine in atau take away tidak boleh dihapus 
                $tiptrans = $this->tiptransmodel->where('id_typetrans', $id_tiptrans)->first()['type_trans'];
                if ($tiptrans == 'dine in' || $tiptrans == 'take away') {
                    return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f19'))->with('error', '## Mohon maaf data default tidak bisa dihapus ##');    
                } // end filter
                $this->tiptransmodel->delete($id_tiptrans);
                return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f19'))->with('success', '## Data Berhasil dihapus ##');
            case 'edit' :
                $data_old = $this->request->getPost('unique_old');
                $id_tiptrans = $this->request->getPost('id_tiptrans');
                // filter - data dine in atau take away tidak boleh diedit 
                $tiptrans = $this->tiptransmodel->where('id_typetrans', $id_tiptrans)->first()['type_trans'];
                if ($tiptrans == 'dine in' || $tiptrans == 'take away') {
                    return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f19'))->with('error', '## Mohon maaf data default tidak bisa diedit ##');    
                } // end filter
                if (!empty($cek_unique) && $cek_unique['type_trans']!=$data_old) {
                    return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f19'))->with('error', 'Data sudah ada, harap ganti agar tidak duplikat.');
                }
                $this->tiptransmodel->update($id_tiptrans, $tiptransdata);
                return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f19'))->with('success', '## Data Berhasil diganti ##');
            default :
            break;
        }
    }
    // master item
    public function master_item($d) {
        $data[]='';
        $data = array_merge($data, $d);
        $data['item'] = $this->itemmodel->getall($data['induk']['id_induk']);
        $data['katitem'] = $this->katitemmodel->getall($data['induk']['id_induk']);
        echo view('unit/submenu/master_item',$data);
    }
    public function up_item() {
        $data[]='';
        $wc = $this->request->getPost('wc');
        $mode = $this->request->getPost('mode');
        $itemdata = [
                'item_barcode' => $this->request->getPost('item_barcode'),
                'id_induk' => $this->request->getPost('id_induk'),
                'id_item_kategori' => $this->request->getPost('id_item_kategori'),
                'item_nama' => $this->request->getPost('item_nama'),
                'item_keterangan' => $this->request->getPost('item_keterangan'),
                'item_satuan' => $this->request->getPost('item_satuan'),
                'item_harga' => $this->request->getPost('item_harga'),
                'item_stock' => $this->request->getPost('item_stock'),
                ];
        //pengecekan data unik agar tidak duplikat
        $cek_unique = $this->itemmodel->where('item_barcode', $this->request->getPost('item_barcode'))->where('id_induk', $this->request->getPost('id_induk'))->first();

        switch ($mode) {
            case 'create' :
                if (!empty($cek_unique)) {
                    return redirect()->to(base_url('u/'.$wc.'?menu=stok&submenu=k4f2'))->with('error', 'Data sudah ada, harap ganti agar tidak duplikat.');
                }
                $this->itemmodel->insert($itemdata);
                return redirect()->to(base_url('u/'.$wc.'?menu=stok&submenu=k4f2'))->with('success', '## Data Berhasil ditambah ##');
            case 'lihat' : //jika mode lihat maka action http request post nya adalah untuk hapus data
                $id_item = $this->request->getPost('id_item');
                $this->itemmodel->delete($id_item);
                return redirect()->to(base_url('u/'.$wc.'?menu=stok&submenu=k4f2'))->with('success', '## Data Berhasil dihapus ##');
            case 'edit' :
                $data_old = $this->request->getPost('unique_old');
                if (!empty($cek_unique) && $cek_unique['item_barcode']!=$data_old) {
                    return redirect()->to(base_url('u/'.$wc.'?menu=stok&submenu=k4f2'))->with('error', 'Data sudah ada, harap ganti agar tidak duplikat.');
                }
                $id_item = $this->request->getPost('id_item');
                $this->itemmodel->update($id_item, $itemdata);
                return redirect()->to(base_url('u/'.$wc.'?menu=stok&submenu=k4f2'))->with('success', '## Data Berhasil diganti ##');
            default :
            break;
        }
    }
    // master menu
    public function master_menu($d) {
        $data[]='';
        $data = array_merge($data, $d);
        $data['menu'] = $this->menumodel->getall($data['induk']['id_induk']);
        $data['katmenu'] = $this->katmenumodel->getall($data['induk']['id_induk']);
        $data['items'] = $this->itemmodel->getall($data['induk']['id_induk']);

        foreach ($data['menu'] as $key=> $v) {
            
            $data['item_menu'][$key] = $this->itemmenumodel->getall($v['id_menu']);
        }
        echo view('unit/submenu/master_menu',$data);
    }
    public function up_menu() {
        $data[]='';
        $wc = $this->request->getPost('wc');
        $mode = $this->request->getPost('mode');
        $menudata = [
                'id_induk' => $this->request->getPost('id_induk'),
                'id_menu_kategori' => $this->request->getPost('id_menu_kategori'),
                'menu_nama' => $this->request->getPost('menu_nama'),
                'menu_keterangan' => $this->request->getPost('menu_keterangan'),
                'menu_harga_pokok' => $this->request->getPost('menu_harga_pokok'),
                'menu_biaya_waste' => $this->request->getPost('menu_biaya_waste'),
                'menu_biaya_lain' => $this->request->getPost('menu_biaya_lain'),
                'menu_biaya_total' => $this->request->getPost('menu_biaya_total'),
                'menu_harga_jual' => $this->request->getPost('menu_harga_jual'),
                'menu_gross' => $this->request->getPost('menu_gross'),
                ];
        //pengecekan data unik agar tidak duplikat
        $cek_unique = $this->menumodel->where('menu_nama', $this->request->getPost('menu_nama'))->where('id_induk', $this->request->getPost('id_induk'))->first();

        // Start transaction
        $db = \Config\Database::connect();
        $db->transStart();

        switch ($mode) {
            case 'create' :
                if (!empty($cek_unique)) {
                    return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f10'))->with('error', 'Data sudah ada, harap ganti agar tidak duplikat.');
                }
                $this->menumodel->insert($menudata);
                $id_menu = $this->menumodel->getInsertID();
                break;
            case 'lihat' : //jika mode lihat maka action http request post nya adalah untuk hapus data
                $id_menu = $this->request->getPost('id_menu');
                $this->menumodel->delete($id_menu);
                $db->transComplete();
                return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f10'))->with('success', '## Data Berhasil dihapus ##');
            case 'edit' :
                $data_old = $this->request->getPost('unique_old');
                if (!empty($cek_unique) && $cek_unique['menu_nama']!=$data_old) {
                    return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f10'))->with('error', 'Data sudah ada, harap ganti agar tidak duplikat.');
                }
                $id_menu = $this->request->getPost('id_menu');
                $this->menumodel->update($id_menu, $menudata);
                $this->itemmenumodel->where('id_menu',$id_menu)->delete();
                break;
            default :
            break;
        }
        if ($this->request->getPost('iditem')) {
                    $items = $this->request->getPost('iditem');
                    $qtys = $this->request->getPost('qty');
                    foreach ($items as $key=> $f) {
                        $itemData = [
                            'id_induk' => $this->request->getPost('id_induk'),
                            'id_menu' => $id_menu,
                            'id_item' => $f,
                            'menu_item_qty' => $qtys[$key]
                        ];
                        $this->itemmenumodel->insert($itemData);
                    }
                }
        $db->transComplete();
        switch ($mode) {
            case 'create' :
                return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f10'))->with('success', '## Data Berhasil ditambah ##');
            case 'edit' :
                return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f10'))->with('success', '## Data Berhasil diganti ##');
        }
                
    }
    // master meja
    public function master_meja($d) {
        $data[]='';
        $data = array_merge($data, $d);
        $data['meja'] = $this->mejamodel->getall($data['induk']['id_induk']);
        echo view('unit/submenu/master_meja',$data);
    }
    public function up_meja() {
        $data[]='';
        $wc = $this->request->getPost('wc');
        $mode = $this->request->getPost('mode');
        $mejadata = [
                'id_induk' => $this->request->getPost('id_induk'),
                'meja_nama' => $this->request->getPost('meja_nama'),
                'status' => $this->request->getPost('status'),
                ];
        //pengecekan data unik agar tidak duplikat
        $cek_unique = $this->mejamodel->where('meja_nama', $this->request->getPost('meja_nama'))->where('id_induk', $this->request->getPost('id_induk'))->first();

        switch ($mode) {
            case 'create' :
                if (!empty($cek_unique)) {
                    return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f18'))->with('error', 'Data sudah ada, harap ganti agar tidak duplikat.');
                }
                $this->mejamodel->insert($mejadata);
                return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f18'))->with('success', '## Data Berhasil ditambah ##');
            case 'lihat' : //jika mode lihat maka action http request post nya adalah untuk hapus data
                $id_meja = $this->request->getPost('id_meja');
                // filter - data default tidak boleh dihapus 
                $meja = $this->mejamodel->where('id_meja', $id_meja)->first()['meja_nama'];
                if ($meja == 'default') {
                    return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f18'))->with('error', '## Mohon maaf data default tidak bisa dihapus ##');    
                } // end filter
                $this->mejamodel->delete($id_meja);
                return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f18'))->with('success', '## Data Berhasil dihapus ##');
            case 'edit' :
                $data_old = $this->request->getPost('unique_old');
                $id_meja = $this->request->getPost('id_meja');
                // filter - data default tidak boleh diedit 
                $meja = $this->mejamodel->where('id_meja', $id_meja)->first()['meja_nama'];
                if ($meja == 'default') {
                    return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f18'))->with('error', '## Mohon maaf data default tidak bisa diedit ##');    
                } // end filter
                if (!empty($cek_unique) && $cek_unique['meja_nama']!=$data_old) {
                    return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f18'))->with('error', 'Data sudah ada, harap ganti agar tidak duplikat.');
                }
                $this->mejamodel->update($id_meja, $mejadata);
                return redirect()->to(base_url('u/'.$wc.'?menu=master&submenu=k3f18'))->with('success', '## Data Berhasil diganti ##');
            default :
            break;
        }
    }
    // konversi stok
    public function konversi($d) {
        $data[]='';
        $data = array_merge($data, $d);
        $data['item'] = $this->itemmodel->getall($data['induk']['id_induk']);
        echo view('unit/submenu/stock_konversi',$data);
    }
    public function up_konversi() {
        $wc = $this->request->getPost('wc');
        $user = $this->usermodel->where('user_nama', session()->get('username'))->first();

        $id_item1 = $this->request->getPost('id1');
        $id_item2 = $this->request->getPost('id2');

        $qty1 = $this->request->getPost('konversi');
        $qty2 = $this->request->getPost('hasil');

        $stock1_old = $this->itemmodel->where('id_item', $id_item1)->first();
        $stock2_old = $this->itemmodel->where('id_item', $id_item2)->first();

        $konversidata = [
                'id_induk' => $this->request->getPost('id_induk'),
                'id_item_awal' => $id_item1,
                'id_item_akhir' => $id_item2,
                'stockcon_qty_awal' => $qty1,
                'stockcon_qty_akhir' => $qty2,
                'stockcon_tanggal' => date('d/m/Y'),
                'stockcon_user' => $user['id_user'],
                'stockcon_keterangan' => $this->request->getPost('keterangan'),
                ];

        $itemdata1 = [
            'item_stock' => $stock1_old['item_stock']-$qty1,
        ];
        $itemdata2 = [
            'item_stock' => $stock2_old['item_stock']+$qty2,
        ];
                
        $this->konversimodel->insert($konversidata);
        $this->itemmodel->update($id_item1, $itemdata1);
        $this->itemmodel->update($id_item2, $itemdata2);

                return redirect()->to(base_url('u/'.$wc.'?menu=stok&submenu=k4f3'))->with('success', '## Data Berhasil ditambah ##');
    }
    // stockout stok
    public function stockout($d) {
        $data[]='';
        $data = array_merge($data, $d);
        $data['item'] = $this->itemmodel->getall($data['induk']['id_induk']);
        echo view('unit/submenu/stockout',$data);
    }
    public function up_stockout() {
        $wc = $this->request->getPost('wc');
        $user = $this->usermodel->where('user_nama', session()->get('username'))->first();

        $id_item = $this->request->getPost('id');
        $jumlah = $this->request->getPost('jumlah');
        $old_stock = $this->itemmodel->where('id_item', $id_item)->first();
        $new_stock = $old_stock['item_stock'] - $jumlah;
        $stockoutdata = [
                'id_induk' => $this->request->getPost('id_induk'),
                'id_item' => $id_item,
                'stockout_tanggal' => date('d/m/Y'),
                'stockout_user' => $user['id_user'],
                'stockout_qty' => $jumlah,
                'stockout_keterangan' => $this->request->getPost('keterangan'),
                ];

        $itemdata = [
            'item_stock' => $new_stock,
        ];
                
        $this->stockoutmodel->insert($stockoutdata);
        $this->itemmodel->update($id_item, $itemdata);
        return redirect()->to(base_url('u/'.$wc.'?menu=stok&submenu=k4f5'))->with('success', '## Data Berhasil diproses ##');
    }
    // stok opname
    public function opname($d) {
        $data[]='';
        $data = array_merge($data, $d);
        $data['item'] = $this->itemmodel->getall($data['induk']['id_induk']);

        if (!empty($data['items'])) {
            foreach ($data['items'] as $v) {
                $item = $this->itemmodel->getopname($v);
                $data['opname'][] = [
                'item' => $item,
                ];
            }
            
            echo view('unit/submenu/opname',$data);
            return;
        }
        echo view('unit/submenu/opname_select',$data);
    }
    public function up_opname() {
        $wc = $this->request->getPost('wc');
        $id_induk = $this->request->getPost('id_induk');
        $id_so = $this->request->getPost('id_so');
        $user = $this->usermodel->where('user_nama', session()->get('username'))->first();
        $tanggal = $this->request->getPost('tanggal');
        $keterangan = $this->request->getPost('keterangan');
        
        $sodata = [
                'id_so' => $id_so,
                'id_induk' => $id_induk,
                'so_tanggal' => $tanggal,
                'so_user' => $user['id_user'],
                'so_keterangan' => $keterangan,
                ];
        $db = \Config\Database::connect();
        $db->transStart();
        
        $this->somodel->insert($sodata);
        if ($this->request->getPost('id_item')) {
            
        $id_item = $this->request->getPost('id_item');
        $qtys_awal = $this->request->getPost('qty_awal');
        $qtys_so = $this->request->getPost('qty_so');

            foreach ($id_item as $key=> $f) {
                $getitem = $this->itemmodel->where('id_item', $f)->first();
                $old_harga = $getitem['item_harga'];
                $qty_selisih = $qtys_so[$key] - $qtys_awal[$key];
                $so_itemData = [
                    'id_induk' => $id_induk,
                    'id_so' => $id_so,
                    'id_item' => $id_item[$key],
                    'qty_awal' => $qtys_awal[$key],
                    'qty_so' => $qtys_so[$key],
                    'qty_selisih' => $qty_selisih,
                    'harga_selisih' => $qty_selisih*$old_harga,
                ];
                $this->soitemmodel->insert($so_itemData);

                $itemData = [
                    'item_stock' => $qtys_so[$key],
                ];
                $this->itemmodel->update($f,$itemData);
            }
        }
        $db->transComplete();
        //return redirect()->to(base_url('/u/'.$wc.'?menu=stok&submenu=k4f4'));
        return $this->pr_opname($id_so, $wc);
    }
    public function pr_opname($so, $wc) {
        $id_so = $so;
        // ambil data so
        $data['so'] = $this->somodel->where('id_so', $id_so)->first();
        // ambil data so_item dan data item by id_so
        $data['soitem'] = $this->soitemmodel->getso($id_so);
        // ambil data user by so_user
        $data['userso'] = $this->usermodel->where('id_user', $data['so']['so_user'])->first();

        $jumlah_item = 0;
        $total_qty_data = 0;
        $total_qty_so = 0;
        $total_qty_selisih = 0;
        $total_harga_selisih = 0;
        $qty_selisih_plus = 0;
        $qty_selisih_minus = 0;
        $harga_selisih_plus = 0;
        $harga_selisih_minus = 0;

        foreach ($data['soitem'] as $key=> $v) {$key++;
            $jumlah_item = $key;
            $qty_selisih = $v['qty_selisih'];
            $harga_selisih = $v['harga_selisih'];
            //-------------------------------------------
            $total_qty_data += $v['qty_awal']; // summary qty awal
            $total_qty_so += $v['qty_so']; // summary qty so / aktual
            $total_qty_selisih += $qty_selisih; // summary selisih qty
            $total_harga_selisih += $harga_selisih; // summary selisih harga

            if ($qty_selisih<0) {
                $qty_selisih_minus += $qty_selisih; // summary selisih qty minus
            }else{
                $qty_selisih_plus += $qty_selisih; // summary selisih qty plus
            }

            if ($harga_selisih<0) {
                $harga_selisih_minus += $harga_selisih; // summary selisih harga minus
            }else{
                $harga_selisih_plus += $harga_selisih; // summary selisih harga plus
            }
        }
        $data['jumlah_item'] = $jumlah_item;
        $data['total_qty_data'] = $total_qty_data;
        $data['total_qty_so'] = $total_qty_so;
        $data['total_qty_selisih'] = $total_qty_selisih;
        $data['total_harga_selisih'] = $total_harga_selisih;
        $data['qty_selisih_plus'] = $qty_selisih_plus;
        $data['qty_selisih_minus'] = $qty_selisih_minus;
        $data['harga_selisih_plus'] = $harga_selisih_plus;
        $data['harga_selisih_minus'] = $harga_selisih_minus;

        $data['wc'] =$wc;
        $data['unit'] = $this->unitmodel->where('wildcard', $wc)->first();
        $data['induk'] = $this->indukmodel->getdetail($data['unit']['id_induk']);
        echo view('unit/report/opname', $data);
    }
    // pembelian barang
    public function po($d) {
        $data[]='';
        $data = array_merge($data, $d);
        $data['suppliers'] = $this->suppliermodel->getall($data['induk']['id_induk']);
        $data['items'] = $this->itemmodel->getall($data['induk']['id_induk']);
        echo view('unit/submenu/po',$data);
    }
    public function up_po() {
        $data[]='';
        $wc = $this->request->getPost('wc');
        $user = $this->usermodel->where('user_nama', session()->get('username'))->first();
        $id_po = $this->request->getPost('id_po');
        $podata = [
                'id_po' => $id_po,
                'id_induk' => $this->request->getPost('id_induk'),
                'id_supplier' => $this->request->getPost('id_supplier'),
                'po_user' => $user['id_user'], 
                'po_tanggal' => date('d/m/Y'),
                'po_harga' => $this->request->getPost('harga'),
                'po_keterangan' => $this->request->getPost('keterangan'),
                ];

        // Start transaction
        $db = \Config\Database::connect();
        $db->transStart();

        $this->pomodel->insert($podata);
        
        if ($this->request->getPost('iditem')) {
                    $items = $this->request->getPost('iditem');
                    $qtys = $this->request->getPost('qty');
                    foreach ($items as $key=> $f) {
                        $itemData = [
                            'id_induk' => $this->request->getPost('id_induk'),
                            'id_po' => $id_po,
                            'id_item' => $f,
                            'po_item_qty' => $qtys[$key]
                        ];
                        $this->poitemmodel->insert($itemData);
                    }
                }
        $db->transComplete();
        return $this->pr_po($id_po, $wc);
                
    }
    public function pr_po($po, $wc) {
        $id_po = $po;
        $data['po'] = $this->pomodel->getpo($id_po);
        $data['poitem'] = $this->poitemmodel->getpo($id_po);
        $data['userpo'] = $this->usermodel->where('id_user', $data['po']['po_user'])->first();
        $data['supplierpo'] = $this->suppliermodel->where('id_supplier', $data['po']['id_supplier'])->first();
        
        $data['wc'] =$wc;
        $get_id = $this->unitmodel->where('wildcard', $wc)->first();
        $id_unit = $get_id['id_unit'];
        $data['unit'] = $this->unitmodel->where('id_unit', $id_unit)->first();
        $data['induk'] = $this->indukmodel->getdetail($data['unit']['id_induk']);
        echo view('unit/report/po', $data);
    }
    // penerimaan barang
    public function receive($d) {
        $data[]='';
        $data = array_merge($data, $d);

        $po = $this->pomodel->get_for_receive($data['induk']['id_induk']);
        foreach ($po as $p) {
            $item = $this->poitemmodel->getpo($p['id_po']);
            $supplier = $this->suppliermodel->where('id_supplier', $p['id_supplier'])->first();
            $user = $this->usermodel->where('id_user', $p['po_user'])->first();
            $data['podata'][] = [
                'po' => $p,
                'item' => $item,
                'supplier' => $supplier,
                'user' => $user,
            ];
        }
        echo view('unit/submenu/receive',$data);
    }
    public function up_receive() {
        $wc = $this->request->getPost('wc');
        $rec_keterangan = $this->request->getPost('rec_keterangan');
        $id_po = $this->request->getPost('id');
        $id_induk = $this->request->getPost('id_induk');

        $id_receive = 'REC'.$id_induk.'-'.date('dmyHis');
        $get_user = $this->usermodel->where('user_nama', session()->get('username'))->first();
        $rec_user = $get_user['id_user'];
        $rec_tanggal = date('d/m/Y');
        
        $receivedata = [
                'id_rec' => $id_receive,
                'id_induk' => $id_induk,
                'id_po' => $id_po,
                'rec_user' => $rec_user, 
                'rec_tanggal' => $rec_tanggal,
                'rec_keterangan' => $rec_keterangan,
                ];

        // Start transaction
        $db = \Config\Database::connect();
        $db->transStart();

        $this->receivemodel->insert($receivedata);
        
        if ($this->request->getPost('id_puritem')) {
                    $pur_items = $this->request->getPost('id_puritem');
                    $rec_qty = $this->request->getPost('rec_qty');
                    $rec_harga = $this->request->getPost('rec_harga');
                    $items = $this->request->getPost('id_item');
                    foreach ($pur_items as $key=> $f) {
                        $pur_itemData = [
                            'rec_item_qty' => $rec_qty[$key],
                            'rec_item_harga' => $rec_harga[$key],
                        ];
                        $this->poitemmodel->update($f,$pur_itemData);
                        $getStock = $this->itemmodel->where('id_item', $items[$key])->first();
                        $oldStock = $getStock['item_stock'];
                        $newStock = $oldStock + $rec_qty[$key];
                        $itemData = [
                            'item_stock' => $newStock,
                        ];
                        $this->itemmodel->update($items[$key],$itemData);
                    }
                }
        $db->transComplete();
        return $this->pr_receive($id_receive, $wc);
                
    }
    public function pr_receive($receive, $wc) {
        $id_receive = $receive;
        $data['receive'] = $this->receivemodel->where('id_rec', $id_receive)->first();
        $data['poitem'] = $this->poitemmodel->getpo($data['receive']['id_po']);
        $rec_total_harga = 0;
        foreach ($data['poitem'] as $v) {
            $total = $v['rec_item_harga']*$v['rec_item_qty'];
            $rec_total_harga += $total;
        }
        $data['rec_total_harga'] = $rec_total_harga;
        $data['userreceive'] = $this->usermodel->where('id_user', $data['receive']['rec_user'])->first();

        $data['po'] =  $this->pomodel->where('id_po', $data['receive']['id_po'])->first();
        $data['userpo'] = $this->usermodel->where('id_user', $data['po']['po_user'])->first();
        $data['supplier'] = $this->suppliermodel->where('id_supplier', $data['po']['id_supplier'])->first();
        
        $data['wc'] =$wc;
        $data['unit'] = $this->unitmodel->where('wildcard', $wc)->first();
        $data['induk'] = $this->indukmodel->getdetail($data['unit']['id_induk']);
        echo view('unit/report/receive', $data);
    }
    // retur barang
    public function retur($d) {
        $data[]='';
        $data = array_merge($data, $d);

        $po = $this->pomodel->get_for_retur($data['induk']['id_induk']);
        foreach ($po as $p) {
            $item = $this->poitemmodel->getpo($p['id_po']);
            $supplier = $this->suppliermodel->where('id_supplier', $p['id_supplier'])->first();
            $user = $this->usermodel->where('id_user', $p['po_user'])->first();
            $data['podata'][] = [
                'po' => $p,
                'item' => $item,
                'supplier' => $supplier,
                'user' => $user,
            ];
        }
        echo view('unit/submenu/retur',$data);
    }
    public function up_retur() {
        $wc = $this->request->getPost('wc');
        $ret_alasan = $this->request->getPost('ret_alasan');
        $id_po = $this->request->getPost('id');
        $id_induk = $this->request->getPost('id_induk');

        $id_retur = 'RET'.$id_induk.'-'.date('dmyHis');
        $get_user = $this->usermodel->where('user_nama', session()->get('username'))->first();
        $ret_user = $get_user['id_user'];
        $ret_harga = $this->request->getPost('ret_harga');
        $ret_tanggal = date('d/m/Y');
        
        $returdata = [
                'id_retur' => $id_retur,
                'id_induk' => $id_induk,
                'id_po' => $id_po,
                'retur_user' => $ret_user, 
                'retur_tanggal' => $ret_tanggal,
                'retur_harga' => $ret_harga,
                'retur_alasan' => $ret_alasan,
                ];

        // Start transaction
        $db = \Config\Database::connect();
        $db->transStart();

        $this->returmodel->insert($returdata);
        
        if ($this->request->getPost('id_puritem')) {
                    $pur_items = $this->request->getPost('id_puritem');
                    $ret_qty = $this->request->getPost('ret_qty');
                    $items = $this->request->getPost('id_item');
                    foreach ($pur_items as $key=> $f) {
                        $pur_itemData = [
                            'retur_item_qty' => $ret_qty[$key],
                        ];
                        $this->poitemmodel->update($f,$pur_itemData);
                        $getStock = $this->itemmodel->where('id_item', $items[$key])->first();
                        $oldStock = $getStock['item_stock'];
                        $newStock = $oldStock - $ret_qty[$key];
                        $itemData = [
                            'item_stock' => $newStock,
                        ];
                        $this->itemmodel->update($items[$key],$itemData);
                    }
                }
        $db->transComplete();
        return $this->pr_retur($id_retur, $wc);
                
    }
    public function pr_retur($retur, $wc) {
        $id_retur = $retur;
        $data['retur'] = $this->returmodel->where('id_retur', $id_retur)->first();
        $data['receive'] = $this->receivemodel->where('id_po', $data['retur']['id_po'])->first();
        $data['poitem'] = $this->poitemmodel->getpo($data['retur']['id_po']);
        $rec_harga = 0;
        foreach ($data['poitem'] as $v) {
            $subtotal = $v['rec_item_harga']*$v['rec_item_qty'];
            $rec_harga = $rec_harga + $subtotal;
        }
        $data['rec_harga'] = $rec_harga;

        $data['userretur'] = $this->usermodel->where('id_user', $data['retur']['retur_user'])->first();
        $data['userreceive'] = $this->usermodel->where('id_user', $data['receive']['rec_user'])->first();

        $data['po'] =  $this->pomodel->where('id_po', $data['retur']['id_po'])->first();
        $data['userpo'] = $this->usermodel->where('id_user', $data['po']['po_user'])->first();
        $data['supplier'] = $this->suppliermodel->where('id_supplier', $data['po']['id_supplier'])->first();
        
        $data['wc'] =$wc;
        $data['unit'] = $this->unitmodel->where('wildcard', $wc)->first();
        $data['induk'] = $this->indukmodel->getdetail($data['unit']['id_induk']);
        echo view('unit/report/retur', $data);
    }
    // Initial shift
    public function initial($d) {
        $data[]='';
        $data = array_merge($data, $d);

        $data['user'] = $this->usermodel->where('user_nama', session()->get('username'))->first();
        $id_user = $data['user']['id_user'];
        $data['init_active'] = $this->initialmodel->get_active($data['induk']['id_induk']);
        $data['init_current'] = $this->initialmodel->get_current($id_user); // cari data initial by user & belum closing
        if (empty($data['init_current'])) {
            $data['shift'] = $this->shiftmodel->where('id_induk', $data['induk']['id_induk'])->findAll();
            echo view('unit/submenu/init',$data);
            return;
        }else{
            echo view('unit/submenu/init_current',$data);
            return;
        }
    }
    public function up_initial() {
        $wc = $this->request->getPost('wc');
        $id_induk = $this->request->getPost('id_induk');

        $tanggal = $this->request->getPost('tanggal');
        $id_shift = $this->request->getPost('id_shift');
        $id_user = $this->request->getPost('id_user');
        $modal = $this->request->getPost('modal');
        $user = $this->usermodel->where('id_user', $id_user)->first()['user_nama'];

        //pengecekan tiap user tidak boleh initial 2 kali di tanggal dan shift yang sama
        $cek = $this->initialmodel->where('id_user', $id_user)->where('initial_tanggal', $tanggal)->where('id_shift', $id_shift)->findAll();
        if (!empty($cek)) {
            return redirect()->to(base_url('/u/'.$wc.'?menu=penjualan&submenu=k3f2'))->with('error', 'Anda sudah pernah initial di tanggal & shift tersebut, Tidak dapat initial dua kali !!');
        }

        $initdata = [
                'id_induk' => $id_induk,
                'id_user' => $id_user,
                'id_shift' => $id_shift,
                'initial_tanggal' => $tanggal,
                'initial_modal' => $modal,
                'initial_jam' => date('H:i'),
                ];

        $this->initialmodel->insert($initdata);

        return redirect()->to(base_url('u/'.$wc.'?menu=penjualan&submenu=k3f2'))->with('success', 'Berhasil initial shift atas nama '.$user);         
    }
    // Closing shift
    public function closing($d) {
        $data[]='';
        $data = array_merge($data, $d);

        $data['user'] = $this->usermodel->where('user_nama', session()->get('username'))->first();
        $id_user = $data['user']['id_user'];
        $data['init_current'] = $this->initialmodel->get_current($id_user); // cari data initial by user & belum closing
        $data['kartu'] = $this->kartumodel->where('id_induk', $data['induk']['id_induk'])->findAll();

        if (empty($data['init_current'])) {
            echo view('unit/submenu/closing',$data);
            return;
        }else{
            echo view('unit/submenu/closing_current',$data);
            return;
        }
    }
    public function up_closing() {
        $wc = $this->request->getPost('wc');
        $id_induk = $this->request->getPost('id_induk');
        $id_init = $this->request->getPost('id_init');

        // jika masih ada transaksi pending atau berlangsung maka tidak dapat tutup shift
        $trx_pending = $this->transmodel->get_pending($id_init);
        $trx_new = $this->transmodel->get_new($id_init);
        if (!empty($trx_new)){
            return redirect()->to(base_url('u/'.$wc.'?menu=penjualan&submenu=k3f1'))->with('error', 'Masih ada transaksi Berlangsung... mohon selesaikan !!');
        }
        if (!empty($trx_pending)){
            return redirect()->to(base_url('u/'.$wc.'?menu=penjualan&submenu=k3f1'))->with('error', 'Masih ada transaksi Pending... mohon selesaikan !!');
        }
        
        $init = $this->initialmodel->where('id_initial', $id_init)->first();

        $modal = $init['initial_modal'];
        $tunai = $this->request->getPost('tunai');
        $nons = $this->request->getPost('non');
        $non = 0;
        foreach ($nons as $key=> $v) {
            $non += $v;
        }
        $aktual = $tunai+$non;
        $trans = $this->transmodel->getpay($id_init);
        $penjualan = 0;
        foreach ($trans as $v) {
            $nominal_tunai = $v['nominal_tunai'];
            $nominal_nontunai = $v['nominal_nontunai'];
            $penjualan += $nominal_tunai + $nominal_nontunai;
        }
                
        $initdata = [
                'closing_tanggal' => date('d/m/Y'),
                'closing_jam' => date('H:i'),
                'initial_penjualan' => $penjualan,
                'initial_aktual_kas' => $aktual,
                'initial_selisih_kas' => $aktual-($penjualan+$modal),
                ];

        $this->initialmodel->update($id_init,$initdata);

        return $this->pr_closing($id_init, $wc);         
    }
    public function pr_closing($id_init, $wc) {
        $data[] = '';

        $data['initial'] = $this->initialmodel->get_closing($id_init);
        $data['user'] = session()->get('username');
        $pay = $this->transmodel->gettrx($id_init);

        $data['jumlah_transaksi'] = $pay['count_trx'];
        $data['total_menu_terjual'] = $pay['count_menu'];
        $data['transaksi_refund'] = $pay['count_refund'];
        $data['menu_refund'] = $pay['count_menu_refund'];
        $data['pay_tunai'] = $pay['sum_tunai'];
        $data['pay_nontunai'] = $pay['sum_nontunai'];
        $data['nominal_refund'] = $pay['sum_biaya_refund'];

        $data['wc'] =$wc;
        $data['unit'] = $this->unitmodel->where('wildcard', $wc)->first();
        $data['induk'] = $this->indukmodel->getdetail($data['unit']['id_induk']);
        echo view('unit/report/closing', $data);
    }
}
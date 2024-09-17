<?php

namespace App\Controllers;

use App\Models\UnitIndukmodel;
use App\Models\Unitmodel;
use App\Models\UnitFiturmodel;
use App\Models\Fiturmodel;
use App\Models\MUsermodel;
use App\Controllers\Fitur;
use CodeIgniter\Controller;

class Management extends BaseController
{
    public function logout()
    {
        session()->remove('username');
        session_destroy();
        return redirect()->to(base_url('/'));
    }
    public function login()
    {
        return view('management/login');
    }
    public function index()
    {
        //layer 1 validation (session[username] exist)
        if(!session()->has('username')) {
            return redirect()->to(base_url('login'))->with('error', 'Harap Login');
        }
        //layer 2 validation (session[base] is management) - tidak bisa ke management jika login dari unit
        if(session()->get('base') == 'unit') {
            return redirect()->to(base_url('/u/'))->with('error', 'Maaf anda tidak punya akses ke sini, silahkan periksa URL anda');
        }

        if ($this->request->getVar('menu')) {
            $menu = $this->request->getVar('menu');
            switch($menu) {
                case 'induk': return $this->induk();
                case 'unit': return $this->unit();
                case 'changepass':return $this->changepass();
                case 'create_unit_account':return $this->create_unit_account();
                default: return $this->induk();
            }
        }
        return $this->induk();
    }
    public function induk()
    {
        $data['page'] = 'induk';
        $unitinduk = new UnitIndukmodel();
        $data['username'] = session()->get('username');
        $data['getdata'] = $unitinduk->getdata();

        //get data untuk halaman detail
        if ($this->request->getVar('select')) {
            //validasi apakah variabel (id_induk) hasil GET terdapat di database

            //cek seluruh record tabel induk
            foreach ($data['getdata'] as $u) {
                //cek apakah apakah variabel (id_induk) hasil GET terdapat di database
                if ($this->request->getVar('select') != $u['id_induk']) {
                    //jika tidak ada maka set id_induk=''
                    $id_induk = '';
                } else {
                    //jika ada maka set id_induk = id dari hasil get
                    $id_induk = $this->request->getVar('select');
                    break;
                }
            }

            //penentuan jika id hasil GET tidak ada, maka tidak dilanjut ke proses pencarian id_induk
            if ($id_induk == '') {
                return view('management/induk', $data);
            }

            //jika id hasil GET ada dalam database, maka lanjut proses pencarian detail induk by id_induk
            $data['details'] = $unitinduk->getdetail($id_induk);
            $data['units'] = $unitinduk->getunit($id_induk);
        }

        //get data untuk halaman edit
        if ($this->request->getVar('edit')) {
            //validasi apakah variabel (id_induk) hasil GET terdapat di database

            //cek seluruh record tabel induk
            foreach ($data['getdata'] as $u) {
                //cek apakah apakah variabel (id_induk) hasil GET terdapat di database
                if ($this->request->getVar('edit') != $u['id_induk']) {
                    //jika tidak ada maka set id_induk=''
                    $id_induk = '';
                } else {
                    //jika ada maka set id_induk = id dari hasil get
                    $id_induk = $this->request->getVar('edit');
                    break;
                }
            }

            //penentuan jika id hasil GET tidak ada, maka tidak dilanjut ke proses pencarian id_induk
            if ($id_induk == '') {
                return view('management/induk', $data);
            }

            //jika id hasil GET ada dalam database, maka lanjut proses pencarian detail induk by id_induk
            $data['edits'] = $unitinduk->getdetail($id_induk);
        }

        //simpan hasil edit
        if ($this->request->getPost('updateid')) {
            $id_induk = $this->request->getPost('updateid');
            $unitinduk->update($id_induk, [
            'induk_nama' => $this->request->getPost('induk_nama'),
            'induk_perusahaan' => $this->request->getPost('induk_perusahaan'),
            'induk_alamat' => $this->request->getPost('induk_alamat'),
            'induk_jenis' => $this->request->getPost('induk_jenis'),
            'induk_pic' => $this->request->getPost('induk_pic'),
            'induk_pic_telepon' => $this->request->getPost('induk_pic_telepon'),
             ]);
            return redirect()->to(base_url('/?menu=induk&select='.$id_induk))->with('success', 'Data Updated Successfully');
        }
        return view('management/induk', $data);
    }
    public function unit()
    {
        $request = \Config\Services::request();
        $data['page'] = 'unit';
        $unitmodel = new UnitModel();
        $unitfiturmodel = new UnitFiturmodel();
        $fiturmodel = new Fiturmodel();
        $indukmodel = new UnitIndukmodel();
        $data['username'] = session()->get('username');
        $data['unit'] = $unitmodel->findAll();
        $data['getk2'] = $fiturmodel->getk2();
        $data['getk3'] = $fiturmodel->getk3();
        $data['getk4'] = $fiturmodel->getk4();
        $data['getall'] = $fiturmodel->getall();
        $data['getinduk'] = $indukmodel->getdata();

        //get data untuk halaman detail
        if ($this->request->getVar('select')) {
            //validasi apakah variabel (id_unit) hasil GET terdapat di database
            //cek seluruh record tabel unit
            foreach ($data['unit'] as $u) {
                //cek apakah apakah variabel (id_unit) hasil GET terdapat di database
                if ($this->request->getVar('select') != $u['id_unit']) {
                    //jika tidak ada maka set idunit=''
                    $idUnit = '';
                } else {
                    //jika ada maka set idunit = id dari hasil get
                    $idUnit = $this->request->getVar('select');
                    break;
                }
            }

            //penentuan jika id hasil GET tidak ada, maka tidak dilanjut ke proses pencarian id_unit
            if ($idUnit == '') {
                return view('management/unit', $data);
            }

            //jika id hasil GET ada dalam database, maka lanjut proses pencarian detail unit by id_unit
            $data['fiturs'] = $unitfiturmodel->getdetail($idUnit);
            $data['details'] = $unitmodel->where('id_unit', $idUnit)->first();
            $data['induk_detail'] = $indukmodel->getdetail($data['details']['id_induk']);

        }

        //get data untuk halaman edit
        if ($this->request->getVar('edit')) {
            //validasi apakah variabel (id_unit) hasil GET terdapat di database

            //cek seluruh record tabel unit
            foreach ($data['unit'] as $u) {
                //cek apakah apakah variabel (id_unit) hasil GET terdapat di database
                if ($this->request->getVar('edit') != $u['id_unit']) {
                    //jika tidak ada maka set idunit=''
                    $idUnit = '';
                } else {
                    //jika ada maka set idunit = id dari hasil get
                    $idUnit = $this->request->getVar('edit');
                    break;
                }
            }

            //penentuan jika id hasil GET tidak ada, maka tidak dilanjut ke proses pencarian id_unit
            if ($idUnit == '') {
                return view('management/unit', $data);
            }

            //jika id hasil GET ada dalam database, maka lanjut proses pencarian detail unit by id_unit
            $data['edits'] = $unitmodel->where('id_unit', $idUnit)->first();
            $data['fiturs'] = $unitfiturmodel->getdetail($idUnit);
        }

        //simpan hasil edit
        if ($this->request->getPost('updateid')) {
            $id_unit = $this->request->getPost('updateid');
            $u = $unitmodel->find($id_unit);
            $oldwc = $u['wildcard'];
            $request = \Config\Services::request();
            $newwc = $this->request->getPost('wildcard');
            if ($oldwc != $newwc) {

                $validation = \Config\Services::validation();

                // Definisikan aturan validasi
                $validation->setRules([
                    'wildcard' => 'required|is_unique[unit_aplikasi.wildcard]',
                ], [
                    'wildcard' => [
                        'is_unique' => ''
                    ]
                ]);

                if ($validation->withRequest($this->request)->run() === false) {
                    // Jika validasi gagal, kembalikan ke form dengan error
                    return redirect()->to(base_url('/?menu=unit&edit='.$id_unit))->with('error', 'WARNING!! <br> ( Duplicate data detected ! ) <br> Wildcard yang diinput sudah ada, Silahkan gunakan wildcard lain');
                }

            }


            $fiturs = $request->getPost('fitur'); // Array of fiturs
            $oldPhoto = $u['photo'];
            $file = $this->request->getFile('photo');
            $datenow = date('dmY');
            $timenow = date('His');

            if ($file && $file->isValid()) {
                if (file_exists(FCPATH . 'images/' . $oldPhoto)) {
                    unlink(FCPATH . 'images/' . $oldPhoto);
                }
                $newName = 'profile-'.$datenow.'-'.$timenow.'.jpg';
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
            } else {
                $newName = $oldPhoto;
            }


            // Start transaction
            $db = \Config\Database::connect();
            $db->transStart();

            $unitmodel->update($id_unit, [
            'wildcard' => $this->request->getPost('wildcard'),
            'unit_nama' => $this->request->getPost('unit_nama'),
            'unit_deskripsi' => $this->request->getPost('unit_deskripsi'),
            'unit_alamat' => $this->request->getPost('unit_alamat'),
            'unit_telepon' => $this->request->getPost('unit_telepon'),
            'unit_email' => $this->request->getPost('unit_email'),
            'photo' => $newName,
            ]);
            $unitfiturmodel->where('id_unit',$id_unit)->delete();
            if (!empty($fiturs)) {
                foreach ($fiturs as $f) {
                    $fiturData = [
                        'id_unit' => $id_unit,
                        'id_fitur' => $f
                    ];
                    $unitfiturmodel->insert($fiturData);
                }
            } else {

            }


            // Complete transaction
            $db->transComplete();
            if ($db->transStatus() === false) {
                // Transaction failed
                return redirect()->back()->with('error', 'Gagal menyimpan data');
            } else {
                // Transaction succeeded
                return redirect()->to(base_url('/?menu=unit&select='.$id_unit))->with('success', 'Data berhasil disimpan');
            }
        }
        echo view('management/unit', $data);
    }
    public function changepass()
    {
        $data['page'] = 'changepass';
        echo view('management/changepass', $data);
    }
    public function insert_induk()
    {
        $request = \Config\Services::request();
        $unitinduk = new UnitIndukmodel();

        // Start transaction
        $db = \Config\Database::connect();
        $db->transStart();

        // Ambil data dari form
        $unitData = [
            'induk_nama' => $request->getPost('induk_nama'),
            'induk_perusahaan' => $request->getPost('induk_perusahaan'),
            'induk_alamat' => $request->getPost('induk_alamat'),
            'induk_jenis' => $request->getPost('induk_jenis'),
            'induk_pic' => $request->getPost('induk_pic'),
            'induk_pic_telepon' => $request->getPost('induk_pic_telepon')
        ];
        // Insert induk data
        $unitinduk->insert($unitData);
        $idInduk = $unitinduk->getInsertID();
        $pos_data = [
            'id_induk' => $idInduk,
            'pajak' => '0',
            'sc' => '0',
            'struk_footer' => 'Terimakasih sampai jumpa kembali',
        ];
        $this->posmodel->insert($pos_data);

        $tiptrans_data1 = [
            'id_induk' => $idInduk,
            'type_trans' => 'dine in',
        ];
        $this->tiptransmodel->insert($tiptrans_data1);

                $tiptrans_data2 = [
            'id_induk' => $idInduk,
            'type_trans' => 'take away',
        ];
        $this->tiptransmodel->insert($tiptrans_data2);

        $meja_data = [
            'id_induk' => $idInduk,
            'meja_nama' => 'default',
            'status' => 'tersedia',
        ];
        $this->mejamodel->insert($meja_data);

        $kartu_data = [
            'id_induk' => $idInduk,
            'kartu_nama' => 'default',
        ];
        $this->kartumodel->insert($kartu_data);

        $idKartu = $this->kartumodel->getInsertID();
        $pay_data = [
            'id_induk' => $idInduk,
            'id_jeniskartu' => $idKartu,
            'nominal_tunai' => '0',
            'nominal_nontunai' => '0',
        ];
        $this->paymodel->insert($pay_data);

        // Complete transaction
        $db->transComplete();
        if ($db->transStatus() === false) {
            // Transaction failed
            return redirect()->back()->with('error', 'Gagal menyimpan data');
        } else {
            // Transaction succeeded
            return redirect()->to(base_url('/?menu=induk&select='.$idInduk))->with('success', 'Data berhasil disimpan');
        }
    }
    public function insert_unit()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();

        // Definisikan aturan validasi
        $validation->setRules([
            'wildcard' => 'required|is_unique[unit_aplikasi.wildcard]', // Pastikan email unik di tabel users
        ], [
            'wildcard' => [
                'is_unique' => 'Wildcard sudah digunakan. Silakan gunakan wildcard lain.'
            ]
        ]);

        if ($validation->withRequest($this->request)->run() === false) {
            // Jika validasi gagal, kembalikan ke form dengan error
            return redirect()->to(base_url('?menu=unit'))->with('error', 'WARNING!! <br> ( Duplicate data detected ! ) <br> Wildcard yang diinput sudah ada, Silahkan gunakan wildcard lain');
        }

        $unit = new Unitmodel();
        $unitfiturModel = new UnitFiturModel();
        $fiturs = $this->request->getPost('fitur'); // Array of fiturs
        if (empty($fiturs)) {
            return redirect()->to(base_url('?menu=unit'))->with('error', 'Mohon Pilih Fitur');
        }
        $file = $this->request->getFile('photo');
        $datenow = date('dmY');
        $timenow = date('His');
        $newName = 'profile-'.$datenow.'-'.$timenow.'.jpg';
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

        // Ambil data dari form
        $unitData = [
            'id_induk' => $request->getPost('unit_induk'),
            'wildcard' => $request->getPost('wildcard'),
            'unit_nama' => $request->getPost('unit_nama'),
            'unit_deskripsi' => $request->getPost('unit_deskripsi'),
            'unit_alamat' => $request->getPost('unit_alamat'),
            'unit_telepon' => $request->getPost('unit_telepon'),
            'unit_email' => $request->getPost('unit_email'),
            'photo' => $newName,
        ];
        // Start transaction
        $db = \Config\Database::connect();
        $db->transStart();

        // Insert unit data
        $unit->insert($unitData);
        $idUnit = $unit->getInsertID();

        // Insert each item with the same id_toko
        foreach ($fiturs as $f) {
            $fiturData = [
                'id_unit' => $idUnit,
                'id_fitur' => $f
            ];
            $unitfiturModel->insert($fiturData);
        }

        // Complete transaction
        $db->transComplete();
        if ($db->transStatus() === false) {
            // Transaction failed
            return redirect()->to(base_url('/?menu=unit'))->with('error', 'Gagal menyimpan data');
        } else {
            // Transaction succeeded
            return redirect()->to(base_url('/?menu=unit&select='.$idUnit))->with('success', 'Data berhasil disimpan');
        }


    }
    public function delete_unit($id)
    {
        $model = new Unitmodel();
        $user = $model->find($id);
        $photo = $user['photo'];
        if (file_exists(FCPATH . 'images/' . $photo)) {
            unlink(FCPATH . 'images/' . $photo);
        }
        // Simpan data ke database
        $model->delete($id);
        return redirect()->to(base_url('/?menu=unit'))->with('success', 'Data Deleted Successfully');
    }
    public function delete_induk($id)
    {
        $model = new UnitIndukmodel();

        // Simpan data ke database
        $model->delete($id);
        return redirect()->to(base_url('/?menu=induk'))->with('success', 'Data Deleted Successfully');
    }
    public function auth()
    {
        $usersModel = new MUserModel();
        $username = $this->request->getPost('username');
        $password = md5($this->request->getPost('password'));
        $user = $usersModel->where('nama_m_user', $username)->first();
        if ($user && $user['password_m_user'] === $password) {
            session()->set('username', $user['nama_m_user']);
            session()->set('base', 'management');
            return redirect()->to(base_url('/'));
        } else {
            return redirect()->to(base_url('/login'))->with('error', 'Username or Password incorrect');
        }

    }
    public function akses_update($id)
    {
        $usr = new MUserModel();
        $usr->update($id, [
        'password_m_user' => md5($this->request->getPost('password')),
        ]);
        return redirect()->to(base_url('/?menu=changepass'))->with('success', 'Data Updated Successfully');
    }
    public function warning()
    {
        echo view('errors/warning');
    }
    public function create_unit_account() {
        $data = 'management';
        $fitur_controller = new Fitur();
        return $fitur_controller->create($data);  
    }
}
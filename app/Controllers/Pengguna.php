<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Pengguna extends BaseController
{
    public function index()
    {
        if (session()->get('level') != 'admin') {
            return redirect()->back();
            exit;
        }

        $data = [
            'title' => 'Halaman Pengguna',
            'judulHalaman' => 'Data Pengguna',
            'dataPengguna' => $this->pengguna->findAll()
        ];
        return view('pengguna/data-pengguna', $data);
    }

    public function tambahPengguna()
    {
        if (session()->get('level') != 'admin') {
            return redirect()->back();
            exit;
        }

        $data = [
            'title' => 'Halaman Pengguna',
            'judulHalaman' => 'Tambah Data Pengguna',
            'levelPengguna' => $this->pengguna->getEnumValues()
        ];
        return view('pengguna/tambah-pengguna', $data);
    }

    public function prosesTambah()
    {
        helper(['form']);
        $validation = \Config\Services::validation();

        $rules = [
            'email' => 'required|is_unique[tbl_pengguna.email]',
            'nama_lengkap' => 'required',
            'username' => 'required|is_unique[tbl_pengguna.username]',
            'password' => 'required',
            'level' => 'required',
        ];

        $messages = [
            'nama_lengkap' => [
                'required' => 'Tidak boleh kosong!',
            ],
            'username' => [
                'required' => 'Tidak boleh kosong!',
                'is_unique' => 'username sudah ada silahkan gunakan yang lain',
            ],
            'password' => [
                'required' => 'Tidak boleh kosong!',
            ],
            'level' => [
                'required' => 'Tidak boleh kosong!',
            ],
        ];

        // set validasi
        $validation->setRules($rules, $messages);

        // cek validasi gagal
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'email' => $this->request->getPost('email'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'username' => $this->request->getPost('username'),
            'password' => md5($this->request->getPost('password')),
            'level' => $this->request->getPost('level'),
        ];

        $this->pengguna->insert($data);

        return redirect()->to('data-pengguna')->with('success', '<div class="alert alert-success" role="alert">
            Data berhasil ditambah
        </div>');
    }


    public function editPengguna($email)
    {
        if (session()->get('level') != 'admin') {
            return redirect()->back();
            exit;
        }
        
        $data = [
            'title' => 'Halaman Pengguna',
            'judulHalaman' => 'Edit Data Pengguna',
            'levelPengguna' => $this->pengguna->getEnumValues(),
            'dataPengguna' => $this->pengguna->find($email)
        ];

        // var_dump($data);
        return view('pengguna/edit-pengguna', $data);
    }

    public function prosesEdit($email)
    {
        $originalPassword = $this->pengguna->find($email);

        helper(['form']);
        $validation = \Config\Services::validation();

        $rules = [
            'email' => 'required|is_unique[tbl_pengguna.email,email,' . $email . ']',
            'nama_lengkap' => 'required',
            'username' => 'required|is_unique[tbl_pengguna.username,email,' . $email . ']',
            'level' => 'required',
        ];

        $messages = [
            'email' => [
                'required' => 'Tidak boleh kosong!',
                'is_unique' => 'username sudah ada silahkan gunakan yang lain',
            ],
            'nama_lengkap' => [
                'required' => 'Tidak boleh kosong!',
            ],
            'username' => [
                'required' => 'Tidak boleh kosong!',
                'is_unique' => 'username sudah ada silahkan gunakan yang lain',
            ],
            'level' => [
                'required' => 'Tidak boleh kosong!',
            ],
        ];

        // set validasi
        $validation->setRules($rules, $messages);

        // cek validasi gagal
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'email' => $this->request->getPost('email'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'username' => $this->request->getPost('username'),
            'password' => ($this->request->getPost('password') ? md5($this->request->getPost('password')) : $originalPassword['password']),
            'level' => $this->request->getPost('level')
        ];

        $this->pengguna->update($email, $data);

        return redirect()->to('data-pengguna')->with('success', '<div class="alert alert-success" role="alert">
            Data berhasil diubah
        </div>');
    }

    public function hapusPengguna($email)
    {

        $this->pengguna->delete($email);

        return redirect()->to('data-pengguna')->with('success', '<div class="alert alert-success" role="alert">
        Data pengguna berhasil dihapus
      </div>');
    }
}

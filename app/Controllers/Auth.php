<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Halamaman Login'
        ];
        return view('auth/halaman-login', $data);
    }

    public function prosesLogin()
    {
        helper(['form']);
        $validation = \Config\Services::validation();

        $rules = [
            'username' => 'required',
            'pass' => 'required',
        ];

        $messages = [
            'username' => [
                'required' => 'Masukan email',
            ],
            'pass' => [
                'required' => 'Masukan password',
            ],
        ];

        // set validasi
        $validation->setRules($rules, $messages);

        // cek validasi gagal
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $user = $this->pengguna->getUser(
            $this->request->getPost('username'),
            $this->request->getPost('pass')
        );

        if (count($user) == 1) {

            $dataSession = [
                'email' => $user[0]['email'],
                'nama_pengguna' => $user[0]['nama_lengkap'],
                'username' => $user[0]['username'],
                'password' => $user[0]['password'],
                'level'    => $user[0]['level'],
                'sudahkahLogin' => true
            ];

            session()->set($dataSession);
            if (session()->get('level') == 'admin') {
                return redirect()->to('/dashboard-admin');
            }
            if (session()->get('level') == 'kasir') {
                return redirect()->to('/dashboard-kasir');
            }
        } else {
            // Pesan kesalahan jika login gagal
            return redirect()->to('/')
                ->with('pesan', '<div class="alert alert-danger" role="alert">
                    Username atau Password salah silahkan coba kembali!
                  </div>')
                ->withInput(); // Untuk menyimpan input sebelumnya
        }
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/');
    }
}

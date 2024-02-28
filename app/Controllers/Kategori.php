<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Kategori extends BaseController
{
    public function index()
    {
        if (session()->get('level') != 'admin') {
            return redirect()->back();
            exit;
        }

        $data = [
            'title' => 'Halaman Kategori',
            'judulHalaman' => 'Data kategori',
            'dataKategori' => $this->kategori->findAll()
        ];
        return view('kategori/data-kategori', $data);
    }

    public function tambahKategori()
    {
        if (session()->get('level') != 'admin') {
            return redirect()->back();
            exit;
        }

        $data = [
            'title' => 'Halaman Kategori',
            'judulHalaman' => 'Tambah Data kategori'
        ];
        return view('kategori/tambah-kategori', $data);
    }

    public function prosesTambah()
    {
        helper(['form']);
        $validation = \Config\Services::validation();

        $rules = [
            'nama_kategori' => 'required|is_unique[tbl_kategori.nama_kategori]',
        ];

        $messages = [
            'nama_kategori' => [
                'required' => 'Tidak boleh kosong!',
                'is_unique' => 'Nama kategori sudah ada',
            ],
        ];

        // set validasi
        $validation->setRules($rules, $messages);

        // cek validasi gagal
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
        ];

        $this->kategori->insert($data);

        return redirect()->to('data-kategori')->with('success', '<div class="alert alert-success" role="alert">
            Data kategori berhasil ditambah
        </div>');
    }

    public function editKategori($id)
    {
        if (session()->get('level') != 'admin') {
            return redirect()->back();
            exit;
        }

        $data = [
            'title' => 'Halaman Kategori',
            'judulHalaman' => 'Edit Data Kategori',
            'dataKategori' => $this->kategori->find($id)
        ];
        return view('kategori/edit-kategori', $data);
    }

    public function prosesEdit($id)
    {
        helper(['form']);
        $validation = \Config\Services::validation();

        $rules = [
            'nama_kategori' => 'required|is_unique[tbl_kategori.nama_kategori,id_kategori,' . $id . ']',
        ];

        $messages = [
            'nama_kategori' => [
                'required' => 'Tidak boleh kosong!',
                'is_unique' => 'Nama kategori sudah ada',
            ],
        ];

        // set validasi
        $validation->setRules($rules, $messages);

        // cek validasi gagal
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
        ];

        $this->kategori->update($id, $data);

        return redirect()->to('data-kategori')->with('success', '<div class="alert alert-success" role="alert">
            Data kategori berhasil diedit
        </div>');
    }

    public function hapusKategori($id)
    {

        $this->kategori->delete($id);

        return redirect()->to('data-kategori')->with('success', '<div class="alert alert-success" role="alert">
        Data satuan berhasil dihapus
      </div>');
    }

    public function cek_keterkaitan_data($id)
    {
        // Lakukan pemeriksaan keterkaitan data
        $keterkaitan = $this->kategori->cekKeterkaitan($id);

        // Kirim respon ke AJAX
        return $this->response->setJSON(['has_keterkaitan' => $keterkaitan]);
    }
}

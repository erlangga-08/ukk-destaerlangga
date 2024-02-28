<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Satuan extends BaseController
{
    public function index()
    {
        if(session()->get('level') != 'admin') {
            return redirect()->back();
            exit;
        }

        $data = [
            'title' => 'Halaman Satuan',
            'judulHalaman' => 'Data Satuan',
            'dataSatuan' => $this->satuan->findAll(),
        ];
        return view('satuan/data-satuan', $data);
    }

    public function tambahSatuan()
    {
        if(session()->get('level') != 'admin') {
            return redirect()->back();
            exit;
        }

        $data = [
            'title' => 'Halaman Satuan',
            'judulHalaman' => 'Tambah Data Satuan'
        ];
        return view('satuan/tambah-satuan', $data);
    }

    public function prosesTambah()
    {
        helper(['form']);
        $validation = \Config\Services::validation();

        $rules = [
            'nama_satuan' => 'required|is_unique[tbl_satuan.nama_satuan]',
        ];

        $messages = [
            'nama_satuan' => [
                'required' => 'Tidak boleh kosong!',
                'is_unique' => 'Nama satuan sudah ada',
            ],
        ];

        // set validasi
        $validation->setRules($rules, $messages);

        // cek validasi gagal
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'nama_satuan' => $this->request->getPost('nama_satuan'),
        ];

        $this->satuan->insert($data);

        return redirect()->to('data-satuan')->with('success', '<div class="alert alert-success" role="alert">
            Data satuan berhasil ditambah
        </div>');
    }

    public function editSatuan($id)
    {
        if(session()->get('level') != 'admin') {
            return redirect()->back();
            exit;
        }
        
        $data = [
            'title' => 'Halaman Satuan',
            'judulHalaman' => 'Edit Data Satuan',
            'dataSatuan' => $this->satuan->find($id)
        ];
        return view('satuan/edit-satuan', $data);
    }

    public function prosesEdit($id)
    {
        helper(['form']);
        $validation = \Config\Services::validation();

        $rules = [
            'nama_satuan' => 'required|is_unique[tbl_satuan.nama_satuan,id_satuan,' . $id . ']',
        ];

        $messages = [
            'nama_satuan' => [
                'required' => 'Tidak boleh kosong!',
                'is_unique' => 'Nama satuan sudah ada',
            ],
        ];

        // set validasi
        $validation->setRules($rules, $messages);

        // cek validasi gagal
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'nama_satuan' => $this->request->getPost('nama_satuan'),
        ];

        $this->satuan->update($id, $data);

        return redirect()->to('data-satuan')->with('success', '<div class="alert alert-success" role="alert">
            Data satuan berhasil diedit
        </div>');
    }

    public function hapusSatuan($id)
    {

        $this->satuan->delete($id);

        return redirect()->to('data-satuan')->with('success', '<div class="alert alert-success" role="alert">
        Data satuan berhasil dihapus
      </div>');
    }

    public function cek_keterkaitan_data($id)
    {
        // Lakukan pemeriksaan keterkaitan data
        $keterkaitan = $this->satuan->cekKeterkaitan($id);

        // Kirim respon ke AJAX
        return $this->response->setJSON(['has_keterkaitan' => $keterkaitan]);
    }
}

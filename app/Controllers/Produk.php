<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Produk extends BaseController
{
    public function index()
    {
        if (session()->get('level') != 'admin') {
            return redirect()->back();
            exit;
        }

        $data = [
            'title' => 'Halaman Produk',
            'judulHalaman' => 'Data Produk',
            'dataProduk' => $this->produk->getProduk(),
        ];
        return view('produk/data-produk', $data);
    }

    public function tambahProduk()
    {
        if (session()->get('level') != 'admin') {
            return redirect()->back();
            exit;
        }

        $data = [
            'title' => 'Halaman Produk',
            'judulHalaman' => 'Tambah Data Produk',
            'dataSatuan' => $this->satuan->findAll(),
            'dataKategori' => $this->kategori->findAll(),
            'kodeProduk' => $this->produk->generateProductCode()
        ];
        return view('produk/tambah-produk', $data);
    }

    public function prosesTambah()
    {
        helper(['form']);
        $validation = \Config\Services::validation();

        $rules = [
            'kode_produk' => 'required|is_unique[tbl_produk.kode_produk]',
            'nama_produk' => 'required|is_unique[tbl_produk.nama_produk]',
            'harga_beli' => 'required',
            'harga_jual' => 'required|checkHargaValid[harga_beli,harga_jual]',
            'stok' => 'required|greater_than[0]',
            'satuan' => 'required',
            'kategori' => 'required',
        ];

        $messages = [
            'kode_produk' => [
                'required' => 'Tidak boleh kosong!',
                'is_unique' => 'Kode produk sudah ada!',
            ],
            'nama_produk' => [
                'required' => 'Nama produk tidak boleh kosong!',
                'is_unique' => 'Nama produk sudah ada!'
            ],
            'harga_beli' => [
                'required' => 'Harga beli tidak boleh kosong!',
            ],
            'harga_jual' => [
                'required' => 'Harga jual tidak boleh kosong!',
                'checkHargaValid' => 'Harga jual tidak boleh lebih kecil dari harga beli!'
            ],
            'stok' => [
                'required' => 'Stok tidak boleh kosong!',
                'greater_than' => 'Stok harus lebih besar dari 0!'
            ],
            'satuan' => [
                'required' => 'Satuan tidak boleh kosong!',
            ],
            'kategori' => [
                'required' => 'kategori tidak boleh kosong!',
            ],
        ];

        // set validasi
        $validation->setRules($rules, $messages);

        // cek validasi gagal
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $data = [
            'kode_produk' => $this->request->getPost('kode_produk'),
            'nama_produk' => $this->request->getPost('nama_produk'),
            'harga_beli' => str_replace('.', '', $this->request->getPost('harga_beli')),
            'harga_jual' => str_replace('.', '', $this->request->getPost('harga_jual')),
            'stok' => str_replace('.', '', $this->request->getPost('stok')),
            'id_satuan' => $this->request->getPost('satuan'),
            'id_kategori' => $this->request->getPost('kategori'),
        ];

        // var_dump($data);

        $this->produk->insert($data);

        return redirect()->to('data-produk')->with('success', '<div id="alert" class="alert alert-success" role="alert">
        Data produk berhasil ditambah
      </div>');
    }

    public function editProduk($id)
    {
        if (session()->get('level') != 'admin') {
            return redirect()->back();
            exit;
        }

        $data = [
            'title' => 'Halaman Produk',
            'judulHalaman' => 'Edit Data Produk',
            'dataProduk' => $this->produk->find($id),
            'dataSatuan' => $this->satuan->findAll(),
            'dataKategori' => $this->kategori->findAll(),
        ];
        return view('produk/edit-produk', $data);
    }

    public function prosesEdit($id)
    {
        helper(['form']);
        $validation = \Config\Services::validation();

        $rules = [
            'kode_produk' => 'required|is_unique[tbl_produk.kode_produk,id_produk,' . $id . ']',
            'nama_produk' => 'required|is_unique[tbl_produk.nama_produk,id_produk,' . $id . ']',
            'harga_beli' => 'required',
            'harga_jual' => 'required|checkHargaValid[harga_beli,harga_jual]',
            'stok' => 'required|greater_than[0]',
            'satuan' => 'required',
            'kategori' => 'required',
        ];

        $messages = [
            'kode_produk' => [
                'required' => 'Tidak boleh kosong!',
                'is_unique' => 'Kode produk sudah ada!',
            ],
            'nama_produk' => [
                'required' => 'Nama produk tidak boleh kosong!',
                'is_unique' => 'Nama produk sudah ada!'
            ],
            'harga_beli' => [
                'required' => 'Harga beli tidak boleh kosong!',
            ],
            'harga_jual' => [
                'required' => 'Harga jual tidak boleh kosong!',
                'checkHargaValid' => 'Harga jual tidak boleh lebih kecil dari harga beli!'
            ],
            'stok' => [
                'required' => 'Stok tidak boleh kosong!',
                'greater_than' => 'Stok harus lebih besar dari 0!'
            ],
            'satuan' => [
                'required' => 'Satuan tidak boleh kosong!',
            ],
            'kategori' => [
                'required' => 'kategori tidak boleh kosong!',
            ],
        ];

        // set validasi
        $validation->setRules($rules, $messages);

        // cek validasi gagal
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $data = [
            'kode_produk' => $this->request->getPost('kode_produk'),
            'nama_produk' => $this->request->getPost('nama_produk'),
            'harga_beli' => str_replace('.', '', $this->request->getPost('harga_beli')),
            'harga_jual' => str_replace('.', '', $this->request->getPost('harga_jual')),
            'stok' => str_replace('.', '', $this->request->getPost('stok')),
            'id_satuan' => $this->request->getPost('satuan'),
            'id_kategori' => $this->request->getPost('kategori'),
        ];

        // var_dump($data);

        $this->produk->update($id, $data);

        return redirect()->to('data-produk')->with('success', '<div id="alert" class="alert alert-success" role="alert">
        Data produk berhasil diedit
      </div>');
    }

    public function hapusProduk($id)
    {

        $this->produk->delete($id);

        return redirect()->to('data-produk')->with('success', '<div class="alert alert-success" role="alert">
        Data produk berhasil dihapus
      </div>');
    }
}

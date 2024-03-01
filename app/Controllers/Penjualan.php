<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Penjualan extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Transaksi',
            'judulHalaman' => 'Transaksi Penjualan',
            'noFaktur' => $this->penjualan->generateNomerFaktur(),
            'tanggal' => $this->penjualan->generateTanggal(),
            'waktu' => $this->penjualan->generateWaktu(),
            'dataProduk' => $this->produk->findAll(),
            'detailPenjualan' => $this->detailpenjualan->getDetailPenjualan(session()->get('IdPenjualan')),
            'totalHarga' => $this->penjualan->getTotalHargaById(session()->get('IdPenjualan')),
        ];
        return view('transaksi/penjualan', $data);
    }

    public function simpanPenjualan()
    {
        helper(['form']);
        $validation = \Config\Services::validation();

        $rules = [
            'jumlah' => 'required|greater_than[0]',
            'id_produk' => 'required',
        ];

        $messages = [
            'jumlah' => [
                'required' => 'Tidak boleh kosong!',
                'greater_than' => 'Jumlah harus lebih besar dari 0!'
            ],
            'id_produk' => [
                'required' => 'Tidak boleh kosong!',
            ],
        ];

        // set validasi
        $validation->setRules($rules, $messages);

        // cek validasi gagal
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // ambil detail barang yang dijual
        $where = ['id_produk' => $this->request->getPost('id_produk')];
        $cekBarang = $this->produk->where($where)->findAll();
        $hargaJual = $cekBarang[0]['harga_jual'];

        if (session()->get('IdPenjualan') == null) {
            // 1. Menyiapkan data penjualan
            date_default_timezone_set('Asia/Jakarta');
            // Mendapatkan waktu saat ini dalam zona waktu yang telah diatur
            $tanggal_sekarang = date('Y-m-d H:i:s');

            $dataPenjualan = [
                'no_faktur' => $this->request->getPost('no_faktur'),
                'tgl_penjualan' => $tanggal_sekarang, // Perbaiki format tanggal
                'email' => session()->get('email'),
                'total' => 0
            ];

            // 2. Menyimpan data ke dalam tabel penjualan
            $this->penjualan->insert($dataPenjualan);

            // 3. Menyiapkan data untuk menyimpan detail penjualan
            $idPenjualanBaru = $this->penjualan->insertID(); // Mendapatkan ID penjualan baru
            $dataDetailPenjualan = [
                'id_penjualan' => $idPenjualanBaru,
                'id_produk' => $this->request->getPost('id_produk'),
                'qty' => $this->request->getPost('jumlah'),
                'total_harga' => $hargaJual * $this->request->getPost('jumlah')
            ];
            // 4. Menyimpan data ke dalam tabel detail penjualan
            $this->detailpenjualan->insert($dataDetailPenjualan);

            // 5. Membuat session untuk penjualan baru
            session()->set('IdPenjualan', $idPenjualanBaru);
        } else {
            // Jika ada ID penjualan yang sudah tersimpan di sesi, gunakan ID itu untuk menyimpan detail penjualan
            $idPenjualanSaatIni = session()->get('IdPenjualan');
            $dataDetailPenjualan = [
                'id_penjualan' => $idPenjualanSaatIni,
                'id_produk' => $this->request->getPost('id_produk'),
                'qty' => $this->request->getPost('jumlah'),
                'total_harga' => $hargaJual * $this->request->getPost('jumlah')
            ];

            // Simpan data ke dalam tabel detail penjualan
            $this->detailpenjualan->insert($dataDetailPenjualan);
        }

        // Mengarahkan pengguna kembali ke halaman transaksi penjualan
        return redirect()->to('penjualan');
    }

    public function simpanPembayaran()
    {
        // Menghapus ID penjualan dari sesi
        session()->remove('IdPenjualan');

        // Mengarahkan pengguna kembali ke halaman transaksi penjualan
        return redirect()->to('penjualan');
    }

    public function hapusDetail($id_detail)
    {
        $this->detailpenjualan->delete($id_detail);

        return redirect()->to('penjualan');
    }
}

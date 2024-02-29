<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Kasir extends BaseController
{
    public function index()
    {
        if (session()->get('level') != 'kasir') {
            return redirect()->back();
            exit;
        }

        $data = [
            'title' => 'Halaman Dashboard',
            'judulHalaman' => 'Selamat Datang',
            'totalPengguna' => $this->pengguna->getTotalPengguna(),
            'totalProduk' => $this->produk->getTotalProduk(),
            'pendapatanHariIni' => $this->detailpenjualan->pendapatanHarian(),
            'pendapatanBulanIni' => $this->detailpenjualan->pendapatanBulanan(),
        ];
        return view('kasir/halaman-kasir', $data);
    }
}

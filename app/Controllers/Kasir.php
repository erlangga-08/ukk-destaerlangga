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
            'totalProduk' => $this->produk->getTotalProduk(),
            'pendapatanHariIni' => $this->detailpenjualan->pendapatanHarian(),
        ];
        
        return view('kasir/halaman-kasir', $data);
    }
}

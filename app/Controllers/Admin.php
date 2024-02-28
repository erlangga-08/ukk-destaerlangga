<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{
    public function index()
    {
        if(session()->get('level') != 'admin') {
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
            'chartData' => $this->detailpenjualan->getMonthlyIncome()
        ];
        return view('admin/halaman-admin', $data);
    }
}

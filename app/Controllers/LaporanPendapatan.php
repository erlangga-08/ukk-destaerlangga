<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;


class LaporanPendapatan extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Laporan',
            'judulHalaman' => 'Cari Laporan Pendapatan'
        ];
        return view('laporan/laporan-pendapatan', $data);
    }

    public function laporanPendapatan()
    {
        $data = [
            'title' => 'Halaman Laporan',
            'judulHalaman' => 'Data Laporan Pendapatan'
        ];
        return view('laporan/laporan-bulanan-tahunan', $data);
    }

    // public function generate_laporan()
    // {
    //     // Ambil data bulan dan tahun dari form
    //     $bulan = $this->request->getPost('bulan');
    //     $tahun = $this->request->getPost('tahun');
    //     $jenis_laporan = $this->request->getPost('jenis_laporan'); // Tambahkan jenis laporan

    //     // Buat koneksi ke database
    //     $db = \Config\Database::connect();

    //     // Query untuk mengambil data penjualan
    //     $builder = $db->table('tbl_detail_penjualan');
    //     $builder->select('tbl_detail_penjualan.*, SUM(tbl_detail_penjualan.total_harga) AS total_penjualan, SUM((tbl_produk.harga_jual - tbl_produk.harga_beli) * tbl_detail_penjualan.qty) AS total_keuntungan, tbl_produk.nama_produk, tbl_produk.harga_jual, tbl_produk.harga_beli');
    //     $builder->join('tbl_penjualan', 'tbl_penjualan.id_penjualan = tbl_detail_penjualan.id_penjualan');
    //     $builder->join('tbl_produk', 'tbl_produk.id_produk = tbl_detail_penjualan.id_produk');

    //     if ($jenis_laporan == 'bulanan') {
    //         // Laporan Bulanan
    //         $builder->where('MONTH(tbl_penjualan.tgl_penjualan)', $bulan);
    //         $builder->where('YEAR(tbl_penjualan.tgl_penjualan)', $tahun);
    //     } else {
    //         // Laporan Tahunan
    //         $builder->where('YEAR(tbl_penjualan.tgl_penjualan)', $tahun);
    //     }

    //     $query = $builder->get();
    //     $result = $query->getRow();

    //     // Query untuk mendapatkan detail penjualan
    //     $detailQuery = $db->table('tbl_detail_penjualan')
    //         ->select('tbl_detail_penjualan.*, tbl_produk.nama_produk, tbl_produk.harga_jual, tbl_produk.harga_beli, tbl_penjualan.tgl_penjualan')
    //         ->join('tbl_produk', 'tbl_produk.id_produk = tbl_detail_penjualan.id_produk');

    //     if ($jenis_laporan == 'bulanan') {
    //         // Laporan Bulanan
    //         $detailQuery->join('tbl_penjualan', 'tbl_penjualan.id_penjualan = tbl_detail_penjualan.id_penjualan')
    //             ->where('MONTH(tbl_penjualan.tgl_penjualan)', $bulan)
    //             ->where('YEAR(tbl_penjualan.tgl_penjualan)', $tahun);
    //     } else {
    //         // Laporan Tahunan
    //         $detailQuery->join('tbl_penjualan', 'tbl_penjualan.id_penjualan = tbl_detail_penjualan.id_penjualan')
    //             ->where('YEAR(tbl_penjualan.tgl_penjualan)', $tahun);
    //     }

    //     $detailResult = $detailQuery->get()->getResultArray();

    //     $data = [
    //         'detail_penjualan' => $detailResult,
    //         'title' => 'LaporanPenjualan',
    //         'judulHalaman' => 'Laporan Penjualan',
    //         'bulan' => $bulan,
    //         'tahun' => $tahun,
    //         'jenis_laporan' => $jenis_laporan,
    //         'total_penjualan' => isset($result->total_penjualan) ? $result->total_penjualan : null,
    //         'total_keuntungan' => isset($result->total_keuntungan) ? $result->total_keuntungan : null
    //     ];

    //     // Mengirim data ke view laporan
    //     return view('laporan/laporan-bulanan-tahunan', $data);
    // }

    public function generate_laporan()
    {
        // Ambil data bulan, tahun, dan jenis laporan dari form
        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');
        $jenis_laporan = $this->request->getPost('jenis_laporan');

        // Panggil method di model untuk mengambil data laporan
        $data = $this->detailpenjualan->getLaporan($bulan, $tahun, $jenis_laporan);

        // Kirim data ke view laporan
        return view('laporan/laporan-bulanan-tahunan', $data);
    }
}

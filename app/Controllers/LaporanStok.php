<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;

class LaporanStok extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Laporan',
            'judulHalaman' => 'Laporan Stok Produk',
            'dataProduk' => $this->produk->getLaporanStok()
        ];

        return view('laporan/laporan-stok', $data);
    }

    public function generatePDF()
    {
        $dompdf = new Dompdf();

        $data = [
            'title' => 'Laporan Stok',
            'dataProduk' => $this->produk->getLaporanStok()
        ];

        $html = view('cetak/pdf_template', $data);

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        // Tampilkan atau unduh file PDF
        $dompdf->stream('Laporan Stok', ['Attachment' => 0]);
    }
}

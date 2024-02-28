<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class Mpenjualan extends Model
{
    protected $table            = 'tbl_penjualan';
    protected $primaryKey       = 'id_penjualan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_penjualan', 'no_faktur', 'tgl_penjualan', 'grand_total', 'email', 'id_pelanggan'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function generateNomerFaktur()
    {
        // Mendapatkan tanggal saat ini dalam format 'Ymd' (contoh: 20240209 untuk 9 Februari 2024)
        $tanggal = date('Ymd');

        $lastInvoice = $this->db->table('tbl_penjualan')
            ->orderBy('id_penjualan', 'DESC')
            ->limit(1)
            ->get()
            ->getRowArray();

        if ($lastInvoice) {
            $lastInvoiceNumber = $lastInvoice['no_faktur'];
            // Memeriksa apakah nomor faktur sebelumnya memiliki tanggal yang sama dengan tanggal saat ini
            if (strpos($lastInvoiceNumber, $tanggal) === 3) {
                // Jika ya, cukup tambahkan nomor berikutnya
                $invoiceNumber = filter_var(substr($lastInvoiceNumber, 11), FILTER_SANITIZE_NUMBER_INT);
                $invoiceNumber++;
            } else {
                // Jika tidak, tambahkan tanggal saat ini sebagai bagian dari nomor faktur
                $invoiceNumber = '1';
            }
        } else {
            // Jika tidak ada penjualan, mulai dari nomor 1
            $invoiceNumber = '1';
        }

        // Menggabungkan tanggal dengan nomor faktur
        return 'FAK' . $tanggal . str_pad($invoiceNumber, 4, '0', STR_PAD_LEFT);
    }


    public function generateWaktu()
    {
        // Mendapatkan waktu saat ini
        $currentTime = Time::now();

        // Mengatur zona waktu ke Asia/Jakarta (WIB) saat memformat waktu
        $formattedTime = $currentTime->setTimezone('Asia/Jakarta')->toLocalizedString('HH:mm:ss');

        return $formattedTime;
    }

    public function generateTanggal()
    {
        // Mendapatkan tanggal saat ini
        $currentDate = Time::now();

        // Mendapatkan nama bulan dalam bahasa Inggris
        $monthNumber = $currentDate->getMonth();
        $englishMonthName = date('F', mktime(0, 0, 0, $monthNumber, 1));

        // Terjemahkan nama bulan ke dalam bahasa yang diinginkan
        $translatedMonthName = $this->translateMonth($englishMonthName, 'id'); // Anda dapat mengganti 'id' dengan kode bahasa yang diinginkan

        // Mendapatkan tanggal, bulan, dan tahun
        $day = $currentDate->getDay();
        $year = $currentDate->getYear();

        // Menggabungkan informasi tanggal dengan nama bulan dan tahun
        $formattedDate = "$day-$translatedMonthName-$year";

        // Mengembalikan tanggal yang diformat
        return $formattedDate;
    }

    private function translateMonth($englishMonthName, $targetLanguage)
    {
        // Terjemahkan nama bulan ke dalam bahasa yang diinginkan
        switch ($englishMonthName) {
            case 'January':
                return 'Januari';
            case 'February':
                return 'Februari';
            case 'March':
                return 'Maret';
            case 'April':
                return 'April';
            case 'May':
                return 'Mei';
            case 'June':
                return 'Juni';
            case 'July':
                return 'Juli';
            case 'August':
                return 'Agustus';
            case 'September':
                return 'September';
            case 'October':
                return 'Oktober';
            case 'November':
                return 'November';
            case 'December':
                return 'Desember';
            default:
                return $englishMonthName;
        }
    }

    public function totalHarga($idPenjualan)
    {
        $penjualan = $this->db->table('tbl_penjualan');
        $penjualan->selectSum('grand_total');
        $penjualan->where('id_penjualan', $idPenjualan);
        $query = $penjualan->get();

        // Kembalikan hasil pencarian sebagai array
        return $query->getResultArray();
    }

    public function isInvoiceAvailable($nomorFaktur)
    {
        $existingInvoice = $this->where('nomor_faktur', $nomorFaktur)->first();
        return empty($existingInvoice);
    }

    public function ambilTerbaruDenganDetail($nomorFaktur, $idPelanggan)
    {
        $db = \Config\Database::connect();
        $penjualan = $db->table('tbl_penjualan');

        // Ambil data transaksi terbaru sesuai dengan nomor faktur dan ID pelanggan yang diberikan
        $penjualan->select('tbl_penjualan.*, tbl_detail_penjualan.id_produk, tbl_detail_penjualan.qty, tbl_detail_penjualan.harga_jual, tbl_detail_penjualan.total_harga');
        $penjualan->join('tbl_detail_penjualan', 'tbl_detail_penjualan.id_penjualan = tbl_penjualan.id_penjualan', 'left');
        $penjualan->where('tbl_penjualan.nomor_faktur', $nomorFaktur);
        $penjualan->where('tbl_penjualan.id_pelanggan', $idPelanggan);
        $penjualan->orderBy('tbl_penjualan.id_penjualan', 'DESC');
        $result = $penjualan->get()->getRowArray();

        return $result; // Mengembalikan data dalam bentuk array
    }

    public function ambilDataPenjualanTerbaru()
    {
        // Ambil data penjualan terbaru dari tabel penjualan
        return $this->orderBy('id_penjualan', 'DESC')
            ->limit(1)
            ->get()
            ->getRowArray();
    }


    public function getByNoFaktur($nomorFaktur)
    {
        return $this->where('no_faktur', $nomorFaktur)->first();
    }

    public function getTotalHargaById($idPenjualan)
    {
        $query = $this->select('grand_total')->where('id_penjualan', $idPenjualan)->first();
        // Periksa apakah hasil kueri tidak kosong sebelum mengakses indeks 'total'
        if ($query) {
            return $query['grand_total'];
        } else {
            // Jika hasil kueri kosong, kembalikan nilai default, misalnya 0
            return 0;
        }
    }
}

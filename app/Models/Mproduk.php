<?php

namespace App\Models;

use CodeIgniter\Model;

class Mproduk extends Model
{
    protected $table            = 'tbl_produk';
    protected $primaryKey       = 'id_produk';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_produk', 'kode_produk', 'nama_produk', 'harga_beli', 'harga_jual', 'diskon', 'id_satuan', 'id_kategori', 'stok'];

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

    public function getProduk()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_produk');
        $builder->select('tbl_produk.id_produk, tbl_produk.kode_produk, tbl_produk.nama_produk, tbl_produk.harga_beli, tbl_produk.harga_jual, tbl_produk.diskon, tbl_produk.id_satuan, tbl_produk.id_kategori, tbl_produk.stok, tbl_kategori.nama_kategori, tbl_satuan.nama_satuan');
        $builder->join('tbl_kategori', 'tbl_produk.id_kategori = tbl_kategori.id_kategori');
        $builder->join('tbl_satuan', 'tbl_produk.id_satuan = tbl_satuan.id_satuan');
        return $builder->get()->getResultArray();
    }

    public function getProdukById($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_produk');
        $builder->select('tbl_produk.id_produk, tbl_produk.kode_produk, tbl_produk.nama_produk, tbl_produk.harga_beli, tbl_produk.harga_jual, tbl_produk.diskon, tbl_produk.id_satuan, tbl_produk.id_kategori, tbl_produk.stok, tbl_kategori.nama_kategori, tbl_kategori.id_kategori, tbl_satuan.id_satuan, tbl_satuan.nama_satuan');
        $builder->join('tbl_kategori', 'tbl_produk.id_kategori = tbl_kategori.id_kategori');
        $builder->join('tbl_satuan', 'tbl_produk.id_satuan = tbl_satuan.id_satuan');
        $builder->where('tbl_produk.id_produk', $id);
        return $builder->get()->getRowArray();
    }

    public function generateProductCode()
    {
        $prefix = 'PRD';
        $lastProduct = $this->orderBy('id_produk', 'DESC')->first();

        if (!$lastProduct) {
            $code = $prefix . '001';
        } else {
            $lastCode = substr($lastProduct['kode_produk'], strlen($prefix));
            $nextCode = str_pad($lastCode + 1, 3, '0', STR_PAD_LEFT);
            $code = $prefix . $nextCode;
        }

        return $code;
    }

    public function cariProduk($keyword)
    {
        $builder = $this->db->table('tbl_produk');
        $builder->like('kode_produk', $keyword);
        $builder->orLike('nama_produk', $keyword);
        $query = $builder->get();

        // Kembalikan hasil pencarian sebagai array
        return $query->getResultArray();
    }

    public function getInfo($keyword)
    {
        $builder = $this->db->table('tbl_produk');
        $builder->like('nama_produk', $keyword);
        $query = $builder->get();

        // Kembalikan hasil pencarian sebagai array
        return $query->getResultArray();
    }

    public function getLaporanStok()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_produk');
        $builder->select('tbl_produk.id_produk, tbl_produk.kode_produk, tbl_produk.nama_produk, tbl_produk.harga_beli, tbl_produk.harga_jual, tbl_produk.diskon, tbl_produk.id_satuan, tbl_produk.id_kategori, tbl_produk.stok, tbl_kategori.nama_kategori, tbl_satuan.nama_satuan');
        $builder->orderBy('stok', 'ASC');
        $builder->join('tbl_kategori', 'tbl_produk.id_kategori = tbl_kategori.id_kategori');
        $builder->join('tbl_satuan', 'tbl_produk.id_satuan = tbl_satuan.id_satuan');
        return $builder->get()->getResultArray();
    }

    public function getTotalProduk()
    {
        return $this->countAllResults();
    }
     
}

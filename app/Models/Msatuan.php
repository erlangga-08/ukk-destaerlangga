<?php

namespace App\Models;

use CodeIgniter\Model;

class Msatuan extends Model
{
    protected $table            = 'tbl_satuan';
    protected $primaryKey       = 'id_satuan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_satuan', 'nama_satuan'];

    protected bool $allowEmptyInserts = false;

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

    public function cekKeterkaitan($id)
    {
        // Contoh: Cek apakah data dengan ID yang diberikan digunakan di tabel lain
        $builder = $this->db->table('tbl_produk');
        $builder->where('id_satuan', $id);
        $count = $builder->countAllResults();

        // Jika terdapat keterkaitan, kembalikan true, jika tidak, kembalikan false
        return ($count > 0);
    }
}

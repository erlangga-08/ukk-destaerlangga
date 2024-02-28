<?php

namespace App\Models;

use CodeIgniter\Model;

class Mpengguna extends Model
{
    protected $table            = 'tbl_pengguna';
    protected $primaryKey       = 'email';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['email', 'nama_lengkap', 'username', 'password', 'level'];

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

    public function getUser($user, $pass)
    {

        $where = [
            'username' => $user,
            'password' => md5($pass)
        ];
        $user = new Mpengguna();
        $user->select("tbl_pengguna.email, tbl_pengguna.username, tbl_pengguna.nama_lengkap, tbl_pengguna.password, tbl_pengguna.level");
        $user->where($where);
        return $user->findAll();
    }

    public function getPengguna($email)
    {
        $where = [
            'email' => $email,
        ];
        $user = new Mpengguna();
        $user->select("tbl_pengguna.email, tbl_pengguna.username, tbl_pengguna.nama_lengkap, tbl_pengguna.password, tbl_pengguna.level");
        $user->where($where);
        return $user->findAll();
    }

    public function getEnumValues()
    {
        $query = $this->db->query("SHOW COLUMNS FROM tbl_pengguna WHERE Field = 'level'");
        $row   = $query->getRow();
        $enum  = explode("','", substr($row->Type, 6, -2));

        return $enum;
    }

    public function getTotalPengguna()
    {
        return $this->countAllResults();
    }
}

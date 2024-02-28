<?php

namespace App\Validation;

class CostumRules
{
     // Callback function
     public function checkHargaValid(string $str, string $field, array $data): bool
     {
        // Ambil nilai harga jual dan harga beli dari data
        $harga_jual = $data['harga_jual'];
        $harga_beli = $data['harga_beli'];

        // Periksa apakah harga jual lebih besar atau sama dengan harga beli
        if ($harga_jual >= $harga_beli) {
            // Harga jual valid, kembalikan true
            return true;
        } else {
            // Harga jual lebih kecil dari harga beli, kembalikan false
            return false;
        }
     }
}

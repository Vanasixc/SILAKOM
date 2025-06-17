<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriBarang extends Model
{
   protected $table            = 'kategori_barang';
    // Primary key dari tabel
    protected $primaryKey       = 'id_kategori';
    // Field yang diizinkan untuk diisi/diubah melalui model
    protected $allowedFields    = ['nama_kategori', 'deskripsi'];
}

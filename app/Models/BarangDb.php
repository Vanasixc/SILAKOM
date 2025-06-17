<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangDb extends Model
{
    protected $table            = 'barang';
    protected $primaryKey       = 'id_barang';
    protected $allowedFields    = [
        'kode_barang', 
        'nama_barang', 
        'id_kategori', 
        'stok_total', 
        'kondisi', // <-- Kolom kondisi yang kita tambahkan
        'deskripsi', 
        'foto_barang'
    ];

    // Mengaktifkan fitur auto-timestamp untuk created_at dan updated_at
    protected $useTimestamps = true;

    // Fungsi kustom untuk mengambil data barang lengkap dengan nama kategorinya
    public function getBarangWithKategori()
    {
        return $this->db->table('barang')
            ->join('kategori_barang', 'kategori_barang.id_kategori = barang.id_kategori')
            ->get()->getResultArray();
    }
}

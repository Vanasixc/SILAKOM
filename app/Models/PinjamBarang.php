<?php

namespace App\Models;

use CodeIgniter\Model;

class PinjamBarang extends Model
{
    protected $table            = 'peminjaman';
    protected $primaryKey       = 'id_peminjaman';
    protected $allowedFields    = [
        'id_barang',
        'id_user_peminjam',
        'jumlah_pinjam',
        'deadline_kembali',
        'tanggal_dikembalikan',
        'status_peminjaman',
        'catatan'
    ];

    // Fungsi kustom untuk mengambil data barang yang sedang dipinjam oleh user tertentu
    public function getBarangDipinjamByUser($userId)
    {
        return $this->db->table('peminjaman')
            ->join('barang', 'barang.id_barang = peminjaman.id_barang')
            ->where('peminjaman.id_user_peminjam', $userId)
            ->where('peminjaman.status_peminjaman', 'Dipinjam') // Hanya yang masih dipinjam
            ->get()->getResultArray();
    }
}

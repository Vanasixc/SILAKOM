<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AccountDb;
use Hermawan\DataTables\DataTable;
use App\Models\PinjamBarang;
use App\Models\BarangDb;


class Dashboard extends BaseController
{

    protected $accountModel;
    protected $pinjamBarang;
    protected $barangModel;

    public function __construct()
    {
        $this->accountModel = new AccountDb();
        $this->pinjamBarang = new PinjamBarang();
        $this->barangModel = new BarangDb();
    }

    //method untuk menampilkan halaman dashboard
    public function getIndex()
    {
        if (session()->get('role') == 'admin') {
            $data = [
                'title' => 'Dashboard Admin'
            ];
            return view('pages/dashboard_admin', $data);

        } else {
            $data = [
                'title' => 'Dashboard'
            ];
            return view('pages/dashboard', $data);
        }
    }

    public function getListbarang()
    {
        $data = [
            'title' => 'List Barang',
        ];
        return view('pages/list_barang', $data);
    }

    public function getManageaccount()
    {
        $data = [
            'title' => 'Manage Account',
        ];

        return view('pages/manage_account', $data);
    }


    // Method untuk mengambil data dari database untuk Datatables
    public function postTableaccount()
    {
        $db = db_connect();
        $builder = $db->table('account')->select('id, name, username, role, status, last_login');
        return DataTable::of($builder)
            ->addNumbering('no')
            ->edit('status', function ($row) {
                if ($row->status == 'active') {
                    return '<span class="badge bg-success">Active</span>';
                } elseif ($row->status == 'inactive') {
                    return '<span class="badge bg-secondary">Inactive</span>';
                }
                return '<span class="badge bg-danger">Banned</span>';
            })
            ->add('action', function ($row) {
                $editBtn = '<button type="button" class="btn btn-primary btn-sm me-1 btn-edit" data-id="' . $row->id . '">Edit</button>';
                $deleteBtn = '<button type="button" class="btn btn-danger btn-sm btn-delete" data-id="' . $row->id . '" data-name="' . esc($row->name) . '">Hapus</button>';
                return $editBtn . $deleteBtn;
            })
            ->toJson(true);
    }

    public function postTablelistbarang()
    {
        $db = db_connect();

        $builder = $db->table('barang')
            ->select('barang.id_barang, barang.foto_barang, barang.kode_barang, barang.nama_barang, kategori_barang.nama_kategori, barang.stok_total, barang.kondisi')
            ->join('kategori_barang', 'kategori_barang.id_kategori = barang.id_kategori');

        return DataTable::of($builder)
            ->addNumbering('no')
            ->edit('foto_barang', function ($row) {
                // Format kolom foto untuk menampilkan gambar
                $imgUrl = base_url('Uploads/img/' . esc($row->foto_barang));
                return '<img src="' . $imgUrl . '" alt="Foto Barang" width="50">';
            })
            ->add('stok', function ($row) {
                // Menghitung stok tersedia secara dinamis
                $peminjamanModel = $this->pinjamBarang;
                $totalDipinjam = $peminjamanModel->where('id_barang', $row->id_barang)
                    ->where('status_peminjaman', 'Dipinjam')
                    ->selectSum('jumlah_pinjam')
                    ->first()['jumlah_pinjam'] ?? 0;

                $stokTersedia = $row->stok_total - $totalDipinjam;
                return $stokTersedia . ' / ' . $row->stok_total;
            })
            ->edit('kondisi', function ($row) {
                if ($row->kondisi == 'Baik') {
                    return '<span class="badge bg-success">Baik</span>';
                } else {
                    return '<span class="badge bg-danger">Rusak</span>';
                }
            })
            ->add('action', function ($row) {
                $editBtn = '';
                if (session()->get('role') == 'admin') {
                    $editBtn = '<button type="button" class="btn btn-warning btn-sm me-1 btn-edit" data-id="' . $row->id_barang . '">Edit</button>';
                }
                $pinjamBtn = '<button type="button" class="btn btn-primary btn-sm me-1 btn-pinjam" 
                    data-id="' . $row->id_barang . '" 
                    data-kode="' . esc($row->kode_barang) . '" 
                    data-nama="' . esc($row->nama_barang) . '"
                    data-kondisi="' . esc($row->kondisi) . '">Pinjam</button>';
                return $pinjamBtn . $editBtn;
            })
            ->toJson(true);
    }

    public function postTablepinjam()
    {
        $userId = session()->get('id');
        $db = db_connect();

        // Membuat query SQL CASE untuk menentukan status secara dinamis di level database
        $statusCase = "CASE 
            WHEN peminjaman.status_peminjaman = 'Sudah Kembali' THEN 'Dikembalikan'
            WHEN NOW() > peminjaman.deadline_kembali THEN 'Terlambat'
            ELSE 'Dipinjam'
        END";

        $builder = $db->table('peminjaman')
            ->select("peminjaman.id_peminjaman, barang.foto_barang, barang.nama_barang, peminjaman.jumlah_pinjam, peminjaman.tanggal_pinjam, peminjaman.deadline_kembali, peminjaman.tanggal_dikembalikan, ({$statusCase}) as status_final")
            ->join('barang', 'barang.id_barang = peminjaman.id_barang')
            ->where('peminjaman.id_user_peminjam', $userId)
            ->orderBy('peminjaman.tanggal_pinjam', 'DESC');

        return DataTable::of($builder)
            ->addNumbering('no')
            ->edit('foto_barang', function ($row) {
                $imgUrl = base_url('Uploads/img/' . esc($row->foto_barang));
                return '<img src="' . $imgUrl . '" alt="Foto" width="60" class="img-thumbnail">';
            })
            ->edit('tanggal_pinjam', function ($row) {
                return date('d F Y', strtotime($row->tanggal_pinjam));
            })
            ->edit('deadline_kembali', function ($row) {
                return date('d F Y', strtotime($row->deadline_kembali));
            })
            ->edit('tanggal_dikembalikan', function ($row) {
                return $row->tanggal_dikembalikan ? date('d F Y', strtotime($row->tanggal_dikembalikan)) : '-';
            })
            ->edit('status_final', function ($row) {
                $status = $row->status_final;
                $badgeClass = 'bg-primary';
                if ($status == 'Dikembalikan') {
                    $badgeClass = 'bg-success';
                } elseif ($status == 'Terlambat') {
                    $badgeClass = 'bg-danger';
                }
                return '<span class="badge ' . $badgeClass . '">' . $status . '</span>';
            })
            ->toJson(true);
    }

    //method fungsi
    public function postDeleteaccount($id = null)
    {
        if ($id == session()->get('id')) {
            return redirect()->to('dashboard/manageaccount')->with('error', 'Anda tidak dapat menghapus akun yang sedang digunakan');
        }

        $user = $this->accountModel->find($id);

        if ($user) {
            $this->accountModel->delete($id);
            return redirect()->to('dashboard/manageaccount')->with('message', 'Akun berhasil dihapus.');
        } else {
            return redirect()->to('dashboard/manageaccount')->with('error', 'Akun tidak ditemukan.');
        }
    }

    public function postSimpan()
    {
        $id_barang = $this->request->getPost('id_barang');
        $jumlah_pinjam = $this->request->getPost('jumlah_pinjam');
        $deadline_kembali = $this->request->getPost('deadline_kembali');

        $barang = $this->barangModel->find($id_barang);
        if (!$barang) {
            return redirect()->to('/dashboard/listbarang')->with('error', 'Barang tidak ditemukan.');
        }

        $totalDipinjam = $this->pinjamBarang->where('id_barang', $id_barang)
            ->where('status_peminjaman', 'Dipinjam')
            ->selectSum('jumlah_pinjam')->first()['jumlah_pinjam'] ?? 0;
        $stokTersedia = $barang['stok_total'] - $totalDipinjam;

        if ($jumlah_pinjam > $stokTersedia) {
            return redirect()->to('/dashboard/listbarang')->with('error', 'Maaf, jumlah yang ingin dipinjam melebihi stok yang tersedia (' . $stokTersedia . ' unit).');
        }

        if (empty($deadline_kembali) || $jumlah_pinjam <= 0) {
            return redirect()->to('/dashboard/listbarang')->with('error', 'Data yang diinput tidak valid.');
        }

        $data = [
            'id_barang' => $id_barang,
            'id_user_peminjam' => session()->get('id'),
            'jumlah_pinjam' => $jumlah_pinjam,
            'tanggal_pinjam' => date('Y-m-d H:i:s'), 
            'deadline_kembali' => $deadline_kembali,
            'status_peminjaman' => 'Dipinjam' 
        ];

        $this->pinjamBarang->insert($data);

        return redirect()->to('/dashboard/listbarang')->with('success', 'Barang berhasil dipinjam!');
    }
}


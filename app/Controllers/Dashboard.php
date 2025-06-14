<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    public function getIndex()
    {
        $data = [
            'title' => 'Dashboard',
        ];

        return view('pages/dashboard', $data);
    }

    public function getBarang()
    {
        $data = [
            'title' => 'Barang',
        ];

        return view('pages/barang', $data);
    }

    public function getPinjambarang()
    {
        # code...
    }
}

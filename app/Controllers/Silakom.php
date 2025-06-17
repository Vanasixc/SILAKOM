<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Silakom extends BaseController
{
    public function getIndex()
    {
        return redirect()->to('dashboard');
    }
}

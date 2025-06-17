<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AccountDb;

class Auth extends BaseController
{

    protected $accountModel;
    public function __construct()
    {
        $this->accountModel = new AccountDb();
    }

    public function getIndex()
    {
        $data = [
            'title' => 'Login',
            'logged_in' => true,
        ];

        return view('pages/login', $data);
    }

    public function postProcesslogin()
    {

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->accountModel->where('username', $username)->first();

        if (!$user) {
            return redirect()->to('auth')->with('error', 'Akun tidak ditemukan. Silakan lakukan Sign Up.');
        }

        if ($user['password'] !== $password) {
            return redirect()->to('auth')->with('error', 'Password yang anda masukkan salah.');
        }

        $session = session();
        $session->set([
            'id' => $user['id'],
            'name' => $user['name'],
            'username' => $user['username'],
            'role' => $user['role'],
            'logged_in' => true
        ]);

        return redirect()->to('silakom')->with('success', 'Login berhasil! Selamat datang ' . $user['name'] . '!');
    }

    public function getRegister()
    {
        $pages = [
            "title" => "Register",
        ];

        return view('pages/register', $pages);
    }

    public function postProcessregister()
    {
        $nama = $this->request->getPost('name');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $rePassword = $this->request->getPost('re-password');

        $user = [
            $nama, $username, $password, $rePassword
        ];
        if (in_array('', $user)) {
            return redirect()->back()->withInput()->with('error', 'Semua field harus diisi!');
        }

        if ($password !== $rePassword) {
            return redirect()->back()->withInput()->with('error', 'Password tidak sama!');
        }

        $data = [
            'name' => $nama,
            'username' => $username,
            'password' => $password,
            'role' => 'user',
        ];

        $this->accountModel->insert($data);

        return redirect()->to('auth')->with('success', 'Registrasi berhasil!');
    }

    public function getLogout()
    {
        session()->destroy();
        return redirect()->to('auth')->with('message', 'Anda telah berhasil logout.');
    }

}


<?php
namespace App\Controllers;
use App\Models\UserModel;

class Admin extends BaseController
{
    public function login()
    {
        return view('admin/dashboard');
    }

    public function auth()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $admin = $userModel->where('username', $username)->where('role', 'admin')->first();

        if ($admin && password_verify($password, $admin['password'])) {
            session()->set([
                'admin_id' => $admin['id'],
                'admin_name' => $admin['nama'],
                'role' => 'admin',
                'isLoggedIn' => true
            ]);
            return redirect()->to('/admin/dashboard');
        } else {
            return redirect()->to('/admin/login')->with('error', 'Username atau password salah');
        }
    }

    public function dashboard()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/admin/login')->with('error', 'Akses ditolak');
        }

        return view('admin/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/login');
    }
}
?>
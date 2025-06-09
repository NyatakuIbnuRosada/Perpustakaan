<?php
namespace App\Controllers;

use App\Models\AnggotaModel;
use CodeIgniter\Controller;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth/login');
    }

    public function auth()
    {
        $model = new \App\Models\AnggotaModel();
        $nim = $this->request->getPost('nim');
        $nama = $this->request->getPost('nama');

        $anggota = $model->where('nim', $nim)->where('nama', $nama)->first();

        if ($anggota) {
            // Simpan id ke dalam session dengan key yang konsisten
            session()->set([
                'anggota_id' => $anggota['id'],
                'nama'       => $anggota['nama'],
                'logged_in'  => true
            ]);
            return redirect()->to('/dashboard');
        }

        return redirect()->back()->with('error', 'Login gagal, NIM atau nama salah.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}

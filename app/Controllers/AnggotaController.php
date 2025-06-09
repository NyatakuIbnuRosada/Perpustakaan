<?php
// File: app/Controllers/AnggotaController.php
namespace App\Controllers;

use App\Models\AnggotaModel;
use CodeIgniter\Controller;

class AnggotaController extends Controller
{
    public function register()
    {
        return view('anggota/register');
    }

    public function saveRegister()
    {
        $anggotaModel = new AnggotaModel();
        $file = $this->request->getFile('foto');

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/', $newName);

            $anggotaModel->save([
                'nim' => $this->request->getPost('nim'),
                'nama' => $this->request->getPost('nama'),
                'jurusan' => $this->request->getPost('jurusan'),
                'fakultas' => $this->request->getPost('fakultas'),
                'foto' => $newName,
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
            ]);
            

            return redirect()->to('/login')->with('success', 'Registrasi berhasil, silakan login.');

        }

        return redirect()->back()->with('error', 'Upload foto gagal');
    }
}
?>
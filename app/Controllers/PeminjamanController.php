<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\BukuModel;
use CodeIgniter\Controller;

class PeminjamanController extends BaseController
{
    public function index()
{
    $peminjamanModel = new PeminjamanModel();
    $bukuModel = new BukuModel();

    $anggota_id = session('anggota_id');

    $data['buku'] = $bukuModel->findAll();
    
    $data['peminjaman'] = $peminjamanModel
        ->select('peminjaman.*, buku.judul, 
                 TIMESTAMPDIFF(SECOND, NOW(), batas_waktu) as sisa_waktu')
        ->join('buku', 'buku.id = peminjaman.buku_id')
        ->where('anggota_id', $anggota_id)
        ->findAll();

    return view('peminjaman/index', $data);
}

    public function pinjam()
    {
        $peminjamanModel = new PeminjamanModel();

        // Ambil anggota_id dari session dengan key yang benar
        $anggota_id = session('anggota_id');
        $buku_id = $this->request->getPost('buku_id');

        $now = date('Y-m-d H:i:s');
        $batas = date('Y-m-d H:i:s', strtotime('+7 days'));

        // Simpan data peminjaman ke database
        $peminjamanModel->save([
            'anggota_id'   => $anggota_id,
            'buku_id'      => $buku_id,
            'waktu_pinjam' => $now,
            'batas_waktu'  => $batas,
            'status'       => 'menunggu'
        ]);

        return redirect()->to('/peminjaman');
    }
    public function updateStatus($id)
{
    $peminjamanModel = new PeminjamanModel();
    
    // Update status menjadi 'dikonfirmasi'
    $peminjamanModel->update($id, [
        'status' => 'dikonfirmasi'
    ]);

    return redirect()->to('/peminjaman');
}

    public function kembalikan()
    {
        $id = $this->request->getPost('id');
        $peminjamanModel = new PeminjamanModel();
        $peminjamanModel->delete($id);

        return redirect()->to('/peminjaman');
    }
    public function getPeminjamanMenunggu()
{
    return $this->select('peminjaman.*, anggota.nama, buku.judul')
               ->join('anggota', 'anggota.id = peminjaman.anggota_id')
               ->join('buku', 'buku.id = peminjaman.buku_id')
               ->where('status', 'menunggu')
               ->orderBy('created_at', 'DESC')
               ->findAll();
}
public function getAllLoans()
{
    return $this->select('peminjaman.*, anggota.nama, buku.judul')
               ->join('anggota', 'anggota.id = peminjaman.anggota_id')
               ->join('buku', 'buku.id = peminjaman.buku_id')
               ->orderBy('peminjaman.created_at', 'DESC')
               ->findAll();
}
}

<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\BukuModel;
use App\Models\AnggotaModel;
use App\Models\KategoriModel;

class AdminController extends BaseController
{
    protected $helpers = ['form', 'url'];

    public function dashboard()
{
    if (!session()->get('is_admin')) {
        return redirect()->to('/admin/login');
    }

    $peminjamanModel = new PeminjamanModel();
    $bukuModel = new BukuModel();
    $anggotaModel = new AnggotaModel();
    $kategoriModel = new KategoriModel(); // Tambahkan ini

    $data = [
        'totalBuku' => $bukuModel->countAll(),
        'totalPeminjaman' => $peminjamanModel->countAll(),
        'totalAnggota' => $anggotaModel->countAll(),
        'peminjamanMenunggu' => $peminjamanModel->getPeminjamanMenunggu(),
        'allLoans' => $peminjamanModel->getAllLoans(),
        'books' => $bukuModel->findAll(),
        'members' => $anggotaModel->getAllMembers(),
        'categories' => $kategoriModel->getAllCategories() // Tambahkan ini
        
    ];

    return view('admin/dashboard', $data);
    
}
    //     $peminjamanModel = new PeminjamanModel();
    //     $data['peminjaman'] = $peminjamanModel->find($id);

    //     if (!$data['peminjaman']) {
    //         return redirect()->to('/admin')->with('error', 'Peminjaman tidak ditemukan');
    //     }
    //     return view('admin/konfirmasi_peminjaman', $data);
    // }
    
    public function login()
{
    // Jika sudah login, tampilkan pesan dan tetap di halaman login
    if (session()->get('is_admin')) {
        session()->setFlashdata('info', 'Anda sudah login sebagai admin');
        return view('admin/login'); // Tetap tampilkan halaman login
    }
    
    return view('admin/login');
}

    
    public function prosesKonfirmasi()
    {
        $peminjamanModel = new PeminjamanModel();

        // Ambil data dari form
        $id = $this->request->getPost('id');
        $status = $this->request->getPost('status');
        $batasWaktu = $this->request->getPost('batas_waktu');

        // Validasi jika status atau batas waktu kosong
        if (empty($status) || empty($batasWaktu)) {
            return redirect()->back()->with('error', 'Status dan batas waktu pengembalian harus diisi.');
        }

        // Update data peminjaman
        $updated = $peminjamanModel->update($id, [
            'status' => $status,
            'batas_waktu' => $batasWaktu
        ]);

        if ($updated) {
            return redirect()->to('/admin/peminjaman')->with('success', 'Peminjaman berhasil dikonfirmasi!');
        } else {
            return redirect()->back()->with('error', 'Gagal mengkonfirmasi peminjaman.');
        }
    }


    // [Tetap pertahankan method login, prosesLogin, dan logout yang sudah ada]


    // Proses login admin
    public function prosesLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Validasi input
        if (empty($username) || empty($password)) {
            session()->setFlashdata('error', 'Username dan password harus diisi!');
            return redirect()->to('/admin/login');
        }

        // Bisa diganti dengan model dan pengecekan database sesuai kebutuhan
        if ($username === 'ibu ita' && $password === 'admin123') {
            session()->set('is_admin', true);
            return redirect()->to('/admin');
        }

        session()->setFlashdata('error', 'Username atau password salah!');
        return redirect()->to('/admin/login');
    }

    // Proses tambah buku
    public function prosesTambahBuku()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => 'required|min_length[3]',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|numeric',
            'stok' => 'required|numeric',
            'kategori' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $bukuModel = new BukuModel();
        $db = \Config\Database::connect();

        try {
            $db->transStart();

            // Simpan data buku
            $bukuId = $bukuModel->insert([
                'judul' => $this->request->getPost('judul'),
                'penulis' => $this->request->getPost('penulis'),
                'penerbit' => $this->request->getPost('penerbit'),
                'tahun_terbit' => $this->request->getPost('tahun_terbit'),
                'stok' => $this->request->getPost('stok')
            ]);

            // Simpan relasi kategori
            $kategori = $this->request->getPost('kategori');
            if (!empty($kategori)) {
                $bukuKategori = [];
                foreach ($kategori as $kategoriId) {
                    $bukuKategori[] = [
                        'buku_id' => $bukuId,
                        'kategori_id' => $kategoriId
                    ];
                }
                $db->table('buku_kategori')->insertBatch($bukuKategori);
            }

            $db->transComplete();

            return redirect()->to('/admin')->with('success', 'Buku berhasil ditambahkan!');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan buku: ' . $e->getMessage());
        }
    }
    public function buku()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $bukuModel = new BukuModel();
        $data['buku'] = $bukuModel->getBukuWithKategori();
        
        return view('admin/buku/index', $data);
    }
    // Menampilkan form konfirmasi peminjaman
    // public function getPeminjamanDetail($id)
    // {
    // return $this->select('peminjaman.*, buku.judul, anggota.nama as nama_peminjam, anggota.nim')
    //             ->join('buku', 'buku.id = peminjaman.buku_id')
    //             ->join('anggota', 'anggota.id = peminjaman.anggota_id')
    //             ->where('peminjaman.id', $id)
    //             ->first(); // Gunakan first() bukan find() untuk join query
    // }
    public function konfirmasi($id)
    {
    if (!session()->get('is_admin')) {
        return redirect()->to('/admin/login');
    }

    $peminjamanModel = new PeminjamanModel();
    
    // Tambahkan error handling dan logging
    try {
        $data = $peminjamanModel->getPeminjamanDetail($id);
        
        if (!$data) {
            log_message('error', "Data peminjaman ID {$id} tidak ditemukan");
            return redirect()->to('/admin')
                    ->with('error', 'Data peminjaman tidak ditemukan');
        }
        
        return view('admin/konfirmasi', ['peminjaman' => $data]);
        
    } catch (\Exception $e) {
        log_message('error', 'Error saat mengambil data peminjaman: ' . $e->getMessage());
        return redirect()->to('/admin')
               ->with('error', 'Terjadi kesalahan sistem');
    }
}

    public function peminjaman()
{
    if (!session()->get('is_admin')) {
        return redirect()->to('/admin/login');
    }

    $peminjamanModel = new PeminjamanModel();
    $data['peminjaman'] = $peminjamanModel->findAll();
    $data['peminjaman'] = $peminjamanModel->getAllWithDetails();


    return view('admin/dashboard', $data); // ✅ sesuai struktur folder
}

    // Logout admin
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/login');
    }
    public function simpanKategori()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required|min_length[3]|is_unique[kategori.nama]',
            'deskripsi' => 'permit_empty'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $kategoriModel = new KategoriModel();
        
        try {
            $kategoriModel->save([
                'nama' => $this->request->getPost('nama'),
                'deskripsi' => $this->request->getPost('deskripsi')
            ]);
            
            return redirect()->to('/admin/kategori')->with('success', 'Kategori berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan kategori: ' . $e->getMessage());
        }
    }
    public function kategori()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $kategoriModel = new KategoriModel();
        $data['kategori'] = $kategoriModel->getKategoriWithCount();
        
        return view('admin/kategori/index', $data);
    }
     public function simpanBuku()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => 'required|min_length[3]',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|numeric',
            'stok' => 'required|numeric',
            'kategori' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $bukuModel = new BukuModel();
        $bukuKategoriModel = new BukuKategoriModel();
        
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Upload cover jika ada
            $cover = $this->request->getFile('cover');
            $coverName = null;
            
            if ($cover && $cover->isValid() && !$cover->hasMoved()) {
                $coverName = $cover->getRandomName();
                $cover->move(ROOTPATH . 'public/uploads/cover', $coverName);
            }

            // Simpan data buku
            $bukuId = $bukuModel->insert([
                'judul' => $this->request->getPost('judul'),
                'penulis' => $this->request->getPost('penulis'),
                'penerbit' => $this->request->getPost('penerbit'),
                'tahun_terbit' => $this->request->getPost('tahun_terbit'),
                'stok' => $this->request->getPost('stok'),
                'cover' => $coverName
            ]);

            // Simpan kategori buku
            $kategori = $this->request->getPost('kategori');
            $bukuKategoriModel->updateKategoriBuku($bukuId, $kategori);

            $db->transComplete();

            return redirect()->to('/admin/buku')->with('success', 'Buku berhasil ditambahkan');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan buku: ' . $e->getMessage());
        }
    }
    public function tambahBuku()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $kategoriModel = new KategoriModel();
        $data['kategori'] = $kategoriModel->findAll();
        
        return view('admin/buku/tambah', $data);
    }
}
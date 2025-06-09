<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id';
    protected $allowedFields = ['anggota_id', 'buku_id', 'waktu_pinjam', 'batas_waktu', 'status'];
    protected $useTimestamps = true;

    // Method untuk semua peminjaman
    public function getAllLoans()
    {
        return $this->select('peminjaman.*, anggota.nama, buku.judul, anggota.nim')
                   ->join('anggota', 'anggota.id = peminjaman.anggota_id')
                   ->join('buku', 'buku.id = peminjaman.buku_id')
                   ->orderBy('peminjaman.created_at', 'DESC')
                   ->findAll();
    }

    // Method untuk peminjaman menunggu
    // public function getPeminjamanMenunggu()
    // {
    //     return $this->where('status', 'menunggu')
    //                ->getAllLoans();
    // }
    public function getPeminjamanDetail($id)
    {
    return $this->select('peminjaman.*, buku.judul, anggota.nama as nama_peminjam, anggota.nim')
                ->join('buku', 'buku.id = peminjaman.buku_id')
                ->join('anggota', 'anggota.id = peminjaman.anggota_id')
                ->where('peminjaman.id', $id)
                ->first(); // Gunakan first() bukan find() untuk join query
    }
    public function getPeminjamanMenunggu($limit = null)
{
    $query = $this->select('peminjaman.*, anggota.nama, buku.judul')
                 ->join('anggota', 'anggota.id = peminjaman.anggota_id')
                 ->join('buku', 'buku.id = peminjaman.buku_id')
                 ->where('status', 'menunggu')
                 ->orderBy('peminjaman.created_at', 'DESC');
    
    if ($limit) {
        $query->limit($limit);
    }
    
    return $query->findAll();
}
public function getAllWithDetails()
{
    return $this->select('peminjaman.*, buku.judul, anggota.nama as nama_peminjam')
                ->join('buku', 'buku.id = peminjaman.buku_id')
                ->join('anggota', 'anggota.id = peminjaman.anggota_id')
                ->findAll();
}

}
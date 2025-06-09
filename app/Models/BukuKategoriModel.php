<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuKategoriModel extends Model
{
    protected $table = 'buku_kategori';
    protected $primaryKey = 'id';
    protected $allowedFields = ['buku_id', 'kategori_id'];
    
    // Method untuk mendapatkan kategori sebuah buku
    public function getKategoriForBuku($bukuId)
    {
        return $this->where('buku_id', $bukuId)
                   ->join('kategori', 'kategori.id = buku_kategori.kategori_id')
                   ->findAll();
    }
    
    // Method untuk update kategori buku
    public function updateKategoriBuku($bukuId, $kategoriIds)
    {
        // Hapus semua relasi lama
        $this->where('buku_id', $bukuId)->delete();
        
        // Tambahkan relasi baru
        $data = [];
        foreach ($kategoriIds as $kategoriId) {
            $data[] = [
                'buku_id' => $bukuId,
                'kategori_id' => $kategoriId
            ];
        }
        
        if (!empty($data)) {
            return $this->insertBatch($data);
        }
        
        return true;
    }
}
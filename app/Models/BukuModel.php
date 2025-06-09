<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'id';
    protected $allowedFields = ['judul', 'penulis', 'penerbit', 'tahun_terbit', 'stok', 'cover'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getBukuTersedia()
    {
        return $this->where('stok >', 0)->findAll();
    }

    public function kurangiStok($id, $jumlah = 1)
    {
        return $this->set('stok', 'stok-'.$jumlah, false)
                   ->where('id', $id)
                   ->update();
    }

    public function tambahStok($id, $jumlah = 1)
    {
        return $this->set('stok', 'stok+'.$jumlah, false)
                   ->where('id', $id)
                   ->update();
    }

    public function search($keyword)
    {
        return $this->like('judul', $keyword)
                   ->orLike('penulis', $keyword)
                   ->orLike('penerbit', $keyword)
                   ->findAll();
    }

    public function uploadCover($file)
    {
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/buku', $newName);
            return $newName;
        }
        return null;
    }
}
<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table = 'kategori';
    
    // Return empty array if table doesn't exist
    public function getAllCategories()
    {
        if (!$this->db->tableExists($this->table)) {
            return [];
        }
        return $this->orderBy('nama', 'ASC')->findAll();
    }
}
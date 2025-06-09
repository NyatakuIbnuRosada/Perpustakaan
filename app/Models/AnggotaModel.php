<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $table = 'anggota';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nim', 'nama', 'jurusan', 'fakultas', 'foto'];
    protected $useTimestamps = true;

    public function getAllMembers()
    {
        return $this->orderBy('nama', 'ASC')->findAll();
    }
}
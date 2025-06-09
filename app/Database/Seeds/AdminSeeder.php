<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'admin',
            'password' => password_hash('123', PASSWORD_DEFAULT),
            'nama'     => 'ibuita',
            'role'     => 'admin'
        ];

        $this->db->table('users')->insert($data);
    }
}

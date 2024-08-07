<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ArtikelSeeder extends Seeder {
    public function run() {
        $data = [
            [
                'judul' => 'Artikel Pertama',
                'isi' => 'Isi dari artikel pertama',
                'gambar' => 'gambar1.jpg',
                'status' => 1,
            ],
            [
                'judul' => 'Artikel Kedua',
                'isi' => 'Isi dari artikel kedua',
                'gambar' => 'gambar2.jpg',
                'status' => 1,
            ],
            [
                'judul' => 'Artikel Ketiga',
                'isi' => 'Isi dari artikel ketiga',
                'gambar' => 'gambar3.jpg',
                'status' => 0,
            ],
            [
                'judul' => 'Artikel Keempat',
                'isi' => 'Isi dari artikel keempat',
                'gambar' => 'gambar4.jpg',
                'status' => 0,
            ],
            [
                'judul' => 'Artikel Kelima',
                'isi' => 'Isi dari artikel kelima',
                'gambar' => 'gambar5.jpg',
                'status' => 1,
            ],
        ];

        // Menggunakan Query Builder
        $this->db->table('artikel')->insertBatch($data);
    }
}

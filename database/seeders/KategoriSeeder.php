<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori')->insert(
            [
                [
                    'nama' => 'Teknologi',
                    'jenis' => 'Berita',
                ],
                [
                    'nama' => 'Teknologi',
                    'jenis' => 'Kegiatan',
                ],
                [
                    'nama' => 'Olahraga',
                    'jenis' => 'Kegiatan',
                ],
            ]
        );
    }
}

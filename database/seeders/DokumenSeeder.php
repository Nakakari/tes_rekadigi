<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dokumen')->insert(
            [
                [
                    'nama' => "umkm4.jpg",
                    'path' => "umkm4.jpg",
                    'id_kegiatan' => NULL,
                    'id_berita' => 1,
                ],
                [
                    'nama' => "umkm5.png",
                    'path' => "umkm5.png",
                    'id_kegiatan' => 1,
                    'id_berita' => NULL,
                ],
            ]
        );
    }
}

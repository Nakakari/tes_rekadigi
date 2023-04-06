<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // \App\Models\User::factory(10)->create();
        $this->call([
            PermissionTableSeeder::class,
            RoleAssigmentSeeder::class,
            KategoriSeeder::class,
            BeritaSeeder::class,
            KegiatanSeeder::class,
            DokumenSeeder::class,
            BerandaSeeder::class,
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authorities = config('permission.authorities');

        $listPermission = [];
        $adminPermissions = [];
        $mitraPermissions = [];
        $unitPermissions = [];
        $pengelolaPermissions = [];
        $unverifPermissions = [];

        foreach ($authorities as $label => $permission) {
            foreach ($permission as $permission) {
                $listPermission[] = [
                    'name' => $permission,
                    'guard_name' => 'web',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                $adminPermissions[] = $permission;
                //admin
                // if (in_array($label, [
                //     'manage_mitra', 'manage_roles', 'manage_users', 'manage_profil'
                // ])) {
                //     $adminPermissions[] = [
                //         'mitra_show', 'mitra_create', 'mitra_update', 'mitra_detail', 'mitra_delete',
                //         'role_show', 'role_create', 'role_update', 'role_detail', 'role_delete',
                //         'user_show', 'user_create', 'user_update', 'user_detail', 'user_delete',
                //         'profil_show', 'profil_update',
                //         'berita_show', 'berita_create', 'berita_update', 'berita_detail', 'berita_delete',
                //         'kegiatan_show', 'kegiatan_create', 'kegiatan_update', 'kegiatan_detail', 'kegiatan_delete',
                //         'produk_show', 'produk_create', 'produk_update', 'produk_detail', 'produk_delete'
                //     ];
                // }
                //mitra
                if (in_array($label, [
                    'manage_mitra', 'manage_profil'
                ])) {
                    $mitraPermissions[] = [
                        'mitra_show', 'mitra_create', 'mitra_update', 'mitra_detail', 'mitra_delete', 'profil_show', 'profil_update'
                    ];
                }
                //unit
                if (in_array($label, [
                    'manage_mitra', 'manage_profil'
                ])) {
                    $unitPermissions[] = [
                        'mitra_show', 'mitra_detail', 'profil_show', 'profil_update'
                    ];
                }
                //pengelola
                if (in_array($label, [
                    'manage_mitra', 'manage_profil', 'manage_berita', 'manage_produk', 'manage_kegiatan'
                ])) {
                    $pengelolaPermissions[] = [
                        'mitra_show', 'mitra_detail', 'profil_show', 'profil_update',
                        'produk_isaktif', 'berita_isaktif', 'kegiatan_isaktif'
                    ];
                }
                //unverif
                if (in_array($label, [
                    'manage_profil'
                ])) {
                    $unverifPermissions[] = [
                        'profil_show', 'profil_update'
                    ];
                }
            }
        }


        //INSERT PERMISSION
        Permission::insert($listPermission);

        //Admin
        $admin = Role::create([
            'name' => "Admin",
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //Pengelola
        $pengelola = Role::create([
            'name' => "Pengelola",
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //Unit
        $unit = Role::create([
            'name' => "Unit",
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //Mitra
        $mitra = Role::create([
            'name' => "Mitra",
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //Unverif
        $unverif = Role::create([
            'name' => "Unverif",
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // Role -> permission
        $admin->givePermissionTo($adminPermissions);
        $pengelola->givePermissionTo($pengelolaPermissions);
        $unit->givePermissionTo($unitPermissions);
        $mitra->givePermissionTo($mitraPermissions);
        $unverif->givePermissionTo($unverifPermissions);

        // User::find(1)->assignRole("Admin");
        $useradmin = User::create([
            'id' => 1,
            'name' => 'Tri Wulandari',
            'email' => 'wdari0161@gmail.com',
            'role' => 1,
            'multirole' => "1, 2",
            'image' => 'ayanan.jpg',
            'is_aktif' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'remember_token' => Str::random(10),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        // $userunverif = User::create([
        //     'id' => 2,
        //     'name' => 'Mitra 1',
        //     'email' => 'mitra@gmail.com',
        //     'role' => 2,
        //     'multirole' => "2,4",
        //     'image' => 'ayanan.jpg',
        //     'is_aktif' => 0,
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('admin123'),
        //     'remember_token' => Str::random(10),
        //     'created_at' => date("Y-m-d H:i:s"),
        //     'updated_at' => date("Y-m-d H:i:s"),
        // ]);
        $userunverif = User::create([
            'id' => 2,
            'name' => 'Sari Eka',
            'email' => 'sarienm2001@gmail.com',
            'role' => 1,
            'multirole' => "1,2,3,4",
            'image' => 'ayanan.jpg',
            'is_aktif' => 1,
            'email_verified_at' => now(),
            'password' => "",
            'remember_token' => Str::random(10),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        $role = $admin;

        $useradmin->assignRole([$admin]);
        $userunverif->assignRole([$unverif]);
    }
}

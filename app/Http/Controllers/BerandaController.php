<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Berita;
use App\Models\Beranda;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Models\RoleAssignment;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class BerandaController extends Controller
{
    public function landing()
    {
        $beranda = Beranda::all();

        $total_kegiatan = count(Kegiatan::all());
        $total_berita = count(Berita::all());
        $berita = Berita::latest()->take(3)->get();
        return view('landing.index', compact(
            'beranda',
            'total_kegiatan',
            'total_berita',
            'berita'
        ));
    }

    public function index()
    {
        $rolenm = DB::table('roles')->where('id', Auth()->user()->role)->first();
        $assignrole = $rolenm->name;
        $user = User::all()->where('id', Auth()->user()->id)->first()->syncRoles($assignrole);
        $users = DB::table('users')->get();
        $role = DB::table('roles')->get();
        $tabelRole =  Role::all();
        $roleAssignment = RoleAssignment::all();
        $beranda = Beranda::all();

        return view('pengaturan.beranda.index_beranda', compact(
            'users',
            'role',
            'tabelRole',
            'roleAssignment',
            'beranda',
        ));
    }

    public function process_beranda(Request $request)
    {
        // save the input to database
        $add = Beranda::findOrFail(1)->update([
            'judul_beranda' => $request->judul_beranda,
            'about_beranda' => $request->about_beranda,
        ]);

        if ($add) {
            return redirect('/beranda')->with("success", "Data berhasil ditambahkan");
        } else {
            return redirect('/beranda')->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function process_kegiatan(Request $request)
    {
        // save the input to database
        $add = Beranda::findOrFail(1)->update([
            'judul_kegiatan' => $request->judul_kegiatan,
            'about_kegiatan' => $request->about_kegiatan,
        ]);

        if ($add) {
            return redirect('/beranda')->with("success", "Data berhasil ditambahkan");
        } else {
            return redirect('/beranda')->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function process_berita(Request $request)
    {
        // save the input to database
        $add = Beranda::findOrFail(1)->update([
            'judul_berita' => $request->judul_berita,
            'about_berita' => $request->about_berita,
        ]);

        if ($add) {
            return redirect('/beranda')->with("success", "Data berhasil ditambahkan");
        } else {
            return redirect('/beranda')->withInput()->withErrors("Terjadi kesalahan");
        }
    }
}

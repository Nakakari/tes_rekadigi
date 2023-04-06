<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\RoleAssignment;
use App\Models\User as Usernya;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:kategoripostingan_create', ['only' => 'addNew']);
        $this->middleware('permission:kategoripostingan_delete', ['only' => 'delete']);
        $this->middleware('permission:kategoripostingan_detail', ['only' => 'show']);
        $this->middleware('permission:kategoripostingan_show', ['only' => 'index']);
        $this->middleware('permission:kategoripostingan_update', ['only' => 'update']);
    }
    public function index()
    {
        $rolenm = DB::table('roles')->where('id', Auth()->user()->role)->first();
        $assignrole = $rolenm->name;
        $user = Usernya::all()->where('id', Auth()->user()->id)->first()->syncRoles($assignrole);
        $users = DB::table('users')->get();
        $role = DB::table('roles')->get();
        $tabelRole =  Role::all();
        $roleAssignment = RoleAssignment::all();
        $kategori = Kategori::all();

        return view('pengaturan.kategori.index_kategori', compact(
            'users',
            'role',
            'tabelRole',
            'roleAssignment',
            'kategori'
        ));
    }

    public function addNew()
    {
        $rolenm = DB::table('roles')->where('id', Auth()->user()->role)->first();
        $assignrole = $rolenm->name;
        $user = Usernya::all()->where('id', Auth()->user()->id)->first()->syncRoles($assignrole);
        $users = DB::table('users')->get();
        $role = DB::table('roles')->get();
        $tabelRole =  Role::all();
        $roleAssignment = RoleAssignment::all();

        return view('pengaturan.kategori.create_kategori', compact(
            'users',
            'role',
            'tabelRole',
            'roleAssignment',
        ));
    }

    public function create(Request $request)
    {
        // save the input to database
        $addKategori = Kategori::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
        ]);
        $addKategori->save();

        if ($addKategori) {
            return redirect('/kategori')->with("success", "Data berhasil ditambahkan");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function Edit($id)
    {
        $id = base64_decode($id);
        $rolenm = DB::table('roles')->where('id', Auth()->user()->role)->first();
        $assignrole = $rolenm->name;
        $user = Usernya::all()->where('id', Auth()->user()->id)->first()->syncRoles($assignrole);
        $users = DB::table('users')->get();
        $role = DB::table('roles')->get();
        $tabelRole =  Role::all();
        $roleAssignment = RoleAssignment::all();
        $kategori = Kategori::where('id', $id)->first();

        return view('pengaturan.kategori.edit_kategori', compact(
            'id',
            'users',
            'role',
            'tabelRole',
            'roleAssignment',
            'kategori'

        ));
        // dd($berita);
    }

    public function UpdateProcess(Request $request, $id)
    {
        $id = base64_decode($id);
        $process = Kategori::findOrFail($id)->update($request->except('_token', 'files'));

        if ($process) {
            return redirect('/kategori')->with("success", "Data berhasil diperbarui");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function delete($id)
    {
        $id = base64_decode($id);
        try {
            $process = Kategori::findOrFail($id)->delete();
            if ($process) {
                return redirect()->back()->with("success", "Data berhasil dihapus");
            } else {
                return redirect()->back()->withErrors("Terjadi kesalahan saat menghapus data");
            }
        } catch (\Exception $e) {
            abort(404);
        }
    }
}

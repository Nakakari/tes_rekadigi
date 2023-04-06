<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use App\Models\RoleAssignment;
use App\Models\User as Usernya;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Komentar;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:berita_create', ['only' => 'addNew']);
        $this->middleware('permission:berita_delete', ['only' => 'delete']);
        $this->middleware('permission:berita_detail', ['only' => 'show']);
        $this->middleware('permission:berita_show', ['only' => 'index']);
        $this->middleware('permission:berita_update', ['only' => 'update']);
        $this->middleware('auth');
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

        $berita = DB::table('berita')
            ->join('kategori', 'berita.id_kategori', '=', 'kategori.id')
            ->select('berita.*',  'kategori.nama as nama_kategori')->get();

        return view('dashboard.berita.index_berita', compact(
            'users',
            'role',
            'tabelRole',
            'roleAssignment',
            'berita',
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
        $kategori = Kategori::where('jenis', 'Berita')->get();


        return view('dashboard.berita.create_berita', compact(
            'users',
            'role',
            'tabelRole',
            'roleAssignment',
            'kategori'
        ));
    }

    public function create(Request $request)
    {
        // save the input to database
        $addBerita = Berita::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'is_aktif' => $request->is_aktif,
            'id_kategori' => $request->id_kategori,
            'created_by' => $request->created_by,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at,
        ]);
        $addBerita->save();

        if ($addBerita) {
            // insert multiple image 
            $data = [];
            $beritaAs = new Berita();
            $idBerita = $beritaAs->select('id')->where('judul', $request->judul)->first();
            if ($request->hasFile('files')) {
                // $image = $request->file('files');
                foreach ($request->file('files') as $y => $image) {
                    $name = $image->getClientOriginalName();
                    $image->move(public_path() . '/dokumen/berita/', $name);
                    // $data[] = $name;
                    $data[$y]['nama'] = $name;
                    $data[$y]['path'] = $name;
                    $data[$y]['id_kegiatan'] = null;
                    $data[$y]['id_berita'] = $idBerita['id'];
                }
                // return ($data);
                Dokumen::insert($data);
            }
            return redirect('/berita')->with("success", "Data berhasil ditambahkan");
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
        $berita =  Berita::where('id', $id)->first();
        $kategori = Kategori::where('jenis', 'Berita')->get();


        return view('dashboard.berita.edit_berita', compact(
            'id',
            'users',
            'role',
            'tabelRole',
            'roleAssignment',
            'berita',
            'kategori'

        ));
        // dd($berita);
    }

    public function UpdateProcess(Request $request, $id)
    {
        $update = $request->except('_token', 'files', 'rdio');
        $id = base64_decode($id);
        $process = Berita::findOrFail($id)->update($update);

        if ($process && !empty($request->file('files')) == 1) {

            $data = [];

            foreach ($request->file('files') as $y => $image) {
                $name = $image->getClientOriginalName();
                $image->move(public_path() . '/dokumen/berita/', $name);
                $data[$y]['nama'] = $name;
                $data[$y]['path'] = $name;
                $data[$y]['id_kegiatan'] = null;
                $data[$y]['id_berita'] = $id;
            }
            // return ($data);
            Dokumen::insert($data);
            return redirect('/berita');
        } elseif ($process && empty($request->file('files')) == 1) {
            return redirect('/berita')->with("success", "Data berhasil diperbarui");
        } else {
            return redirect('/berita')->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function isAktif(Request $request)
    {
        $berita = Berita::find($request->id);
        $berita->is_aktif = $request->is_aktif;
        $berita->save();
        return response()->json(['success' => 'Status change successfully.']);
    }

    public function delete($id)
    {
        $id = base64_decode($id);

        //menghapus di folder publik laravel
        $fileberita = Dokumen::where('id_berita', $id)->first();
        File::delete('dokumen/berita/' . $fileberita->nama);

        try {
            $process = Berita::findOrFail($id)->delete();
            if ($process) {
                return redirect()->back()->with("success", "Data berhasil dihapus");
            } else {
                return redirect()->back()->withErrors("Terjadi kesalahan saat menghapus data");
            }
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function thumbnail($id)
    {
        $id = base64_decode($id);
        $rolenm = DB::table('roles')->where('id', Auth()->user()->role)->first();
        $assignrole = $rolenm->name;
        $user = Usernya::all()->where('id', Auth()->user()->id)->first()->syncRoles($assignrole);
        $users = DB::table('users')->get();
        $role = DB::table('roles')->get();
        $tabelRole =  Role::all();
        $roleAssignment = RoleAssignment::all();
        $berita =  Berita::where('id', $id)->first();

        return view('dashboard.berita.thumbnail_berita', compact(
            'id',
            'users',
            'role',
            'tabelRole',
            'roleAssignment',
            'berita'

        ));
    }

    public function addThumbnail(Request $request, $id)
    {
        $id = base64_decode($id);
        $berita = Berita::find($id);
        $berita->thumbnail = $request->thumbnail;
        $berita->save();
        if ($berita->save()) {
            return redirect('/berita')->with("success", "Data berhasil diperbarui");
        } else {
            return redirect()->back()->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function detail($id)
    {
        $id = base64_decode($id);
        $rolenm = DB::table('roles')->where('id', Auth()->user()->role)->first();
        $assignrole = $rolenm->name;
        $user = Usernya::all()->where('id', Auth()->user()->id)->first()->syncRoles($assignrole);
        $users = DB::table('users')->get();
        $role = DB::table('roles')->get();
        $tabelRole =  Role::all();
        $roleAssignment = RoleAssignment::all();
        $berita =  Berita::where('id', $id)->first();
        $total_komentar = count(Komentar::all()->where('id_berita', $id));

        return view('dashboard.berita.detail_berita', compact(
            'id',
            'users',
            'role',
            'tabelRole',
            'roleAssignment',
            'berita',
            'total_komentar'
        ));
    }

    public function delete_gambar($id)
    {
        $id = base64_decode($id);
        //menghapus di folder publik laravel
        $fileberita = Dokumen::where('id', $id)->get();
        File::delete('dokumen/berita/' . $fileberita->nama);
        $delete = Dokumen::where('id', $id)->delete();
        if ($delete) {
            return redirect()->back()->with("success", "Data berhasil dihapus");
        } else {
            return redirect()->back()->withErrors("Terjadi kesalahan saat menghapus data");
        }
    }
}

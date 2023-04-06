<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Kategori;
use App\Models\Kegiatan;
use App\Models\Komentar;
use Illuminate\Http\Request;
use App\Models\RoleAssignment;
use App\Models\User as Usernya;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class KegiatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:kegiatan_create', ['only' => 'addNew']);
        $this->middleware('permission:kegiatan_delete', ['only' => 'delete']);
        $this->middleware('permission:kegiatan_detail', ['only' => 'show']);
        $this->middleware('permission:kegiatan_show', ['only' => 'index']);
        $this->middleware('permission:kegiatan_update', ['only' => 'update']);
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


        $kegiatan = DB::table('kegiatan')
            ->join('kategori', 'kegiatan.id_kategori', '=', 'kategori.id')
            ->select('kegiatan.*', 'kategori.nama as nama_kategori')->get();

        return view('dashboard.kegiatan.index_kegiatan', compact(
            'users',
            'role',
            'tabelRole',
            'roleAssignment',
            'kegiatan',
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
        $kegiatan = Kegiatan::all();
        $kategori = Kategori::where('jenis', 'Kegiatan')->get();

        return view('dashboard.kegiatan.create_kegiatan', compact(
            'users',
            'role',
            'tabelRole',
            'roleAssignment',
            'kategori',
            'kegiatan',
        ));
    }

    public function create(Request $request)
    {
        // save the input to database
        $addKegiatan = Kegiatan::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tgl_pelaksanaan' => $request->tgl_pelaksanaan,
            'is_aktif' => $request->is_aktif,
            'id_kategori' => $request->id_kategori,
            'created_by' => $request->created_by,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at,
        ]);
        $addKegiatan->save();

        if ($addKegiatan) {
            // insert multiple image 
            $data = [];
            $KegiatanAs = new Kegiatan();
            $idKegiatan = $KegiatanAs->select('id')->where('judul', $request->judul)->first();
            if ($request->hasFile('files')) {
                // $image = $request->file('files');
                foreach ($request->file('files') as $y => $image) {
                    $name = $image->getClientOriginalName();
                    $image->move(public_path() . '/dokumen/kegiatan/', $name);
                    // $data[] = $name;
                    $data[$y]['nama'] = $name;
                    $data[$y]['path'] = $name;
                    $data[$y]['id_kegiatan'] = $idKegiatan['id'];
                    $data[$y]['id_berita'] = null;
                }
                // return ($data);
                Dokumen::insert($data);
            }
            return redirect('/kegiatan')->with("success", "Data berhasil ditambahkan");
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
        $kegiatan =  Kegiatan::where('id', $id)->first();
        $kategori = Kategori::where('jenis', 'Kegiatan')->get();

        return view('dashboard.kegiatan.edit_kegiatan', compact(
            'id',
            'users',
            'role',
            'tabelRole',
            'roleAssignment',
            'kegiatan',
            'kategori'
        ));
    }

    public function UpdateProcess(Request $request, $id)
    {
        $update = $request->except('_token', 'files', 'rdio');
        $id = base64_decode($id);
        $process = Kegiatan::findOrFail($id)->update($update);

        if ($process && !empty($request->file('files')) == 1) {

            $data = [];

            foreach ($request->file('files') as $y => $image) {
                $name = $image->getClientOriginalName();
                $image->move(public_path() . '/dokumen/kegiatan/', $name);
                $data[$y]['nama'] = $name;
                $data[$y]['path'] = $name;
                $data[$y]['id_kegiatan'] = $id;
                $data[$y]['id_berita'] = null;
            }
            // return ($data);
            Dokumen::insert($data);
            return redirect('/kegiatan');
        } elseif ($process && empty($request->file('files')) == 1) {
            return redirect('/kegiatan')->with("success", "Data berhasil diperbarui");
        } else {
            return redirect('/kegiatan')->withInput()->withErrors("Terjadi kesalahan");
        }
    }

    public function isAktif(Request $request)
    {
        $kegiatan = Kegiatan::find($request->id);
        $kegiatan->is_aktif = $request->is_aktif;
        $kegiatan->save();
        return response()->json(['success' => 'Status change successfully.']);
    }

    public function delete($id)
    {
        $id = base64_decode($id);

        //menghapus di folder publik laravel
        $file_kegiatan = Dokumen::where('id_kegiatan', $id)->first();
        File::delete('dokumen/kegiatan/' . $file_kegiatan->nama);

        try {
            $process = Kegiatan::findOrFail($id)->delete();
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
        $kegiatan =  Kegiatan::where('id', $id)->first();

        return view('dashboard.kegiatan.thumbnail_kegiatan', compact(
            'id',
            'users',
            'role',
            'tabelRole',
            'roleAssignment',
            'kegiatan'

        ));
    }

    public function addThumbnail(Request $request, $id)
    {
        $id = base64_decode($id);
        $kegiatan = Kegiatan::find($id);
        $kegiatan->thumbnail = $request->thumbnail;
        $kegiatan->save();
        if ($kegiatan->save()) {
            return redirect('/kegiatan')->with("success", "Data berhasil diperbarui");
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
        $kegiatan = Kegiatan::where('id', $id)->first();
        $total_komentar = count(Komentar::all()->where('id_kegiatan', $id));

        return view('dashboard.kegiatan.detail_kegiatan', compact(
            'id',
            'users',
            'role',
            'tabelRole',
            'roleAssignment',
            'kegiatan',
            'total_komentar'
        ));
        // return $total_komentar;
    }

    public function delete_gambar($id)
    {
        $id = base64_decode($id);

        //menghapus di folder publik laravel
        $filekegiatan = Dokumen::where('id', $id)->first();
        File::delete('dokumen/kegiatan/' . $filekegiatan->nama);
        $delete = Dokumen::where('id', $id)->delete();
        if ($delete) {
            return redirect()->back()->with("success", "Data berhasil dihapus");
        } else {
            return redirect()->back()->withErrors("Terjadi kesalahan saat menghapus data");
        }
    }
}

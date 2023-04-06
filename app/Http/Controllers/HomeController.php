<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kegiatan;
use App\Models\Kategori;
use App\Models\Komentar;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function news()
    {
        $komentar = Komentar::all();
        $berita = Berita::where('is_aktif', 1)->orderBy('created_at', 'desc')->paginate(4);
        $kategori = Kategori::where('jenis', 'Berita')->get();

        //    hitung total per kategori
        $count = [];
        foreach ($kategori as $k) {
            $count[$k->id] = count(Berita::all()->where('id_kategori', $k->id));
        }

        return view('landing.news', compact(
            'komentar',
            'berita',
            'kategori',
            'count'
        ));
    }
    public function news_category($namakategori)
    {
        $komentar = Komentar::all();
        $pilihkategori = Kategori::where('jenis', 'Berita')
            ->where('nama', $namakategori)
            ->get();
        $berita = Berita::where('is_aktif', 1)
            ->where('id_kategori', $pilihkategori[0]->id)
            ->orderBy('created_at', 'desc')->paginate(4);
        $kategori = Kategori::where('jenis', 'Berita')->get();

        //    hitung total per kategori
        $count = [];
        foreach ($kategori as $k) {
            $count[$k->id] = count(Berita::all()->where('id_kategori', $k->id));
        }

        return view('landing.news', compact(
            'komentar',
            'berita',
            'kategori',
            'count'
        ));
        // return $pilihkategori[0]->id;
    }
    public function news_search(Request $request)
    {
        $search = $request->search;
        $komentar = Komentar::all();
        $kategori = Kategori::where('jenis', 'Berita')->get();
        $berita = Berita::where('is_aktif', 1)
            ->where('is_aktif', 1)
            ->where('judul', 'LIKE', '%' . $search . '%')
            ->orderBy('created_at', 'desc')->paginate(4);

        return view('landing.news', compact(
            'komentar',
            'berita',
            'kategori',
            'search'
        ));
    }

    public function news_page($id)
    {
        $id = base64_decode($id);
        $users = DB::table('users')->get();
        $berita = Berita::where('id', $id)->first();

        return view('dashboard.berita.page_news', compact(
            'users',
            'berita',
        ));
    }

    public function activities()
    {
        $komentar = Komentar::all();
        $kegiatan = Kegiatan::where('is_aktif', 1)->orderBy('created_at', 'desc')->paginate(4);;
        $kategori = Kategori::where('jenis', 'Kegiatan')->get();

        //    hitung total per kategori
        $count = [];
        foreach ($kategori as $k) {
            $count[$k->id] = count(Kegiatan::all()->where('id_kategori', $k->id));
        }

        return view('landing.activities', compact(
            'komentar',
            'kegiatan',
            'kategori',
            'count'
        ));
    }

    public function activities_category($namakategori)
    {
        $komentar = Komentar::all();
        $pilihkategori = Kategori::where('jenis', 'Kegiatan')
            ->where('nama', $namakategori)
            ->get();
        $kategori = Kategori::where('jenis', 'Kegiatan')->get();

        $kegiatan = Kegiatan::where('is_aktif', 1)
            ->where('id_kategori', $pilihkategori[0]->id)
            ->orderBy('created_at', 'desc')->paginate(4);

        //    hitung total per kategori
        $count = [];
        foreach ($kategori as $k) {
            $count[$k->id] = count(Kegiatan::all()->where('id_kategori', $k->id));
        }

        return view('landing.activities', compact(
            'komentar',
            'kegiatan',
            'kategori',
            'count'
        ));
    }

    public function activities_search(Request $request)
    {
        $search = $request->search;
        $komentar = Komentar::all();
        $kegiatan = Kegiatan::where('is_aktif', 1)
            ->where('judul', 'LIKE', '%' . $search . '%')
            ->orderBy('created_at', 'desc')->paginate(4);
        $kategori = Kategori::where('jenis', 'Kegiatan')->get();

        return view('landing.activities', compact(
            'mitra',
            'komentar',
            'kegiatan',
            'kategori',
            'search'
        ));
    }
    public function activities_page($id)
    {
        $id = base64_decode($id);
        $users = DB::table('users')->get();
        $kegiatan = Kegiatan::where('id', $id)->first();

        $komentar = new Komentar();
        $comments = $komentar->all()->where('id_kegiatan', $id);

        return view('dashboard.kegiatan.page_activities', compact(
            'users',
            'kegiatan',
            'komentar',
            'comments'
        ));
    }

    public function kategori_kegiatan($id, Request $request)
    {
        $id = base64_decode($id);
        $users = DB::table('users')->get();
        $reqKategoriKegiatan = $request->kategori;
        $reqKategoriBerita = "";
        $idkategori = Kategori::where('nama', $request->kategori)
            ->where('jenis', "Kegiatan")->first();
        // $slug = $mitra->slug;
        $berita = Berita::where(['id_mitra' => $id, 'is_aktif' => '1'])->orderBy('created_at', 'desc')->paginate(4);
        if ($idkategori != null || !empty($idkategori)) {
            $kegiatan = Kegiatan::where(['id_mitra' => $id, 'is_aktif' => '1'])
                ->where('id_kategori', '=', $idkategori->id)
                ->orderBy('created_at', 'desc')->paginate(4);
        } else {
            $kegiatan = Kegiatan::where(['id_mitra' => $id, 'is_aktif' => '1'])
                ->orderBy('created_at', 'desc')->paginate(4);
        }
        $active = 'Profil'; //panel aktif
        $kategori = Kategori::all();
        $kegiatansearch = '';
        $beritasearch = '';

        return view('dashboard.mitra.page_mitra', compact(
            'users',
            'berita',
            'kegiatan',
            'active',
            'kegiatansearch',
            'beritasearch',
            'kategori',
            'id',
            'slug',
            'reqKategoriKegiatan',
            'reqKategoriBerita',
        ));
        // return $id;
    }
    public function kategori_berita($id, Request $request)
    {
        $id = base64_decode($id);
        $users = DB::table('users')->get();
        $reqKategoriProduk = "";
        $reqKategoriKegiatan = "";
        $reqKategoriBerita = $request->kategori;
        $idkategori = Kategori::where('nama', $request->kategori)
            ->where('jenis', "Berita")->first();
        if ($idkategori != null || !empty($idkategori)) {
            $berita = Berita::where(['id_mitra' => $id, 'is_aktif' => '1'])
                ->where('id_kategori', '=', $idkategori->id)->orderBy('created_at', 'desc')->paginate(4);
        } else {
            $berita = Berita::where(['id_mitra' => $id, 'is_aktif' => '1'])->orderBy('created_at', 'desc')->paginate(4);
        }
        $kegiatan = Kegiatan::where(['id_mitra' => $id, 'is_aktif' => '1'])->orderBy('created_at', 'desc')->paginate(4);
        $active = 'Profil'; //panel aktif
        $kategori = Kategori::all();
        $kegiatansearch = '';
        $beritasearch = '';


        return view('dashboard.mitra.page_mitra', compact(
            'users',
            'berita',
            'kegiatan',
            'active',
            'kegiatansearch',
            'beritasearch',
            'kategori',
            'id',
            'namamitra',
            'reqKategoriKegiatan',
            'reqKategoriBerita',
        ));
        // return $id;
    }

    public function kegiatan_search(Request $request) // di page_mitra
    {
        $users = DB::table('users')->get();
        $berita = Berita::where(['is_aktif' => '1'])->orderBy('created_at', 'desc')->paginate(4);
        $kegiatan = Kegiatan::where(['is_aktif' => '1'])
            ->where('judul', 'Like', '%' . $request->kegiatan_search . '%')
            ->orderBy('created_at', 'desc')->paginate(4);
        $active = 'Kegiatan'; //panel aktif
        $kegiatansearch = $request->kegiatan_search;

        return view('dashboard.mitra.page_mitra', compact(
            'users',
            'berita',
            'kegiatan',
            'active',
            'kegiatansearch'
        ));
    }
    public function berita_search(Request $request) // di page_mitra
    {
        $users = DB::table('users')->get();
        $berita = Berita::where(['is_aktif' => '1'])
            ->where('judul', 'Like', '%' . $request->berita_search . '%')
            ->orderBy('created_at', 'desc')->paginate(4);
        $kegiatan = Kegiatan::where(['is_aktif' => '1'])->orderBy('created_at', 'desc')->paginate(4);
        $active = 'Berita'; //panel aktif
        $beritasearch = $request->berita_search;

        return view('dashboard.mitra.page_mitra', compact(
            'users',
            'berita',
            'kegiatan',
            'active',
            'beritasearch'
        ));
    }
}

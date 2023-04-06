<?php

namespace App\Http\Controllers\ApiMitra;

use App\Models\Mitra;
use App\Http\Controllers\Controller;
use App\Models\Pendampingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiMitraController extends Controller
{
    public function index()
    {
        $mitra = DB::table('mitra')
            ->join('jenis_mitra', 'jenis_mitra.id', '=', 'mitra.id_jenis_mitra')
            ->join('unit', 'unit.id', '=', 'mitra.id_unit')
            ->join('distrik', 'distrik.id', '=', 'mitra.id_distrik')
            ->join('kota', 'kota.id', '=', 'distrik.id_kota')
            ->join('provinsi', 'provinsi.id', '=', 'kota.id_provinsi')
            ->select(
                'mitra.id',
                'mitra.nama_mitra',
                'jenis_mitra.jenis',
                'unit.nama_unit',
                'mitra.contact_person',
                'mitra.telepon',
                'mitra.whatsapp',
                'mitra.email',
                'mitra.deskripsi',
                'distrik.nama as distrik',
                'kota.nama as kota',
                'provinsi.nama as provinsi',
                'mitra.alamat',
                'mitra.longitude',
                'mitra.latitude',
                'mitra.facebook',
                'mitra.instagram',
                'mitra.shopee',
                'mitra.tokopedia'
            )
            ->get();
        return response()->json([
            "status" => true,
            "messages" => "Pengembalian indeks",
            "data" => $mitra
        ], 200);
    }
    public function show($id)
    {
        $mitra = DB::table('mitra')
            ->join('jenis_mitra', 'jenis_mitra.id', '=', 'mitra.id_jenis_mitra')
            ->join('unit', 'unit.id', '=', 'mitra.id_unit')
            ->join('distrik', 'distrik.id', '=', 'mitra.id_distrik')
            ->join('kota', 'kota.id', '=', 'distrik.id_kota')
            ->join('provinsi', 'provinsi.id', '=', 'kota.id_provinsi')
            ->select(
                'mitra.id',
                'mitra.nama_mitra',
                'jenis_mitra.jenis',
                'unit.nama_unit',
                'mitra.contact_person',
                'mitra.telepon',
                'mitra.whatsapp',
                'mitra.email',
                'mitra.deskripsi',
                'distrik.nama as distrik',
                'kota.nama as kota',
                'provinsi.nama as provinsi',
                'mitra.alamat',
                'mitra.longitude',
                'mitra.latitude',
                'mitra.facebook',
                'mitra.instagram',
                'mitra.shopee',
                'mitra.tokopedia'
            )
            ->where('mitra.id', $id)
            ->get();
        $pendampingan = DB::table('pendampingan')
            ->select(
                'id as id_pendampingan',
                'id_mitra',
                'mitra',
                'judul',
                'keterangan',
                'tahun',
                'nama_pendamping',
                'nidn',
                'fakultas',
                'prodi',
                'pendanaan'
            )
            ->where('id_mitra', $id)
            ->get();
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Mitra',
            'data' => $mitra,
            'pendampingan' => $pendampingan,
        ], 200);
    }
}

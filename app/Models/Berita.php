<?php

namespace App\Models;

use App\Models\User;
use App\Models\Dokumen;
use App\Models\Komentar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Berita extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $keyType = 'string';
    protected $table = 'berita';
    protected $guarded = [];

    public function get_dokumen()
    {
        return $this->hasMany(Dokumen::class, 'id_berita', 'id');
    }
    public function get_onepic()
    {
        return $this->belongsTo(Dokumen::class, 'thumbnail', 'id');
    }
    public function get_user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }
    public function get_mitra()
    {
        return $this->belongsTo(Mitra::class, 'id_mitra', 'id');
    }
    public function comments()
    {
        return $this->hasMany(Komentar::class, 'id_berita', 'id')->whereNull('id_parent');
    }
}

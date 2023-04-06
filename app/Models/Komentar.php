<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $keyType = 'string';
    protected $table = 'komentar';
    protected $guarded = [];
    public function iduser()
    {
        return $this->belongsTo('App\Models\User', 'id_user', 'id');
    }
    public function replies()
    {
        return $this->hasMany(Komentar::class, 'id_parent');
    }
}

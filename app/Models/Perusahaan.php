<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_perusahaan';
    protected $table = 'perusahaan';
    protected $guarded = [];
    protected $casts = [
        'id_perusahaan' => 'string',
    ];

    public function projek()
    {
        return $this->hasMany(Projek::class,'perusahaan_id','id_perusahaan');
    }
    public function rekening()
    {
        return $this->hasMany(Rekening::class,'perusahaan_id','id_perusahaan');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisRekening extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_jenis_rekening';
    protected $table = 'jenis_rekening';
    protected $guarded = [];
    protected $casts = [
        'id_jenis_rekening' => 'string',
    ];

    public function rekening()
    {
        return $this->hasMany(Rekening::class,'jenis_rekening_id','id_jenis_rekening');
    }
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class,'jenis_rekening_id','id_jenis_rekening');
    }
}
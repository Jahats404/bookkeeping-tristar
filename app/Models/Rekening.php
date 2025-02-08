<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_rekening';
    protected $table = 'rekening';
    protected $guarded = [];
    protected $casts = [
        'id_rekening' => 'string',
    ];

    public function jenis_rekening()
    {
        return $this->belongsTo(JenisRekening::class,'jenis_rekening_id','id_jenis_rekening');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class,'rekening_id','id_rekening');
    }
    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class,'perusahaan_id','id_perusahaan');
    }
    public function projek()
    {
        return $this->belongsTo(Projek::class,'projek_id','id_projek');
    }
}
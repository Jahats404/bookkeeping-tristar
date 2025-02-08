<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_transaksi';
    protected $table = 'transaksi';
    protected $guarded = [];
    protected $casts = [
        'id_transaksi' => 'string',
    ];

    public function jenis_rekening()
    {
        return $this->belongsTo(JenisRekening::class,'jenis_rekening_id','id_jenis_rekening');
    }
    public function rekening()
    {
        return $this->belongsTo(Rekening::class,'rekening_id','id_rekening');
    }
    public function detail_transaksi()
    {
        return $this->hasOne(DetailTransaksi::class,'transaksi_id','id_transaksi');
    }
}
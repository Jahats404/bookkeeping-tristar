<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_detail_transaksi';
    protected $table = 'detail_transaksi';
    protected $guarded = [];
    protected $casts = [
        'id_detail_transaksi' => 'string',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class,'transaksi_id','id_transaksi');
    }
    public function projek()
    {
        return $this->belongsTo(Projek::class,'projek_id','id_projek');
    }
}
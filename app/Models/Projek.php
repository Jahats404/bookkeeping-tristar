<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projek extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_projek';
    protected $table = 'projek';
    protected $guarded = [];
    protected $casts = [
        'id_projek' => 'string',
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class,'perusahaan_id','id_perusahaan');
    }
    public function projek()
    {
        return $this->hasMany(Projek::class,'projek_id','id_projek');
    }
    public function detail_transaksi()
    {
        return $this->hasMany(DetailTransaksi::class,'projek_id','id_projek');
    }


    public static $rules = [
        // 'id_projek'         => 'required|string|unique:projek,id_projek|max:255',
        'nama_projek'       => 'required|string|max:255',
        'no_kontrak'        => 'required|integer|min:1',
        'nominal_kontrak'   => 'required|numeric|min:0',
        'durasi'            => 'required|string|max:255',
        'tanggal_mulai'     => 'required|date|before_or_equal:tanggal_selesai',
        'tanggal_selesai'   => 'required|date|after_or_equal:tanggal_mulai',
        'perusahaan_id'     => 'required|string|exists:perusahaan,id_perusahaan'
    ];
    
    public static $messages = [
        'id_projek.required'        => 'ID Projek wajib diisi.',
        'id_projek.string'          => 'ID Projek harus berupa teks.',
        'id_projek.unique'          => 'ID Projek sudah digunakan, silakan pilih yang lain.',
        'id_projek.max'             => 'ID Projek tidak boleh lebih dari 255 karakter.',
    
        'nama_projek.required'      => 'Nama Projek wajib diisi.',
        'nama_projek.string'        => 'Nama Projek harus berupa teks.',
        'nama_projek.max'           => 'Nama Projek tidak boleh lebih dari 255 karakter.',
    
        'no_kontrak.required'       => 'Nomor Kontrak wajib diisi.',
        'no_kontrak.integer'        => 'Nomor Kontrak harus berupa angka.',
        'no_kontrak.min'            => 'Nomor Kontrak harus lebih besar dari 0.',
    
        'nominal_kontrak.required'  => 'Nominal Kontrak wajib diisi.',
        'nominal_kontrak.numeric'   => 'Nominal Kontrak harus berupa angka.',
        'nominal_kontrak.min'       => 'Nominal Kontrak tidak boleh kurang dari 0.',
    
        'durasi.required'           => 'Durasi wajib diisi.',
        'durasi.string'             => 'Durasi harus berupa teks.',
        'durasi.max'                => 'Durasi tidak boleh lebih dari 255 karakter.',
    
        'tanggal_mulai.required'    => 'Tanggal Mulai wajib diisi.',
        'tanggal_mulai.date'        => 'Tanggal Mulai harus berupa format tanggal yang valid.',
        'tanggal_mulai.before_or_equal' => 'Tanggal Mulai tidak boleh lebih dari Tanggal Selesai.',
    
        'tanggal_selesai.required'  => 'Tanggal Selesai wajib diisi.',
        'tanggal_selesai.date'      => 'Tanggal Selesai harus berupa format tanggal yang valid.',
        'tanggal_selesai.after_or_equal' => 'Tanggal Selesai harus sama atau setelah Tanggal Mulai.',
    
        'perusahaan_id.required'    => 'Perusahaan ID wajib diisi.',
        'perusahaan_id.string'      => 'Perusahaan ID harus berupa teks.',
        'perusahaan_id.exists'      => 'Perusahaan ID tidak ditemukan dalam database.'
    ];
}
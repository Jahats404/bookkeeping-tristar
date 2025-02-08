<?php

namespace App\Http\Controllers\kas;

use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;
use App\Models\JenisRekening;
use App\Models\Projek;
use App\Models\Rekening;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AbkKasController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::all();
        $jenisRekening = JenisRekening::all();
        $projek = Projek::all();
        
        return view('abk.kas-besar.index',compact('transaksi','jenisRekening','projek'));
    }

    public function getRekening($jenis_rekening_id)
    {
        $rekening = Rekening::where('jenis_rekening_id', $jenis_rekening_id)->distinct()->get();
        return response()->json($rekening);
    }

    public function getRekeningUpdate($jenis_rekening_id)
    {
        $rekening = Rekening::where('jenis_rekening_id', $jenis_rekening_id)->get();
        return response()->json($rekening);
    }
    
    public function store(Request $request)
    {
        $rules = [
            // Validasi untuk transaksi
            'tanggal_transaksi' => 'required|date',
            'rekening_id' => 'required|string|exists:rekening,id_rekening',
    
            // Validasi untuk detail_transaksi
            'jenis_biaya' => 'nullable|string|in:Material,Umum,Upah',
            'jenis_transaksi' => 'nullable|string',
            'dpp' => 'nullable|numeric|min:0',
            'pajak' => 'nullable|integer|min:0|max:100',
            'nominal_pajak' => 'nullable|numeric|min:0',
            'nominal_akhir' => 'nullable|numeric|min:0',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'invoice' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'dokumen_lain' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'keterangan' => 'nullable|string',
    
            'projek_id' => 'nullable|exists:projek,id_projek',
            'jenis_rekening_id' => 'required|string|exists:jenis_rekening,id_jenis_rekening',
        ];
    
        $messages = [
            'tanggal_transaksi.required' => 'Tanggal transaksi wajib diisi.',
            'tanggal_transaksi.date' => 'Tanggal transaksi harus berupa format tanggal yang valid.',
            'jenis_rekening_id.required' => 'Jenis rekening wajib dipilih.',
            'jenis_rekening_id.exists' => 'Jenis rekening tidak ditemukan di database.',
            'rekening_id.required' => 'Rekening wajib dipilih.',
            'rekening_id.exists' => 'Rekening tidak ditemukan di database.',
    
            'jenis_biaya.required' => 'Jenis Biaya wajib diisi.',
            'jenis_biaya.in' => 'Jenis biaya hanya boleh Material, Umum, atau Upah.',
            'dpp.numeric' => 'DPP harus berupa angka.',
            'dpp.min' => 'DPP tidak boleh negatif.',
            'pajak.integer' => 'Pajak harus berupa angka bulat.',
            'pajak.min' => 'Pajak tidak boleh negatif.',
            'pajak.max' => 'Pajak tidak boleh lebih dari 100%.',
            'nominal_pajak.numeric' => 'Nominal pajak harus berupa angka.',
            'nominal_pajak.min' => 'Nominal pajak tidak boleh negatif.',
            'nominal_akhir.numeric' => 'Nominal akhir harus berupa angka.',
            'nominal_akhir.min' => 'Nominal akhir tidak boleh negatif.',
            'bukti_pembayaran.mimes' => 'Bukti pembayaran harus berupa file JPG, JPEG, PNG, atau PDF.',
            'bukti_pembayaran.max' => 'Ukuran bukti pembayaran tidak boleh lebih dari 2MB.',
            'dokumen_lain.mimes' => 'Dokumen lain harus berupa file JPG, JPEG, PNG, atau PDF.',
            'dokumen_lain.max' => 'Ukuran dokumen lain tidak boleh lebih dari 2MB.',
            'transaksi_id.required' => 'Transaksi ID wajib diisi.',
            'transaksi_id.exists' => 'Transaksi ID tidak ditemukan di database.',
            'projek_id.required' => 'Projek wajib dipilih.',
            'projek_id.exists' => 'Projek tidak ditemukan di database.',
        ];

        $cekJr = JenisRekening::find($request->jenis_rekening_id);
        if ($cekJr->jenis_rekening == 'Projek') {
            $rules = array_merge($rules, [
                'jenis_biaya' => 'required',
                'projek_id' => 'required',
            ]);
        }

        $validasi = $request->validate($rules,$messages);

        $transaksi = new Transaksi();
        $transaksi->id_transaksi = 'TR' . str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        $transaksi->tanggal_transaksi = $request->tanggal_transaksi;
        $transaksi->jenis_rekening_id = $request->jenis_rekening_id;
        $transaksi->rekening_id = $request->rekening_id;

        $dt = new DetailTransaksi();
        $dt->id_detail_transaksi = 'DTR' . str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        if ($cekJr->jenis_rekening == 'Projek') {
            $dt->jenis_biaya = $request->jenis_biaya;
            $dt->projek_id = $request->projek_id;
        }
        $dt->jenis_transaksi = $request->jenis_transaksi;
        $dt->dpp = $request->dpp;
        $dt->pajak = $request->pajak;
        $dt->nominal_pajak = $request->nominal_pajak;
        $dt->nominal_akhir = $request->nominal_akhir;
        $dt->nominal_akhir = $request->nominal_akhir;
        
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');

            $path = 'uploads/bukti_pembayaran';

            // Simpan file baru
            $dt->bukti_pembayaran = $file->store($path, 'public');
        }

        if ($request->hasFile('invoice')) {
            $file = $request->file('invoice');

            $path = 'uploads/invoice';

            // Simpan file baru
            $dt->invoice = $file->store($path, 'public');
        }

        if ($request->hasFile('dokumen_lain')) {
            $file = $request->file('dokumen_lain');

            $path = 'uploads/dokumen_lain';

            // Simpan file baru
            $dt->dokumen_lain = $file->store($path, 'public');
        }

        $dt->keterangan = $request->keterangan;
        $dt->transaksi_id = $transaksi->id_transaksi;
        $dt->projek_id = $request->projek_id;
        $transaksi->save();
        $dt->save();

        return redirect()->back()->with('success','Kas Besar berhasil ditambahkan');
    }

    public function update(Request $request,$id)
    {
        $rules = [
            // Validasi untuk transaksi
            'tanggal_transaksi' => 'required|date',
            'rekening_id' => 'required|string|exists:rekening,id_rekening',
    
            // Validasi untuk detail_transaksi
            'jenis_biaya' => 'nullable|string|in:Material,Umum,Upah',
            'jenis_transaksi' => 'nullable|string',
            'dpp' => 'nullable|numeric|min:0',
            'pajak' => 'nullable|integer|min:0|max:100',
            'nominal_pajak' => 'nullable|numeric|min:0',
            'nominal_akhir' => 'nullable|numeric|min:0',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'invoice' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'dokumen_lain' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'keterangan' => 'nullable|string',
    
            'projek_id' => 'nullable|exists:projek,id_projek',
            'jenis_rekening_id' => 'required|string|exists:jenis_rekening,id_jenis_rekening',
        ];
    
        $messages = [
            'tanggal_transaksi.required' => 'Tanggal transaksi wajib diisi.',
            'tanggal_transaksi.date' => 'Tanggal transaksi harus berupa format tanggal yang valid.',
            'jenis_rekening_id.required' => 'Jenis rekening wajib dipilih.',
            'jenis_rekening_id.exists' => 'Jenis rekening tidak ditemukan di database.',
            'rekening_id.required' => 'Rekening wajib dipilih.',
            'rekening_id.exists' => 'Rekening tidak ditemukan di database.',
    
            'jenis_biaya.required' => 'Jenis Biaya wajib diisi.',
            'jenis_biaya.in' => 'Jenis biaya hanya boleh Material, Umum, atau Upah.',
            'dpp.numeric' => 'DPP harus berupa angka.',
            'dpp.min' => 'DPP tidak boleh negatif.',
            'pajak.integer' => 'Pajak harus berupa angka bulat.',
            'pajak.min' => 'Pajak tidak boleh negatif.',
            'pajak.max' => 'Pajak tidak boleh lebih dari 100%.',
            'nominal_pajak.numeric' => 'Nominal pajak harus berupa angka.',
            'nominal_pajak.min' => 'Nominal pajak tidak boleh negatif.',
            'nominal_akhir.numeric' => 'Nominal akhir harus berupa angka.',
            'nominal_akhir.min' => 'Nominal akhir tidak boleh negatif.',
            'bukti_pembayaran.mimes' => 'Bukti pembayaran harus berupa file JPG, JPEG, PNG, atau PDF.',
            'bukti_pembayaran.max' => 'Ukuran bukti pembayaran tidak boleh lebih dari 2MB.',
            'dokumen_lain.mimes' => 'Dokumen lain harus berupa file JPG, JPEG, PNG, atau PDF.',
            'dokumen_lain.max' => 'Ukuran dokumen lain tidak boleh lebih dari 2MB.',
            'transaksi_id.required' => 'Transaksi ID wajib diisi.',
            'transaksi_id.exists' => 'Transaksi ID tidak ditemukan di database.',
            'projek_id.required' => 'Projek wajib dipilih.',
            'projek_id.exists' => 'Projek tidak ditemukan di database.',
        ];

        $cekJr = JenisRekening::find($request->jenis_rekening_id);
        if ($cekJr->jenis_rekening == 'Projek') {
            $rules = array_merge($rules, [
                'jenis_biaya' => 'required',
                'projek_id' => 'required',
            ]);
        }

        $validasi = $request->validate($rules,$messages);

        $transaksi = Transaksi::find($id);
        $transaksi->tanggal_transaksi = $request->tanggal_transaksi;
        $transaksi->jenis_rekening_id = $request->jenis_rekening_id;
        $transaksi->rekening_id = $request->rekening_id;

        $dt = DetailTransaksi::where('transaksi_id',$transaksi->id_transaksi)->first();
        if ($cekJr->jenis_rekening == 'Projek') {
            $dt->jenis_biaya = $request->jenis_biaya;
            $dt->projek_id = $request->projek_id;
        } else {
            $dt->jenis_biaya = null;
            $dt->projek_id = null;
        }
        $dt->jenis_transaksi = $request->jenis_transaksi;
        $dt->dpp = $request->dpp;
        $dt->pajak = $request->pajak;
        $dt->nominal_pajak = $request->nominal_pajak;
        $dt->nominal_akhir = $request->nominal_akhir;
        $dt->nominal_akhir = $request->nominal_akhir;
        
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');

            // Hapus file lama jika ada
            if ($dt->bukti_pembayaran) {
                // Menghapus file lama dari storage
                Storage::disk('public')->delete($dt->bukti_pembayaran);
            }

            $path = 'uploads/bukti_pembayaran';

            // Simpan file baru
            $dt->bukti_pembayaran = $file->store($path, 'public');
        }

        if ($request->hasFile('invoice')) {
            $file = $request->file('invoice');

            if ($dt->invoice) {
                Storage::disk('public')->delete($dt->invoice);
            }

            $path = 'uploads/invoice';

            // Simpan file baru
            $dt->invoice = $file->store($path, 'public');
        }

        if ($request->hasFile('dokumen_lain')) {
            $file = $request->file('dokumen_lain');

            if ($dt->dokumen_lain) {
                Storage::disk('public')->delete($dt->dokumen_lain);
            }

            $path = 'uploads/dokumen_lain';

            // Simpan file baru
            $dt->dokumen_lain = $file->store($path, 'public');
        }

        $dt->keterangan = $request->keterangan;
        $dt->transaksi_id = $transaksi->id_transaksi;
        $transaksi->save();
        $dt->save();

        return redirect()->back()->with('success','Kas Besar berhasil diperbarui');
    }

    public function delete($id)
    {
        $transaksi = Transaksi::find($id);
        $dt = DetailTransaksi::where('transaksi_id',$transaksi->id_transaksi)->first();
        if ($dt->bukti_pembayaran) {
            Storage::disk('public')->delete($dt->bukti_pembayaran);
        }
        if ($dt->invoice) {
            Storage::disk('public')->delete($dt->invoice);
        }
        if ($dt->dokumen_lain) {
            Storage::disk('public')->delete($dt->dokumen_lain);
        }
        $transaksi->delete();

        return redirect()->back()->with('success','Transaksi berhasil dihapus');
    }
}
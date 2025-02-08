<?php

namespace App\Http\Controllers\projek;

use App\Exports\DetailTransaksiExport;
use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;
use App\Models\Perusahaan;
use App\Models\Projek;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AbkProjekController extends Controller
{
    public function index()
    {
        $projek = Projek::all();
        $perusahaan = Perusahaan::all();
        
        return view('abk.projek.index',compact('projek','perusahaan'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $validasi = $request->validate(Projek::$rules,Projek::$messages);
        
        $projek = new Projek();
        $projek->id_projek = 'P' . str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        $projek->nama_projek = $request->nama_projek;
        $projek->no_kontrak = $request->no_kontrak;
        $projek->nominal_kontrak = $request->nominal_kontrak;
        $projek->durasi = $request->durasi;
        $projek->tanggal_mulai = $request->tanggal_mulai;
        $projek->tanggal_selesai = $request->tanggal_selesai;
        $projek->status = $request->status;
        $projek->perusahaan_id = $request->perusahaan_id;
        $projek->save();

        return redirect()->back()->with('success','Projek berhasil ditambahkan');
    }

    public function update(Request $request,$id)
    {
        // dd($request);
        $validasi = $request->validate(Projek::$rules,Projek::$messages);
        
        $projek = Projek::find($id);
        $projek->nama_projek = $request->nama_projek;
        $projek->no_kontrak = $request->no_kontrak;
        $projek->nominal_kontrak = $request->nominal_kontrak;
        $projek->durasi = $request->durasi;
        $projek->tanggal_mulai = $request->tanggal_mulai;
        $projek->tanggal_selesai = $request->tanggal_selesai;
        $projek->status = $request->status;
        $projek->perusahaan_id = $request->perusahaan_id;
        $projek->save();

        return redirect()->back()->with('success','Projek berhasil diperbarui');
    }

    public function delete($id)
    {
        $projek = Projek::find($id);
        $projek->delete();

        return redirect()->back()->with('success','Projek berhasil diperbarui');
    }

    public function detail($id)
    {
        $dt = DetailTransaksi::where('projek_id',$id)->with(['transaksi' => function ($query) {
            $query->orderBy('tanggal_transaksi', 'asc'); // Urutkan berdasarkan tanggal_transaksi di transaksi
        }])->get();
        
        return view('abk.projek.detail',compact('dt','id'));
    }
    
    public function filter(Request $request)
    {
        $bulan = $request->bulan;
        $projek_id = $request->projek_id;

        // Pastikan projek_id valid sebelum mengambil nama proyek
        $projek = Projek::find($projek_id);
        $namaProjek = $projek ? $projek->nama_projek : null;

        // Ambil data berdasarkan bulan yang dipilih
        $dt = DetailTransaksi::where('projek_id', $projek_id)
            ->whereHas('transaksi', function ($query) use ($bulan) {
                if (!empty($bulan)) {
                    $query->whereMonth('tanggal_transaksi', Carbon::parse($bulan)->month)
                        ->whereYear('tanggal_transaksi', Carbon::parse($bulan)->year);
                }
            })
            ->with(['transaksi' => function ($query) {
                $query->orderBy('tanggal_transaksi', 'asc'); // Urutkan berdasarkan tanggal_transaksi di transaksi
            }])
            ->get();

        return view('abk.projek.partial-table', compact('dt', 'namaProjek'));
    }


    public function exportExcel(Request $request)
    {
        $bulan = $request->bulan;
        $projek_id = $request->projek_id;
        $namaProjek = Projek::find($projek_id)->nama_projek;
        
        return Excel::download(new DetailTransaksiExport($projek_id,$bulan,$namaProjek), $namaProjek . '_' . $bulan . '.xlsx');
    }
}
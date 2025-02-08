<?php

namespace App\Http\Controllers\rekening;

use App\Http\Controllers\Controller;
use App\Models\JenisRekening;
use App\Models\Perusahaan;
use App\Models\Projek;
use App\Models\Rekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AbkRekeningController extends Controller
{
    public function index()
    {
        $rekening = Rekening::all();
        $jenisRekening = JenisRekening::all();
        $perusahaan = Perusahaan::all();
        $projek = Projek::all();
        // dd($jenisRekening);
        return view('abk.rekening.index',compact('rekening','jenisRekening','perusahaan','projek'));
    }

    public function store(Request $request)
    {
        // Definisikan rules awal
        $rules = [
            'nama_rekening' => 'required',
            'jenis_rekening_id' => 'required|exists:jenis_rekening,id_jenis_rekening',
            'perusahaan_id' => 'exists:perusahaan,id_perusahaan',
            'projek_id' => 'exists:projek,id_projek',
        ];
        
        $messages = [
            'nama_rekening.required' => 'Nama Rekening wajib diisi',
            'jenis_rekening_id.required' => 'Jenis Rekening wajib diisi',
            'jenis_rekening_id.exists' => 'Jenis Rekening tidak valid',
            'perusahaan_id.exists' => 'Perusahaan tidak valid',
            'projek_id.exists' => 'Projek tidak valid',
        ];

        // Periksa apakah jenis rekening yang dipilih adalah "Projek"
        $cekJr = JenisRekening::find($request->jenis_rekening_id);

        if ($cekJr && $cekJr->jenis_rekening != 'Projek') {
            // Jika bukan "Projek", maka nama_perusahaan dan nama_projek tidak wajib
            $rules = array_merge($rules, [
                'perusahaan_id' => 'nullable',
                'projek_id' => 'nullable',
            ]);
        }
        
        $validatedData = $request->validate($rules, $messages);

        $rekening = new Rekening();
        $rekening->id_rekening = 'R' . str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        $rekening->nama_rekening = $request->nama_rekening;
        if ($cekJr && $cekJr->jenis_rekening == 'Projek') {
            $rekening->perusahaan_id = $request->perusahaan_id;
            $rekening->projek_id = $request->projek_id;
        }
        $rekening->jenis_rekening_id = $request->jenis_rekening_id;
        $rekening->save();

        return redirect()->back()->with('success','Rekening berhasil ditambahkan');
    }

    public function update(Request $request,$id)
    {
        // Definisikan rules awal
        $rules = [
            'nama_rekening' => 'required',
            'jenis_rekening_id' => 'required|exists:jenis_rekening,id_jenis_rekening',
            'perusahaan_id' => 'exists:perusahaan,id_perusahaan',
            'projek_id' => 'exists:projek,id_projek',
        ];
        
        $messages = [
            'nama_rekening.required' => 'Nama Rekening wajib diisi',
            'jenis_rekening_id.required' => 'Jenis Rekening wajib diisi',
            'jenis_rekening_id.exists' => 'Jenis Rekening tidak valid',
            'perusahaan_id.exists' => 'Perusahaan tidak valid',
            'projek_id.exists' => 'Projek tidak valid',
        ];

        // Periksa apakah jenis rekening yang dipilih adalah "Projek"
        $cekJr = JenisRekening::find($request->jenis_rekening_id);

        if ($cekJr && $cekJr->jenis_rekening != 'Projek') {
            // Jika bukan "Projek", maka nama_perusahaan dan nama_projek tidak wajib
            $rules = array_merge($rules, [
                'nama_perusahaan' => 'nullable',
                'nama_projek' => 'nullable',
            ]);
        }
        
        $validatedData = $request->validate($rules, $messages);

        $rekening = Rekening::find($id);
        $rekening->nama_rekening = $request->nama_rekening;
        if ($cekJr && $cekJr->jenis_rekening == 'Projek') {
            $rekening->perusahaan_id = $request->perusahaan_id;
            $rekening->projek_id = $request->projek_id;
        } else {
            $rekening->perusahaan_id = null;
            $rekening->projek_id = null;
        }
        $rekening->jenis_rekening_id = $request->jenis_rekening_id;
        $rekening->save();

        return redirect()->back()->with('success','Rekening berhasil diperbarui');
    }

    public function delete($id)
    {
        $rekening = Rekening::find($id);
        $rekening->delete();

        return redirect()->back()->with('success','Rekening berhasil dihapus');
    }

}
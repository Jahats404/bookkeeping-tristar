<?php

namespace App\Http\Controllers\jenis_rekening;

use App\Http\Controllers\Controller;
use App\Models\JenisRekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AbkJenisRekeningController extends Controller
{
    public function index()
    {
        $jenisRekening = JenisRekening::all();
        return view('abk.jenis-rekening.index',compact('jenisRekening'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), 
            [
                'jenis_rekening' => 'required',
            ],
            [
                'jenis_rekening.required' => 'Jenis Rekening wajib diisi',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $jk = new JenisRekening();
        $jk->id_jenis_rekening = 'JR' . str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        $jk->jenis_rekening = $request->jenis_rekening;
        $jk->save();

        return redirect()->back()->with('success','Jenis Rekening berhasil ditambahakan');
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), 
            [
                'jenis_rekening' => 'required',
            ],
            [
                'jenis_rekening.required' => 'Jenis Rekening wajib diisi',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $jk = JenisRekening::find($id);
        $jk->jenis_rekening = $request->jenis_rekening;
        $jk->save();

        return redirect()->back()->with('success','Jenis Rekening berhasil diperbarui');
    }

    public function delete($id)
    {
        $jk = JenisRekening::find($id);
        $jk->delete();

        return redirect()->back()->with('success','Jenis Rekening berhasil dihapus');
    }
}
<?php

namespace App\Http\Controllers\perusahaan;

use App\Http\Controllers\Controller;
use App\Models\Perusahaan;
use Illuminate\Http\Request;

class AbkPerusahaanController extends Controller
{
    public function index()
    {
        $perusahaan = Perusahaan::all();

        return view('abk.perusahaan.index',compact('perusahaan'));
    }

    public function store(Request $request)
    {
        $rules = [
            'nama_perusahaan' => 'required|string',
            'nama_dirut' => 'required|string',
        ];
        
        $messages = [
            'nama_perusahaan.required' => 'Nama Perusahaan wajib diisi',
            'nama_dirut.required' => 'Nama Direktur wajib diisi',
        ];
        
        $validatedData = $request->validate($rules, $messages);

        function generateCompanyId() {
            $lastCompany = Perusahaan::latest('id_perusahaan')->first(); // Ambil ID terakhir
        
            if (!$lastCompany) {
                return 'A'; // Jika belum ada data, mulai dari "A"
            }
        
            $lastId = $lastCompany->id_perusahaan; // Ambil ID terakhir
            $nextId = $lastId;
            $length = strlen($lastId);
            $carry = true;
        
            for ($i = $length - 1; $i >= 0; $i--) {
                if ($carry) {
                    if ($lastId[$i] === 'Z') {
                        $nextId[$i] = 'A';
                    } else {
                        $nextId[$i] = chr(ord($lastId[$i]) + 1);
                        $carry = false;
                    }
                }
            }
        
            if ($carry) {
                $nextId = 'A' . $nextId; // Tambah panjang jika semua huruf adalah 'Z'
            }
        
            return $nextId;
        }

        $perusahaan = new Perusahaan();
        $perusahaan->id_perusahaan = generateCompanyId();
        $perusahaan->nama_perusahaan = $request->nama_perusahaan;
        $perusahaan->nama_dirut = $request->nama_dirut;
        $perusahaan->keterangan = $request->keterangan;
        $perusahaan->save();

        return redirect()->back()->with('success','Perusahaan berhasil ditambahakan');
    }

    public function update(Request $request,$id)
    {
        $rules = [
            'nama_perusahaan' => 'required|string',
            'nama_dirut' => 'required|string',
        ];
        
        $messages = [
            'nama_perusahaan.required' => 'Nama Perusahaan wajib diisi',
            'nama_dirut.required' => 'Nama Direktur wajib diisi',
        ];
        
        $validatedData = $request->validate($rules, $messages);

        $perusahaan = Perusahaan::find($id);
        $perusahaan->nama_perusahaan = $request->nama_perusahaan;
        $perusahaan->nama_dirut = $request->nama_dirut;
        $perusahaan->keterangan = $request->keterangan;
        $perusahaan->save();

        return redirect()->back()->with('success','Perusahaan berhasil diperbarui');
    }

    public function delete($id)
    {
        $perusahaan = Perusahaan::find($id);
        $perusahaan->delete();

        return redirect()->back()->with('success','Perusahaan berhasil dihapus');
    }
}
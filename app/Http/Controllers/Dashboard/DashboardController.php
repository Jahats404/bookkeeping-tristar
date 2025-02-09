<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Perusahaan;
use App\Models\Projek;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function abk()
    {
        $perusahaan = Perusahaan::count();
        $selesai = Projek::where('status','Selesai')->count();
        $proses = Projek::where('status','Proses')->count();
        return view('dashboard.dashboard-abk',compact('perusahaan','selesai','proses'));
    }
}
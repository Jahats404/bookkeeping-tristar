<?php

namespace App\Http\Controllers\report;

use App\Exports\DetailTransaksiExport;
use App\Exports\KasBesarExport;
use App\Exports\TransaksiProjekExport;
use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AbkReportController extends Controller
{
    public function transaksiProjek()
    {
        $dt = DetailTransaksi::whereNotNull('projek_id')->get();
        
        return view('abk.report.report-transaksi-projek.index',compact('dt'));
    }

    public function filterTransaksiProjek(Request $request)
    {
        $bulan = $request->bulan;

        // Ambil data berdasarkan bulan yang dipilih
        $dt = DetailTransaksi::whereNotNull('projek_id')
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

        return view('abk.projek.partial-table', compact('dt'));
    }

    public function exportExcelTransaksiProjek(Request $request)
    {
        $bulan = $request->bulan;

        $dt = DetailTransaksi::whereNotNull('projek_id')
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

        return Excel::download(new TransaksiProjekExport($bulan),'transaksi_projek_' . $bulan . '.xlsx');
    }
    
    public function kasBesar()
    {
        // $dt = DetailTransaksi::all();

        $bulan = '2025-02';

        $dt = DetailTransaksi::whereHas('transaksi', function ($query) use ($bulan) {
            if (!empty($bulan)) {
                $query->whereMonth('tanggal_transaksi', Carbon::parse($bulan)->month)
                    ->whereYear('tanggal_transaksi', Carbon::parse($bulan)->year);
            }
        })->get();

        return view('abk.report.kas-besar.index',compact('dt'));
    }

    public function filterKasBesar(Request $request)
    {
        $bulan = $request->bulan;

        $dt = DetailTransaksi::whereHas('transaksi', function ($query) use ($bulan) {
            if (!empty($bulan)) {
                $query->whereMonth('tanggal_transaksi', Carbon::parse($bulan)->month)
                    ->whereYear('tanggal_transaksi', Carbon::parse($bulan)->year);
            }
        })->get();
        
        return view('abk.report.kas-besar.partial-table',compact('dt'));
    }
    
    public function exportExcelKasBesar(Request $request)
    {
        $bulan = $request->bulan;

        $dt = DetailTransaksi::whereHas('transaksi', function ($query) use ($bulan) {
            if (!empty($bulan)) {
                $query->whereMonth('tanggal_transaksi', Carbon::parse($bulan)->month)
                    ->whereYear('tanggal_transaksi', Carbon::parse($bulan)->year);
            }
        })->get();

        return Excel::download(new KasBesarExport($bulan), 'kas_besar_' . $bulan . '.xlsx');
    }
}
<?php

namespace App\Exports;

use App\Models\DetailTransaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KasBesarExport implements FromView, WithStyles, WithColumnFormatting, ShouldAutoSize
{
    protected $bulan;

    public function __construct($bulan)
    {
        $this->bulan = $bulan;
    }

    public function view():View
    {
        $dt = DetailTransaksi::whereHas('transaksi', function ($query) {
                if ($this->bulan) {
                    $query->whereMonth('tanggal_transaksi', Carbon::parse($this->bulan)->month)
                        ->whereYear('tanggal_transaksi', Carbon::parse($this->bulan)->year);
                }
            })
            ->with(['transaksi' => function ($query) {
                $query->orderBy('tanggal_transaksi', 'asc'); // Urutkan berdasarkan tanggal_transaksi di transaksi
            }])
            ->get();
        
        if ($this->bulan) {
            $bulan = $this->bulan;
        } else {
            $bulan = null;
        }
        
        return view('abk.report.kas-besar.export-excel',compact('dt','bulan'));
    }

    public function styles(Worksheet $sheet)
    {
        // Dapatkan jumlah baris tertinggi dari data yang ada
        $highestRow = $sheet->getHighestRow();

        // Atur border untuk semua sel yang berisi data
        $sheet->getStyle("A1:E$highestRow")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        // Atur header agar bold dan warna background abu-abu
        $sheet->getStyle('A1:E3')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'D3D3D3'], // Abu-abu muda
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Atur agar nomor, tanggal, dan uraian berada di tengah
        $sheet->getStyle("A3:A$highestRow")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("B3:B$highestRow")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("C3:C$highestRow")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        
        // Atur agar jenis biaya berada di tengah
        $sheet->getStyle("D3:E$highestRow")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    }

    public function columnFormats(): array
    {
        return [
            'B' => 'DD-MMMM-YYYY', // Format tanggal dalam bahasa Indonesia
        ];
    }
}
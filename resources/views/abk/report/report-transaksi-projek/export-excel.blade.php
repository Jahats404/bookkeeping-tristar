{{-- @if ($bulan)
    <span>Laporan Transaksi {{ $namaProjek }} Periode </span>
@else

@endif --}}
<table>
    @if ($bulan)
        @php
            $formattedBulan = date('F Y', strtotime($bulan)); // Format menjadi "January 2025"
            $formattedBulan = str_replace(
                ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                $formattedBulan
            );
        @endphp
        <tr class="title-row">
            <td colspan="6" style="text-transform: uppercase">Laporan Transaksi Projek Periode {{ $formattedBulan }}</td>
        </tr>
    @else
        <tr class="title-row">
            <td colspan="6">SELURUH LAPORAN TRANSAKSI PROJEK</td>
        </tr>
    @endif
    <thead>
        <tr>
            <th rowspan="2">NO</th>
            <th rowspan="2">TANGGAL</th>
            <th rowspan="2">URAIAN</th>
            <th colspan="3">JENIS BIAYA</th>
        </tr>
        <tr>
            <th>MATERIAL</th>
            <th>UPAH</th>
            <th>UMUM</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dt as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($item->transaksi->tanggal_transaksi)->translatedFormat('d F Y') }}</td>
                <td>{{ $item->keterangan ?? '-' }}</td>
                <td>{{ $item->jenis_biaya == 'Material' ? 'Rp.' . number_format($item->nominal_akhir, 0, ',', '.') : '-' }}</td>
                <td>{{ $item->jenis_biaya == 'Upah' ? 'Rp.' . number_format($item->nominal_akhir, 0, ',', '.') : '-' }}</td>
                <td>{{ $item->jenis_biaya == 'Umum' ? 'Rp.' . number_format($item->nominal_akhir, 0, ',', '.') : '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

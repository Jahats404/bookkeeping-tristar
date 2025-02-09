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
            <td colspan="5" style="text-transform: uppercase">Laporan Kas Besar Periode {{ $formattedBulan }}</td>
        </tr>
    @else
        <tr class="title-row">
            <td colspan="5">SELURUH LAPORAN KAS BESAR</td>
        </tr>
    @endif
    <thead>
        <tr class="text-center">
            <th class="align-middle" rowspan="2">NO</th>
            <th class="align-middle" rowspan="2">TANGGAL</th>
            <th class="align-middle" rowspan="2">KETERANGAN</th>
            <th colspan="2">JENIS TRANSAKSI</th>
        </tr>
        <tr class="text-center">
            <th>KREDIT</th>
            <th>DEBIT</th>
        </tr>
    </thead>
    
    <tbody>
        @foreach ($dt as $index => $item)
            <tr class="text-center">
                <td>{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($item->transaksi->tanggal_transaksi)->translatedFormat('d F Y') ?? '-' }}</td>
                <td>{{ $item->keterangan ?? '-' }}</td>
                <td>{{ $item->jenis_transaksi == 'Debit' ? 'Rp.' . number_format($item->nominal_akhir, 0, ',', '.') : '-' }}</td>
                <td>{{ $item->jenis_transaksi == 'Kredit' ? 'Rp.' . number_format($item->nominal_akhir, 0, ',', '.') : '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
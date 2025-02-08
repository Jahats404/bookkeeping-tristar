@foreach ($dt as $item)
    <tr class="text-center">
        <td>{{ $loop->iteration }}</td>
        <td>{{ \Carbon\Carbon::parse($item->transaksi->tanggal_transaksi)->translatedFormat('d F Y') ?? '-' }}</td>
        <td>{{ $item->keterangan ?? '-' }}</td>
        @if ($item->jenis_biaya == 'Material')
            <td>{{ 'Rp. ' . number_format($item->nominal_akhir, 0, ',', '.') ?? '-' }}</td>
            <td>-</td>
            <td>-</td>
        @elseif ($item->jenis_biaya == 'Upah')
            <td>-</td>
            <td>{{ 'Rp. ' . number_format($item->nominal_akhir, 0, ',', '.') ?? '-' }}</td>
            <td>-</td>
        @elseif ($item->jenis_biaya == 'Umum')
            <td>-</td>
            <td>-</td>
            <td>{{ 'Rp. ' . number_format($item->nominal_akhir, 0, ',', '.') ?? '-' }}</td>
        @endif
    </tr>
@endforeach

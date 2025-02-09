@foreach ($dt as $item)
    <tr class="text-center">
        <td>{{ $loop->iteration }}</td>
        <td>{{ \Carbon\Carbon::parse($item->transaksi->tanggal_transaksi)->translatedFormat('d F Y') ?? '-' }}</td>
        <td>{{ $item->keterangan ?? '-' }}</td>
        <td>{{ $item->jenis_transaksi == 'Debit' ? 'Rp.' . number_format($item->nominal_akhir, 0, ',', '.') : '-' }}</td>
        <td>{{ $item->jenis_transaksi == 'Kredit' ? 'Rp.' . number_format($item->nominal_akhir, 0, ',', '.') : '-' }}</td>
    </tr>
@endforeach
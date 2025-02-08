@extends('layouts.master')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">KELOLA KAS BESAR</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-wrap align-items-center">
            <h6 class="m-0 font-weight-bold text-primary flex-grow-1">Daftar Kas Besar</h6>
            <button type="button" class="btn btn-sm btn-primary shadow-sm mt-2 mt-md-0" data-toggle="modal" data-target="#modalTambahFg">
                <i class="fas fa-solid fa-chart-bar fa-sm text-white-50"></i> Tambah Kas Besar
            </button>
        </div>

        {{-- TAMBAH --}}
        <form action="{{ route('abk.store.kas') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal fade" id="modalTambahFg" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahLabel">Tambah Kas Besar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="tanggal_transaksi" class="col-form-label">Tanggal</label>
                                <input 
                                    type="date" 
                                    name="tanggal_transaksi" 
                                    class="form-control @error('tanggal_transaksi') is-invalid @enderror" 
                                    id="tanggal_transaksi" 
                                    value="{{ old('tanggal_transaksi') }}" 
                                    placeholder="Masukkan Tanggal Transaksi">
                                @error('tanggal_transaksi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="jenis_rekening_id" class="col-form-label">Jenis Rekening</label>
                                <select id="jenis_rekening_id" name="jenis_rekening_id" class="form-control @error('jenis_rekening_id') is-invalid @enderror">
                                    <option value="">-- Pilih Jenis Rekening --</option>
                                    @foreach ($jenisRekening as $item)
                                        <option value="{{ $item->id_jenis_rekening }}" {{ old('jenis_rekening_id') == $item->id_jenis_rekening ? 'selected' : '' }}>
                                            {{ $item->jenis_rekening }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jenis_rekening_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="rekening_id" class="col-form-label">Rekening</label>
                                <select id="rekening_id" name="rekening_id" class="form-control @error('rekening_id') is-invalid @enderror">
                                    <option value="">-- Pilih Rekening --</option>
                                </select>
                                @error('rekening_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group projek-field">
                                <label for="projek_id" class="col-form-label">Nama Projek</label>
                                <select id="projek_id" name="projek_id" class="form-control @error('projek_id') is-invalid @enderror">
                                    <option value="">-- Pilih Nama Projek --</option>
                                    @foreach ($projek as $item)
                                        <option value="{{ $item->id_projek }}" {{ old('projek_id') == $item->id_projek ? 'selected' : '' }}>
                                            {{ $item->nama_projek }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('projek_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group jenis-biaya-field">
                                <label for="jenis_biaya" class="col-form-label">Jenis Biaya</label>
                                <select id="jenis_biaya" name="jenis_biaya" class="form-control @error('jenis_biaya') is-invalid @enderror">
                                    <option value="">-- Pilih Jenis Biaya --</option>
                                    <option value="Material" {{ old('jenis_biaya') == 'Material' ? 'selected' : '' }}>Material</option>
                                    <option value="Umum" {{ old('jenis_biaya') == 'Umum' ? 'selected' : '' }}>Umum</option>
                                    <option value="Upah" {{ old('jenis_biaya') == 'Upah' ? 'selected' : '' }}>Upah</option>
                                </select>
                                @error('jenis_biaya')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="jenis_transaksi" class="col-form-label">Jenis Transaksi</label>
                                <select id="jenis_transaksi" name="jenis_transaksi" class="form-control @error('jenis_transaksi') is-invalid @enderror">
                                    <option value="">-- Pilih Rekening --</option>
                                    <option value="Kredit">Kredit</option>
                                    <option value="Debit">Debit</option>
                                </select>
                                @error('jenis_transaksi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="dpp" class="col-form-label">DPP</label>
                                <input 
                                    type="number" 
                                    name="dpp" 
                                    class="form-control @error('dpp') is-invalid @enderror" 
                                    id="dpp" 
                                    value="{{ old('dpp') }}" 
                                    placeholder="Masukkan DPP">
                                @error('dpp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="pajak" class="col-form-label">Pajak %</label>
                                <input 
                                    type="number" 
                                    name="pajak" 
                                    class="form-control @error('pajak') is-invalid @enderror" 
                                    id="pajak" 
                                    value="{{ old('pajak') }}" 
                                    placeholder="Masukkan Pajak %">
                                @error('pajak')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nominal_pajak" class="col-form-label">Nominal Pajak</label>
                                <input 
                                    type="number" 
                                    name="nominal_pajak" 
                                    class="form-control @error('nominal_pajak') is-invalid @enderror" 
                                    id="nominal_pajak" 
                                    value="{{ old('nominal_pajak') }}" 
                                    readonly>
                                @error('nominal_pajak')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nominal_akhir" class="col-form-label">Nominal Akhir</label>
                                <input 
                                    type="number" 
                                    name="nominal_akhir" 
                                    class="form-control @error('nominal_akhir') is-invalid @enderror" 
                                    id="nominal_akhir" 
                                    readonly
                                    value="{{ old('nominal_akhir') }}">
                                @error('nominal_akhir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="bukti_pembayaran" class="col-form-label">Bukti Pembayaran</label>
                                <input 
                                    type="file" 
                                    name="bukti_pembayaran" 
                                    class="form-control @error('bukti_pembayaran') is-invalid @enderror" 
                                    id="bukti_pembayaran" 
                                    value="{{ old('bukti_pembayaran') }}" 
                                    placeholder="Masukkan Tanggal Transaksi">
                                @error('bukti_pembayaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="invoice" class="col-form-label">Invoice</label>
                                <input 
                                    type="file" 
                                    name="invoice" 
                                    class="form-control @error('invoice') is-invalid @enderror" 
                                    id="invoice" 
                                    value="{{ old('invoice') }}" 
                                    placeholder="Masukkan Tanggal Transaksi">
                                @error('invoice')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="dokumen_lain" class="col-form-label">Dokumen Lain</label>
                                <input 
                                    type="file" 
                                    name="dokumen_lain" 
                                    class="form-control @error('dokumen_lain') is-invalid @enderror" 
                                    id="dokumen_lain" 
                                    value="{{ old('dokumen_lain') }}" 
                                    placeholder="Masukkan Tanggal Transaksi">
                                @error('dokumen_lain')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="keterangan" class="col-form-label">Keterangan</label>
                                <textarea name="keterangan" class="form-control" placeholder="Opsional" id="">{{ old('keterangan') }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>ID</th>
                            <th>TANGGAL</th>
                            <th>URAIAN TRANSAKSI</th>
                            <th>KREDIT</th>
                            <th>DEBIT</th>
                            <th>KETERANGAN</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($transaksi as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id_transaksi }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_transaksi)->translatedFormat('d F Y') ?? '-' }}</td>
                                <td>{{ $item->jenis_rekening->jenis_rekening }}</td>
                                @if ($item->detail_transaksi?->jenis_transaksi == 'Kredit')
                                    <td>{{ 'Rp. ' . number_format($item->detail_transaksi?->nominal_akhir, 0, ',', '.') ?? '-' }}</td>
                                    <td>-</td>
                                @elseif ($item->detail_transaksi?->jenis_transaksi == 'Debit')
                                    <td>-</td>
                                    <td>{{ 'Rp. ' . number_format($item->detail_transaksi?->nominal_akhir, 0, ',', '.') ?? '-' }}</td>
                                @else
                                    <td></td>
                                    <td>-</td>
                                @endif
                                <td>{{ $item->detail_transaksi->keterangan ?? '-' }}</td>
                                
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="#" class="btn btn-info btn-circle btn-sm mr-2" data-toggle="modal" data-target="#modalDetail{{ $item->id_transaksi }}" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-warning btn-circle btn-sm mr-2" data-toggle="modal" data-target="#modalEdit{{ $item->id_transaksi }}" title="Update">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </a>
                                        <form action="{{ route('abk.delete.kas', ['id' => $item->id_transaksi]) }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-circle btn-sm delete-btn mr-2" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            {{-- SweetAlert Delete --}}
                            <script>
                                // Pilih semua tombol dengan kelas delete-btn
                                document.querySelectorAll('.delete-btn').forEach(button => {
                                    button.addEventListener('click', function (e) {
                                        e.preventDefault(); // Mencegah pengiriman form langsung
                            
                                        const form = this.closest('form'); // Ambil form terdekat dari tombol yang diklik
                            
                                        Swal.fire({
                                            title: 'Apakah data ini akan dihapus?',
                                            text: "Data yang dihapus tidak dapat dikembalikan!",
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#d33',
                                            cancelButtonColor: '#3085d6',
                                            confirmButtonText: 'Ya, hapus!',
                                            cancelButtonText: 'Batal'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                form.submit(); // Kirim form jika pengguna mengonfirmasi
                                            }
                                        });
                                    });
                                });
                            </script>

                            <!-- Modal Detail -->
                            <div class="modal fade" id="modalDetail{{ $item->id_transaksi }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel{{ $item->id_transaksi }}">Detail Transaksi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="list-group">
                                                <li class="list-group-item"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($item->tanggal_transaksi)->translatedFormat('d F Y') ?? '-' }}</li>
                                                <li class="list-group-item"><strong>Jenis Rekening:</strong> {{ $item->jenis_rekening->jenis_rekening ?? '-' }}</li>
                                                <li class="list-group-item"><strong>Nama Projek:</strong> {{ $item->detail_transaksi->projek->nama_projek ?? '-' }}</li>
                                                <li class="list-group-item"><strong>Rekening:</strong> {{ $item->rekening->nama_rekening ?? '-' }}</li>
                                                <li class="list-group-item"><strong>Jenis Biaya:</strong> {{ $item->detail_transaksi->jenis_biaya ?? '-' }}</li>
                                                <li class="list-group-item"><strong>Jenis Transaksi:</strong> {{ $item->detail_transaksi->jenis_transaksi ?? '-' }}</li>
                                                <li class="list-group-item"><strong>DPP:</strong> {{ 'Rp. ' . number_format($item->detail_transaksi?->dpp, 0, ',', '.') ?? '-' }}</li>
                                                <li class="list-group-item"><strong>Pajak:</strong> {{ $item->detail_transaksi?->pajak . '%' ?? '-' }}</li>
                                                <li class="list-group-item"><strong>Nominal Pajak:</strong> {{  'Rp. ' . number_format($item->detail_transaksi?->nominal_pajak, 0, ',', '.') ?? '-'  }}</li>
                                                <li class="list-group-item"><strong>Nominal Akhir:</strong> {{  'Rp. ' . number_format($item->detail_transaksi?->nominal_akhir, 0, ',', '.') ?? '-'  }}</li>
                                                <li class="list-group-item">
                                                    <strong>Bukti Pembayaran:</strong> 
                                                    @if ($item->detail_transaksi?->bukti_pembayaran)
                                                        <a href="{{ asset('storage/' . $item->detail_transaksi->bukti_pembayaran) }}">Lihat Bukti Pembayaran</a>
                                                    @else
                                                        -
                                                    @endif
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Invoice:</strong> 
                                                    @if ($item->detail_transaksi?->invoice)
                                                        <a href="{{ asset('storage/' . $item->detail_transaksi->invoice) }}">Lihat Invoice</a>
                                                    @else
                                                        -
                                                    @endif
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Dokumen Lain:</strong> 
                                                    @if ($item->detail_transaksi?->dokumen_lain)
                                                        <a href="{{ asset('storage/' . $item->detail_transaksi->dokumen_lain) }}">Lihat Dokumen Lain</a>
                                                    @else
                                                        -
                                                    @endif
                                                </li>
                                                <li class="list-group-item"><strong>Keterangan:</strong> {{ $item->detail_transaksi->keterangan ?? '-' }}</li>
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- MODAL EDIT --}}
                            <div class="modal fade" id="modalEdit{{ $item->id_transaksi }}" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTambahLabel"> Kas Besar</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('abk.update.kas',$item->id_transaksi) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="tanggal_transaksi" class="col-form-label">Tanggal</label>
                                                    <input 
                                                        type="date" 
                                                        name="tanggal_transaksi" 
                                                        class="form-control @error('tanggal_transaksi') is-invalid @enderror" 
                                                        id="tanggal_transaksi" 
                                                        value="{{ old('tanggal_transaksi',$item->tanggal_transaksi) }}" 
                                                        placeholder="Masukkan Tanggal Transaksi">
                                                    @error('tanggal_transaksi')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="jenis_rekening_id_update_{{ $item->id_transaksi }}" class="col-form-label">Jenis Rekening</label>
                                                    <select id="jenis_rekening_id_update_{{ $item->id_transaksi }}" 
                                                            name="jenis_rekening_id" 
                                                            class="form-control jenis-rekening @error('jenis_rekening_id') is-invalid @enderror" 
                                                            data-id="{{ $item->id_transaksi }}">
                                                        <option value="">-- Pilih Jenis Rekening --</option>
                                                        @foreach ($jenisRekening as $jr)
                                                            <option value="{{ $jr->id_jenis_rekening }}" 
                                                                    {{ old('jenis_rekening_id', $item->jenis_rekening_id) == $jr->id_jenis_rekening ? 'selected' : '' }}>
                                                                {{ $jr->jenis_rekening }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('jenis_rekening_id')
                                                        <div class="invalid-feedback" data-id="{{ $item->id_transaksi }}">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="rekening_id_update_{{ $item->id_transaksi }}" class="col-form-label">Rekening</label>
                                                    <select id="rekening_id_update_{{ $item->id_transaksi }}" 
                                                            name="rekening_id" 
                                                            class="form-control rekening @error('rekening_id') is-invalid @enderror" 
                                                            data-id="{{ $item->id_transaksi }}" 
                                                            data-selected="{{ $item->rekening_id }}">
                                                        <option value="">-- Pilih Rekening --</option>
                                                    </select>
                                                    @error('rekening_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group projek-field-update" data-id="{{ $item->id_transaksi }}">
                                                    <label for="projek_id" class="col-form-label">Nama Projek</label>
                                                    <select id="projek_id" name="projek_id" class="form-control @error('projek_id') is-invalid @enderror">
                                                        <option value="">-- Pilih Nama Projek --</option>
                                                        @foreach ($projek as $projekItem)
                                                            <option value="{{ $projekItem->id_projek }}" {{ old('projek_id',$item->detail_transaksi->projek_id) == $projekItem->id_projek ? 'selected' : '' }}>
                                                                {{ $projekItem->nama_projek }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('projek_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                
                                                <div class="form-group jenis-biaya-field-update" data-id="{{ $item->id_transaksi }}">
                                                    <label for="jenis_biaya" class="col-form-label">Jenis Biaya</label>
                                                    <select id="jenis_biaya" name="jenis_biaya" class="form-control @error('jenis_biaya') is-invalid @enderror">
                                                        <option value="">-- Pilih Jenis Biaya --</option>
                                                        <option value="Material" {{ old('jenis_biaya',$item->detail_transaksi?->jenis_biaya) == 'Material' ? 'selected' : '' }}>Material</option>
                                                        <option value="Umum" {{ old('jenis_biaya',$item->detail_transaksi?->jenis_biaya) == 'Umum' ? 'selected' : '' }}>Umum</option>
                                                        <option value="Upah" {{ old('jenis_biaya',$item->detail_transaksi?->jenis_biaya) == 'Upah' ? 'selected' : '' }}>Upah</option>
                                                    </select>
                                                    @error('jenis_biaya')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="jenis_transaksi" class="col-form-label">Jenis Transaksi</label>
                                                    <select id="jenis_transaksi" name="jenis_transaksi" class="form-control @error('jenis_transaksi') is-invalid @enderror">
                                                        <option value="">-- Pilih Rekening --</option>
                                                        <option value="Kredit" {{ old('jenis_transaksi',$item->detail_transaksi->jenis_transaksi) == 'Kredit' ? 'selected' : '' }}>Kredit</option>
                                                        <option value="Debit" {{ old('jenis_transaksi',$item->detail_transaksi->jenis_transaksi) == 'Debit' ? 'selected' : '' }}>Debit</option>
                                                    </select>
                                                    @error('jenis_transaksi')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="dpp" class="col-form-label">DPP</label>
                                                    <input 
                                                        type="number" 
                                                        name="dpp" 
                                                        class="form-control @error('dpp') is-invalid @enderror" 
                                                        id="dpp{{ $item->id_transaksi }}" 
                                                        value="{{ old('dpp',$item->detail_transaksi->dpp) }}" 
                                                        placeholder="Masukkan DPP">
                                                    @error('dpp')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="pajak" class="col-form-label">Pajak %</label>
                                                    <input 
                                                        type="number" 
                                                        name="pajak" 
                                                        class="form-control @error('pajak') is-invalid @enderror" 
                                                        id="pajak{{ $item->id_transaksi }}" 
                                                        value="{{ old('pajak',$item->detail_transaksi->pajak) }}" 
                                                        placeholder="Masukkan Pajak %">
                                                    @error('pajak')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="nominal_pajak" class="col-form-label">Nominal Pajak</label>
                                                    <input 
                                                        type="number" 
                                                        name="nominal_pajak" 
                                                        class="form-control @error('nominal_pajak') is-invalid @enderror" 
                                                        id="nominal_pajak{{ $item->id_transaksi }}" 
                                                        value="{{ old('nominal_pajak',$item->detail_transaksi->nominal_pajak) }}" 
                                                        readonly>
                                                    @error('nominal_pajak')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="nominal_akhir" class="col-form-label">Nominal Akhir</label>
                                                    <input 
                                                        type="number" 
                                                        name="nominal_akhir" 
                                                        class="form-control @error('nominal_akhir') is-invalid @enderror" 
                                                        id="nominal_akhir{{ $item->id_transaksi }}" 
                                                        readonly
                                                        value="{{ old('nominal_akhir',$item->detail_transaksi->nominal_akhir) }}">
                                                    @error('nominal_akhir')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="bukti_pembayaran" class="col-form-label">Bukti Pembayaran</label>
                                                    <input 
                                                        type="file" 
                                                        name="bukti_pembayaran" 
                                                        class="form-control @error('bukti_pembayaran') is-invalid @enderror" 
                                                        id="bukti_pembayaran" 
                                                        value="{{ old('bukti_pembayaran') }}" 
                                                        placeholder="Masukkan Tanggal Transaksi">
                                                    @error('bukti_pembayaran')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    @if($item->detail_transaksi->bukti_pembayaran)
                                                        <small class="form-text text-muted">
                                                            Bukti Pembayaran saat ini: 
                                                            <a href="{{ asset('storage/' . $item->detail_transaksi->bukti_pembayaran) }}">Lihat Bukti</a>.
                                                            Biarkan kosong jika tidak ingin mengganti.
                                                        </small>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="invoice" class="col-form-label">Invoice</label>
                                                    <input 
                                                        type="file" 
                                                        name="invoice" 
                                                        class="form-control @error('invoice') is-invalid @enderror" 
                                                        id="invoice" 
                                                        value="{{ old('invoice') }}" 
                                                        placeholder="Masukkan Tanggal Transaksi">
                                                    @error('invoice')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    @if($item->detail_transaksi->invoice)
                                                        <small class="form-text text-muted">
                                                            Invoice saat ini: 
                                                            <a href="{{ asset('storage/' . $item->detail_transaksi->bukti_pembayaran) }}">Lihat Invoice</a>.
                                                            Biarkan kosong jika tidak ingin mengganti.
                                                        </small>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="dokumen_lain" class="col-form-label">Dokumen Lain</label>
                                                    <input 
                                                        type="file" 
                                                        name="dokumen_lain" 
                                                        class="form-control @error('dokumen_lain') is-invalid @enderror" 
                                                        id="dokumen_lain" 
                                                        value="{{ old('dokumen_lain') }}" 
                                                        placeholder="Masukkan Tanggal Transaksi">
                                                    @error('dokumen_lain')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    @if($item->detail_transaksi->dokumen_lain)
                                                        <small class="form-text text-muted">
                                                            Dokumen lain saat ini: 
                                                            <a href="{{ asset('storage/' . $item->detail_transaksi->dokumen_lain) }}">Lihat Dokumen lain</a>.
                                                            Biarkan kosong jika tidak ingin mengganti.
                                                        </small>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="keterangan" class="col-form-label">Keterangan</label>
                                                    <textarea name="keterangan" class="form-control" placeholder="Opsional" id="">{{ old('keterangan') }}</textarea>
                                                    @error('keterangan')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <script>
                                $(document).ready(function () {
                                    // Fungsi untuk mengisi dropdown rekening berdasarkan jenis rekening
                                    function loadRekening(jenisRekeningId, transaksiId, rekeningDropdown, selectedRekeningId) {
                                        rekeningDropdown.html('<option value="">-- Pilih Rekening --</option>'); // Reset dropdown

                                        if (jenisRekeningId) {
                                            $.ajax({
                                                url: "/get-rekening/" + jenisRekeningId,
                                                type: "GET",
                                                dataType: "json",
                                                success: function (data) {
                                                    rekeningDropdown.html('<option value="">-- Pilih Rekening --</option>'); // Reset ulang
                                                    let addedOptions = []; // Gunakan array untuk melacak id_rekening yang sudah ditambahkan

                                                    $.each(data, function (key, value) {
                                                        if (!addedOptions.includes(value.id_rekening)) {
                                                            rekeningDropdown.append(
                                                                '<option value="' +
                                                                    value.id_rekening +
                                                                    '"' +
                                                                    (value.id_rekening == selectedRekeningId ? " selected" : "") +
                                                                    ">" +
                                                                    value.nama_rekening +
                                                                    "</option>"
                                                            );
                                                            addedOptions.push(value.id_rekening); // Tambahkan id_rekening ke array
                                                        }
                                                    });
                                                },
                                                error: function () {
                                                    alert("Gagal mengambil data rekening.");
                                                },
                                            });
                                        }
                                    }

                                    // Event ketika dropdown jenis-rekening berubah
                                    $(document).on("change", ".jenis-rekening", function () {
                                        var transaksiId = $(this).data("id");
                                        var jenisRekeningId = $(this).val();
                                        var rekeningDropdown = $("#rekening_id_update_" + transaksiId);

                                        loadRekening(jenisRekeningId, transaksiId, rekeningDropdown, null);
                                    });

                                    // Saat halaman dimuat, jalankan untuk setiap transaksi
                                    $(".jenis-rekening").each(function () {
                                        var transaksiId = $(this).data("id");
                                        var jenisRekeningId = $(this).val(); // Ambil nilai yang sudah terpilih
                                        var rekeningDropdown = $("#rekening_id_update_" + transaksiId);
                                        var selectedRekeningId = rekeningDropdown.data("selected"); // Nilai rekening_id yang sudah tersimpan

                                        // Jalankan fungsi untuk mengisi rekening jika jenis rekening sudah dipilih
                                        loadRekening(jenisRekeningId, transaksiId, rekeningDropdown, selectedRekeningId);
                                    });
                                });
                            </script>

                            <script>
                                $(document).ready(function () {
                                    function toggleFields(selectElement) {
                                        var transaksiId = $(selectElement).data('id'); // Mengambil ID dari atribut data-id
                                        var selectedText = $(selectElement).find("option:selected").text();
                                        var isProjek = selectedText.includes("Projek");

                                        if (isProjek) {
                                            $(".projek-field-update[data-id='" + transaksiId + "'], .jenis-biaya-field-update[data-id='" + transaksiId + "']").show();
                                            localStorage.setItem("projekFieldsVisible_" + transaksiId, "true");
                                        } else {
                                            $(".projek-field-update[data-id='" + transaksiId + "'], .jenis-biaya-field-update[data-id='" + transaksiId + "']").hide();
                                            localStorage.removeItem("projekFieldsVisible_" + transaksiId);
                                        }
                                    }

                                    // Menambahkan event listener untuk perubahan pada select
                                    $(".jenis-rekening").on("change", function () {
                                        toggleFields(this);
                                    });

                                    // Mengecek kondisi saat halaman pertama kali dimuat
                                    $(".jenis-rekening").each(function () {
                                        toggleFields(this);
                                    });
                                });
                            </script>

                            <script>
                                $(document).ready(function() {
                                    function hitungNominalPajakDanAkhir() {
                                        var dpp = parseFloat($("#dpp{{ $item->id_transaksi }}").val()) || 0;
                                        var pajak = parseFloat($("#pajak{{ $item->id_transaksi }}").val()) || 0;

                                        var nominalPajak = Math.ceil((dpp * pajak) / 100); // Bulatkan ke atas
                                        $("#nominal_pajak{{ $item->id_transaksi }}").val(nominalPajak);

                                        var nominalAkhir = Math.ceil(dpp + nominalPajak); // Bulatkan ke atas
                                        $("#nominal_akhir{{ $item->id_transaksi }}").val(nominalAkhir);
                                    }

                                    $("#dpp{{ $item->id_transaksi }}, #pajak{{ $item->id_transaksi }}").on("input", hitungNominalPajakDanAkhir);
                                });
                            </script>

                            {{-- <script>
                                $(document).ready(function () {
                                    $(document).on("change", ".jenis-rekening", function () {
                                        var transaksiId = $(this).data("id");
                                        var jenisRekeningId = $(this).val();
                                        var rekeningDropdown = $("#rekening_id_update_" + transaksiId);

                                        rekeningDropdown.html('<option value="">-- Pilih Rekening --</option>');

                                        if (jenisRekeningId) {
                                            $.ajax({
                                                url: "/get-rekening/" + jenisRekeningId,
                                                type: "GET",
                                                dataType: "json",
                                                success: function (data) {
                                                    rekeningDropdown.html('<option value="">-- Pilih Rekening --</option>'); // Reset
                                                    let addedOptions = [];
                                                    $.each(data, function (key, value) {
                                                        if (!addedOptions.includes(value.id_rekening)) {
                                                            rekeningDropdown.append('<option value="' + value.id_rekening + '">' + value.nama_rekening + '</option>');
                                                            addedOptions.push(value.id_rekening);
                                                        }
                                                    });
                                                },
                                                error: function () {
                                                    alert("Gagal mengambil data rekening.");
                                                }
                                            });
                                        }
                                    });
                                });
                            </script> --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    <script>
        $(document).ready(function () {
            $("#jenis_rekening_id").change(function () {
                var jenisRekeningId = $(this).val();
                var rekeningDropdown = $("#rekening_id");
    
                rekeningDropdown.html('<option value="">-- Pilih Rekening --</option>'); // Reset pilihan
    
                if (jenisRekeningId) {
                    $.ajax({
                        url: "/get-rekening/" + jenisRekeningId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $.each(data, function (key, value) {
                                rekeningDropdown.append('<option value="' + value.id_rekening + '">' + value.nama_rekening + '</option>');
                            });
                        },
                        error: function () {
                            alert("Gagal mengambil data rekening.");
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            function toggleFields() {
                var selectedText = $("#jenis_rekening_id option:selected").text();
                var isProjek = selectedText.includes("Projek");
    
                if (isProjek) {
                    $(".projek-field, .jenis-biaya-field").show();
                    localStorage.setItem("projekFieldsVisible", "true");
                } else {
                    $(".projek-field, .jenis-biaya-field").hide();
                    localStorage.removeItem("projekFieldsVisible");
                }
            }
    
            $("#jenis_rekening_id").on("change", toggleFields);
    
            // Pastikan input tetap muncul setelah validasi gagal
            if (localStorage.getItem("projekFieldsVisible") === "true" || $(".invalid-feedback:visible").length) {
                $(".projek-field, .jenis-biaya-field").show();
            } else {
                $(".projek-field, .jenis-biaya-field").hide();
            }
        });
    </script>

    {{-- script desimal --}}
    {{-- <script>
        $(document).ready(function() {
            function hitungNominalPajakDanAkhir() {
                var dpp = parseFloat($("#dpp").val()) || 0; // Ambil nilai DPP (default 0 jika kosong)
                var pajak = parseFloat($("#pajak").val()) || 0; // Ambil nilai Pajak % (default 0 jika kosong)

                var nominalPajak = (dpp * pajak) / 100; // Hitung Nominal Pajak
                $("#nominal_pajak").val(nominalPajak.toFixed(2)); // Tampilkan Nominal Pajak

                var nominalAkhir = dpp + nominalPajak; // Hitung Nominal Akhir
                $("#nominal_akhir").val(nominalAkhir.toFixed(2)); // Tampilkan Nominal Akhir
            }

            // Jalankan fungsi saat nilai DPP atau Pajak berubah
            $("#dpp, #pajak").on("input", hitungNominalPajakDanAkhir);
        });
    </script> --}}

    {{-- script bilangan bulat --}}
    <script>
        $(document).ready(function() {
            function hitungNominalPajakDanAkhir() {
                var dpp = parseFloat($("#dpp").val()) || 0;
                var pajak = parseFloat($("#pajak").val()) || 0;

                var nominalPajak = Math.ceil((dpp * pajak) / 100); // Bulatkan ke atas
                $("#nominal_pajak").val(nominalPajak);

                var nominalAkhir = Math.ceil(dpp + nominalPajak); // Bulatkan ke atas
                $("#nominal_akhir").val(nominalAkhir);
            }

            $("#dpp, #pajak").on("input", hitungNominalPajakDanAkhir);
        });
    </script>


@include('validasi.notifikasi')
@include('validasi.notifikasi-error')
@endsection
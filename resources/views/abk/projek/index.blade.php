@extends('layouts.master')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">KELOLA PROJEK</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-wrap align-items-center">
            <h6 class="m-0 font-weight-bold text-primary flex-grow-1">Daftar Projek</h6>
            <button type="button" class="btn btn-sm btn-primary shadow-sm mt-2 mt-md-0" data-toggle="modal" data-target="#modalTambahFg">
                <i class="fas fa-solid fa-building fa-sm text-white-50"></i> Tambah Projek
            </button>
        </div>

        {{-- TAMBAH --}}
        <form action="{{ route('abk.store.projek') }}" method="POST">
        @csrf
            <div class="modal fade" id="modalTambahFg" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahLabel">Tambah Projek</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_projek" class="col-form-label">Nama Projek</label>
                                <input 
                                    type="text" 
                                    name="nama_projek" 
                                    class="form-control @error('nama_projek') is-invalid @enderror" 
                                    id="nama_projek" 
                                    value="{{ old('nama_projek') }}" 
                                    placeholder="Masukkan Nama Projek">
                                @error('nama_projek')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="perusahaan_id" class="col-form-label">Perusahaan</label>
                                <select id="perusahaan_id" name="perusahaan_id" class="form-control @error('perusahaan_id') is-invalid @enderror">
                                    <option value="">-- Pilih Perusahaan --</option>
                                    @foreach ($perusahaan as $item)
                                        <option value="{{ $item->id_perusahaan }}" {{ old('perusahaan_id') == $item->id_perusahaan ? 'selected' : '' }}>
                                            {{ $item->nama_perusahaan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('perusahaan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="no_kontrak" class="col-form-label">No Kontrak</label>
                                <input 
                                    type="number" 
                                    name="no_kontrak" 
                                    class="form-control @error('no_kontrak') is-invalid @enderror" 
                                    id="no_kontrak" 
                                    value="{{ old('no_kontrak') }}" 
                                    placeholder="Masukkan No Kontrak">
                                @error('no_kontrak')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nominal_kontrak" class="col-form-label">Nominal Kontrak</label>
                                <input 
                                    type="number" 
                                    name="nominal_kontrak" 
                                    class="form-control @error('nominal_kontrak') is-invalid @enderror" 
                                    id="nominal_kontrak" 
                                    value="{{ old('nominal_kontrak') }}" 
                                    placeholder="Masukkan Nominal Kontrak">
                                @error('nominal_kontrak')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tanggal_mulai" class="col-form-label">Tanggal Mulai</label>
                                <input 
                                    type="date" 
                                    name="tanggal_mulai" 
                                    class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                                    id="tanggal_mulai" 
                                    value="{{ old('tanggal_mulai') }}" 
                                    placeholder="Masukkan Tanggal Mulai">
                                @error('tanggal_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tanggal_selesai" class="col-form-label">Tanggal Selesai</label>
                                <input 
                                    type="date" 
                                    name="tanggal_selesai" 
                                    class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                                    id="tanggal_selesai" 
                                    value="{{ old('tanggal_selesai') }}" 
                                    placeholder="Masukkan Tanggal Selesai">
                                @error('tanggal_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="durasi" class="col-form-label">Durasi</label>
                                <input 
                                    type="text" 
                                    name="durasi" 
                                    readonly
                                    class="form-control @error('durasi') is-invalid @enderror" 
                                    id="durasi" 
                                    value="{{ old('durasi') }}" 
                                    placeholder="">
                                @error('durasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-form-label">Status</label>
                                <select id="status" name="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Mulai" {{ old('status') == 'Mulai' ? 'selected' : '' }} >Mulai</option>
                                    <option value="Proses" {{ old('status') == 'Proses' ? 'selected' : '' }} >Proses</option>
                                    <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }} >Selesai</option>
                                </select>
                                @error('status')
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
            <div class="table-responsive" style="overflow-x: auto; white-space: nowrap;">
                <table class="table table-bordered" id="projek" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>NAMA PROJEK</th>
                            <th>NAMA PERUSAHAAN</th>
                            <th>NO KONTRAK</th>
                            <th>NOMINAL KONTRAK</th>
                            <th>DURASI</th>
                            <th>TANGGAL MULAI</th>
                            <th>TANGGAL SELESAI</th>
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projek as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_projek }}</td>
                                <td>{{ $item->perusahaan->nama_perusahaan }}</td>
                                <td>{{ $item->no_kontrak }}</td>
                                <td>{{ $item->nominal_kontrak }}</td>
                                <td>{{ $item->durasi }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y') ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d F Y') ?? '-' }}</td>
                                <td>
                                    @if ($item->status == 'Mulai')
                                        <span class="badge badge-info">{{ $item->status }}</span>
                                    @elseif ($item->status == 'Proses')
                                        <span class="badge badge-primary">{{ $item->status }}</span>
                                    @elseif ($item->status == 'Selesai')
                                        <span class="badge badge-success">{{ $item->status }}</span>
                                    @endif
                                </td>
                                
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('abk.detail.projek',$item->id_projek) }}" class="btn btn-info btn-circle btn-sm mr-2" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-warning btn-circle btn-sm mr-2" data-toggle="modal" data-target="#modalEdit{{ $item->id_projek }}" title="Update">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </a>
                                        <form action="{{ route('abk.delete.projek', ['id' => $item->id_projek]) }}" method="POST" class="delete-form">
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


                            {{-- <!-- Modal Detail -->
                            <div class="modal fade" id="modalDetail{{ $item->id_projek }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel{{ $item->id_projek }}">Detail Transaksi</h5>
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
                                                    @if ($item->detail_transaksi->bukti_pembayaran)
                                                        <a href="{{ asset('storage/' . $item->detail_transaksi->bukti_pembayaran) }}">Lihat Bukti Pembayaran</a>
                                                    @else
                                                        -
                                                    @endif
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Invoice:</strong> 
                                                    @if ($item->detail_transaksi->invoice)
                                                        <a href="{{ asset('storage/' . $item->detail_transaksi->invoice) }}">Lihat Bukti Pembayaran</a>
                                                    @else
                                                        -
                                                    @endif
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Dokumen Lain:</strong> 
                                                    @if ($item->detail_transaksi->dokumen_lain)
                                                        <a href="{{ asset('storage/' . $item->detail_transaksi->dokumen_lain) }}">Lihat Bukti Pembayaran</a>
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
                            </div> --}}

                            {{-- MODAL EDIT --}}
                            <div class="modal fade" id="modalEdit{{ $item->id_projek }}" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTambahLabel">Edit Perusahaan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('abk.update.projek',$item->id_projek) }}" method="POST">
                                            @csrf
                                            @method('put')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="nama_projek" class="col-form-label">Nama Projek</label>
                                                    <input 
                                                        type="text" 
                                                        name="nama_projek" 
                                                        class="form-control @error('nama_projek') is-invalid @enderror" 
                                                        id="nama_projek" 
                                                        value="{{ old('nama_projek',$item->nama_projek) }}" 
                                                        placeholder="Masukkan Nama Projek">
                                                    @error('nama_projek')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="perusahaan_id" class="col-form-label">Perusahaan</label>
                                                    <select id="perusahaan_id" name="perusahaan_id" class="form-control @error('perusahaan_id') is-invalid @enderror">
                                                        <option value="">-- Pilih Perusahaan --</option>
                                                        @foreach ($perusahaan as $p)
                                                            <option value="{{ $p->id_perusahaan }}" {{ old('perusahaan_id',$item->perusahaan_id) == $p->id_perusahaan ? 'selected' : '' }}>
                                                                {{ $p->nama_perusahaan }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('perusahaan_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="no_kontrak" class="col-form-label">No Kontrak</label>
                                                    <input 
                                                        type="number" 
                                                        name="no_kontrak" 
                                                        class="form-control @error('no_kontrak') is-invalid @enderror" 
                                                        id="no_kontrak" 
                                                        value="{{ old('no_kontrak',$item->no_kontrak) }}" 
                                                        placeholder="Masukkan No Kontrak">
                                                    @error('no_kontrak')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="nominal_kontrak" class="col-form-label">Nominal Kontrak</label>
                                                    <input 
                                                        type="number" 
                                                        name="nominal_kontrak" 
                                                        class="form-control @error('nominal_kontrak') is-invalid @enderror" 
                                                        id="nominal_kontrak" 
                                                        value="{{ old('nominal_kontrak',$item->nominal_kontrak) }}" 
                                                        placeholder="Masukkan Nominal Kontrak">
                                                    @error('nominal_kontrak')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal_mulai" class="col-form-label">Tanggal Mulai</label>
                                                    <input 
                                                        type="date" 
                                                        name="tanggal_mulai" 
                                                        class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                                                        id="tanggal_mulai{{ $item->id_projek }}" 
                                                        value="{{ old('tanggal_mulai',$item->tanggal_mulai) }}" 
                                                        placeholder="Masukkan Tanggal Mulai">
                                                    @error('tanggal_mulai')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal_selesai" class="col-form-label">Tanggal Selesai</label>
                                                    <input 
                                                        type="date" 
                                                        name="tanggal_selesai" 
                                                        class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                                                        id="tanggal_selesai{{ $item->id_projek }}" 
                                                        value="{{ old('tanggal_selesai',$item->tanggal_selesai) }}" 
                                                        placeholder="Masukkan Tanggal Selesai">
                                                    @error('tanggal_selesai')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="durasi" class="col-form-label">Durasi</label>
                                                    <input 
                                                        type="text" 
                                                        name="durasi" 
                                                        readonly
                                                        class="form-control @error('durasi') is-invalid @enderror" 
                                                        id="durasi{{ $item->id_projek }}" 
                                                        value="{{ old('durasi',$item->durasi) }}" 
                                                        placeholder="">
                                                    @error('durasi')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="status" class="col-form-label">Status</label>
                                                    <select id="status" name="status" class="form-control @error('status') is-invalid @enderror">
                                                        <option value="">-- Pilih Status --</option>
                                                        <option value="Mulai" {{ old('status',$item->status) == 'Mulai' ? 'selected' : '' }} >Mulai</option>
                                                        <option value="Proses" {{ old('status',$item->status) == 'Proses' ? 'selected' : '' }} >Proses</option>
                                                        <option value="Selesai" {{ old('status',$item->status) == 'Selesai' ? 'selected' : '' }} >Selesai</option>
                                                    </select>
                                                    @error('status')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Tambah</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    const tanggalMulai = document.getElementById("tanggal_mulai{{ $item->id_projek }}");
                                    const tanggalSelesai = document.getElementById("tanggal_selesai{{ $item->id_projek }}");
                                    const durasi = document.getElementById("durasi{{ $item->id_projek }}");
                            
                                    function hitungDurasi() {
                                        if (tanggalMulai.value && tanggalSelesai.value) {
                                            const tglMulai = new Date(tanggalMulai.value);
                                            const tglSelesai = new Date(tanggalSelesai.value);
                            
                                            if (tglSelesai >= tglMulai) {
                                                const selisihHari = Math.ceil((tglSelesai - tglMulai) / (1000 * 60 * 60 * 24));
                                                durasi.value = `${selisihHari} hari`;
                                            } else {
                                                durasi.value = "Tanggal tidak valid";
                                            }
                                        } else {
                                            durasi.value = "";
                                        }
                                    }
                            
                                    tanggalMulai.addEventListener("change", hitungDurasi);
                                    tanggalSelesai.addEventListener("change", hitungDurasi);
                                });
                            </script>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const tanggalMulai = document.getElementById("tanggal_mulai");
            const tanggalSelesai = document.getElementById("tanggal_selesai");
            const durasi = document.getElementById("durasi");
    
            function hitungDurasi() {
                if (tanggalMulai.value && tanggalSelesai.value) {
                    const tglMulai = new Date(tanggalMulai.value);
                    const tglSelesai = new Date(tanggalSelesai.value);
    
                    if (tglSelesai >= tglMulai) {
                        const selisihHari = Math.ceil((tglSelesai - tglMulai) / (1000 * 60 * 60 * 24));
                        durasi.value = `${selisihHari} hari`;
                    } else {
                        durasi.value = "Tanggal tidak valid";
                    }
                } else {
                    durasi.value = "";
                }
            }
    
            tanggalMulai.addEventListener("change", hitungDurasi);
            tanggalSelesai.addEventListener("change", hitungDurasi);
        });
    </script>

@include('validasi.notifikasi')
@include('validasi.notifikasi-error')
@endsection
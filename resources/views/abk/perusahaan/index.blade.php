@extends('layouts.master')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">KELOLA PERUSAHAAN</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-wrap align-items-center">
            <h6 class="m-0 font-weight-bold text-primary flex-grow-1">Daftar Perusahaan</h6>
            <button type="button" class="btn btn-sm btn-primary shadow-sm mt-2 mt-md-0" data-toggle="modal" data-target="#modalTambahFg">
                <i class="fas fa-solid fa-building fa-sm text-white-50"></i> Tambah Perusahaan
            </button>
        </div>

        {{-- TAMBAH --}}
        <div class="modal fade" id="modalTambahFg" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahLabel">Tambah Perusahaan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('abk.store.perusahaan') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_perusahaan" class="col-form-label">Nama Perusahaan</label>
                                <input 
                                    type="text" 
                                    name="nama_perusahaan" 
                                    class="form-control @error('nama_perusahaan') is-invalid @enderror" 
                                    id="nama_perusahaan" 
                                    value="{{ old('nama_perusahaan') }}" 
                                    placeholder="Masukkan Nama Perusahaan">
                                @error('nama_perusahaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama_dirut" class="col-form-label">Direktur Utama</label>
                                <input 
                                    type="text" 
                                    name="nama_dirut" 
                                    class="form-control @error('nama_dirut') is-invalid @enderror" 
                                    id="nama_dirut" 
                                    value="{{ old('nama_dirut') }}" 
                                    placeholder="Masukkan Nama Direktur">
                                @error('nama_dirut')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="keterangan" class="col-form-label">Keterangan</label>
                                <input 
                                    type="text" 
                                    name="keterangan" 
                                    class="form-control @error('keterangan') is-invalid @enderror" 
                                    id="keterangan" 
                                    value="{{ old('keterangan') }}" 
                                    placeholder="Masukkan Keterangan (Opsional)">
                                @error('keterangan')
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

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>KODE PERUSAHAAN</th>
                            <th>NAMA PERUSAHAAN</th>
                            <th>DIREKTUR UTAMA</th>
                            <th>KETERANGAN</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perusahaan as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id_perusahaan }}</td>
                                <td>{{ $item->nama_perusahaan }}</td>
                                <td>{{ $item->nama_dirut }}</td>
                                <td>{{ $item->keterangan ?? '-' }}</td>
                                
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="#" class="btn btn-warning btn-circle btn-sm mr-2" data-toggle="modal" data-target="#modalEdit{{ $item->id_perusahaan }}" title="Update">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </a>
                                        <form action="{{ route('abk.delete.perusahaan', ['id' => $item->id_perusahaan]) }}" method="POST" class="delete-form">
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

                            {{-- MODAL EDIT --}}
                            <div class="modal fade" id="modalEdit{{ $item->id_perusahaan }}" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTambahLabel">Edit Perusahaan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('abk.update.perusahaan',$item->id_perusahaan) }}" method="POST">
                                            @csrf
                                            @method('put')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="nama_perusahaan" class="col-form-label">Nama Perusahaan</label>
                                                    <input 
                                                        type="text" 
                                                        name="nama_perusahaan" 
                                                        class="form-control @error('nama_perusahaan') is-invalid @enderror" 
                                                        id="nama_perusahaan" 
                                                        value="{{ old('nama_perusahaan',$item->nama_perusahaan) }}" 
                                                        placeholder="Masukkan Nama Perusahaan">
                                                    @error('nama_perusahaan')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama_dirut" class="col-form-label">Direktur Utama</label>
                                                    <input 
                                                        type="text" 
                                                        name="nama_dirut" 
                                                        class="form-control @error('nama_dirut') is-invalid @enderror" 
                                                        id="nama_dirut" 
                                                        value="{{ old('nama_dirut',$item->nama_dirut) }}" 
                                                        placeholder="Masukkan Nama Direktur">
                                                    @error('nama_dirut')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="keterangan" class="col-form-label">Keterangan</label>
                                                    <input 
                                                        type="text" 
                                                        name="keterangan" 
                                                        class="form-control @error('keterangan') is-invalid @enderror" 
                                                        id="keterangan" 
                                                        value="{{ old('keterangan',$item->keterangan) }}" 
                                                        placeholder="Masukkan Keterangan (Opsional)">
                                                    @error('keterangan')
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@include('validasi.notifikasi')
@include('validasi.notifikasi-error')
@endsection
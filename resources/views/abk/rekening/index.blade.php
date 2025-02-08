@extends('layouts.master')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">KELOLA REKENING</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-wrap align-items-center">
            <h6 class="m-0 font-weight-bold text-primary flex-grow-1">Daftar Rekening</h6>
            <button type="button" class="btn btn-sm btn-primary shadow-sm mt-2 mt-md-0" data-toggle="modal" data-target="#modalTambahFg">
                <i class="fas fa-solid fa-clipboard-list fa-sm text-white-50"></i> Tambah Rekening
            </button>
        </div>

        {{-- TAMBAH --}}
        <div class="modal fade" id="modalTambahFg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahLabel">Tambah Rekening</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('abk.store.rekening') }}" method="POST">
                        @csrf
                        <div class="modal-body">
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
                                <label for="nama_rekening" class="col-form-label">Nama Rekening</label>
                                <input 
                                    type="text" 
                                    name="nama_rekening" 
                                    class="form-control @error('nama_rekening') is-invalid @enderror" 
                                    id="nama_rekening" 
                                    value="{{ old('nama_rekening') }}" 
                                    placeholder="Masukkan Nama Rekening">
                                @error('nama_rekening')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Form tambahan yang akan muncul jika 'Projek' dipilih -->
                            <div id="projekFields" style="display: none;">
                                <br>
                                <hr>
                                <div class="form-group">
                                    <label for="perusahaan_id" class="col-form-label">Nama Perusahaan</label>
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
                                    <label for="projek_id" class="col-form-label">Nama Projek</label>
                                    <select id="projek_id" name="projek_id" class="form-control @error('projek_id') is-invalid @enderror">
                                        <option value="">-- Pilih Projek --</option>
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
                            <th>ID REKENING</th>
                            <th>JENIS REKENING</th>
                            <th>NAMA REKENING</th>
                            <th>NAMA PERUSAHAAN</th>
                            <th>NAMA PROJEK</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekening as $item)
                            
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id_rekening }}</td>
                                <td>{{ $item->jenis_rekening->jenis_rekening }}</td>
                                <td>{{ $item->nama_rekening }}</td>
                                <td>{{ $item->perusahaan->nama_perusahaan ?? '-' }}</td>
                                <td>{{ $item->projek->nama_projek ?? '-' }}</td>
                                
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="#" class="btn btn-warning btn-circle btn-sm mr-2" data-toggle="modal" data-target="#modalEdit{{ $item->id_rekening }}" title="Update">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </a>
                                        <form action="{{ route('abk.delete.rekening', ['id' => $item->id_rekening]) }}" method="POST" class="delete-form">
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
                            <div class="modal fade" id="modalEdit{{ $item->id_rekening }}" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Jenis Rekening</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('abk.update.rekening', $item->id_rekening) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="jenis_rekening_id{{ $item->id_rekening }}" class="col-form-label">Jenis Rekening</label>
                                                    <select id="jenis_rekening_id{{ $item->id_rekening }}" name="jenis_rekening_id" class="form-control @error('jenis_rekening_id') is-invalid @enderror">
                                                        <option>-- Pilih Jenis Rekening --</option>
                                                        @foreach ($jenisRekening as $jr)
                                                            <option value="{{ $jr->id_jenis_rekening }}" 
                                                                {{ old('jenis_rekening_id', $item->jenis_rekening_id) == $jr->id_jenis_rekening ? 'selected' : '' }}>
                                                                {{ $jr->jenis_rekening }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('jenis_rekening_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                            
                                                <div class="form-group">
                                                    <label for="nama_rekening" class="col-form-label">Nama Rekening</label>
                                                    <input 
                                                        type="text" 
                                                        name="nama_rekening" 
                                                        class="form-control @error('nama_rekening') is-invalid @enderror" 
                                                        id="nama_rekening" 
                                                        value="{{ old('nama_rekening', $item->nama_rekening) }}" 
                                                        placeholder="Masukkan Nama Rekening">
                                                    @error('nama_rekening')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                            
                                                <!-- Form tambahan untuk Projek -->
                                                <div id="projekFields{{ $item->id_rekening }}" style="display: none;">
                                                    <br>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label for="perusahaan_id" class="col-form-label">Nama Perusahaan</label>
                                                        <select id="perusahaan_id" name="perusahaan_id" class="form-control @error('perusahaan_id') is-invalid @enderror">
                                                            <option value="">-- Pilih Perusahaan --</option>
                                                            @foreach ($perusahaan as $prs)
                                                                <option value="{{ $prs->id_perusahaan }}" {{ old('perusahaan_id',$item->perusahaan_id) == $prs->id_perusahaan ? 'selected' : '' }}>
                                                                    {{ $prs->nama_perusahaan }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('perusahaan_id')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="projek_id" class="col-form-label">Nama Projek</label>
                                                        <select id="projek_id" name="projek_id" class="form-control @error('projek_id') is-invalid @enderror">
                                                            <option value="">-- Pilih Projek --</option>
                                                            @foreach ($projek as $prj)
                                                                <option value="{{ $prj->id_projek }}" {{ old('projek_id',$item->projek_id) == $prj->id_projek ? 'selected' : '' }}>
                                                                    {{ $prj->nama_projek }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('projek_id')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    document.querySelectorAll('[id^="jenis_rekening_id"]').forEach(function (selectElement) {
                                        const modalId = selectElement.id.replace("jenis_rekening_id", "");
                                        const projekFields = document.getElementById("projekFields" + modalId);
                            
                                        function toggleProjekFields() {
                                            const selectedText = selectElement.options[selectElement.selectedIndex].text;
                                            if (selectedText.trim() === "Projek") {
                                                projekFields.style.display = "block";
                                            } else {
                                                projekFields.style.display = "none";
                                            }
                                        }
                            
                                        // Panggil fungsi saat halaman dimuat (jika ada nilai lama)
                                        toggleProjekFields();
                            
                                        // Tambahkan event listener untuk mendeteksi perubahan
                                        selectElement.addEventListener("change", toggleProjekFields);
                                    });
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
            const jenisRekeningSelect = document.getElementById("jenis_rekening_id");
            const projekFields = document.getElementById("projekFields");

            function toggleProjekFields() {
                const selectedText = jenisRekeningSelect.options[jenisRekeningSelect.selectedIndex].text;
                if (selectedText === "Projek") {
                    projekFields.style.display = "block";
                } else {
                    projekFields.style.display = "none";
                }
            }

            // Panggil fungsi saat halaman dimuat (jika ada nilai lama)
            toggleProjekFields();

            // Tambahkan event listener untuk mendeteksi perubahan
            jenisRekeningSelect.addEventListener("change", toggleProjekFields);
        });
    </script>

    

@include('validasi.notifikasi')
@include('validasi.notifikasi-error')
@endsection
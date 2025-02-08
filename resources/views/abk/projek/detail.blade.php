@extends('layouts.master')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">DAFTAR TRANSAKSI PROJEK</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between flex-wrap">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Transaksi Projek</h6>

            <div class="d-flex align-items-center flex-wrap">
                <div class="form-group d-flex mb-0 align-items-center">
                    <input type="month" name="bulan" value="" id="filterTanggal" class="form-control form-control-sm mr-2" placeholder="Pilih bulan">
                    <form action="{{ route('abk.projek.export.excel') }}" method="GET" class="d-flex align-items-center mr-3">
                        <input type="hidden" name="bulan" id="bulanExport">
                        <input type="hidden" value="{{ $id }}" name="projek_id">
                        <button id="exportBtn" class="btn btn-sm btn-primary shadow-sm d-flex align-items-center">
                            <i class="fas fa-file-export fa-sm text-white-50 mr-1"></i> Export
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive" style="overflow-x: auto; white-space: nowrap;">
                <table class="table table-bordered" id="projek" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th class="align-middle" rowspan="2">NO</th>
                            <th class="align-middle" rowspan="2">TANGGAL</th>
                            <th class="align-middle" rowspan="2">URAIAN</th>
                            <th colspan="3">JENIS BIAYA</th>
                        </tr>
                        <tr class="text-center">
                            <th>MATERIAL</th>
                            <th>UPAH</th>
                            <th>UMUM</th>
                        </tr>
                    </thead>
                    <tbody id="projekData" data-id="{{ $id }}">
                        @include('abk.projek.partial-table', ['dt' => $dt]) <!-- Load partial view -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@include('validasi.notifikasi')
@include('validasi.notifikasi-error')

<script>
    $(document).ready(function () {
        $('#filterTanggal').on('change', function () {
            let bulan = $(this).val();
            let projekId = $('#projekData').data('id');
            $.ajax({
                url: "{{ route('abk.projek.filter') }}",
                type: "GET",
                data: { bulan: bulan, projek_id: projekId },
                success: function (data) {
                    $('#projekData').html(data);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#filterTanggal').on('change', function () {
            let bulan = $(this).val();
            $('#bulanExport').val(bulan); // Set value bulan ke hidden input
        });
    });
</script>

@endsection

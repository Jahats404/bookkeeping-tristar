@extends('layouts.master')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">LAPORAN KAS BESAR</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-wrap justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary flex-grow-1">Daftar Kas Besar</h6>

            <div class="d-flex align-items-center flex-wrap">
                <div class="form-group d-flex mb-0 align-items-center">
                    <input type="month" name="bulan" value="" id="filterTanggal" class="form-control form-control-sm mr-2" placeholder="Pilih bulan">
                    <form action="{{ route('abk.export.kas.besar') }}" method="GET" class="d-flex align-items-center mr-3">
                        <input type="hidden" name="bulan" id="bulanExport">
                        <button id="exportBtn" class="btn btn-sm btn-primary shadow-sm d-flex align-items-center">
                            <i class="fas fa-file-export fa-sm text-white-50 mr-1"></i> Export
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                    
                    <tbody id="projekData">
                        @include('abk.report.kas-besar.partial-table', ['dt' => $dt])
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            $('#filterTanggal').on('change', function () {
                let bulan = $(this).val();
                console.log(bulan);
                
                $.ajax({
                    url: "{{ route('abk.filter.kas.besar') }}",
                    type: "GET",
                    data: { bulan: bulan },
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

@include('validasi.notifikasi')
@include('validasi.notifikasi-error')
@endsection
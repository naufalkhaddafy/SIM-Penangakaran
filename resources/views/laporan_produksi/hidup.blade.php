@extends('admin-lte.template')
@section('title', 'Hasil Produksi Hidup')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{-- <h3>
                            <div class="row">
                                <div class="col-md-6" style="margin:1px;">
                                    <select name="penangkaran_id" id="penangkaran"
                                        class="form-control @error('penangkaran_id') is-invalid @enderror" required>
                                        <option value="" selected><b>Pilih Penangkaran</b></option>
                                        @foreach ($penangkarans as $data)
                                            <option value="{{ $data->id }}">
                                                {{ $data->lokasi_penangkaran }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <div class="col-lg-3 col-md-6" style="margin:1px;">
                                    <button id="cek" type="button" class="btn btn-block btn-outline-dark">
                                        <ion-icon name="home"></ion-icon> <b>Cek Penangkaran</b>
                                    </button>
                                </div>
                            </div>
                        </h3> --}}
                        <h3 class="card-header border-0 p-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title"> Total Produksi Hidup :
                                    <b class="text-danger">{{ count($produksis->where('status_produksi', 'Hidup')) }}</b>
                                </h3>
                                <button type="button" class="btn btn-outline-success" onclick="showPrintMati()">
                                    <ion-icon name="print-outline"></ion-icon> Print
                                </button>
                            </div>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div id="readData"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Dynamic Modal --}}
    <div class="modal fade " id="showModal">
        <div class="modal-dialog modal-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="showModalBody">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" id="btnClose" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="btnSubmit" class="btn btn-info"></button>
                    <button type="submit" id="btnDelete" class="btn btn-danger"></button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            readData()
        });

        function readData() {
            $.get("{{ url('/show-laporan-produksi-hidup') }}", function(data) {
                $('#readData').html(data);
            });
        }

        function showRead(id) {
            $.get("{{ url('/modal-read-produksi') }}/" + id, function(data) {
                $('#modalLabel').text('Data Burung')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').show();
                $('#btnSubmit').hide();
                $('#btnDelete').hide();
            });
        }

        function showUpdate(id) {
            $.get("{{ url('/modal-update-report-indukan/') }}/" + id, function(data) {
                $('#modalLabel').text('Update Data Burung')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').show();
                $('#btnSubmit').show().text('Update').attr('onclick', 'update()');
                $('#btnDelete').hide();
            });
        }

        function showPrintMati() {
            $.get("{{ url('/modal-print-hidup') }}", function(data) {
                $('#modalLabel').text('Print Data Laporan Produksi Hidup')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').show();
                $('#btnSubmit').show().text('Print').attr('onclick', 'printProduksiMati()');
                $('#btnDelete').hide();
            });
        }
    </script>
@endpush

@extends('admin-lte.template')
@section('title', 'Data Indukan')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{-- <h3 class="card-title">
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-block btn-outline-success" onclick="showCreate()">
                                    <ion-icon name="finger-print-outline"></ion-icon> <b>Tambah</b>
                                </button>
                            </div>
                        </h3> --}}
                        <h3 class="card-header border-0 p-0">
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-outline-success" onclick="showCreate()">
                                    <ion-icon name="finger-print-outline"></ion-icon> <b>Tambah</b>
                                </button>
                                <h3 class="card-title">Total Indukan :
                                    <b
                                        class="text-danger">{{ count($produksis->where('status_produksi', 'Indukan')) }}</b>
                                </h3>
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
            $.get("{{ url('/show-laporan-produksi-indukan') }}", function(data) {
                $('#readData').html(data);
            });
        }

        function showRead(id) {
            $.get("{{ url('/modal-read-produksi') }}/" + id, function(data) {
                $('#modalLabel').text('Data Indukan')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').show();
                $('#btnSubmit').hide();
                $('#btnDelete').hide();
            });
        }

        function showCreate() {
            $.get("{{ url('/modal-create-indukan') }}", function(data) {
                $('#modalLabel').text('Tambah Data Indukan')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').show();
                $('#btnSubmit').show().text('Tambah').attr('onclick', 'tambah()');
                $('#btnDelete').hide();
            });
        }

        function showUpdate(id) {
            $.get("{{ url('/modal-update-report-indukan/') }}/" + id, function(data) {
                $('#modalLabel').text('Update Data Indukan')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').show();
                $('#btnSubmit').show().text('Update').attr('onclick', 'update()');
                $('#btnDelete').hide();
            });
        }
    </script>
@endpush

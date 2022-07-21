@extends('admin-lte.template')
@section('title', 'Produksi Mati')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-header border-0 p-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Total Produksi Mati :
                                    <b class="text-danger">{{ count($produksis->where('status_produksi', 'Mati')) }}</b>
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
            $.get("{{ url('/show-laporan-produksi-mati') }}", function(data) {
                $('#readData').html(data);
            });
        }

        function showPrintMati() {
            $.get("{{ url('/modal-print-mati') }}", function(data) {
                $('#modalLabel').text('Print Data Laporan Produksi Mati')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').show();
                $('#btnSubmit').show().text('Print').attr('onclick', 'printProduksiMati()');
                $('#btnDelete').hide();
            });
        }
    </script>
@endpush

@extends('template.template')
@section('title')
    Detail Penangkaran {{ $penangkarans->lokasi_penangkaran }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <td>
                                <button type="button" class="btn btn-block btn-outline-success"
                                    onclick="showCreate({{ $penangkarans->id }})">
                                    <ion-icon name="home"></ion-icon> <b>Tambah</b>
                                </button>
                            </td>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div style="text-align:center">
                            <h2>Lokasi Penangkaran</h2>
                            <a href="#">
                                <h2><b>{{ $penangkarans->lokasi_penangkaran }}</b></h2>
                            </a>
                            <h2>Jumlah Kandang : {{ count($penangkarans->kandangs) }}</h2>
                            <h2>Jumlah Pekerja : {{ count($penangkarans->users) }}</h2>
                        </div>
                        <br>
                        <div id="readKandang"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Dynamic Modal --}}
    <div class="modal fade " id="showModal">
        <div class="modal-dialog modal-md">
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
            readTable()
        });

        function readTable() {
            $.get("{{ url('/show-kandang/') . '/' . $penangkarans->id }}", function(data) {
                $('#readKandang').html(data);
            });
        }

        function showRead(id) {
            $.get("{{ url('/modal-read') }}/" + id, function(data) {
                $('#modalLabel').text('Data Pengguna')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').hide();
                $('#btnSubmit').hide();
                $('#btnDelete').hide();
            });
        }

        function showCreate(id) {
            $.get("{{ url('/modal-create-kandang') }}/" + id, function(data) {
                $('#modalLabel').text('Tambah Kandang')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').show();
                $('#btnSubmit').show().text('Tambah').attr('onclick', 'tambah()');
                $('#btnDelete').hide();
            });
        }

        function showUpdate(id) {
            $.get("{{ url('/modal-update-kandang') }}/" + id, function(data) {
                $('#modalLabel').text('Update Data Kandang')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').show();
                $('#btnSubmit').show().text('Update').attr('onclick', 'update()');
                $('#btnDelete').hide();
            });
        }

        function showDelete(id) {
            $.get("{{ url('/modal-delete-kandang') }}/" + id, function(data) {
                $('#modalLabel').text('Delete Data Kandang')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').show();
                $('#btnSubmit').hide();
                $('#btnDelete').show().text('Delete').attr('onclick', 'destroy()');
            });
        }
    </script>
@endpush

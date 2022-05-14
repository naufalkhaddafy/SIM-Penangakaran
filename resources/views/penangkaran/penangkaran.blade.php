@extends('template.template')
@section('title', 'Penangkaran')

@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <td>
                        <button type="button" class="btn btn-block btn-outline-success" onclick="showCreate()">
                            <ion-icon name="home"></ion-icon> <b>Tambah</b>
                        </button>
                    </td>
                </h3>
            </div>
            <div class="card-body">
                <div id="readData">
                </div>
            </div>
        </div>
    </div>
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
            readData()
        });

        function readData() {
            $.get("{{ url('/show-penangkaran') }}", function(data) {
                $('#readData').html(data);
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

        function showCreate() {

            $.get("{{ url('/modal-create-penangkaran') }}", function(data) {
                $('#modalLabel').text('Tambah Penangkaran')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').show();
                $('#btnSubmit').show().text('Tambah').attr('onclick', 'tambah()');
                $('#btnDelete').hide();
            });
        }

        function showUpdate(id) {
            $.get("{{ url('/modal-update-penangkaran') }}/" + id, function(data) {
                $('#modalLabel').text('Update Penangkaran')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').show();
                $('#btnSubmit').show().text('Update').attr('onclick', 'update()');
                $('#btnDelete').hide();
            });
        }

        function showDelete(id) {
            $.get("{{ url('/modal-delete-penangkaran') }}/" + id, function(data) {
                $('#modalLabel').text('Delete Penangkaran')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').show();
                $('#btnSubmit').hide();
                $('#btnDelete').show().text('Delete').attr('onclick', 'destroy()');
            });
        }
    </script>
@endpush

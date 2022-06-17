@extends('template.template')
@section('title', 'Produksi Inkubator')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <div class="row">
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
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            readData()
        });

        function readData() {
            $.get("{{ url('/show-produksi-inkubator') }}", function(data) {
                $('#readData').html(data);
            });
        }

        function showRead(id) {
            $.get("{{ url('/show-produksi-inkubator') }}/" + id, function(data) {
                $('#modalLabel').text('Data Panduan')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').hide();
                $('#btnSubmit').hide();
                $('#btnDelete').hide();
            });
        }

        function showUpdate(id) {
            $.get("{{ url('/modal-update-panduan') }}/" + id, function(data) {
                $('#modalLabel').text('Update Data Panduan')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').show();
                $('#btnSubmit').show().text('Update').attr('onclick', 'update()');
                $('#btnDelete').hide();
            });
        }
    </script>
@endpush

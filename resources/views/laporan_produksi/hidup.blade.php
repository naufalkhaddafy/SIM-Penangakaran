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
                        <h3 class="card-title"> Total Produksi Hidup :
                            <b class="text-danger">{{ count($produksis->where('status_produksi', 'Hidup')) }}</b>
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
            $.get("{{ url('/show-laporan-produksi-hidup') }}", function(data) {
                $('#readData').html(data);
            });
        }

        function showRead(id) {
            $.get("{{ url('/show-produksi-inkubator') }}/" + id, function(data) {
                $('#modalLabel').text('Data Produksi Hidup')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').hide();
                $('#btnSubmit').hide();
                $('#btnDelete').hide();
            });
        }

        function showUpdate(id) {
            $.get("{{ url('modal-update-produksi-hidup') }}/" + id, function(data) {
                $('#modalLabel').text('Update Data Produksi Hidup')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').show();
                $('#btnSubmit').show().text('Update').attr('onclick', 'update()');
                $('#btnDelete').hide();
            });
        }
    </script>
@endpush

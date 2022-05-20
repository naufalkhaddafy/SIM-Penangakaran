@extends('template.template')
@section('title', 'Kandang')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            <div class="row">
                                <div class="col-md-6" style="margin:1px;">
                                    <select name="penangkaran_id" id="penangkaran"
                                        class="form-control @error('penangkaran_id') is-invalid @enderror" required>
                                        <option value="" selected>Pilih Penangkaran</option>
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
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="readData"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {

            $('#cek').on('click', function(e) {
                e.preventDefault();
                var penangkaran = $('#penangkaran').find(":selected").val();
                if (penangkaran == 0) {
                    alert("Pilih Penangkaran");
                } else {
                    $.get("{{ url('/show-kandang') }}/" + penangkaran, function(data, status) {
                        $('.readData').html(data);
                    });
                }
            });
        });
    </script>
@endpush

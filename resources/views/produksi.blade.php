@extends('template.template')
@section('title', 'Hasil Produksi')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        @if (session('create'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                                <h6><i class="icon fas fa-check"></i>{{ session('create') }} </h6>
                            </div>
                        @elseif(session('delete'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                                <h6><i class="icon fas fa-check"></i>{{ session('delete') }}</h6>
                            </div>
                        @endif
                        <h3>
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
                        </h3>
                    </div>
                    <div class="readData"></div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Bertelur</th>
                                    <th>Tanggal Masuk Inkubator</th>
                                    <th>Tanggal Menetas</th>
                                    <th>Kondisi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('template.template')
@section('title', 'Kandang')

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
                                    <select name="penangkaran_id" id="inputState"
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
                                    <button type="button" class="btn btn-block btn-outline-dark">
                                        <ion-icon name="home"></ion-icon> <b>Cek Penangkaran</b>
                                    </button>
                                </div>
                            </div>
                        </h3>
                    </div>
                    <br>
                    <div class="card-body col-md-2">
                        <button type="button" class="btn btn-block btn-outline-success" data-toggle="modal"
                            data-target="#modal-lg">
                            <ion-icon name="home"></ion-icon> <b>Tambah</b>
                        </button>
                        <div class="modal fade" id="modal-lg">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Tambah Pengguna</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('kandang') }}" method="post">
                                            @csrf
                                            <div class="input-group mb-3">
                                                <input type="text" id="namakandang" name="namakandang"
                                                    class="form-control @error('namakandang') is-invalid @enderror"
                                                    placeholder="Nama Kandang" value="{{ old('namakandang') }}">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <ion-icon name="code-slash"></ion-icon>
                                                    </div>
                                                </div>
                                                @error('namakandang')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="input-group mb-3">
                                                <select name="category_id" id="inputState"
                                                    class="form-control @error('category_id') is-invalid @enderror"
                                                    required>
                                                    <option value="" selected>Kondisi Kandang</option>
                                                    @foreach ($categories as $data)
                                                        <option value="{{ $data->id }}">
                                                            {{ $data->kategori }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="text" id="penangkaran_id" name="penangkaran_id"
                                                    class="form-control @error('penangkaran_id') is-invalid @enderror"
                                                    placeholder="Penangkaran" value="{{ old('penangkaran_id') }}">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <ion-icon name="attach"></ion-icon>
                                                    </div>
                                                </div>
                                                @error('penangkaran_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Tambah</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <?php $no = 1; ?>
                            @foreach ($kandangs as $data)
                                <div class="col-md-4 ">
                                    <div class="card">
                                        <img src="https://images.unsplash.com/photo-1475855581690-80accde3ae2b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80"
                                            class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"><b>{{ $data->namakandang }}</b></h5>
                                            <p class="card-text">Kondisi Kandang<br>
                                                <b>{{ $data->category->kategori }}</b><br>
                                                <b> {{ $data->penangkaran->lokasi_penangkaran }}</b>
                                            </p>
                                            <a href="/penangkaran" class="btn btn-primary">Go
                                                somewhere</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

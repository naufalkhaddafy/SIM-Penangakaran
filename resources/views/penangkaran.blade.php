@extends('template.template')
@section('title', 'Penangkaran')

@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                @if (session('create'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h6><i class="icon fas fa-check"></i>{{ session('create') }} </h6>
                    </div>
                @elseif(session('delete'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h6><i class="icon fas fa-check"></i>{{ session('delete') }}</h6>
                    </div>
                @endif
                <h3 class="card-title">
                    <td>
                        <button type="button" class="btn btn-block btn-outline-success" data-toggle="modal"
                            data-target="#modal-lg">
                            <ion-icon name="home"></ion-icon> <b>Tambah</b>
                        </button>
                        <div class="modal fade" id="modal-lg">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Tambah Penangkaran</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('penangkaran') }}" method="post">
                                            @csrf
                                            <div class="input-group mb-3">
                                                <input type="text" id="kode_penangkara" name="kode_penangkaran"
                                                    class="form-control @error('kode_penangkaran') is-invalid @enderror"
                                                    placeholder="Kode Penangkaran" value="{{ $kode }}" required
                                                    readonly>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <ion-icon name="code-slash"></ion-icon>
                                                    </div>
                                                </div>
                                                @error('kode_penangkaran')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="text" id="lokasipenangkaran" name="lokasi_penangkaran"
                                                    class="form-control @error('lokasi_penangkaran') is-invalid @enderror"
                                                    placeholder="Lokasi Penangkaran"
                                                    value="{{ old('lokasi_penangkaran') }}" required>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <ion-icon name="home"></ion-icon>
                                                    </div>
                                                </div>
                                                @error('lokasi_penangkaran')
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
                    </td>
                </h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <?php $no = 1; ?>
                    @foreach ($penangkarans as $data)
                        <div class="col-lg-4 col-md-6">
                            <link rel="stylesheet" href="{{ asset('card') }}/card1.css" />
                            {{-- <a id="id" href=""> --}}
                            <div>
                                <div class="card">
                                    <div class="box">
                                        <div class="content">
                                            <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                                data-target="{{ url('#delete' . $data->id) }}">
                                                &times;
                                            </button>
                                            <h2>0{{ $no++ }}</h2>
                                            <h3>Penangkaran </h3>
                                            <p>
                                                <b>{{ $data->kode_penangkaran }}</b><br>
                                                {{ $data->lokasi_penangkaran }}
                                            </p>
                                            <a href="{{ url('/penangkaran/' . $data->id) }}">Info
                                                Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- </a> --}}
                        </div>
                        <div class="modal fade" id="delete{{ $data->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Alert</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah anda ingin menghapus {{ $data->lokasi_penangkaran }}</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                                        <a href='{{ url('/penangkaran/delete/' . $data->id) }}' type="button"
                                            class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

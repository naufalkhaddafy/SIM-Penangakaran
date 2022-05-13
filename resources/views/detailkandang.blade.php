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
                                <button type="button" class="btn btn-block btn-outline-success" data-toggle="modal"
                                    data-target="#modal-lg">
                                    <ion-icon name="home"></ion-icon> <b>Tambah</b>
                                </button>
                                <div class="modal fade" id="modal-lg">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Tambah Kandang</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('kandang') }}" method="post">
                                                    @csrf
                                                    <div class="input-group mb-3">
                                                        <input type="text" id="nama_kandang" name="nama_kandang"
                                                            class="form-control @error('nama_kandang') is-invalid @enderror"
                                                            placeholder="Nama Kandang"
                                                            value="CR-{{ old('nama_kandang') }}" required>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <ion-icon name="code-slash"></ion-icon>
                                                            </div>
                                                        </div>
                                                        @error('nama_kandang')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <select name="kategori" id="kategori"
                                                            class="form-control @error('kategori') is-invalid @enderror"
                                                            required>
                                                            <option value="" selected>Kondisi Kandang</option>
                                                            <option value="Produktif"> Produktif</option>
                                                            <option value="Tidak Produktif"> Tidak Produktif</option>
                                                            <option value="Ganti Bulu"> Ganti Bulu</option>
                                                        </select>
                                                        @error('category_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <input type="hidden" id="penangkaran_id" name="penangkaran_id"
                                                            class="form-control @error('penangkaran_id') is-invalid @enderror"
                                                            placeholder="Penangkaran" value="{{ $penangkarans->id }}">
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
                    <!-- /.card-header -->
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
                        <div class="row">
                            <?php $no = 1; ?>
                            @foreach ($penangkarans->kandangs as $data)
                                <div class="col-md-4">
                                    <div class="card">

                                        {{-- <button type="button" class="close" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button> --}}
                                        {{-- <button type="button" class="close" data-toggle="modal"
                                                data-target="{{ url('#delete' . $data->id) }}">
                                                <ion-icon name="ellipsis-vertical"></ion-icon>
                                            </button> --}}

                                        <div class="btn-group">
                                            <div class="btn-group">
                                                <button type="button" class="btn" data-toggle="dropdown">
                                                    <ion-icon name="ellipsis-vertical"></ion-icon>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <button class="dropdown-item" data-toggle="modal" href="#">
                                                        <ion-icon name="create-outline"></ion-icon> Update
                                                    </button>
                                                    <div class="dropdown-divider"></div>
                                                    <button class="dropdown-item" data-toggle="modal"
                                                        href="{{ url('#delete' . $data->id) }}">
                                                        <ion-icon name="trash-outline"></ion-icon> Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <img src="https://images.unsplash.com/photo-1475855581690-80accde3ae2b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80"
                                            class="card-img-top" alt="...">
                                        <div class="card-body" style="text-align:center">
                                            <h4>
                                                <b>Kandang {{ $data->nama_kandang }}</b>
                                            </h4>
                                            <h5 class="card-text">Kondisi Kandang<br>
                                                <b class="text-success">{{ $data->kategori }}</b><br>
                                                <b></b>
                                            </h5>
                                            <br>
                                            <a href="{{ url('kandang' . '/' . $data->id . '/' . $data->nama_kandang) }}"
                                                class="btn btn-primary">Detail Kandang
                                            </a>
                                        </div>

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
                                                    <p>Apakah anda ingin menghapus Kandang {{ $data->nama_kandang }}</p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Tidak</button>
                                                    <a href='{{ url('/kandang/delete/' . $data->id) }}' type="button"
                                                        class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>

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

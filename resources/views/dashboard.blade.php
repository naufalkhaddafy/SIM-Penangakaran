@extends('template.template')
@section('title', 'Dashboard')

@section('content')
    <div class="content">
        <div class="container-fluid">
            @if (session('login'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h6><i class="icon fas fa-check"></i>{{ session('login') }}</h6>
                    <h5>Selamat Datang {{ Auth::user()->nama_lengkap }}</h5>
                </div>
            @endif
            @if (Auth::user()->role == 'pemilik')
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <tbody>
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>
                                        {{ count($penangkarans) }}
                                    </h3>
                                    <p>Jumlah Penangkaran</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-location"></i>
                                </div>
                                <a href="{{ route('penangkaran') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </tbody>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ count($kandangs) }}</h3>
                                <p>Jumlah Kandang</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-home"></i>
                            </div>
                            <a href="{{ route('kandang') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>
                                    {{ count($users) }}
                                </h3>
                                <p>Jumlah Pengguna</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('pengguna') }}" class="small-box-footer">Info Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>65</h3>
                                <p>Unique Visitors</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            @elseif(Auth::user()->role == 'pekerja')
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                {{-- <div class="card-header">
                                </div> --}}
                                <div class="card-body">
                                    <br>
                                    <div style="text-align:center">
                                        {{-- <h3><b>HALAMAN PEKERJA</b></h3> --}}
                                        <h3><b>Selamat Datang</b></h3>
                                        <h3> {{ Auth::user()->nama_lengkap }} </h3>
                                        <h3> <b>Tanggal</b> </h3>
                                        <h4>{{ date('l, d F Y') }} </h4>
                                        <h3> <b>Lokasi Penangkaran</b>
                                            <h4> {{ optional(Auth::user()->penangkaran)->lokasi_penangkaran ?? 'Lokasi Penangkaran Belum Tersedia' }}
                                            </h4>
                                            {{-- {{ Auth::user() }} --}}
                                    </div>
                                    <br>
                                    <div class="card">
                                        <div class="card-header border-0">
                                            <h5 style="text-align:center"><b>Pakan Tersedia</b></h5>
                                        </div>
                                        <div class="card-body table-responsive p-0">
                                            <table class="table table-striped table-valign-middle">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Pakan</th>
                                                        <th>Kode Tempat</th>
                                                        <th>Kadaluwarsa</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            Pakan
                                                        </td>
                                                        <td>$13 USD</td>
                                                        <td> Tanggal</td>
                                                        <td>
                                                            <a href="#" class="text-muted">
                                                                <i class="fas fa-search"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header border-0">
                                                    <h5 style="text-align:center"><b>Informasi Kandang</b></h5>
                                                </div>
                                                {{-- produktif --}}
                                                <div style="text-align:center" class="bg-lime p-md-2">
                                                    <h6><b>Produktif</b></h6>
                                                </div>
                                                <div class="card-body table-responsive p-0">
                                                    <table class="table table-striped table-valign-middle">
                                                        <thead>
                                                            <tr align="center">
                                                                <th>Kandang</th>
                                                                <th>Status Telur</th>
                                                                <th>Akan Bertelur</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody align="center">
                                                            @foreach (Auth::user()->penangkaran->kandangs ?? [] as $data)
                                                                @if ($data->kategori == 'Produktif')
                                                                    <tr>
                                                                        <td>
                                                                            {{ $data->nama_kandang }}
                                                                        </td>
                                                                        <td class="m-3 p-2 badge bg-success">
                                                                            @foreach ($data->produksis as $d)
                                                                                @if ($loop->last)
                                                                                    @if ($d->status_telur == 'pertama')
                                                                                        Kedua
                                                                                    @elseif($d->status_telur == 'kedua')
                                                                                        Pertama
                                                                                    @endif
                                                                                @endif
                                                                            @endforeach
                                                                        </td>
                                                                        <td>
                                                                            @foreach ($data->produksis as $d)
                                                                                @if ($loop->last)
                                                                                    {{ date('d F Y', strtotime($d->jadwal->latest()->first()->tgl_akan_bertelur)) }}
                                                                                @endif
                                                                            @endforeach
                                                                        </td>
                                                                        <td></td>
                                                                        <td>
                                                                            <button type="button"
                                                                                class="btn btn-default  btn-outline-success"
                                                                                data-toggle="modal"
                                                                                data-target="{{ url('#modal-create' . $data->id) }}">
                                                                                <ion-icon name="add"></ion-icon>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                {{-- tidak produktif --}}
                                                <div style="text-align:center" class="bg-warning p-md-2">
                                                    <h6><b>Tidak Produktif</b></h6>
                                                </div>
                                                <div class="card-body table-responsive p-0">
                                                    <table class="table table-striped table-valign-middle">

                                                        <thead align="center">
                                                            <tr>
                                                                <th>Kandang</th>
                                                                <th>Masuk Kandang</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody align="center">
                                                            @foreach (Auth::user()->penangkaran->kandangs ?? [] as $data)
                                                                @if ($data->kategori == 'Tidak Produktif')
                                                                    <tr>
                                                                        <td>
                                                                            {{ $data->nama_kandang }}
                                                                        </td>
                                                                        <td>date
                                                                        </td>
                                                                        <td>
                                                                            <a href="#" class="text-muted">
                                                                                <i class="fas fa-search"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                {{-- ganti bulu --}}
                                                <div style="text-align:center" class="bg-lightblue p-md-2">
                                                    <h6><b>Ganti Bulu</b></h6>
                                                </div>
                                                <div class="card-body table-responsive p-0">
                                                    <table class="table table-striped table-valign-middle">

                                                        <thead align="center">
                                                            <tr>
                                                                <th>Kandang</th>
                                                                <th>Terakhir Bertelur</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody align="center">
                                                            @foreach (Auth::user()->penangkaran->kandangs ?? [] as $data)
                                                                @if ($data->kategori == 'Ganti Bulu')
                                                                    <tr>
                                                                        <td>
                                                                            {{ $data->nama_kandang }}
                                                                        </td>
                                                                        <td>date
                                                                        </td>
                                                                        <td>
                                                                            <a href="#" class="text-muted">
                                                                                <i class="fas fa-search"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header border-0">
                                                    <h5 style="text-align:center"><b>Kebersihan Kandang</b></h5>
                                                </div>
                                                <div class="card-body table-responsive p-0">
                                                    <table class="table table-striped table-valign-middle">
                                                        <thead>
                                                            <tr>
                                                                <th>Kandang</th>
                                                                <th>Pembersihan</th>
                                                                <th>Status</th>
                                                            </tr>

                                                        </thead>
                                                        <tbody>
                                                            @foreach (Auth::user()->penangkaran->kandangs ?? [] as $data)
                                                                <tr>
                                                                    <td>
                                                                        {{ $data->nama_kandang }}
                                                                    </td>
                                                                    <td>{{ $data->jadwal_pembersihan }}</td>
                                                                    <td>
                                                                        <a href="#" class="text-muted">
                                                                            <i class="fas fa-search"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Modal create --}}
                @foreach (Auth::user()->penangkaran->kandangs ?? [] as $data)
                    @if ($data->kategori == 'Produktif')
                        <div class="modal fade" id="modal-create{{ $data->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Tambah Telur Baru</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form
                                            action="{{ url('/produksi-telur' . '/' . $data->id . '/' . $data->nama_kandang) }}"
                                            method="POST">
                                            @csrf

                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="TanggalBertelur">Tanggal Bertelur Hari ini
                                                        Kandang
                                                        {{ $data->nama_kandang }}</label>
                                                    <input type="input"
                                                        class="form-control  @error('tgl_bertelur') is-invalid @enderror"
                                                        id="tgl_bertelur" name="tgl_bertelur" value="{{ date('Y-m-d') }}"
                                                        readonly>
                                                    @error('tgl_bertelur')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <input type="hidden" class="form-control" id="tgl_masuk_inkubator"
                                                        name="tgl_masuk_inkubator" value="{{ date('Y-m-d') }}">
                                                    <input type="hidden" class="form-control" id="kandang_id"
                                                        name="kandang_id" value="{{ $data->id }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="StatusTelur">Status Telur</label>
                                                    <select name="status_telur" id="status_telur"
                                                        class="form-control @error('statur_telur') is-invalid @enderror"
                                                        required>
                                                        <option value="" selected>Status Telur</option>
                                                        <option value="pertama">Pertama</option>
                                                        <option value="kedua">Kedua</option>
                                                    </select>
                                                    @error('status_telur')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
@endsection

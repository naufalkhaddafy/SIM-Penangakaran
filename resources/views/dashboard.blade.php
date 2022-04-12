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
                                        class="fas fa-arrow-circle-right"></i></a>
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
                                        <h4> <b>Tanggal</b> </h4>
                                        <h4>{{ date('l, d F Y') }} </h4>
                                        <h4> <b>{{ optional(Auth::user()->penangkaran)->lokasi_penangkaran }}</b> </h4>
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
                                                <div style="text-align:center" class="bg-success p-md-2">
                                                    <h5><b>Produktif</b></h5>
                                                </div>
                                                <div class="card-body table-responsive p-0">
                                                    <table class="table table-striped table-valign-middle">
                                                        <thead>
                                                            <tr>
                                                                <th>Kandang</th>
                                                                <th>Akan Bertelur</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach (Auth::user()->penangkaran->kandangs->where('kategori', 'Produktif') ?? [] as $data)
                                                                <tr>
                                                                    <td>
                                                                        {{ $data->nama_kandang }}
                                                                    </td>
                                                                    <td>{{ $data->tgl_akan_bertelur }}
                                                                    </td>
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
                                                {{-- tidak produktif --}}
                                                <div style="text-align:center" class="bg-warning p-md-2">
                                                    <h5><b>Tidak Produktif</b></h5>
                                                </div>
                                                <div class="card-body table-responsive p-0">
                                                    <table class="table table-striped table-valign-middle">

                                                        <thead>
                                                            <tr>
                                                                <th>Kandang</th>
                                                                <th>Masuk Kandang</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach (Auth::user()->penangkaran->kandangs->where('kategori', 'Tidak Produktif') ?? [] as $data)
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
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                {{-- ganti bulu --}}
                                                <div style="text-align:center" class="bg-info p-md-2">
                                                    <h5><b>Ganti Bulu</b></h5>
                                                </div>
                                                <div class="card-body table-responsive p-0">
                                                    <table class="table table-striped table-valign-middle">

                                                        <thead>
                                                            <tr>
                                                                <th>Kandang</th>
                                                                <th>Terakhir Bertelur</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach (Auth::user()->penangkaran->kandangs->where('kategori', 'Ganti Bulu') ?? [] as $data)
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
            @endif
        </div>
    </div>
@endsection

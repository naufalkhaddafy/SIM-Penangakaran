@extends('admin-lte.template')
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
                        <h3 class="card-title">
                            <td>
                                Detail Kandang
                            </td>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div style="text-align:center">
                            <h2>Lokasi Penangkaran</h2>
                            <a href="#">
                                <h2><b>{{ optional(Auth::user()->penangkaran)->lokasi_penangkaran }}</b></h2>
                            </a>
                            <h2>Jumlah Kandang : {{ count(Auth::user()->penangkaran->kandangs ?? []) }}</h2>
                        </div>
                        <br>
                        <div class="row">
                            @foreach (Auth::user()->penangkaran->kandangs ?? [] as $data)
                                <div class="col-md-4">
                                    <div class="card">
                                        <a class="text-dark"
                                            href="{{ url('kandang' . '/' . $data->id . '/' . $data->nama_kandang) }}">
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
                                                <h6 class="card-text"> Indukan<br>
                                                    <b class="text-success">
                                                        {{-- <a href="#">{{ $data->indukan }}</a> --}}
                                                        @foreach ($data->indukans as $indukan)
                                                            <a href="#">{{ optional($indukan->produksi)->kode_ring }}
                                                            </a>
                                                        @endforeach

                                                    </b>
                                                </h6>
                                                <h5 class="card-text">Masuk Kandang<br>
                                                    <b class="text-danger">{{ $data->tgl_masuk_kandang }}</b><br>
                                                </h5>
                                                <a href="{{ url('kandang' . '/' . $data->id . '/' . $data->nama_kandang) }}"
                                                    class="btn btn-primary">Detail Kandang</a>
                                            </div>
                                        </a>
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

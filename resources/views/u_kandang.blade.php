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
                                <h2><b>{{ Auth::user()->penangkaran->lokasi_penangkaran }}</b></h2>
                            </a>
                            <h2>Jumlah Kandang : {{ count(Auth::user()->penangkaran->kandangs) }}</h2>
                        </div>
                        <br>
                        <div class="row">
                            <?php $no = 1; ?>
                            @foreach (Auth::user()->penangkaran->kandangs as $data)
                                <div class="col-md-4">
                                    <div class="card">
                                        <a class="text-dark" href="#">
                                            <img src="https://images.unsplash.com/photo-1475855581690-80accde3ae2b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80"
                                                class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><b>{{ $data->namakandang }}</b>
                                                </h5>
                                                <p class="card-text">Kondisi Kandang<br>
                                                    <b class="text-success">{{ $data->kategori }}</b><br>
                                                    <b></b>
                                                </p>
                                                <a href="{{ url('kandang' . '/' . $data->id . '/' . $data->namakandang) }}"
                                                    class="btn btn-primary">Go
                                                    somewhere</a>
                                            </div>
                                        </a>
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
                                                    <p>Apakah anda ingin menghapus {{ $data->namakandang }}
                                                    </p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Tidak</button>
                                                    <a href='{{ url('/kandang/delete/' . $data->id) }}' type="button"
                                                        class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
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

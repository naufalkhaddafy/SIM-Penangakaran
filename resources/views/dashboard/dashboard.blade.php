@extends('admin-lte.template')
@section('title', 'Dashboard')

@section('content')
    <div class="content-wrapper">
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
                            <a href="{{ route('read.penangkaran') }}" class="small-box-footer">Info Detail <i
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
                        <a href="{{ route('kandang') }}" class="small-box-footer">Info Detail <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>
                                {{ count($users->where('role', 'pekerja')) }}
                            </h3>
                            <p>Jumlah Pekerja</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('pengguna.pekerja') }}" class="small-box-footer">Info Detail <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ count($produksis->where('status_produksi', 'Hidup')) }}</h3>
                            <p>Hasil Produksi Hidup</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{ route('report.hidup') }}" class="small-box-footer">Info Detail <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Sales</h3>
                        <a href="javascript:void(0);">View Report</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg">$18,230.00</span>
                            <span>Sales Over Time</span>
                        </p>
                        <p class="ml-auto d-flex flex-column text-right">
                            <span class="text-success">
                                <i class="fas fa-arrow-up"></i> 33.1%
                            </span>
                            <span class="text-muted">Since last month</span>
                        </p>
                    </div>
                    <!-- /.d-flex -->

                    <div class="position-relative mb-4">
                        <canvas id="sales-chart" height="200"></canvas>
                    </div>

                    <div class="d-flex flex-row justify-content-end">
                        <span class="mr-2">
                            <i class="fas fa-square text-primary"></i> This year
                        </span>

                        <span>
                            <i class="fas fa-square text-gray"></i> Last year
                        </span>
                    </div>
                </div>
            </div>
        @elseif(Auth::user()->role == 'pekerja')
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
                            <div id="readPakan"></div>
                            <div id="readJadwal"></div>
                            <div id="readKebersihan"></div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Dynamic Modal --}}
            <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel"></h5>
                            <button type="button" class="btn-close" id="close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="showModalBody">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="btnClose"
                                data-bs-dismiss="modal">Close</button>
                            <button type="button" id="btnSubmit" class="btn btn-primary"></button>
                            <button type="button" id="btnDelete" class="btn btn-primary"></button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Modal Create Kebersihan --}}
            @foreach (Auth::user()->penangkaran->kandangs ?? [] as $data)
                <div class="modal fade" id="modal-createkebersihan{{ $data->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah Kandang Telah Dibersihkan</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('/kebersihan/create') }}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="TanggalBertelur"> Hari ini
                                                {{ $data->nama_kandang }} Telah Dibersihkan </label>
                                            <input type="input"
                                                class="form-control  @error('tgl_pembersihan') is-invalid @enderror"
                                                id="tgl_pembersihan" name="tgl_pembersihan"
                                                value="{{ date('Y-m-d') }}" readonly>
                                            <input type="hidden" class="form-control" id="kandang_id" name="kandang_id"
                                                value="{{ $data->id }}" readonly>
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
            @endforeach
        @endif
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            readPakan();
            readJadwal();
            readKebersihan();
        });

        function readPakan() {
            $.get("{{ url('/dashboard/pakan') }}", function(data) {
                $('#readPakan').html(data);
            });
        }

        function readJadwal() {
            $.get("{{ url('/dashboard/jadwal') }}", function(data) {
                $('#readJadwal').html(data);
            });
        }

        function readKebersihan() {
            $.get("{{ url('/dashboard/kebersihan') }}", function(data) {
                $('#readKebersihan').html(data);
            });
        }

        function showCreate(id) {
            $.get("{{ url('/modal-create-produksi') }}/" + id, function(data) {
                $('#modalLabel').text('Tambah Data Telur Baru')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').show();
                $('#btnSubmit').show().text('Tambah').attr('onclick', 'tambah()');
                $('#btnDelete').hide();
            });
        }

        function showUpdate(id) {
            $.get("{{ url('/modal-update-pakan') }}/" + id, function(data) {
                $('#modalLabel').text('Update Data Pakan')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').show();
                $('#btnSubmit').show().text('Update').attr('onclick', 'update()');
                $('#btnDelete').hide();
            });
        }
    </script>
@endpush

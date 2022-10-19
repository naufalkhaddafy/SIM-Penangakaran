@extends('admin-lte.template')
@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
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
                            <h3>{{ count($produksis->where('kandang_id', '!==', null)) }}</h3>
                            <p>Hasil Produksi</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{ route('report.hidup') }}" class="small-box-footer">Info Detail <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            {{-- CHART START --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sexing</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="chart-responsive">
                                <canvas id="pieChart" height="150"></canvas>
                            </div>
                            <!-- ./chart-responsive -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-4">
                            <ul class="chart-legend clearfix">
                                <li><i class="far fa-circle text-danger"></i> Jantan</li>
                                <li><i class="far fa-circle text-primary"></i> Betina</li>
                                <li><i class="far fa-circle text-secondary"></i> Belum DNA</li>
                            </ul>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
            </div>
            {{-- CHART END --}}
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
                                            ({{ optional(Auth::user()->penangkaran)->kode_penangkaran ?? '' }})
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
            </div>
        @endif
    </div>
    {{-- Dynamic Modal --}}
    <div class="modal fade " id="showModal">
        <div class="modal-dialog modal-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="showModalBody">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" id="btnClose" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="btnSubmit" class="btn btn-info"></button>
                    <button type="submit" id="btnDelete" class="btn btn-danger"></button>
                </div>
            </div>
        </div>
    </div>
@endsection
@if (Auth::user()->role == 'pemilik')
    @push('js')
        <script src="{{ asset('admin-lte') }}/plugins/chart.js/Chart.min.js"></script>
        <script>
            $.get("{{ route('chart') }}", function(data) {
                var Jantan = data.Jantan;
                var Betina = data.Betina;
                var None = data.None;
                var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
                var pieData = {
                    labels: [
                        'Jantan',
                        'Betina',
                        'Belum DNA',
                    ],
                    datasets: [{
                        data: [Jantan, Betina, None],
                        backgroundColor: ['#f56954', '#3c8dbc', '#d2d6de']
                    }]
                }
                var pieOptions = {
                    legend: {
                        display: false
                    }
                }
                var pieChart = new Chart(pieChartCanvas, {
                    type: 'doughnut',
                    data: pieData,
                    options: pieOptions
                })
            });
        </script>
    @endpush
@endif
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

        function showCreateProduksi(id) {
            $.get("{{ url('/modal-create-produksi') }}/" + id, function(data) {
                $('#modalLabel').text('Tambah Data Telur Baru')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').show();
                $('#btnSubmit').show().text('Tambah').attr('onclick', 'tambah()');
                $('#btnDelete').hide();
            });
        }

        function showUpdatePakan(id) {
            $.get("{{ url('/modal-update-pakan') }}/" + id, function(data) {
                $('#modalLabel').text('Update Data Pakan')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').show();
                $('#btnSubmit').show().text('Update').attr('onclick', 'update()');
                $('#btnDelete').hide();
            });
        }

        function showCreateKebersihan(id) {
            $.get("{{ url('/modal-create-kebersihan') }}/" + id, function(data) {
                $('#modalLabel').text('Tambah Data Pembersihan Kandang')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').show();
                $('#btnSubmit').show().text('Tambah').attr('onclick', 'tambah()');
                $('#btnDelete').hide();
            });
        }
    </script>
@endpush

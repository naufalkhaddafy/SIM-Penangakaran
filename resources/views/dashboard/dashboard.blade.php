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
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="sales-chart" height="200" class="chartjs-render-monitor"></canvas>
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
@push('js')
    <script src="{{ asset('admin-lte') }}/plugins/chart.js/Chart.min.js"></script>
    <script>
        $(function() {
            'use strict'

            var ticksStyle = {
                fontColor: '#495057',
                fontStyle: 'bold'
            }

            var mode = 'index'
            var intersect = true

            var $salesChart = $('#sales-chart')
            // eslint-disable-next-line no-unused-vars
            var salesChart = new Chart($salesChart, {
                type: 'bar',
                data: {
                    labels: ['JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
                    datasets: [{
                            backgroundColor: '#007bff',
                            borderColor: '#007bff',
                            data: [1000, 2000, 3000, 2500, 2700, 2500, 3000]
                        },
                        {
                            backgroundColor: '#ced4da',
                            borderColor: '#ced4da',
                            data: [700, 1700, 2700, 2000, 1800, 1500, 2000]
                        }
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            // display: false,
                            gridLines: {
                                display: true,
                                lineWidth: '4px',
                                color: 'rgba(0, 0, 0, .2)',
                                zeroLineColor: 'transparent'
                            },
                            ticks: $.extend({
                                beginAtZero: true,

                                // Include a dollar sign in the ticks
                                callback: function(value) {
                                    if (value >= 1000) {
                                        value /= 1000
                                        value += 'k'
                                    }

                                    return '$' + value
                                }
                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false
                            },
                            ticks: ticksStyle
                        }]
                    }
                }
            })

        })
    </script>
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

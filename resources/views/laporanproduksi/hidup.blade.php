@extends('admin-lte.template')
@section('title', 'Hasil Produksi Hidup')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        @if (session('create'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
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
                                    <select name="penangkaran_id" id="penangkaran"
                                        class="form-control @error('penangkaran_id') is-invalid @enderror" required>
                                        <option value="" selected><b>Pilih Penangkaran</b></option>
                                        @foreach ($penangkarans as $data)
                                            <option value="{{ $data->id }}">
                                                {{ $data->lokasi_penangkaran }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <div class="col-lg-3 col-md-6" style="margin:1px;">
                                    <button id="cek" type="button" class="btn btn-block btn-outline-dark">
                                        <ion-icon name="home"></ion-icon> <b>Cek Penangkaran</b>
                                    </button>
                                </div>
                            </div>
                        </h3>
                    </div>
                    <div class="readData"></div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead align="center">
                                <tr>
                                    <th>Penangkaran</th>
                                    <th>Kode Ring</th>
                                    <th>Asal Telur</th>
                                    <th>Tanggal Menetas</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Usia</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody align="center">
                                @foreach ($produksis->where('status_produksi', 'Hidup') as $data)
                                    <tr>
                                        <td>{{ $data->kandang->penangkaran->lokasi_penangkaran }}</td>
                                        <td>{{ $data->kode_ring ?? 'belum tersedia' }} </td>
                                        <td>Kandang <b>{{ $data->kandang->nama_kandang }}</b> Telur
                                            {{ $data->status_telur }} </td>
                                        <td>{{ date('d F Y', strtotime($data->tgl_menetas)) }}</td>
                                        <td>{{ $data->jenis_kelamin }}</td>
                                        <td> {{ \Carbon\Carbon::parse($data->tgl_menetas)->diffInMonths($tgl_today) }}
                                            Bulan
                                            {{ \Carbon\Carbon::parse($data->tgl_menetas)->diffInDays($tgl_today) }}Hari
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-default  btn-outline-success"
                                                data-toggle="modal" data-target="{{ url('#modal-read' . $data->id) }}">
                                                <ion-icon name="search"></ion-icon>
                                            </button>
                                            <button type="button" class="btn btn-default  btn-outline-success"
                                                data-toggle="modal" data-target="{{ url('#modal-update' . $data->id) }}">
                                                <ion-icon name="open-outline"></ion-icon>
                                            </button>


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
@endsection
@push('js')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush

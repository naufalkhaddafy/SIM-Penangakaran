@extends('admin-lte.template')
@section('title', 'Data Indukan')
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
                            </td>
                        </h3>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead align="center">
                                <tr>
                                    <th>Tempat Indukan</th>
                                    <th>Kode Ring</th>
                                    {{-- <th>Asal Telur</th>
                                    <th>Tanggal Menetas</th> --}}
                                    <th>Jenis Kelamin</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produksis->where('status_produksi', 'Indukan') as $data)
                                    <tr>
                                        <td>{{ $data->indukans->kandang->penangkaran->lokasi_penangkaran ?? '' }}
                                            {{ $data->indukans->kandang->nama_kandang ?? 'Belum Tersedia' }} </td>
                                        <td>{{ $data->kode_ring ?? 'Belum tersedia' }} </td>
                                        {{-- <td>Kandang <b>{{ $data->kandang->nama_kandang ?? 'Tidak Tersedia' }}</b> Telur
                                            {{ $data->status_telur }} </td>
                                        <td>{{ date('d F Y', strtotime($data->tgl_menetas ?? 'Tidak Tersedia')) }}</td> --}}
                                        <td>{{ $data->jenis_kelamin }}</td>
                                        <td>Usia
                                            {{ \Carbon\Carbon::parse($data->tgl_menetas)->diffInMonths($tgl_today) }}
                                            Bulan
                                            {{ \Carbon\Carbon::parse($data->tgl_menetas)->diffInDays($tgl_today) }} Hari
                                            <br>
                                            {{ $data->keterangan }}
                                            Asal Burung
                                            {{ $data->kandang->penangkaran->lokasi_penangkaran ?? '' }}
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
    {{-- Modal Create --}}
    <div class="modal fade " id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel">Tambah Data Indukan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="showModalBody">
                    <form action="{{ route('create.indukan') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" id="kode_ring" name="kode_ring"
                                class="form-control @error('kode_ring') is-invalid @enderror" placeholder="Kode Ring"
                                required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <ion-icon name="code-slash"></ion-icon>
                                </div>
                            </div>
                            @error('kode_ring')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control " required>
                                <option value="" selected>Jenis Kelamin</option>
                                <option value="Jantan">Jantan</option>
                                <option value="Betina">Betina</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" id="keterangan" name="keterangan" class="form-control"
                                placeholder="Keterangan Indukan">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <ion-icon name="code-slash"></ion-icon>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="hidden" id="status_produksi" name="status_produksi" class="form-control"
                                value="Indukan">
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" id="btnClose" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="btnSubmit" class="btn btn-info">Tambah</button>
                        </div>
                    </form>
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
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush

@extends('template.template')
@section('title', 'Produksi Hidup')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                        <h3 class="card-title">
                            <div class="row">

                            </div>
                        </h3>
                    </div>
                    <div class="readData"></div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Ring</th>
                                    <th>Asal Telur</th>
                                    <th>Tanggal Menetas</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Usia</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach (auth()->user()->penangkaran->kandangs ?? [] as $auth)
                                    @foreach ($auth->produksis->where('status_produksi', 'Hidup') as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
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
                                                    data-toggle="modal"
                                                    data-target="{{ url('#modal-read' . $data->id) }}">
                                                    <ion-icon name="search"></ion-icon>
                                                </button>
                                                <button type="button" class="btn btn-default  btn-outline-success"
                                                    data-toggle="modal"
                                                    data-target="{{ url('#modal-update' . $data->id) }}">
                                                    <ion-icon name="open-outline"></ion-icon>
                                                </button>


                                            </td>
                                        </tr>
                                        {{-- Modal Read --}}
                                        <div class="modal fade" id="modal-read{{ $data->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Detail Data Produksi Burung</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">

                                                        <div class="card-body">

                                                            <div class="form-group">

                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend ">
                                                                        <span class="input-group-text"> <b> Kode
                                                                                Ring</b></span>

                                                                    </div>
                                                                    <input type="input" class="form-control "
                                                                        value="{{ $data->kode_ring ?? 'Belum Tersedia' }}"
                                                                        disabled>
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"> <b>Asal
                                                                                Telur</b></span>
                                                                    </div>
                                                                    <input type="input" class="form-control"
                                                                        value="Kandang {{ $data->kandang->nama_kandang }}"
                                                                        disabled>
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><b> Status Telur
                                                                            </b></span>
                                                                    </div>
                                                                    <input type="input" class="form-control"
                                                                        value="{{ $data->status_telur }}" disabled>
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"> <b> Tanggal
                                                                                Bertelur </b></span>
                                                                    </div>
                                                                    <input type="input" class="form-control"
                                                                        value="{{ date('d F Y', strtotime($data->tgl_bertelur)) }}"
                                                                        disabled>
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"> <b> Tanggal
                                                                                Menetas</b></span>
                                                                    </div>
                                                                    <input type="input" class="form-control"
                                                                        value="{{ date('d F Y', strtotime($data->tgl_menetas)) }}"
                                                                        disabled>
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"> <b>Jenis
                                                                                Kelamin</b>
                                                                        </span>
                                                                    </div>
                                                                    <input type="input" class="form-control  "
                                                                        value="{{ $data->jenis_kelamin ?? 'Belum Tersedia' }}"
                                                                        disabled>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- modal Update --}}

                                        <div class="modal fade" id="modal-update{{ $data->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update Data Produksi Burung</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ url('/produksi-hidup/update/' . $data->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="card-body">
                                                                <div class="form-group">

                                                                    <label for="kode_ring">Kode Ring</label>
                                                                    <input type="input"
                                                                        class="form-control  @error('kode_ring') is-invalid @enderror"
                                                                        id="kode_ring" name="kode_ring"
                                                                        value="{{ $data->kode_ring }}"
                                                                        placeholder="Masukan Kode Ring">
                                                                    @error('kode_ring')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                    <label for="jeniskelamin">Jenis Kelamin</label>
                                                                    <select name="jenis_kelamin" id="jenis_kelamin"
                                                                        class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                                                        <option value="" selected>Jenis Kelamin</option>
                                                                        <option value="Jantan">Jantan</option>
                                                                        <option value="Betina">Betina</option>
                                                                    </select>
                                                                    @error('jenis_kelamin')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                    <label for="status_produksi">Kondisi Burung</label>
                                                                    <select name="status_produksi" id="status_produksi"
                                                                        class="form-control @error('status_produksi') is-invalid @enderror"
                                                                        required>
                                                                        <option value="{{ $data->status_produksi }}"
                                                                            selected>{{ $data->status_produksi }}
                                                                        </option>
                                                                        <option value="Mati">Mati</option>
                                                                    </select>
                                                                    @error('status_produksi')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                    <input type="hidden"
                                                                        class="form-control  @error('keterangan') is-invalid @enderror"
                                                                        id="keterangan" name="keterangan"
                                                                        value="{{ \Carbon\Carbon::parse($data->tgl_menetas)->diffInMonths($tgl_today) }}
                                                                Bulan
                                                                {{ \Carbon\Carbon::parse($data->tgl_menetas)->diffInDays($tgl_today) }}Hari ">

                                                                </div>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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
    <script src="{{ asset('template') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    {{-- <script src="{{ asset('template') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('template') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('template') }}/plugins/pdfmake/vfs_fonts.js"></script> --}}
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

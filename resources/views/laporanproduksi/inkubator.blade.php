@extends('template.template')
@section('title', 'Hasil Produksi Inkubator')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

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
                                    <th>Kode Inkubator</th>
                                    <th>Tanggal Masuk Inkubator</th>
                                    <th>Tanggal Akan Menetas</th>
                                    <th>Asal Telur</th>
                                    <th>Update</th>
                                </tr>
                            </thead>
                            <tbody align="center">
                                @foreach ($produksis->where('status_produksi', 'Inkubator') as $data)
                                    <tr>
                                        <td>{{ $data->jadwal->kode_tempat_inkubator }}</td>
                                        <td>{{ date('d F Y', strtotime($data->tgl_masuk_inkubator)) }}</td>
                                        <td class="text-danger">
                                            {{ date('d', strtotime($data->jadwal->tgl_akan_menetas_start)) }}-{{ date('d F Y', strtotime($data->jadwal->tgl_akan_menetas_end)) }}
                                        </td>
                                        <td>Kandang <b>{{ $data->kandang->nama_kandang }}</b> Telur
                                            {{ $data->status_telur }} </td>
                                        <td><button type="button" class="btn btn-default  btn-outline-success"
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
    <script src="{{ asset('template') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    {{-- <script src="{{ asset('template') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('template') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('template') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script> --}}
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

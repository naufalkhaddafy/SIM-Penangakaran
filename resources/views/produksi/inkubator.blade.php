@extends('template.template')
@section('title', 'Produksi Inkubator')
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
                            <div class="row">
                            </div>
                        </h3>
                    </div>
                    <div class="readData"></div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead align="center">
                                <tr>
                                    <th>No</th>
                                    <th>Kandang</th>
                                    <th>Status Telur</th>
                                    <th>Tanggal Bertelur</th>
                                    <th>Tanggal Masuk Inkubator</th>
                                    <th>Tanggal Akan Menetas</th>
                                    <th>Keterangan</th>
                                    <th>Update</th>
                                </tr>
                            </thead>
                            <tbody align="center">
                                <?php $no = 1; ?>
                                @foreach (Auth::user()->penangkaran->kandangs ?? [] as $auth)
                                    @foreach ($auth->produksis->where('status_produksi', 'Inkubator') as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>Kandang {{ $data->kandang->nama_kandang }}</td>
                                            <td>{{ $data->status_telur }}</td>
                                            <td>{{ date('d F Y', strtotime($data->tgl_bertelur)) }}</td>
                                            <td>{{ date('d F Y', strtotime($data->tgl_masuk_inkubator)) }}</td>
                                            <td>{{ date('d F Y', strtotime($data->jadwal->tgl_akan_menetas)) }}</td>
                                            <td>menetas/tidak</td>
                                            <td><button type="button" class="btn btn-default  btn-outline-success"
                                                    data-toggle="modal"
                                                    data-target="{{ url('#modal-create' . $data->id) }}">
                                                    <ion-icon name="add"></ion-icon>
                                                </button>
                                            </td>
                                        </tr>
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

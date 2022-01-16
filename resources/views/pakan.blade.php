@extends('template.template')
@section('title', 'Supply Pakan')
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
                                <button type="button" class="btn btn-block btn-outline-success" data-toggle="modal"
                                    data-target="#modal-lg">
                                    <ion-icon name="nutrition"></ion-icon><b>Tambah</b>
                                </button>
                                <div class="modal fade" id="modal-lg">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Tambah Pakan</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('pakan') }}" method="post">
                                                    @csrf
                                                    <div class="input-group mb-3">
                                                        <input type="text" id="kode_tempat" name="kode_tempat"
                                                            class="form-control @error('kode_kategori') is-invalid @enderror"
                                                            placeholder="Kode Tempat" value="{{ old('kode_tempat') }}">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <ion-icon name="code-slash"></ion-icon>
                                                            </div>
                                                        </div>
                                                        @error('kode_tempat')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <input type="text" id="nama_pakan" name="nama_pakan"
                                                            class="form-control @error('nama_pakan') is-invalid @enderror"
                                                            placeholder="Nama Pakan " value="{{ old('nama_pakan') }}">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <ion-icon name="attach"></ion-icon>
                                                            </div>
                                                        </div>
                                                        @error('nama_pakan')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <input type="date" id="expired" name="expired"
                                                            class="form-control @error('expired') is-invalid @enderror"
                                                            placeholder="Expired" value="{{ old('expired') }}">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <ion-icon name="calendar"></ion-icon>
                                                            </div>
                                                        </div>
                                                        @error('Expired')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Tambah</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            </td>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Tempat</th>
                                    <th>Nama Pakan</th>
                                    <th>Expired</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($pakans as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->kode_tempat }}</td>
                                        <td>{{ $data->nama_pakan }}</td>
                                        <td><?= date('d F Y', strtotime($data->expired)) ?></td>
                                        <td style="text-align:center">
                                            <button type="button" class="btn btn-default bg-warning" data-toggle="modal"
                                                data-target="{{ url('#modal-update' . $data->id) }}">
                                                <ion-icon name="open-outline"></ion-icon>
                                            </button>
                                            <button type="button" class="btn btn-default bg-danger" data-toggle="modal"
                                                data-target="{{ url('#delete' . $data->id) }}">
                                                <ion-icon name="trash-outline"></ion-icon>
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
    {{-- Modal Delete --}}
    @foreach ($pakans as $data)
        <div class="modal fade" id="delete{{ $data->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Alert</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda ingin menghapus {{ $data->nama_pakan }}</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                        <a href='{{ url('/pakan/delete/' . $data->id) }}' type="button" class="btn btn-danger">Delete</a>
                    </div>
                </div>

            </div>

        </div>
    @endforeach
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
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush

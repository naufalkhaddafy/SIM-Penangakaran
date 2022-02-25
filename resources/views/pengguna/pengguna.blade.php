@extends('template.template')
@section('title', 'Pengguna')

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
                        @elseif(session('update'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                                <h6><i class="icon fas fa-check"></i>{{ session('update') }}</h6>
                            </div>
                        @endif
                        <h3 class="card-title">
                            <td>
                                <button type="button" class="btn btn-block btn-outline-success" data-toggle="modal"
                                    data-target="#modal-tambah">
                                    <ion-icon name="person-add"></ion-icon> <b>Tambah</b>
                                </button>
                            </td>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Username</th>
                                    <th>No.HP</th>
                                    <th>Level</th>
                                    <th>Lokasi Kerja</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($users as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->namalengkap }}</td>
                                        <td>{{ $data->username }}</td>
                                        <td> {{ $data->nohp }}</td>
                                        <td>{{ $data->level }}</td>
                                        <td>
                                            {{ optional($data->penangkaran)->lokasi_penangkaran }}
                                        </td>
                                        <td style="text-align:center">
                                            <button type="button" class="btn btn-default bg-info" data-toggle="modal"
                                                data-target="{{ url('#modal-read' . $data->id) }}">
                                                <ion-icon name="eye-outline"></ion-icon>
                                            </button>
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
    {{-- Modal Tambah --}}
    <div class="modal fade " id="modal-tambah">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Pengguna</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pengguna') }}" method="post" id="form-create">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" id="namalengkap" name="namalengkap"
                                class="form-control @error('namalengkap') is-invalid @enderror" placeholder="Full name"
                                value="{{ old('namalengkap') }}" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            @error('namalengkap')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" id="username" name="username"
                                class="form-control @error('username') is-invalid @enderror" placeholder="Username"
                                value="{{ old('username') }}" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" id="nohp" class="form-control @error('nohp') is-invalid @enderror"
                                name="nohp" placeholder="No.Hp +62">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-phone"></span>
                                </div>
                            </div>
                            @error('nohp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="level" class="col-sm-2 control-label">Level</label>
                            <div class="col-sm-12">
                                <select name="level" id="level" class="form-control" required>
                                    <option value="" selected>Pilih Status Pengguna</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                                @error('level')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="lokasikerja" class="col-sm-2 control-label">Lokasi
                                Kerja</label>
                            <select name="penangkaran_id" id="penangkaran"
                                class="form-control @error('penangkaran_id') is-invalid @enderror" required>
                                <option value="" selected>Lokasi Kerja</option>
                                @foreach ($penangkarans as $data)
                                    <option value="{{ $data->id }}">
                                        {{ $data->lokasi_penangkaran }}
                                    </option>
                                @endforeach
                            </select>
                            @error('penangkaran_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="btn-tambah" class="btn btn-success">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- Modal Read --}}
    @foreach ($users as $data)
        <div class="modal fade" id="modal-read{{ $data->id }}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Data Pengguna</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span><b> Nama</b>
                                </div>
                            </div>
                            <input type="text" id="namalengkap" name="namalengkap" class="form-control"
                                placeholder="Full name" value="{{ $data->namalengkap }}" disabled>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span><b>Username</b>
                                </div>
                            </div>
                            <input type="text" id="username" name="username" class="form-control" placeholder="Username"
                                value="{{ $data->username }}" disabled>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-phone"></span><b> No.HP</b>
                                </div>
                            </div>
                            <input type="text" id="nohp" class="form-control " name="nohp" placeholder="No.Hp +62"
                                value="{{ $data->nohp }}" disabled>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span><b>Status</b>
                                </div>
                            </div>
                            <input type="level" name="level" id="level" class="form-control" placeholder="Password"
                                disabled value="{{ $data->level }}">

                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <ion-icon name="location-sharp"></ion-icon><b>Berkerja di</b>
                                </div>
                            </div>
                            <input type="lokasikerja" name="penangkaran_id" id="penangkaran_id" class="form-control"
                                placeholder="Password" disabled
                                value="{{ optional($data->penangkaran)->lokasi_penangkaran }}">

                        </div>
                        </form>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    @endforeach
    {{-- Modal Update --}}
    @foreach ($users as $data)
        <div class="modal fade" id="modal-update{{ $data->id }}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Pengguna</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('pengguna/update/' . $data->id) }}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" id="namalengkap" name="namalengkap"
                                    class="form-control @error('namalengkap') is-invalid @enderror" placeholder="Full name"
                                    value="{{ $data->namalengkap }}" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                                @error('namalengkap')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" id="username" name="username"
                                    class="form-control @error('username') is-invalid @enderror" placeholder="Username"
                                    value="{{ $data->username }}" readonly>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" id="nohp" class="form-control @error('nohp') is-invalid @enderror"
                                    name="nohp" placeholder="No.Hp +62" value="{{ $data->nohp }}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-phone"></span>
                                    </div>
                                </div>
                                @error('nohp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="level" class="col-sm-2 control-label">Level</label>
                                <div class="col-sm-12">
                                    <select name="level" id="level"
                                        class="form-control @error('penangkaran_id') is-invalid @enderror" required>
                                        <option value="{{ $data->level }}" selected>{{ $data->level }}</option>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                    @error('level')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="lokasikerja" class="col-sm-2 control-label">Lokasi
                                    Kerja</label>
                                <select name="penangkaran_id" id="penangkaran"
                                    class="form-control @error('penangkaran_id') is-invalid @enderror">
                                    <option value="{{ optional($data->penangkaran)->id }}" selected>
                                        {{ optional($data->penangkaran)->lokasi_penangkaran }}
                                    </option>
                                    @foreach ($penangkarans as $data)
                                        <option value="{{ $data->id }}">
                                            {{ $data->lokasi_penangkaran }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('penangkaran_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endforeach
    {{-- Modal Delete --}}
    @foreach ($users as $data)
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
                        <p>Apakah anda ingin menghapus {{ $data->namalengkap }}</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                        <a href='{{ url('/pengguna/delete/' . $data->id) }}' type="button"
                            class="btn btn-danger">Delete</a>
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
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            @if ($errors->any()) {
                $('#modal-tambah').modal('show');
                }
            @endif
        });
    </script>
@endpush

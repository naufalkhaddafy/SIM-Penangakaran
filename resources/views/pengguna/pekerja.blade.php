@extends('template.template')
@section('title', 'Data Status Pekerja')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <td>
                                <button type="button" class="btn btn-block btn-outline-success" onclick="create()">
                                    <ion-icon name="person-add"></ion-icon> <b>Tambah</b>
                                </button>
                            </td>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="readTable"></div>
                        {{-- <table id="tableData" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Username</th>
                                    <th>No.HP</th>
                                    <th>Role</th>
                                    <th>Lokasi Kerja</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($users->where('role', 'pekerja') as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->nama_lengkap }}</td>
                                        <td>{{ $data->username }}</td>
                                        <td> {{ $data->nohp }}</td>
                                        <td>{{ $data->role }}</td>
                                        <td>
                                            {{ optional($data->penangkaran)->lokasi_penangkaran ?? 'Belum Tersedia' }}
                                        </td>
                                        <td style="text-align:center">

                                            <button type="button" class="btn btn-default bg-success"
                                                onclick="show({{ $data->id }})">
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
                        </table> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Update --}}
    {{-- @foreach ($users as $data)
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
                            @method('PATCH')
                            <div class="input-group mb-3">
                                <input type="text" id="nama_lengkap" name="nama_lengkap"
                                    class="form-control @error('nama_lengkap') is-invalid @enderror" placeholder="Full name"
                                    value="{{ $data->nama_lengkap }}" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                                @error('nama_lengkap')
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
                                <label for="role" class="col-sm-2 control-label">role</label>

                                <select name="role" id="role"
                                    class="form-control @error('penangkaran_id') is-invalid @enderror" required>
                                    <option value="{{ $data->role }}" selected>{{ $data->role }}</option>
                                    <option value="pemilik">Pemilik</option>
                                    <option value="pekerja">pekerja</option>
                                </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

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
    @endforeach --}}
    {{-- Modal Delete --}}
    {{-- @foreach ($users as $data)
        <form action="{{ route('delete.pengguna', $data->id) }}" method="POST">
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
                            <p>Apakah anda ingin menghapus {{ $data->nama_lengkap }}</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            @method('DELETE')
                            @csrf
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endforeach --}}
    {{-- ajax --}}
    <div class="modal fade " id="showModal">
        <div class="modal-dialog modal-lg">
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
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            readTable()
        });

        function readTable() {
            const url = '/table'
            $.get(url, function(data) {
                $('#readTable').html(data);
            });
        }

        function show(id) {
            const url = '/modal-read/' + id
            $.get(url, function(data) {
                $('#modalLabel').text('Data Pengguna')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').hide();
                $('#btnSubmit').hide();
            });
        }

        function create() {
            const url = '/modal-create'
            $.get(url, function(data) {
                $('#modalLabel').text('Tambah Pekerja')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').show();
                $('#btnSubmit').text('Tambah').attr('onclick', 'tambah()');
            });
        }
    </script>
@endpush
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
            @if ($errors->any())
                {
                    $('#modal-tambah').modal('show');
                }
            @endif
        });
    </script>
@endpush

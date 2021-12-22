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
                        @endif
                        <h3 class="card-title">
                            <td>
                                <button type="button" class="btn btn-block btn-outline-success" data-toggle="modal"
                                    data-target="#modal-lg">
                                    <ion-icon name="person-add"></ion-icon><b>Tambah</b>
                                </button>
                                <div class="modal fade" id="modal-lg">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Tambah Pengguna</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('pengguna') }}" method="post">
                                                    @csrf
                                                    <div class="input-group mb-3">
                                                        <input type="text" id="namalengkap" name="namalengkap"
                                                            class="form-control @error('namalengkap') is-invalid @enderror"
                                                            placeholder="Full name" value="{{ old('namalengkap') }}">
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
                                                            class="form-control @error('username') is-invalid @enderror"
                                                            placeholder="Username" value="{{ old('username') }}">
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
                                                        <input type="text" id="nohp"
                                                            class="form-control @error('nohp') is-invalid @enderror"
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
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            placeholder="Password">
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
                                                    <div class="input-group mb-3">
                                                        <input type="level" name="level" id="level" value="admin"
                                                            style="display:none">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="level" class="col-sm-2 control-label">Level</label>
                                                        <div class="col-sm-12">
                                                            <select name="level" id="inputState" class="form-control">
                                                                <option selected>Pilih Status Pengguna</option>
                                                                <option value="admin">Admin</option>
                                                                <option value="user">User</option>
                                                            </select>
                                                        </div>
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
                                    <th>Nama Lengkap</th>
                                    <th>Username</th>
                                    <th>No.HP</th>
                                    <th>Level</th>
                                    <th>Bekerja di</th>
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
                                        <td>tes</td>
                                        <td><a href="#" class="btn btn-success">
                                                <ion-icon name="eye-outline"></ion-icon>
                                            </a>
                                            <a href="#" class="btn btn-warning">
                                                <ion-icon name="open-outline"></ion-icon>
                                            </a>
                                            <button type="button" class="btn btn-default bg-danger" data-toggle="modal"
                                                data-target="{{ url('#delete' . $data->id) }}">
                                                <ion-icon name="trash-outline"></ion-icon>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @foreach ($users as $data)
                            <div class="modal fade" id="delete{{ $data->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Alert</h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah anda ingin menghapus {{ $data->namalengkap }}</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Tidak</button>
                                            <a href='{{ url('/pengguna/delete/' . $data->id) }}' type="button"
                                                class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

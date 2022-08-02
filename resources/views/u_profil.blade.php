@extends('admin-lte.template')
@section('title', 'Profil Pengguna')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <td>
                                Update Akun
                            </td>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('update.profile', $data->id) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        id="username" name="username" value="{{ $data->username }}" readonly>
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                                        id="nama_lengkap" name="nama_lengkap" value="{{ $data->nama_lengkap }}">
                                    @error('nama_lengkap')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nohp">No. HP</label>
                                    <input type="text" class="form-control @error('nohp') is-invalid @enderror"
                                        id="nohp" name="nohp" value="{{ $data->nohp }}">
                                    @error('nohp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Password" value="{{ $pw }}">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                                    <input type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        id="password_confirmation" name="password_confirmation"
                                        placeholder="Konfirmasi Password">
                                    @error('password-confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <p class="text-danger">Kosongkan Password dan Konfirmasi Password Baru jika tidak ingin
                                        mengubah</p>
                                </div>
                                {{-- <input type="hidden" name="penangkaran_id" value="{{ $data->penangkaran_id }}"></input> --}}
                                <button type="submit" class="btn btn-primary">Ganti</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

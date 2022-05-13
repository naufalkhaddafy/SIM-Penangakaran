<div class="input-group mb-3">
    <input type="text" id="nama_lengkap" name="nama_lengkap"
        class="form-control @error('nama_lengkap') is-invalid @enderror" placeholder="Full name" required>
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
    <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror"
        placeholder="Username" required>
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
    <input type="text" id="nohp" class="form-control @error('nohp') is-invalid @enderror" name="nohp"
        placeholder="No.Hp +62">
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
    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
        placeholder="Password" required>
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
    <label for="role" class="col-sm-2 control-label">Role</label>

    <select name="role" id="role" class="form-control" required>
        <option value="" selected>Pilih Status Pengguna</option>
        <option value="pemilk">Pemilik</option>
        <option value="pekerja">Pekerja</option>
    </select>
    @error('role')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="lokasikerja" class="col-sm-5 control-label">Lokasi
        Kerja</label>
    <select name="penangkaran_id" id="penangkaran_id"
        class="form-control @error('penangkaran_id') is-invalid @enderror">
        <option value="" selected>Lokasi Kerja</option>
        @foreach ($penangkaran as $data)
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
<script>
    function tambah() {
        var nama_lengkap = $('#nama_lengkap').val()
        var username = $('#username').val()
        var nohp = $('#nohp').val()
        var password = $('#password').val()
        var role = $('#role').val()
        var penangkaran_id = $('#penangkaran_id').val()
        $.ajax({
            url: '/pengguna',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                nama_lengkap: nama_lengkap,
                username: username,
                nohp: nohp,
                password: password,
                role: role,
                penangkaran_id: penangkaran_id,
            },
            // dataType: 'json',
            success: function(data) {
                $(".close").click();
                readTable()
            }

        });
    }
</script>

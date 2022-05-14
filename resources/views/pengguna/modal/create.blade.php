<div id="error"></div>
<div class="input-group mb-3">
    <input type="text" id="nama_lengkap" name="nama_lengkap"
        class="form-control @error('nama_lengkap') is-invalid @enderror" placeholder="Full name" required>
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-user"></span>
        </div>
    </div>
</div>
<div class="input-group mb-3">
    <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror"
        placeholder="Username" required>
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-user"></span>
        </div>
    </div>
</div>
<div class="input-group mb-3">
    <input type="text" id="nohp" class="form-control @error('nohp') is-invalid @enderror" name="nohp"
        placeholder="No.Hp +62">
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-phone"></span>
        </div>
    </div>
</div>
<div class="input-group mb-3">
    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
        placeholder="Password" required>
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-lock"></span>
        </div>
    </div>
</div>
<div class="form-group mb-3">
    <label for="role" class="col-sm-2 control-label">Role</label>

    <select name="role" id="role" class="form-control" required>
        <option value="" selected>Pilih Status Pengguna</option>
        <option value="pemilik">Pemilik</option>
        <option value="pekerja">Pekerja</option>
    </select>
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
</div>
<script>
    function tambah() {
        $.ajax({
            url: '/pengguna',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                nama_lengkap: $('#nama_lengkap').val(),
                username: $('#username').val(),
                nohp: $('#nohp').val(),
                password: $('#password').val(),
                role: $('#role').val(),
                penangkaran_id: $('#penangkaran_id').val(),
            },
            // dataType: 'json',
            success: function(data) {
                $('.close').click();
                readTable()
            },
            error: function(data) {

                var response = data.responseJSON;
                var error = response.errors;
                var error_message = '';
                $.each(error, function(key, value) {
                    if (value != null) {
                        error_message += '<li>' + value + '</li>';
                    }
                });

                $('#error').html(
                    '<div class="alert alert-danger alert-dismissible">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                    '<h5><i class="icon fas fa-ban"></i> Perhatian!</h5>' +
                    '<ul>' + error_message + '</ul>' +
                    '</div>'
                );
            }
        });
    }
</script>

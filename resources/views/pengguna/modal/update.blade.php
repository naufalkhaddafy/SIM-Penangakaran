<div id="error"></div>
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
    <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror"
        placeholder="Username" value="{{ $data->username }}" readonly>
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
        placeholder="No.Hp +62" value="{{ $data->nohp }}">
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
<div class="form-group mb-3">
    <label for="role" class="col-sm-2 control-label">role</label>

    <select name="role" id="role" class="form-control @error('penangkaran_id') is-invalid @enderror" required>
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
    <label for="lokasikerja" class="col-sm-5 control-label">Lokasi
        Kerja</label>
    <select name="penangkaran_id" id="penangkaran_id"
        class="form-control @error('penangkaran_id') is-invalid @enderror">
        <option value="{{ optional($data->penangkaran)->id }}" selected>
            {{ optional($data->penangkaran)->lokasi_penangkaran }}
        </option>
        @foreach ($penangkarans as $penangkaran)
            <option value="{{ $penangkaran->id }}">
                {{ $penangkaran->lokasi_penangkaran }}
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
    function update() {
        $.ajax({
            url: '{{ route('update.pengguna', $data->id) }}',
            type: 'PATCH',
            data: {
                "_token": "{{ csrf_token() }}",
                id: {{ $data->id }},
                nama_lengkap: $('#nama_lengkap').val(),
                nohp: $('#nohp').val(),
                role: $('#role').val(),
                penangkaran_id: $('#penangkaran_id').val(),
            },
            // dataType: 'json',
            success: function(data) {
                $('.close').click();
                readData()
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                Toast.fire({
                    icon: 'success',
                    title: 'Berhasil Merubah Data Pengguna'
                })
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

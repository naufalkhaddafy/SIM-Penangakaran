<div id="error"></div>
<div class="input-group mb-3">
    <select name="penangkaran_id" id="penangkaran_id" class="form-control" required>
        <option value="" selected>Pilih Penangakaran</option>
        @foreach ($penangkarans as $penangkaran)
            <option value="{{ $penangkaran->id }}"> {{ $penangkaran->lokasi_penangkaran }}</option>
        @endforeach
    </select>
</div>
<div class="input-group mb-3">
    <input type="text" id="kode_tempat" name="kode_tempat" class="form-control " placeholder="Kode Tempat"
        value="{{ old('kode_tempat') }}">
    <div class="input-group-append">
        <div class="input-group-text">
            <ion-icon name="code-slash"></ion-icon>
        </div>
    </div>
</div>
<div class="input-group mb-3">
    <input type="text" id="nama_pakan" name="nama_pakan" class="form-control " placeholder="Nama Pakan "
        value="{{ old('nama_pakan') }}">
    <div class="input-group-append">
        <div class="input-group-text">
            <ion-icon name="attach"></ion-icon>
        </div>
    </div>
</div>
<div class="input-group mb-3">
    <input type="date" id="tgl_kadaluwarsa" name="tgl_kadaluwarsa" class="form-control" placeholder="Expired">
    <div class="input-group-append">
        <div class="input-group-text">
            <ion-icon name="calendar"></ion-icon>
        </div>
    </div>
</div>
<div class="input-group mb-3">
    <select name="status" id="status" class="form-control" required>
        <option value="" selected>Pilih Status Pakan</option>
        <option value="Baru">Baru</option>
        <option value="Setengah">Setengah</option>
        <option value="Habis">Habis</option>
        <option value="Kadaluwarsa">Kadaluwarsa</option>
    </select>
</div>
<script>
    function tambah() {
        $.ajax({
            url: '{{ route('create.pakan') }}',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                penangkaran_id: $('#penangkaran_id').val(),
                kode_tempat: $('#kode_tempat').val(),
                nama_pakan: $('#nama_pakan').val(),
                tgl_kadaluwarsa: $('#tgl_kadaluwarsa').val(),
                status: $('#status').val(),
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
                    title: 'Berhasil Menambahkan Data Pakan'
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

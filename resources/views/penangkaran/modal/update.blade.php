<div id="error"></div>
<label>Kode Penangkaran</label>
<div class="input-group mb-3">
    <input type="text" id="kode_penangkaran" name="kode_penangkaran"
        class="form-control @error('kode_penangkaran') is-invalid @enderror" placeholder="Kode Penangkaran"
        value="{{ $data->kode_penangkaran }}" required readonly>
    <div class="input-group-append">
        <div class="input-group-text">
            <ion-icon name="code-slash"></ion-icon>
        </div>
    </div>
</div>
<label>Lokasi Penangkaran</label>
<div class="input-group mb-3">
    <input type="text" id="lokasi_penangkaran" name="lokasi_penangkaran"
        class="form-control @error('lokasi_penangkaran') is-invalid @enderror" placeholder="Lokasi Penangkaran"
        value="{{ $data->lokasi_penangkaran }}" required>
    <div class="input-group-append">
        <div class="input-group-text">
            <ion-icon name="location-sharp"></ion-icon>
        </div>
    </div>
</div>
<script>
    function update() {
        $.ajax({
            url: '{{ route('update.penangkaran', $data->id) }}',
            type: 'PATCH',
            data: {
                "_token": "{{ csrf_token() }}",
                kode_penangkaran: $('#kode_penangkaran').val(),
                lokasi_penangkaran: $('#lokasi_penangkaran').val(),
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
                    title: 'Berhasil Merubah Data Penangkaran'
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

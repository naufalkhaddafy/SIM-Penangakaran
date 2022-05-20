<div id="error"></div>
<div class="input-group mb-3">
    <input type="text" id="nama_kandang" name="nama_kandang" class="form-control" value="{{ $data->nama_kandang }}"
        required>
    <div class=" input-group-append">
        <div class="input-group-text">
            <ion-icon name="code-slash"></ion-icon>
        </div>
    </div>
</div>
<div class="input-group mb-3">
    <select name="kategori" id="kategori" class="form-control @error('kategori') is-invalid @enderror" required>
        @foreach ($kategori as $kategori)
            <option value="{{ $kategori }}" {{ $kategori == $data->kategori ? 'selected' : '' }}>
                {{ $kategori }}
            </option>
        @endforeach
    </select>
</div>
<div class="input-group mb-3">
    <input type="hidden" id="penangkaran_id" name="penangkaran_id" class="form-control" placeholder="Penangkaran"
        value="{{ $data->penangkaran_id }}">
</div>
<script>
    function update() {
        $.ajax({
            url: '{{ route('update.kandang', $data->id) }}',
            type: 'PATCH',
            data: {
                "_token": "{{ csrf_token() }}",
                nama_kandang: $('#nama_kandang').val(),
                kategori: $('#kategori').val(),
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
                    title: 'Berhasil Merubah Data Kandang'
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

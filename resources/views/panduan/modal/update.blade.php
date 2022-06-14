<div id="error"></div>
<input type="hidden" id="user_id" name="user_id" class="form-control" value="{{ Auth::user()->id }}" required>

<div class="input-group mb-3">
    <input type="text" id="judul" name="judul" class="form-control" value="{{ $data->judul }}" placeholder="Judul"
        required>
    <div class="input-group-append">
        <div class="input-group-text">
            <ion-icon name="text-outline"></ion-icon>
        </div>
    </div>
</div>
<div class="input-group mb-3">
    <textarea id="isi" name="isi" rows="5" class="form-control" placeholder="Isi Panduan" required>{{ $data->isi }}</textarea>
    <div class="input-group-append">
        <div class="input-group-text">
            <ion-icon name="text-outline"></ion-icon>
        </div>
    </div>
</div>
<div class="input-group mb-3">
    <select name="kategori" id="kategori" class="form-control" required>
        @foreach ($kategori as $kategori)
            <option value="{{ $kategori }}" {{ $kategori == $data->kategori ? 'selected' : '' }}>
                {{ $kategori }}
            </option>
        @endforeach
    </select>
</div>
<div class="input-group mb-3">
    <select name="status" id="status" class="form-control" required>
        @foreach ($status as $status)
            <option value="{{ $status }}" {{ $status == $data->status ? 'selected' : '' }}>
                {{ $status }}
            </option>
        @endforeach
    </select>
</div>
<script>
    function update() {
        $.ajax({
            url: '{{ route('update.panduan', $data->id) }}',
            type: 'PATCH',
            data: {
                "_token": "{{ csrf_token() }}",
                user_id: $('#user_id').val(),
                judul: $('#judul').val(),
                isi: $('#isi').val(),
                kategori: $('#kategori').val(),
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
                    title: 'Berhasil Merubah Data Panduan'
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

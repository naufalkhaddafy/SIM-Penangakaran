<div id="error"></div>
<div class="input-group mb-3">
    <input type="text" id="kode_ring" name="kode_ring" class="form-control"
        placeholder="Kode Ring"value="{{ $data->kode_ring }}"required>
    <div class="input-group-append">
        <div class="input-group-text">
            <ion-icon name="code-slash"></ion-icon>
        </div>
    </div>
</div>
<div class="input-group mb-3">
    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control " required>
        <option value="">Jenis Kelamin</option>
        @foreach ($jk as $jenis_kelamin)
            <option
                value="{{ $data->jenis_kelamin }} "{{ $data->jenis_kelamin == $jenis_kelamin ? 'selected' : '' }}>
                {{ $jenis_kelamin }}
            </option>
        @endforeach
    </select>
</div>
<div class="input-group mb-3">
    <input type="text" id="keterangan" name="keterangan" class="form-control" value="{{ $data->keterangan }}"
        placeholder="Keterangan Indukan">
    <div class="input-group-append">
        <div class="input-group-text">
            <ion-icon name="text"></ion-icon>
        </div>
    </div>
</div>
<div class="input-group mb-3">
    <select id="status_produksi" name="status_produksi" class="form-control">
        <option value="">Status Produksi</option>
        @foreach ($status as $status_produksi)
            <option value="{{ $data->status_produksi }}"
                {{ $data->status_produksi == $status_produksi ? 'selected' : '' }}> {{ $status_produksi }}</option>
        @endforeach
</div>
<script>
    function update() {
        $.ajax({
            url: '{{ route('update.indukan', $data->id) }}',
            type: 'PATCH',
            data: {
                "_token": "{{ csrf_token() }}",
                kode_ring: $('#kode_ring').val(),
                jenis_kelamin: $('#jenis_kelamin').val(),
                keterangan: $('#keterangan').val(),
                status_produksi: $('#status_produksi').val(),
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
                    title: 'Berhasil Merubah Data Indukan'
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

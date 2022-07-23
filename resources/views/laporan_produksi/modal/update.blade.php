<div id="error"></div>
<label>Kode Ring<span class="text-danger">*</span></label>
<div class="input-group mb-1">
    <input type="text" id="kode_ring" name="kode_ring" class="form-control" placeholder="Kode Ring"
        value="{{ $data->kode_ring }}" required>
    <div class="input-group-append">
        <div class="input-group-text">
            <ion-icon name="code-slash"></ion-icon>
        </div>
    </div>
</div>
<label>Indukan</label>
<div class="input-group mb-1">
    <input type="text" id="indukan" name="indukan" class="form-control" placeholder="Indukan"
        value="{{ $data->indukan }}" required>
    <div class="input-group-append">
        <div class="input-group-text">
            <ion-icon name="code-slash"></ion-icon>
        </div>
    </div>
</div>
<label>Tanggal Menetas</label>
<div class="input-group mb-1">
    <input type="date" id="tgl_meneteas" name="tgl_meneteas"placeholder="Indukan"value="{{ $data->tgl_menetas }}"
        class="form-control" required>
    <div class="input-group-append">
        <div class="input-group-text">
            <ion-icon name="calendar"></ion-icon>
        </div>
    </div>
</div>
<label>Jenis Kelamin<span class="text-danger">*</span></label>
<div class="input-group mb-1">
    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control " required>
        <option value="">Jenis Kelamin</option>
        @foreach ($jk as $jenis_kelamin)
            <option value="{{ $jenis_kelamin }} "{{ $data->jenis_kelamin == $jenis_kelamin ? 'selected' : '' }}>
                {{ $jenis_kelamin }}
            </option>
        @endforeach
    </select>
</div>
<label>Status Burung<span class="text-danger">*</span></label>
<div class="input-group mb-1">
    <select id="status_produksi" name="status_produksi" class="form-control">
        @foreach ($status as $status_produksi)
            <option value="{{ $status_produksi }}"
                {{ $data->status_produksi == $status_produksi ? 'selected' : '' }}> {{ $status_produksi }}</option>
        @endforeach
    </select>
</div>
<label>Keterangan</label>
<div class="input-group mb-1">
    <textarea type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan Indukan">{{ $data->keterangan }}</textarea>
</div>

<script>
    function update() {
        $.ajax({
            url: '{{ route('update.indukan', $data->id) }}',
            type: 'PATCH',
            data: {
                "_token": "{{ csrf_token() }}",
                kode_ring: $('#kode_ring').val(),
                indukan: $('#indukan').val(),
                tgl_menetas: $('#tgl_menetas').val(),
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
                    title: 'Berhasil Merubah Data Burung'
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

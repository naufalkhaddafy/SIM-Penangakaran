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
        value="{{ $data->indukan ?? 'Tidak tersedia' }}" readonly>
    <div class="input-group-append">
        <div class="input-group-text">
            <ion-icon name="code-slash"></ion-icon>
        </div>
    </div>
</div>
<label>Tanggal Menetas</label>
<div class="input-group mb-1">
    <input type="date" id="tgl_meneteas" name="tgl_meneteas"placeholder="Indukan"value="{{ $data->tgl_menetas }}"
        class="form-control" readonly>
    <div class="input-group-append">
        <div class="input-group-text">
            <ion-icon name="calendar"></ion-icon>
        </div>
    </div>
</div>
<label>Jenis Kelamin<span class="text-danger">*</span></label>
<div class="input-group mb-1">
    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
        <option value="" selected>Jenis Kelamin</option>
        @foreach ($jk as $jk)
            <option value="{{ $jk }}" {{ $jk == $data->jenis_kelamin ? 'selected' : '' }}>
                {{ $jk }}
            </option>
        @endforeach
    </select>
</div>
<label>Status Burung<span class="text-danger">*</span></label>
<div class="input-group mb-1">
    <select name="status_produksi" id="status_produksi" class="form-control" required>
        <option value="{{ $data->status_produksi }}" selected>{{ $data->status_produksi }}
        </option>
        <option value="Mati">Mati</option>
    </select>
</div>
<div id="keterangan-form" class="form-group">
    <label for="Keterangan">Keterangan<span class="text-danger">*</span></label>
    <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="5">
Kode Ring : {{ $data->kode_ring ?? 'Belum ada kode ring' }}
Usia             : {{ \Carbon\Carbon::parse($data->tgl_menetas)->diffInDays($tgl_today) }} Hari
Catatan:

</textarea>
</div>

<script>
    $(document).ready(function() {
        $('#keterangan-form').hide();
        $('#status_produksi').change(function() {
            if ($(this).val() == 'Hidup') {
                $('#keterangan-form').hide();
            } else if ($(this).val() == 'Mati') {
                $('#keterangan-form').show();
            } else {
                $('#keterangan-form').hide();
            }
        });
    });

    function update() {
        $.ajax({
            url: '{{ route('update.produksi.hidup', $data->id) }}',
            type: 'PATCH',
            data: {
                "_token": "{{ csrf_token() }}",
                kode_ring: $('#kode_ring').val(),
                status_produksi: $('#status_produksi').val(),
                jenis_kelamin: $('#jenis_kelamin').val(),
                keterangan: $('#keterangan').val(),
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
                    title: 'Berhasil Merubah Data Telur'
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

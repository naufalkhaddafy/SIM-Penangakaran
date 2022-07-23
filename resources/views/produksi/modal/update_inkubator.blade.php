<div id="error"></div>
<div class="card-body">
    <div class="form-group">
        <label for="TanggalBertelur">Hari ini telur
            {{ $data->status_telur }} Kandang
            {{ $data->kandang->nama_kandang }}
            Kode Tempat
            {{ $data->jadwal->kode_tempat_inkubator }}</label>
        <input type="input" class="form-control" id="tgl_menetas" name="tgl_menetas" value="{{ date('Y-m-d') }}"
            readonly>
    </div>
    <div class="form-group">
        <select name="status_produksi" id="status_produksi" class="form-control" required>
            <option value="" selected>Pilih Status Telur</option>
            <option value="Hidup">Hidup/Menetas</option>
            <option value="Mati">Mati</option>
        </select>
    </div>
    <div id="keterangan-form" class="form-group">
        <label for="Keterangan">Keterangan</label>
        <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="5"></textarea>
    </div>
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
            url: '{{ route('update.produksi.inkubator', $data->id) }}',
            type: 'PATCH',
            data: {
                "_token": "{{ csrf_token() }}",
                tgl_menetas: $('#tgl_menetas').val(),
                status_produksi: $('#status_produksi').val(),
                keterangan: $('#keterangan').val(),
            },
            // dataType: 'json',
            success: function(data) {
                $('.close').click();
                // readData()
                window.location.href = "{{ url('/produksi-hidup') }}";
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

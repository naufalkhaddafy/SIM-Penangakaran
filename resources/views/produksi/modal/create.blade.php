<div class="card-body">
    <div class="form-group">
        <label for="TanggalBertelur">Tanggal Bertelur Hari ini
            Kandang
            {{ $kandang->nama_kandang }}</label>
        <input type="input" class="form-control  @error('tgl_bertelur') is-invalid @enderror" id="tgl_bertelur"
            name="tgl_bertelur" value="{{ date('Y-m-d') }}" readonly>
        <input type="hidden" class="form-control" id="tgl_masuk_inkubator" name="tgl_masuk_inkubator"
            value="{{ date('Y-m-d') }}">
        <input type="hidden" class="form-control" id="kandang_id" name="kandang_id" value="{{ $kandang->id }}">
    </div>
    <div class="form-group">
        <label for="StatusTelur">Status Telur</label>
        <select name="status_telur" id="status_telur" class="form-control @error('statur_telur') is-invalid @enderror"
            required>
            <option value="" selected>Status Telur</option>
            <option value="pertama">Pertama</option>
            <option value="kedua">Kedua</option>
        </select>
    </div>
    <label for="TempatInkubator">Kode Tempat Inkubator</label>
    <input type="input" class="form-control  @error('tgl_bertelur') is-invalid @enderror" id="kode_tempat_inkubator"
        name="kode_tempat_inkubator" placeholder="Harus diisi !!" required>
</div>
<script>
    function tambah() {
        $.ajax({
            url: '{{ route('create.produksi') }}',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                kandang_id: $('#kandang_id').val(),
                tgl_bertelur: $('#tgl_bertelur').val(),
                tgl_masuk_inkubator: $('#tgl_masuk_inkubator').val(),
                status_telur: $('#status_telur').val(),
                kode_tempat_inkubator: $('#kode_tempat_inkubator').val(),
            },
            // dataType: 'json',
            success: function(data) {
                $('.close').click();
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                Toast.fire({
                    icon: 'success',
                    title: 'Berhasil Menambahkan Data Produksi'
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

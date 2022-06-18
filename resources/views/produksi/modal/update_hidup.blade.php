<div class="card-body">
    <div class="form-group">
        <label for="kode_ring">Kode Ring</label>
        <input type="input" class="form-control  @error('kode_ring') is-invalid @enderror" id="kode_ring" name="kode_ring"
            value="{{ $data->kode_ring }}" placeholder="Masukan Kode Ring">
        @error('kode_ring')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <label for="jeniskelamin">Jenis Kelamin</label>
        <select name="jenis_kelamin" id="jenis_kelamin"
            class="form-control @error('jenis_kelamin') is-invalid @enderror">
            <option value="" selected>Jenis Kelamin</option>
            <option value="Jantan">Jantan</option>
            <option value="Betina">Betina</option>
        </select>
        @error('jenis_kelamin')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <label for="status_produksi">Kondisi Burung</label>
        <select name="status_produksi" id="status_produksi"
            class="form-control @error('status_produksi') is-invalid @enderror" required>
            <option value="{{ $data->status_produksi }}" selected>{{ $data->status_produksi }}
            </option>
            <option value="Mati">Mati</option>
        </select>
        @error('status_produksi')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <input type="hidden" class="form-control  @error('keterangan') is-invalid @enderror" id="keterangan"
            name="keterangan"
            value="{{ \Carbon\Carbon::parse($data->tgl_menetas)->diffInMonths($tgl_today) }}
            Bulan {{ \Carbon\Carbon::parse($data->tgl_menetas)->diffInDays($tgl_today) }}Hari ">
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
            url: '{{ route('update.produksi.hidup', $data->id) }}',
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

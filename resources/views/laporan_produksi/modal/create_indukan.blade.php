<div id="error"></div>
<div class="input-group mb-3">
    <input type="text" id="kode_ring" name="kode_ring" class="form-control" placeholder="Kode Ring" required>
    <div class="input-group-append">
        <div class="input-group-text">
            <ion-icon name="code-slash"></ion-icon>
        </div>
    </div>
</div>
<div class="input-group mb-3">
    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control " required>
        <option value="" selected>Jenis Kelamin</option>
        <option value="Jantan">Jantan</option>
        <option value="Betina">Betina</option>
    </select>
</div>
<div class="input-group mb-3">
    <input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan Indukan">
    <div class="input-group-append">
        <div class="input-group-text">
            <ion-icon name="text"></ion-icon>
        </div>
    </div>
</div>
<div class="input-group mb-3">
    <input type="hidden" id="status_produksi" name="status_produksi" class="form-control" value="Indukan">
</div>
<script>
    function tambah() {
        $.ajax({
            url: '{{ route('create.indukan') }}',
            type: 'POST',
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
                    title: 'Berhasil Menambahkan Data Indukan'
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

<div class="form-group">
    <label for="Kebersihan"> Hari ini
        {{ $data->nama_kandang }} Telah Dibersihkan </label>
    <input type="input" class="form-control" id="tgl_pembersihan" name="tgl_pembersihan" value="{{ date('Y-m-d') }}"
        readonly>
    <input type="hidden" class="form-control" id="kandang_id" name="kandang_id" value="{{ $data->id }}" readonly>
</div>
<script>
    function tambah() {
        $.ajax({
            url: '{{ route('create.kebersihan') }}',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                tgl_pembersihan: $('#tgl_pembersihan').val(),
                kandang_id: $('#kandang_id').val(),
            },
            // dataType: 'json',
            success: function(data) {
                $('.close').click();
                readKebersihan()
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                Toast.fire({
                    icon: 'success',
                    title: 'Berhasil Menambahkan Data Kebesihan Kandang'
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

<div class="input-group mb-3">
    <label for="status"></label>
    <select name="status" id="status" class="form-control form-select mb-3" required>
        @foreach ($status as $data)
            <option value="{{ $data }}" {{ $data == $pakans->status ? 'selected' : '' }}>{{ $data }}
            </option>
        @endforeach
    </select>
</div>
<script>
    function update() {
        $.ajax({
            url: '{{ route('update.pakan', $pakans->id) }}',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                status: $('#status').val(),
            },
            // dataType: 'json',
            success: function(data) {
                $('.close').click();
                readPakan()
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                Toast.fire({
                    icon: 'success',
                    title: 'Berhasil Merubah Data Pakan'
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

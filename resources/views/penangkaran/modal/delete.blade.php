<div id="error"></div>
<p>Apakah anda ingin menghapus <span class="text-danger">{{ $data->lokasi_penangkaran }}</span> ?!!</p>
<p>Dikarenakan menghapus penangkaran akan menghapus seluruh data produksi pada pengkaran maka ketik <span
        class="text-danger">'delete'</span> Untuk
    mengonfirmasi penghapusan</p>
<input type="text" id="confirm" class="form-control" placeholder="ketik 'delete'">
<script>
    function destroy() {
        var confirm = $('#confirm').val();
        if (confirm == 'delete') {
            $.ajax({
                url: '{{ route('delete.penangkaran', $data->id) }}',
                type: 'DELETE',
                data: {
                    '_token': "{{ csrf_token() }}"
                },
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
                        title: 'Berhasil Menghapus Data Penangkaran'
                    })
                }
            });
        } else {
            $('#error').html(
                '<div class="alert alert-danger alert-dismissible">' +
                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                '<h5><i class="icon fas fa-ban"></i> Perhatian!</h5>' +
                '<ul>' + '<li>Ketik delete untuk menghapus Penangkaran</li>' + '</ul>' +
                '</div>');
        }

    }
</script>

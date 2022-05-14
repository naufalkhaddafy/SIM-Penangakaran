<p>Apakah anda ingin menghapus Kandang {{ $data->nama_kandang }}</p>
<script>
    function destroy() {
        $.ajax({
            url: '{{ route('delete.kandang', $data->id) }}',
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
                    title: 'Berhasil Menghapus Data Kandang'
                })
            }
        });
    }
</script>

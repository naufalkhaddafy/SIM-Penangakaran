<p>Apakah anda ingin menghapus {{ $data->nama_lengkap }}</p>

<script>
    function destroy() {
        $.ajax({
            url: '/pengguna/delete/{{ $data->id }}',
            type: 'DELETE',
            data: {
                '_token': "{{ csrf_token() }}"
            },
            success: function(data) {
                $('.close').click();
                readTable()
            }
        });
    }
</script>

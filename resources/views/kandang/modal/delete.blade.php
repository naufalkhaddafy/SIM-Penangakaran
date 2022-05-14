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
                readTable()
            }
        });
    }
</script>

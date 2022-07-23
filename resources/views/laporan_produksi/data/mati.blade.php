<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Penangkaran</th>
            <th>Asal Produksi</th>
            <th>Tanggal Bertelur</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        @foreach ($produksis->where('status_produksi', 'Mati') as $data)
            <tr>
                <td>{{ $data->kandang->penangkaran->kode_penangkaran }}</td>
                <td>Kandang <b>{{ $data->kandang->nama_kandang }}</b> Telur
                    {{ $data->status_telur }}</td>
                <td>{{ date('d F Y', strtotime($data->tgl_bertelur)) }}</td>
                <td>
                    <textarea rows="4" cols="30" style="border-color: white; width:100%;" readonly>{{ $data->keterangan }}</textarea>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>

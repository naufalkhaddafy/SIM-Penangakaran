<table id="tableData" class="table table-bordered table-hover">
    <thead align="center">
        <tr>
            <th>Asal Produksi</th>
            <th>Tanggal Bertelur</th>
            <th>Indukan</th>
            <th>Keterangan</th>
            <th>Tanggal Mati</th>
        </tr>
    </thead>
    <tbody align="center">
        <?php $no = 1; ?>
        @foreach (auth()->user()->penangkaran->kandangs ?? [] as $auth)
            @foreach ($auth->produksis->where('status_produksi', 'Mati') as $data)
                <tr>
                    <td>Kandang <b>{{ $data->kandang->nama_kandang }}</b> Telur
                        {{ $data->status_telur }}</td>
                    <td>{{ date('d F Y', strtotime($data->tgl_bertelur)) }}</td>
                    <td>{{ $data->indukan }}</td>
                    <td>
                        <textarea rows="4" cols="30" style="border-color: white; width:100%;" readonly>{{ $data->keterangan }}</textarea>
                    </td>
                    <td>{{ $data->updated_at }}</td>
                </tr>
            @endforeach
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
        $('#tableData').DataTable({
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

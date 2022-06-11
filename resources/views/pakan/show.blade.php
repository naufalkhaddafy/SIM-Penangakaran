<table id="tableData" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Penangkaran</th>
            <th>Kode Tempat</th>
            <th>Nama Pakan</th>
            <th>Expired</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        @foreach ($pakans as $data)
            <tr>
                <td>{{ $data->penangkaran->lokasi_penangkaran }}</td>
                <td>{{ $data->kode_tempat }}</td>
                <td>{{ $data->nama_pakan }}</td>
                <td>{{ date('d F Y', strtotime($data->tgl_kadaluwarsa)) }}</td>
                <td>{{ $data->status }}</td>
                <td style="text-align:center">
                    <button type="button" class="btn btn-default bg-danger" data-toggle="modal"
                        data-target="{{ $data->id }}">
                        <ion-icon name="trash-outline"></ion-icon>
                    </button>
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
        $('#tableData').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>

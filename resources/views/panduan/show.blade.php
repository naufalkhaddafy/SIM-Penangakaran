<table id="tableData" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Isi</th>
            <th>Kategori</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        @foreach ($panduans as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->judul }}</td>
                <td>
                    <textarea rows="8" cols="50" style="border-color: white; width:100%;"readonly>{{ $data->isi }}</textarea>
                </td>
                <td>{{ $data->kategori }}</td>
                <td>{{ $data->status }}</td>
                <td style="text-align:center">
                    <button type="button" class="btn btn-default bg-success" onclick="showRead({{ $data->id }})">
                        <ion-icon name="eye-outline"></ion-icon>
                    </button>
                    <button type="button" class="btn btn-default bg-warning" onclick="showUpdate({{ $data->id }})">
                        <ion-icon name="open-outline"></ion-icon>
                    </button>
                    <button type="button" class="btn btn-default bg-danger" onclick="showDelete({{ $data->id }})">
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

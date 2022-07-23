<table id="tableData" class="table table-bordered table-hover">
    <thead align="center">
        <tr>
            <th>Kode Inkubator</th>
            <th>Tanggal Masuk Inkubator</th>
            <th>Tanggal Akan Menetas</th>
            <th>Asal Telur</th>
            <th>Update</th>
        </tr>
    </thead>
    <tbody align="center">
        @foreach (auth()->user()->penangkaran->kandangs ?? [] as $auth)
            @foreach ($auth->produksis->where('status_produksi', 'Inkubator') as $data)
                <tr>
                    <td>{{ $data->jadwal->kode_tempat_inkubator }}</td>
                    <td>{{ date('d M Y', strtotime($data->tgl_masuk_inkubator)) }}</td>
                    <td class="text-danger"><b>
                            {{ date('d', strtotime($data->jadwal->tgl_akan_menetas_start)) }}-{{ date('d M Y', strtotime($data->jadwal->tgl_akan_menetas_end)) }}</b>
                    </td>
                    <td>Kandang <b>{{ $data->kandang->nama_kandang }}</b> Telur
                        {{ $data->status_telur }} </td>
                    <td><button type="button" class="btn btn-default  btn-outline-success"
                            onclick="showUpdate({{ $data->id }})">
                            <ion-icon name="open-outline"></ion-icon>
                        </button>
                    </td>
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

<table id="example2" class="table table-bordered table-hover">
    <thead align="center">
        <tr>
            <th>Penangkaran</th>
            <th>Kode Inkubator</th>
            <th>Indukan</th>
            <th>Tanggal Masuk Inkubator</th>
            <th>Tanggal Akan Menetas</th>
            {{-- <th>Asal Telur</th> --}}
        </tr>
    </thead>
    <tbody align="center">
        @foreach ($produksis->where('status_produksi', 'Inkubator') as $data)
            <tr>
                <td>{{ $data->kandang->penangkaran->kode_penangkaran }} {{ $data->kandang->nama_kandang }} </td>
                <td>{{ $data->jadwal->kode_tempat_inkubator }}</td>
                <td>{{ $data->indukan }}</td>
                <td>{{ date('d F Y', strtotime($data->tgl_masuk_inkubator)) }}</td>
                <td class="text-danger">
                    <b>
                        {{ date('d', strtotime($data->jadwal->tgl_akan_menetas_start)) }}-{{ date('d F Y', strtotime($data->jadwal->tgl_akan_menetas_end)) }}
                    </b>
                </td>
                {{-- <td>Kandang <b>{{ $data->kandang->nama_kandang }}</b> Telur
                    {{ $data->status_telur }} </td> --}}
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

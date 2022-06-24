<table id="example2" class="table table-bordered table-hover">
    <thead align="center">
        <tr>
            <th>Penangkaran</th>
            <th>Kode Ring</th>
            <th>Asal Telur</th>
            <th>Tanggal Menetas</th>
            <th>Jenis Kelamin</th>
            <th>Usia</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody align="center">
        @foreach ($produksis->where('status_produksi', 'Hidup') as $data)
            <tr>
                <td>{{ $data->kandang->penangkaran->lokasi_penangkaran }}</td>
                <td>{{ $data->kode_ring ?? 'belum tersedia' }} </td>
                <td>Kandang <b>{{ $data->kandang->nama_kandang }}</b> Telur
                    {{ $data->status_telur }} </td>
                <td>{{ date('d F Y', strtotime($data->tgl_menetas)) }}</td>
                <td>{{ $data->jenis_kelamin }}</td>
                <td> {{ \Carbon\Carbon::parse($data->tgl_menetas)->diffInMonths($tgl_today) }}
                    Bulan
                    {{ \Carbon\Carbon::parse($data->tgl_menetas)->diffInDays($tgl_today) }}Hari
                </td>
                <td>
                    <button type="button" class="btn btn-default  btn-outline-success" data-toggle="modal"
                        data-target="{{ url('#modal-read' . $data->id) }}">
                        <ion-icon name="search"></ion-icon>
                    </button>
                    <button type="button" class="btn btn-default  btn-outline-success" data-toggle="modal"
                        data-target="{{ url('#modal-update' . $data->id) }}">
                        <ion-icon name="open-outline"></ion-icon>
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

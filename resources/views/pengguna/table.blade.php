<table id="tableData" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Username</th>
            <th>No.HP</th>
            <th>Role</th>
            <th>Lokasi Kerja</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        @foreach ($users->where('role', 'pekerja') as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->nama_lengkap }}</td>
                <td>{{ $data->username }}</td>
                <td> {{ $data->nohp }}</td>
                <td>{{ $data->role }}</td>
                <td>
                    {{ optional($data->penangkaran)->lokasi_penangkaran ?? 'Belum Tersedia' }}
                </td>
                <td style="text-align:center">

                    <button type="button" class="btn btn-default bg-success" onclick="show({{ $data->id }})">
                        <ion-icon name="eye-outline"></ion-icon>
                    </button>
                    <button type="button" class="btn btn-default bg-warning" data-toggle="modal"
                        data-target="{{ url('#modal-update' . $data->id) }}">
                        <ion-icon name="open-outline"></ion-icon>
                    </button>
                    <button type="button" class="btn btn-default bg-danger" data-toggle="modal"
                        data-target="{{ url('#delete' . $data->id) }}">
                        <ion-icon name="trash-outline"></ion-icon>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

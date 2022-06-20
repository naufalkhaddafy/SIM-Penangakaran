<div class="card">
    <div class="card-header border-0">
        <h5 style="text-align:center"><b>Pakan Tersedia</b></h5>
    </div>
    <div class="table-responsive">
        <table class="table table-valign-middle">
            <thead align="center">
                <tr>
                    <th>Kode Tempat</th>
                    <th>Nama Pakan</th>
                    <th>Kadaluwarsa</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody align="center">
                @foreach (Auth::user()->penangkaran->pakans as $data)
                    <tr>
                        <td>{{ $data->kode_tempat }}</td>
                        <td>{{ $data->nama_pakan }}</td>
                        <td>{{ $data->tgl_kadaluwarsa }}</td>
                        <td>{{ $data->status }}</td>
                        <td>
                            <button type="button" class="btn btn-default bg-warning"
                                onclick="showUpdate({{ $data->id }})">
                                <i class="ti-pencil-alt"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-header border-0">
        <h5 style="text-align:center"><b>Pakan Tersedia</b></h5>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-striped table-valign-middle">
            <thead>
                <tr>
                    <th>Kode Tempat</th>
                    <th>Nama Pakan</th>
                    <th>Kadaluwarsa</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach (Auth::user()->penangkaran->pakans as $data)
                    <tr>
                        <td>{{ $data->kode_tempat }}</td>
                        <td>{{ $data->nama_pakan }}</td>
                        <td>{{ $data->tgl_kadaluwarsa }}</td>
                        <td>{{ $data->status }}</td>
                        <td>
                            <button type="button" class="btn btn-default bg-warning"
                                onclick="showUpdate({{ $data->id }})">
                                <ion-icon name="open-outline"></ion-icon>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

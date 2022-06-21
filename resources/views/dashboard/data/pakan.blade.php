<div class="card">
    <div class="card-header border-0">
        <h5 style="text-align:center"><b>Pakan Tersedia</b></h5>
    </div>
<<<<<<< HEAD
    <div class="table-responsive">
        <table class="table table-valign-middle">
            <thead align="center">
                <tr>
=======
    <div class="card-body table-responsive p-0">
        <table class="table table-striped table-valign-middle">
            <thead>
                <tr align="center">
>>>>>>> b1
                    <th>Kode Tempat</th>
                    <th>Nama Pakan</th>
                    <th>Kadaluwarsa</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody align="center">
<<<<<<< HEAD
                @foreach (Auth::user()->penangkaran->pakans as $data)
=======
                @foreach (Auth::user()->penangkaran->pakans ?? [] as $data)
>>>>>>> b1
                    <tr>
                        <td>{{ $data->kode_tempat }}</td>
                        <td>{{ $data->nama_pakan }}</td>
                        <td>{{ $data->tgl_kadaluwarsa }}</td>
                        <td>
<<<<<<< HEAD
                            <button type="button" class="btn btn-default bg-warning"
                                onclick="showUpdate({{ $data->id }})">
                                <i class="ti-pencil-alt"></i>
=======
                            <span class="badge badge-danger">
                                {{ $data->status }}
                            </span>
                        </td>
                        <td>
                            <button type="button" class="btn btn-default " onclick="showUpdate({{ $data->id }})">
                                <ion-icon name="open-outline"></ion-icon>
>>>>>>> b1
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

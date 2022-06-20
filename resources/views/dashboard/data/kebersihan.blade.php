<div class="card">
    <div class="card-header border-0">
        <h5 style="text-align:center"><b>Kebersihan Kandang</b></h5>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-striped table-valign-middle">
            <thead align="center">
                <tr>
                    <th>Kandang</th>
                    <th>Jadwal Pembersihan</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody align="center">
                @foreach (auth()->user()->penangkaran->kandangs ?? [] as $data)
                    <tr>
                        <td>
                            {{ $data->nama_kandang }}
                        </td>
                        @if ($data->kebersihans->last() == null)
                            <td>Belum ada</td>
                        @elseif(!$data->kebersihans->last() == null)
                            <td class="text-danger">
                                {{ date('d F Y', strtotime($data->kebersihans->last()->jadwal_pembersihan)) }}
                            </td>
                        @endif
                        <td></td>
                        <td>
                            <button type="button" class="btn btn-default  btn-outline-success" data-toggle="modal"
                                data-target="{{ url('#modal-createkebersihan' . $data->id) }}">
                                <ion-icon name="add"></ion-icon>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

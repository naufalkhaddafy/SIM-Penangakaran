<div class="card">
    <div class="card-header border-0">
        <h5 style="text-align:center"><b>Informasi Produksi Kandang</b></h5>
    </div>
    {{-- produktif --}}
    <div style="text-align:center" class="bg-lime p-2">
        <h6><b>Produktif</b></h6>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-striped table-valign-middle">
            <thead>
                <tr align="center">
                    <th>Kandang</th>
                    <th>Status Telur</th>
                    <th>Akan Bertelur</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody align="center">
                @foreach ($produktif ?? [] as $data)
                    @if ($data->kategori == 'Produktif')
                        <tr>
                            <td>
                                {{ $data->nama_kandang }}
                            </td>
                            <td class="m-3 p-2 badge bg-success">
                                @if (optional($data->produksis->last())->status_telur == 'pertama')
                                    Kedua
                                @elseif(optional($data->produksis->last())->status_telur == 'kedua')
                                    Pertama
                                @endif
                            </td>
                            <td class="text-danger"><b>
                                    @foreach ($data->produksis as $d)
                                        @if ($loop->last)
                                            {{ date('d', strtotime($d->jadwal->tgl_akan_bertelur_start)) }}-
                                            {{ date('d F Y', strtotime($d->jadwal->tgl_akan_bertelur_end)) }}
                                        @endif
                                    @endforeach
                                </b>
                            </td>
                            <td>
                                <button type="button" class="btn btn-default  btn-outline-success"
                                    onclick="showCreate({{ $data->id }})">
                                    <ion-icon name="add"></ion-icon>
                                </button>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-md-6">
            {{-- tidak produktif --}}
            <div style="text-align:center" class="bg-lightblue p-2">
                <h6><b>Tidak Produktif</b></h6>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                    <thead align="center">
                        <tr>
                            <th>Kandang</th>
                            <th>Masuk Kandang</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                        @foreach (Auth::user()->penangkaran->kandangs ?? [] as $data)
                            @if ($data->kategori == 'Tidak Produktif')
                                <tr>
                                    <td>
                                        {{ $data->nama_kandang }}
                                    </td>
                                    <td>
                                        {{ date('d F Y', strtotime($data->tgl_masuk_kandang)) }}
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-default  btn-outline-success"
                                            onclick="showCreate({{ $data->id }})">
                                            <ion-icon name="add"></ion-icon>
                                        </button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            {{-- ganti bulu --}}
            <div style="text-align:center" class="bg-warning p-2">
                <h6 class="text-white"><b>Ganti Bulu</b></h6>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                    <thead align="center">
                        <tr>
                            <th>Kandang</th>
                            <th>Terakhir Bertelur</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                        @foreach (Auth::user()->penangkaran->kandangs ?? [] as $data)
                            @if ($data->kategori == 'Ganti Bulu')
                                <tr>
                                    <td>
                                        {{ $data->nama_kandang }}
                                    </td>
                                    <td>{{ optional($data->produksis->last())->tgl_bertelur == !null ? date('d F Y', strtotime(optional($data->produksis->last())->tgl_bertelur)) : 'Belum Ada Produksi' }}

                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-default  btn-outline-success"
                                            onclick="showCreate({{ $data->id }})">
                                            <ion-icon name="add"></ion-icon>
                                        </button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

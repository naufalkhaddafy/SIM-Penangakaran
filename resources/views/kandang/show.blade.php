<div style="text-align:center">
    <h2>Lokasi Penangkaran</h2>
    <a href="#">
        <h2><b>{{ $penangkarans->lokasi_penangkaran }}</b></h2>
    </a>
    <h2>Jumlah Kandang : {{ count($penangkarans->kandangs) }}</h2>
    <h2>Jumlah Pekerja : {{ count($penangkarans->users) }}</h2>
</div>
<br>
<div class="row">
    <?php $no = 1; ?>
    @foreach ($penangkarans->kandangs as $data)
        <div class="col-md-4">
            <div class="card ">
                <div class="btn-group">
                    <div class="btn-group">
                        <button type="button" class="btn" data-toggle="dropdown">
                            <ion-icon name="ellipsis-vertical"></ion-icon>
                        </button>
                        <div class="dropdown-menu">
                            <button class="dropdown-item" onclick="showUpdate({{ $data->id }})">
                                <ion-icon name="create-outline"></ion-icon> Update
                            </button>
                            <div class="dropdown-divider"></div>
                            <button class="dropdown-item" onclick="showDelete({{ $data->id }})">
                                <ion-icon name="trash-outline"></ion-icon> Delete
                            </button>
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                {{-- <img src="https://images.unsplash.com/photo-1475855581690-80accde3ae2b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80"
                    class="card-img-top" alt="..."> --}}
                <div class="card-body" style="text-align:center">
                    <h4>
                        <b>Kandang {{ $data->nama_kandang }}</b>
                    </h4>
                    <h5 class="card-text">Kondisi Kandang<br>
                        <b class="text-success">{{ $data->kategori }}</b>
                    </h5>
                    <h6 class="card-text"> Indukan<br>
                        <b class="text-success">
                            {{-- <a href="#">{{ $data->indukan }}</a> --}}
                            @foreach ($data->indukans as $indukan)
                                <a href="#">{{ optional($indukan->produksi)->kode_ring }}
                                </a>
                            @endforeach

                        </b>
                    </h6>
                    <h5 class="card-text">Masuk Kandang<br>
                        <b class="text-danger">{{ $data->tgl_masuk_kandang }}</b><br>
                    </h5>
                    <a href="{{ url('kandang' . '/' . $data->id . '/' . $data->nama_kandang) }}"
                        class="btn btn-primary">Detail Kandang
                    </a>
                </div>

            </div>

        </div>
    @endforeach
</div>

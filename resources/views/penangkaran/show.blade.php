<div class="row">
    <?php $no = 1; ?>
    @foreach ($penangkarans as $data)
        <div class="col-md-4">
            <div class="card">
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
                <img src="https://images.unsplash.com/photo-1475855581690-80accde3ae2b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80"
                    class="card-img-top" alt="...">
                <div class="card-body" style="text-align:center">
                    <h5>
                        <b>Penangkaran 0{{ $no++ }}</b>
                    </h5>
                    <h6 class="card-text">Kode Penangkaran<br>
                        <b class="text-danger"><b>{{ $data->kode_penangkaran }}</b>
                        </b>
                    </h6>
                    <h6 class="card-text"> Lokasi Penangkaran<br>
                        <b class="text-success">
                            {{ $data->lokasi_penangkaran }}
                        </b>
                    </h6>
                    <a href="{{ url('/penangkaran/' . $data->id . '/lokasi/' . $data->lokasi_penangkaran) }}"
                        class="btn btn-primary">Detail Penangkaran
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

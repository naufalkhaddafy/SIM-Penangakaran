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
                    <div class="content">
                        <h2>0{{ $no++ }}</h2>
                        <h3>Penangkaran </h3>
                        <p>
                            <b>{{ $data->kode_penangkaran }}</b><br>
                            {{ $data->lokasi_penangkaran }}
                        </p>
                        <a href="{{ url('/penangkaran/' . $data->id . '/' . $data->lokasi_penangkaran) }}"
                            class="btn btn-primary">Info
                            Detail</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

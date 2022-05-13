<div class="modal-body">
    <div class="input-group mb-3">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user"></span><b>Nama </b>
            </div>
        </div>
        <input type="text" class=" form-control" value="{{ $data->nama_lengkap }}" disabled>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user"></span><b>Username</b>
            </div>
        </div>
        <input type="text" class="form-control" value="{{ $data->username }}" disabled>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-phone"></span><b> No.HP </b>
            </div>
        </div>
        <input type="text" class="form-control " value="{{ $data->nohp }}" disabled>
    </div>

    <div class="input-group mb-3">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span><b>Status </b>
            </div>
        </div>
        <input type="text" class="form-control" disabled value="{{ $data->role }}">

    </div>
    <div class="input-group mb-3">
        <div class="input-group-append">
            <div class="input-group-text">
                <ion-icon name="location-sharp"></ion-icon><b>Berkerja di </b>
            </div>
        </div>
        <input type="text" class="form-control" disabled
            value="{{ optional($data->penangkaran)->lokasi_penangkaran ?? 'Belum Tersedia' }}">
    </div>

</div>

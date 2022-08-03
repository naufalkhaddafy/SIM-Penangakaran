<div class="form-group row">
    <label class="col-sm-4 col-form-label">Nama</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" value="{{ $data->nama_lengkap ?? 'Tidak Tersedia' }}" readonly>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-4 col-form-label">Username</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" value="{{ $data->username ?? 'Tidak Tersedia' }}" readonly>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-4 col-form-label">No.HP</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" value="{{ $data->nohp ?? 'Tidak Tersedia' }}" readonly>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-4 col-form-label">Status</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" value="{{ $data->role ?? 'Tidak Tersedia' }}" readonly>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-4 col-form-label">Berkerja di</label>
    <div class="col-sm-8">
        <input type="text" class="form-control"
            value="{{ optional($data->penangkaran)->lokasi_penangkaran ?? 'Tidak Tersedia' }}" readonly>
    </div>
</div>

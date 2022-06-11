<div class="input-group mb-3">
    <input type="text" id="kode_tempat" name="kode_tempat"
        class="form-control @error('kode_kategori') is-invalid @enderror" placeholder="Kode Tempat"
        value="{{ old('kode_tempat') }}">
    <div class="input-group-append">
        <div class="input-group-text">
            <ion-icon name="code-slash"></ion-icon>
        </div>
    </div>
    @error('kode_tempat')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="input-group mb-3">
    <input type="text" id="nama_pakan" name="nama_pakan" class="form-control @error('nama_pakan') is-invalid @enderror"
        placeholder="Nama Pakan " value="{{ old('nama_pakan') }}">
    <div class="input-group-append">
        <div class="input-group-text">
            <ion-icon name="attach"></ion-icon>
        </div>
    </div>
    @error('nama_pakan')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="input-group mb-3">
    <input type="date" id="expired" name="expired" class="form-control @error('expired') is-invalid @enderror"
        placeholder="Expired" value="{{ old('expired') }}">
    <div class="input-group-append">
        <div class="input-group-text">
            <ion-icon name="calendar"></ion-icon>
        </div>
    </div>
    @error('Expired')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

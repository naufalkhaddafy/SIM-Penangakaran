<div class="input-group mb-3">
    <input type="text" id="kode_tempat" name="kode_tempat" class="form-control" placeholder="Kode Tempat"
        value="{{ old('kode_tempat') }}">
    <div class="input-group-append">
        <div class="input-group-text">
            <ion-icon name="code-slash"></ion-icon>
        </div>
    </div>

</div>
<div class="input-group mb-3">
    <input type="text" id="nama_pakan" name="nama_pakan" class="form-control" placeholder="Nama Pakan "
        value="{{ old('nama_pakan') }}">
    <div class="input-group-append">
        <div class="input-group-text">
            <ion-icon name="attach"></ion-icon>
        </div>
    </div>

</div>
<div class="input-group mb-3">
    <input type="date" id="expired" name="expired" class="form-control" placeholder="Expired"
        value="{{ old('expired') }}">
    <div class="input-group-append">
        <div class="input-group-text">
            <ion-icon name="calendar"></ion-icon>
        </div>
    </div>
</div>

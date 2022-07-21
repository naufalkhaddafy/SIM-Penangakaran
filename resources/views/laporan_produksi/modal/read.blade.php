<div class="form-group row">
    <label for="kode_ring" class="col-sm-4 col-form-label">Kode Ring</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="kode_ring" value="{{ $data->kode_ring ?? 'Tidak Tersedia' }}"
            readonly>
    </div>
</div>
<div class="form-group row">
    <label for="tgl_menetas" class="col-sm-4 col-form-label">Tanggal Menetas</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="tgl_menetas"
            value="{{ $data->tgl_menetas ?? 'Tidak Tersedia' }}" readonly>
    </div>
</div>
<div class="form-group row">
    <label for="indukan" class="col-sm-4 col-form-label">Indukan</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="indukan" value="{{ $data->indukan ?? 'Tidak Tersedia' }}"
            readonly>
    </div>
</div>
<div class="form-group row">
    <label for="jenis_kelamin" class="col-sm-4 col-form-label">Jenis Kelamin</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="jenis_kelamin"
            value="{{ $data->jenis_kelamin ?? 'Tidak Tersedia' }}" readonly>
    </div>
</div>
<div class="form-group row">
    <label for="keterangan" class="col-sm-4 col-form-label">Keterangan</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="keterangan" value="{{ $data->keterangan ?? 'Tidak Tersedia' }}"
            readonly>
    </div>
</div>
{{-- <div class="form-group row">
    <div class="offset-sm-2 col-sm-10">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck2">
            <label class="form-check-label" for="exampleCheck2">Remember me</label>
        </div>
    </div>
</div> --}}

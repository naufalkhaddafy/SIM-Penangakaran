<div class="card-body">
    <div class="form-group">
        <label for="TanggalBertelur">Hari ini Telur
            {{ $data->status_telur }} Menetas Kandang
            {{ $data->kandang->nama_kandang }}
            Kode Tempat
            {{ $data->jadwal->kode_tempat_inkubator }}</label>
        <input type="input" class="form-control" id="tgl_menetas" name="tgl_menetas" value="{{ date('Y-m-d') }}"
            readonly>
        @error('tgl_menetas')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

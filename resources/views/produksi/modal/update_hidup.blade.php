<div class="card-body">
    <div class="form-group">
        <label for="kode_ring">Kode Ring</label>
        <input type="input" class="form-control  @error('kode_ring') is-invalid @enderror" id="kode_ring"
            name="kode_ring" value="{{ $data->kode_ring }}" placeholder="Masukan Kode Ring">
        @error('kode_ring')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <label for="jeniskelamin">Jenis Kelamin</label>
        <select name="jenis_kelamin" id="jenis_kelamin"
            class="form-control @error('jenis_kelamin') is-invalid @enderror">
            <option value="" selected>Jenis Kelamin</option>
            <option value="Jantan">Jantan</option>
            <option value="Betina">Betina</option>
        </select>
        @error('jenis_kelamin')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <label for="status_produksi">Kondisi Burung</label>
        <select name="status_produksi" id="status_produksi"
            class="form-control @error('status_produksi') is-invalid @enderror" required>
            <option value="{{ $data->status_produksi }}" selected>{{ $data->status_produksi }}
            </option>
            <option value="Mati">Mati</option>
        </select>
        @error('status_produksi')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <input type="hidden" class="form-control  @error('keterangan') is-invalid @enderror" id="keterangan"
            name="keterangan"
            value="{{ \Carbon\Carbon::parse($data->tgl_menetas)->diffInMonths($tgl_today) }}
                                                                Bulan
                                                                {{ \Carbon\Carbon::parse($data->tgl_menetas)->diffInDays($tgl_today) }}Hari ">
    </div>
</div>

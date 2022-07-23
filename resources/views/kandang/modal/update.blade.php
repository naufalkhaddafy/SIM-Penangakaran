<div id="error"></div>
<label>Nama Kandang<span class="text-danger">*</span></label>
<div class="input-group mb-3">
    <input type="text" id="nama_kandang" name="nama_kandang" class="form-control" value="{{ $data->nama_kandang }}"
        placeholder="Nama Kandang" required>
    <div class=" input-group-append">
        <div class="input-group-text">
            <ion-icon name="code-slash"></ion-icon>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label>Indukan Pertama<span class="text-danger">*</span></label>
        <select name="indukan_pertama" id="indukan_pertama" class=" form-control " required>
            <option value="{{ $indukanPertama->produksi_id }}" selected>{{ $indukanPertama->produksi->kode_ring }}
            </option>
            @foreach ($produksis as $indukanpertama)
                @if ($indukanpertama->indukans == null)
                    <option value="{{ $indukanpertama->id }}"> {{ $indukanpertama->kode_ring }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="col-md-6 mb-3">
        <label>Indukan Kedua<span class="text-danger">*</span></label>
        <select name="indukan_kedua" id="indukan_kedua" class="form-control " required>
            <option value="{{ $indukanKedua->produksi_id }}" selected>{{ $indukanKedua->produksi->kode_ring }}
            </option>
            @foreach ($produksis as $indukankedua)
                @if ($indukankedua->indukans == null)
                    <option value="{{ $indukankedua->id }}"> {{ $indukankedua->kode_ring }}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>
<label>Tanggal Masuk Kandang<span class="text-danger">*</span></label>
<div class="input-group mb-3">
    <input type="date" id="tgl_masuk_kandang" name="tgl_masuk_kandang" value="{{ $data->tgl_masuk_kandang }}"
        class="form-control" placeholder="Nama Kandang" required>
    <div class="input-group-append">
        <div class="input-group-text">
            <ion-icon name="calendar"></ion-icon>
        </div>
    </div>
</div>
<label>Kondisi Kandang<span class="text-danger">*</span></label>
<div class="input-group mb-3">
    <select name="kategori" id="kategori" class="form-control @error('kategori') is-invalid @enderror" required>
        @foreach ($kategori as $kategori)
            <option value="{{ $kategori }}" {{ $kategori == $data->kategori ? 'selected' : '' }}>
                {{ $kategori }}
            </option>
        @endforeach
    </select>
</div>
<div class="input-group mb-3">
    <input type="hidden" id="penangkaran_id" name="penangkaran_id" class="form-control" placeholder="Penangkaran"
        value="{{ $data->penangkaran_id }}">
</div>
<script>
    function update() {
        $.ajax({
            url: '{{ route('update.kandang', $data->id) }}',
            type: 'PATCH',
            data: {
                "_token": "{{ csrf_token() }}",
                nama_kandang: $('#nama_kandang').val(),
                kategori: $('#kategori').val(),
                indukan_pertama: $('#indukan_pertama').val(),
                indukan_kedua: $('#indukan_kedua').val(),
                tgl_masuk_kandang: $('#tgl_masuk_kandang').val(),
                penangkaran_id: $('#penangkaran_id').val(),
            },
            // dataType: 'json',
            success: function(data) {
                $('.close').click();
                readData()
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                Toast.fire({
                    icon: 'success',
                    title: 'Berhasil Merubah Data Kandang'
                })
            },
            error: function(data) {
                var response = data.responseJSON;
                var error = response.errors;
                var error_message = '';
                $.each(error, function(key, value) {
                    if (value != null) {
                        error_message += '<li>' + value + '</li>';
                    }
                });
                $('#error').html(
                    '<div class="alert alert-danger alert-dismissible">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                    '<h5><i class="icon fas fa-ban"></i> Perhatian!</h5>' +
                    '<ul>' + error_message + '</ul>' +
                    '</div>'
                );
            }
        });
    }
</script>

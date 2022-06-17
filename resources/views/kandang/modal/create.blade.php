<div id="error"></div>
<div class="input-group mb-3">
    <input type="text" id="nama_kandang" name="nama_kandang" class="form-control" placeholder="Nama Kandang"
        value="CR-{{ old('nama_kandang') }}" required>
    <div class="input-group-append">
        <div class="input-group-text">
            <ion-icon name="code-slash"></ion-icon>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <select name="indukan_pertama" id="indukan_pertama" class=" form-control " required>
            <option value="" selected>Pilih Indukan Pertama</option>
            @foreach ($produksis as $indukanpertama)
                @if ($indukanpertama->indukans == null)
                    <option value="{{ $indukanpertama->id }}"> {{ $indukanpertama->kode_ring }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="col-md-6 mb-3">
        <select name="indukan_kedua" id="indukan_kedua" class="form-control " required>
            <option value="" selected>Pilih Indukan Kedua</option>
            {{-- @foreach ($produksis->where('status_produksi', 'Indukan') as $indukankedua)
                <option value="{{ $indukankedua->id }}" {{ $indukankedua->id }}>
                    {{ $indukankedua->kode_ring }}
                </option>
            @endforeach --}}
            @foreach ($produksis as $indukankedua)
                @if ($indukankedua->indukans == null)
                    <option value="{{ $indukankedua->id }}"> {{ $indukankedua->kode_ring }}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>
<div class="input-group mb-3">
    <input type="date" id="tgl_masuk_kandang" name="tgl_masuk_kandang" class="form-control" placeholder="Nama Kandang"
        required>
    <div class="input-group-append">
        <div class="input-group-text">
            <ion-icon name="calendar"></ion-icon>
        </div>
    </div>
</div>
<div class="input-group mb-3">
    <select name="kategori" id="kategori" class="form-control" required>
        <option value="" selected>Kondisi Kandang</option>
        <option value="Produktif"> Produktif</option>
        <option value="Tidak Produktif"> Tidak Produktif</option>
        <option value="Ganti Bulu"> Ganti Bulu</option>
    </select>
</div>
<div class="input-group mb-3">
    <input type="hidden" id="penangkaran_id" name="penangkaran_id" class="form-control" placeholder="Penangkaran"
        value="{{ $penangkarans->id }}">
</div>
<script>
    function tambah() {
        // var indukan_pertama = $('#indukan_pertama').val();
        // var indukan_kedua = $('#indukan_kedua').val();
        // if (indukan_pertama == indukan_kedua) {
        //     $('#error').html(
        //         '<div class="alert alert-danger alert-dismissible">' +
        //         '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
        //         '<h5><i class="icon fas fa-ban"></i> Perhatian!</h5>' +
        //         '<ul>' + 'Indukan Tidak Boleh Sama' + '</ul>' +
        //         '</div>'
        //     );
        // } else {}
        $.ajax({
            url: '{{ route('create.kandang') }}',
            type: 'POST',
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
                    title: 'Berhasil Menambahkan Data Kandang'
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

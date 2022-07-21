<div id="error"></div>
<div class="form-group">
    <label>Penangkaran</label>
    <select class="form-control" id="penangkaran" name="penangkaran">
        <option value="" selected>Pilih Penangkaran</option>
        <option value="Penangkarans">Data Semua Penangkaran</option>
        @foreach ($penangkarans as $penangkaran)
            <option value="{{ $penangkaran->id }}">{{ $penangkaran->lokasi_penangkaran }}</option>
        @endforeach
    </select>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Dari tanggal </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </span>
                </div>
                <input type="date" name="startDate" class="form-control float-right" id="startDate">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Sampai tanggal</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </span>
                </div>
                <input type="date" name="endDate" class="form-control float-right" id="endDate">
            </div>
        </div>
    </div>
</div>
<script>
    function printProduksiMati() {
        var penangkaran = $('#penangkaran').val();
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();

        if (penangkaran == '' || startDate == '' || endDate == '') {
            $('#error').html(
                '<div class="alert alert-danger alert-dismissible">' +
                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                '<h5><i class="icon fas fa-ban"></i> Perhatian!</h5>' +
                '<ul>' + '<li>Penangkaran, Tanggal Awal dan Tanggal Akhir Tidak Boleh Kosong</li>' + '</ul>' +
                '</div>');
        } else {
            $('#error').html('');
            window.open("{{ url('/print-laporan-produksi-hidup/') }}/" + penangkaran + "/" +
                startDate + "/" + endDate);
        }

    }
</script>

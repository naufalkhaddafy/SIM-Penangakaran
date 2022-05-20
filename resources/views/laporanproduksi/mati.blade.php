@extends('template.template')
@section('title', 'Produksi Mati')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <div class="row">
                            </div>
                        </h3>
                    </div>
                    <div class="readData"></div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Penangkaran</th>
                                    <th>Asal Produksi</th>
                                    <th>Tanggal Bertelur</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($produksis->where('status_produksi', 'Mati') as $data)
                                    <tr>
                                        <td>{{ $data->kandang->penangkaran->lokasi_penangkaran }}</td>
                                        <td>Kandang <b>{{ $data->kandang->nama_kandang }}</b> Telur
                                            {{ $data->status_telur }}</td>
                                        <td>{{ date('d F Y', strtotime($data->tgl_bertelur)) }}</td>
                                        <td>{{ $data->keterangan }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush

@extends('admin-lte.template')
@section('title')
    Kandang {{ $kandangs->nama_kandang }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Data Riwayat Kandang {{ $kandangs->nama_kandang }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div>
                            <h3><b>
                                    Riwayat Produksi
                                </b>
                            </h3>
                            <table id="tableData" class="table table-bordered table-hover">
                                <thead align="center">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Bertelur</th>
                                        <th>Status Telur</th>
                                        <th>Status Hasil Produksi</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody align="center">
                                    <?php $no = 1; ?>
                                    @foreach ($produksis as $data)
                                        <tr>
                                            <td> {{ $no++ }}</td>
                                            <td>{{ $data->tgl_bertelur }}</td>
                                            <td>{{ $data->status_telur }}</td>
                                            <td>{{ $data->status_produksi }}</td>
                                            <td>{{ $data->keterangan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
            $('#tableData').DataTable({
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

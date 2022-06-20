@extends('admin-arfa.template')
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
                        <div class="table-responsive">
                            <table id="example" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Asal Produksi</th>
                                        <th>Tanggal Bertelur</th>
                                        <th>Keterangan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach (auth()->user()->penangkaran->kandangs ?? [] as $auth)
                                        @foreach ($auth->produksis->where('status_produksi', 'Mati') as $data)
                                            <tr>
                                                <td>Kandang <b>{{ $data->kandang->nama_kandang }}</b> Telur
                                                    {{ $data->status_telur }}</td>
                                                <td>{{ date('d F Y', strtotime($data->tgl_bertelur)) }}</td>
                                                <td>{{ $data->keterangan }}</td>
                                                <td></td>
                                            </tr>
                                        @endforeach
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
{{-- @push('js')
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
@endpush --}}

@extends('template.template')
@section('title', 'Produksi Inkubator')
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
                            <thead align="center">
                                <tr>
                                    <th>Kode Inkubator</th>
                                    <th>Tanggal Masuk Inkubator</th>
                                    <th>Tanggal Akan Menetas</th>
                                    <th>Asal Telur</th>
                                    <th>Update</th>
                                </tr>
                            </thead>
                            <tbody align="center">

                                @foreach (auth()->user()->penangkaran->kandangs ?? [] as $auth)
                                    @foreach ($auth->produksis->where('status_produksi', 'Inkubator') as $data)
                                        <tr>
                                            <td>{{ $data->jadwal->kode_tempat_inkubator }}</td>
                                            <td>{{ date('d F Y', strtotime($data->tgl_masuk_inkubator)) }}</td>
                                            <td class="text-danger"><b>
                                                    {{ date('d', strtotime($data->jadwal->tgl_akan_menetas_start)) }}-{{ date('d F Y', strtotime($data->jadwal->tgl_akan_menetas_end)) }}</b>
                                            </td>
                                            <td>Kandang <b>{{ $data->kandang->nama_kandang }}</b> Telur
                                                {{ $data->status_telur }} </td>
                                            <td><button type="button" class="btn btn-default  btn-outline-success"
                                                    data-toggle="modal"
                                                    data-target="{{ url('#modal-update' . $data->id) }}">
                                                    <ion-icon name="open-outline"></ion-icon>
                                                </button>
                                            </td>
                                        </tr>
                                        {{-- modal update --}}
                                        <div class="modal fade" id="modal-update{{ $data->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update Tanggal Menetas</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ url('/produksi-inkubator/update/' . $data->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label for="TanggalBertelur">Hari ini Telur
                                                                        {{ $data->status_telur }} Menetas Kandang
                                                                        {{ $data->kandang->nama_kandang }}
                                                                        Kode Tempat
                                                                        {{ $data->jadwal->kode_tempat_inkubator }}</label>
                                                                    <input type="input"
                                                                        class="form-control  @error('tgl_menetas') is-invalid @enderror"
                                                                        id="tgl_menetas" name="tgl_menetas"
                                                                        value="{{ date('Y-m-d') }}" readonly>
                                                                    @error('tgl_menetas')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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
    <script src="{{ asset('template') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    {{-- <script src="{{ asset('template') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('template') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('template') }}/plugins/pdfmake/vfs_fonts.js"></script> --}}
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

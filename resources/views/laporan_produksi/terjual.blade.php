@extends('admin-lte.template')
@section('title', 'Produksi Terjual')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-header border-0 p-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Total Produksi Terjual :
                                    <b class="text-danger">{{ count($produksis->where('status_produksi', 'Terjual')) }}</b>
                                </h3>
                                {{-- <button type="button" class="btn btn-outline-success" onclick="showPrintMati()">
                                    <ion-icon name="print-outline"></ion-icon> Print
                                </button> --}}
                            </div>
                        </h3>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead align="center">
                                <tr>
                                    <th>No.</th>
                                    <th>Penangkaran</th>
                                    <th>Kode Ring</th>
                                    <th>Indukan</th>
                                    <th>Tanggal Menetas</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Keterangan</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($produksis->where('status_produksi', 'Terjual') as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->kandang->penangkaran->kode_penangkaran ?? '' }}</td>
                                        <td>{{ $data->kode_ring ?? 'belum tersedia' }} </td>
                                        <td>{{ $data->indukan }}</td>

                                        <td>{{ date('d F Y', strtotime($data->tgl_menetas)) }}</td>
                                        <td>{{ $data->jenis_kelamin }}</td>
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
@endsection

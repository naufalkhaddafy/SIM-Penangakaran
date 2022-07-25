@extends('admin-lte.template')
@section('title', 'Panduan')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{-- <h3 class="card-title">
                            <td>
                                Panduan Perawatan
                            </td>
                        </h3> --}}
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="reproduksi">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header bg-green" id="heading">
                                        <h2 class="mb-0">
                                            <button class="btn btn-block" type="button" data-toggle="collapse"
                                                data-target="#collapseReproduksi" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <h5 class=" text-left text-white"><b>Panduan Reproduksi</b>
                                                </h5>
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseReproduksi" class="collapse" aria-labelledby="heading"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach ($panduans->where('status', 'publish')->where('kategori', 'Reproduksi') as $data)
                                                    <div class="col-sm-6">
                                                        <h4 align="center">{{ $data->judul }}</h4>
                                                        <textarea class="form-control" rows="5" style="border-color: white; width:100%;"readonly>{{ $data->isi }}</textarea>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="perkandangan">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header bg-green" id="heading">
                                        <h2 class="mb-0">
                                            <button class="btn btn-block" type="button" data-toggle="collapse"
                                                data-target="#collapsePerkandangan" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <h5 class=" text-left text-white"><b>Panduan Perkandangan</b>
                                                </h5>
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapsePerkandangan" class="collapse" aria-labelledby="heading"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach ($panduans->where('status', 'publish')->where('kategori', 'Perkandangan') as $data)
                                                    <div class="col-sm-6">
                                                        <h4 align="center">{{ $data->judul }}</h4>
                                                        <textarea class="form-control" rows="5" style="border-color: white; width:100%;"readonly>{{ $data->isi }}</textarea>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="perawatan">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header bg-green" id="heading">
                                        <h2 class="mb-0">
                                            <button class="btn btn-block" type="button" data-toggle="collapse"
                                                data-target="#collapsePerawatan" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <h5 class=" text-left text-white"><b>Panduan Perawatan</b>
                                                </h5>
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapsePerawatan" class="collapse" aria-labelledby="heading"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach ($panduans->where('status', 'publish')->where('kategori', 'Perawatan') as $data)
                                                    <div class="col-sm-6">
                                                        <h4 align="center">{{ $data->judul }}</h4>
                                                        <textarea class="form-control" rows="5" style="border-color: white; width:100%;"readonly>{{ $data->isi }}</textarea>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pakan">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header bg-green" id="heading">
                                        <h2 class="mb-0">
                                            <button class="btn btn-block" type="button" data-toggle="collapse"
                                                data-target="#collapsePakan" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <h5 class=" text-left text-white"><b>Panduan Pakan</b>
                                                </h5>
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapsePakan" class="collapse" aria-labelledby="heading"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach ($panduans->where('status', 'publish')->where('kategori', 'Pakan') as $data)
                                                    <div class="col-sm-6">
                                                        <h4 align="center">{{ $data->judul }}</h4>
                                                        <textarea class="form-control" rows="5" style="border-color: white; width:100%;"readonly>{{ $data->isi }}</textarea>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

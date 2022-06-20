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
                        @foreach ($panduans->where('status', 'publish') as $data)
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header bg-green" id="heading">
                                        <h2 class="mb-0">
                                            <button class="btn btn-block" type="button" data-toggle="collapse"
                                                data-target="#collapse{{ $data->id }}" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <h5 class=" text-left text-white"><b>{{ $data->judul }}</b></h5>
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapse{{ $data->id }}" class="collapse" aria-labelledby="heading"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <textarea class="form-control" rows="5" readonly>{{ $data->isi }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

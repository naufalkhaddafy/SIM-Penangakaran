@extends('template.template')
@section('title', 'Kandang')

@section('content')
    <?php $no = 1; ?>
    <div class="card-body">
        <div class="card" style="width: 20rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="row">
                <div class="card-body">
                    <h5 class="card-title">Penangkaran {{ $no++ }}</h5>
                    <p class="card-text"></p>
                    <a href="/penangkaran/" class="btn btn-primary">Detail Penangkaran</a>
                </div>
            </div>
        </div>
    </div>


@endsection

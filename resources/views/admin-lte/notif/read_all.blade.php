@extends('admin-lte.template')
@section('title', 'Seluruh Notifikasi')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Riwayat Notifikasi
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="card-body">
                            <ul class="todo-list" data-widget="todo-list">
                                @foreach ($allNotif as $data)
                                    <li>
                                        <!-- drag handle -->
                                        <span class="handle">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>
                                        <!-- todo text -->
                                        <span class="text">{{ $data->message }}</span>
                                        <!-- Emphasis label -->
                                        <small class="badge badge-success"><i
                                                class="far fa-clock"></i>{{ $data->created_at->diffForHumans() }}</small>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

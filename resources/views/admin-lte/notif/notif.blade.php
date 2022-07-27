<a class="nav-link" data-toggle="dropdown" href="#">
    <i class="far fa-bell"></i>
    <span
        class="badge badge-danger navbar-badge">{{ count($notif->where('read_at', null)) ? count($notif->where('read_at', null)) : '' }}</span>
</a>
<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
    <span class="dropdown-item dropdown-header">{{ count($notif->where('read_at', null)) }} Notifications</span>
    <div class="dropdown-divider"></div>
    @foreach ($notif->where('read_at', null) as $data)
        <a onclick="notifRead({{ $data->id }})" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> {{ $data->type }}
            <span class="float-right text-muted text-sm">{{ $data->created_at->diffForHumans() }}</span>
        </a>
    @endforeach
    <div class="dropdown-divider"></div>
    <a href="{{ route('read.all.notification') }}" class="dropdown-item dropdown-footer">See All Notifications</a>
</div>
<script>
    function notifRead(id) {
        $.get("{{ url('/notification-read') }}/" + id, function(data) {
            $('#modalLabel').text('Pesan Notifikasi')
            $('#showModalBody').html(data);
            $('#showModal').modal('show');
            $('#btnClose').show();
            $('#btnSubmit').hide();
            $('#btnDelete').hide();
            getNotifikasi();
        });
    }
</script>

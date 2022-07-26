<a class="nav-link" data-toggle="dropdown" href="#">
    <i class="far fa-bell"></i>
    <span
        class="badge badge-danger navbar-badge">{{ count($notif->where('read_at', null)) ? count($notif->where('read_at', null)) : '' }}</span>
</a>
<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
    <span class="dropdown-item dropdown-header">{{ count($notif->where('read_at', null)) }} Notifications</span>
    <div class="dropdown-divider"></div>
    @foreach ($notif->where('read_at', null) as $notif)
        <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> {{ $notif->type }}
            <span class="float-right text-muted text-sm">{{ $notif->created_at->diffForHumans() }}</span>
        </a>
    @endforeach
    <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
</div>

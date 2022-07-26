<!-- Left navbar links -->
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
        </a>
    </li>
</ul>
<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
        <div id="notifikasi"></div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            Hi, {{ Auth::user()->nama_lengkap }}
            <ion-icon name="chevron-down-outline"></ion-icon>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item" class="btn btn-block btn-outline-dark" data-toggle="modal"
                data-target="#modal-sm">
                <ion-icon name="person-outline"></ion-icon> Profile
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item" class="btn btn-block btn-outline-dark" data-toggle="modal"
                data-target="#modal-sm">
                <ion-icon name="exit-outline"></ion-icon> Logout
            </a>
        </div>
    </li>
</ul>

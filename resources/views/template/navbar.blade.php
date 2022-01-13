<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
            <ion-icon name="grid"></ion-icon>
            <p>
                Dashboard
            </p>
        </a>
    </li>
    <li class="nav-header">ADMIN</li>
    <li class="nav-item">
        <a href="{{ route('penangkaran') }}" class="nav-link {{ request()->is('penangkaran') ? 'active' : '' }}">
            <ion-icon name="location-sharp"></ion-icon>
            <p>
                Penangkaran
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('kandang') }}" class="nav-link {{ request()->is('kandang') ? 'active' : '' }}">
            <ion-icon name="home"></ion-icon>
            <p>
                Kandang
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('pakan') }}" class="nav-link {{ request()->is('pakan') ? 'active' : '' }}">
            <ion-icon name="nutrition"></ion-icon>
            <p>
                Pakan
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('reportproduksi') }}"
            class="nav-link {{ request()->is('reportproduksi') ? 'active' : '' }}">
            <ion-icon name="bar-chart"></ion-icon>
            <p>
                Produksi
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('pengguna') }}" class="nav-link {{ request()->is('pengguna') ? 'active' : '' }}">
            <ion-icon name="person-sharp"></ion-icon>
            <p>
                Pengguna
            </p>
        </a>
    </li>
    <li class="nav-item {{ request()->is('kategori', 'kategoriproduksi') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ request()->is('kategori', 'kategoriproduksi') ? 'active' : '' }}">
            <ion-icon name="attach-sharp"></ion-icon>
            <p>
                Kategori
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('kategori') }}"
                    class=" nav-link {{ request()->is('kategori') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kategori Kandang</p>
                </a>
            </li>
        </ul>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('kategoriproduksi') }}"
                    class=" nav-link {{ request()->is('kategoriproduksi') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kategori Produksi</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-header">Pekerja</li>
    <li class="nav-item {{ request()->is('dashboar') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ request()->is('dashboa') ? 'active' : '' }}">
            <ion-icon name="home"></ion-icon>
            <p>
                Kandang
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="#" class="nav-link {{ request()->is('dashboa') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kandang</p>
                </a>
            </li>
        </ul>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="#" class="nav-link {{ request()->is('dashboa') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kebersihan</p>
                </a>
            </li>
        </ul>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="#" class="nav-link {{ request()->is('dashboa') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Produksi</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link {{ request()->is('') ? 'active' : '' }}">
            <ion-icon name="home"></ion-icon>
            <p>
                Inkubator
            </p>
        </a>
    </li>
</ul>

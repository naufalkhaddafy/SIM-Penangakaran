<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
            <ion-icon name="grid"></ion-icon>
            <p>
                Dashboard
            </p>
        </a>
    </li>
    @if (Auth::user()->role == 'pemilik')
        {{-- <li class="nav-header">ADMIN</li> --}}
        <li class="nav-item">
            <a href="{{ route('read.penangkaran') }}"
                class="nav-link {{ request()->is('penangkaran') ? 'active' : '' }}">
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
            <a href="{{ route('report.indukan') }}"
                class="nav-link {{ request()->is('report-indukan') ? 'active' : '' }}">
                <ion-icon name="finger-print-outline"></ion-icon>
                <p>
                    Indukan
                </p>
            </a>
        </li>
        <li class="nav-item {{ request()->is('report-inkubator', 'report-hidup', 'report-mati') ? 'menu-open' : '' }}">
            <a href="#"
                class="nav-link {{ request()->is('report-inkubator', 'report-hidup', 'report-mati') ? 'active' : '' }}">
                <ion-icon name="bar-chart"></ion-icon>
                <p>
                    Hasil Produksi
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('report.inkubator') }}"
                        class=" nav-link {{ request()->is('report-inkubator') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Inkubator</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('report.hidup') }}"
                        class=" nav-link {{ request()->is('report-hidup') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Hidup</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('report.mati') }}"
                        class=" nav-link {{ request()->is('report-mati') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Mati</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="#" class=" nav-link {{ request()->is('kategoriproduksi') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Terjual</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{ request()->is('pengguna-pemilik', 'pengguna-pekerja') ? 'menu-open' : '' }}">
            <a href="#"
                class="nav-link {{ request()->is('pengguna-pemilik', 'pengguna-pekerja') ? 'active' : '' }}">
                <ion-icon name="person-sharp"></ion-icon>
                <p>
                    Pengguna
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('pengguna.pemilik') }}"
                        class=" nav-link {{ request()->is('pengguna-pemilik') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pemilik</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('pengguna.pekerja') }}"
                        class=" nav-link {{ request()->is('pengguna-pekerja') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pekerja</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="{{ route('panduan') }}" class="nav-link {{ request()->is('panduan') ? 'active' : '' }}">
                <ion-icon name="book"></ion-icon>
                <p>
                    Panduan
                </p>
            </a>
        </li>
    @elseif (Auth::user()->role == 'pekerja')
        {{-- <li class="nav-header">Pekerja</li> --}}
        <li class="nav-item">
            <a href="{{ route('detail.kandang') }}"
                class="nav-link {{ request()->is('detail-kandang') ? 'active' : '' }}">
                <ion-icon name="home"></ion-icon>
                <p>
                    Kandang
                </p>
            </a>
        </li>
        <li
            class="nav-item {{ request()->is('produksi-inkubator', 'produksi-hidup', 'produksi-mati') ? 'menu-open' : '' }}">
            <a href="#"
                class="nav-link {{ request()->is('produksi-inkubator', 'produksi-hidup', 'produksi-mati') ? 'active' : '' }}">
                <ion-icon name="bar-chart"></ion-icon>
                <p>
                    Produksi
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('produksi.inkubator') }}"
                        class="nav-link {{ request()->is('produksi-inkubator') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Inkubator</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('produksi.hidup') }}"
                        class="nav-link {{ request()->is('produksi-hidup') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Hidup</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('produksi.mati') }}"
                        class="nav-link {{ request()->is('produksi-mati') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Mati</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="{{ route('user.panduan') }}"
                class="nav-link {{ request()->is('Panduan-Pekerja-Perawatan') ? 'active' : '' }}">
                <ion-icon name="book"></ion-icon>
                <p>
                    Panduan
                </p>
            </a>
        </li>
    @endif
</ul>

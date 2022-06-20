    <ul>
        <li class="{{ request()->is('dashboard') ? 'active open' : '' }}">
            <a href="{{ route('dashboard') }}" class="link">
                <i class="ti-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @if (Auth::user()->role == 'pemilik')
            <li
                class="{{ request()->is('produksi-inkubator', 'produksi-hidup', 'produksi-mati') ? 'active open' : '' }} ">
                <a href="#" class="main-menu has-dropdown">
                    <i class="ti-desktop"></i>
                    <span>Produksi</span>
                </a>
                <ul
                    class="sub-menu {{ request()->is('produksi-inkubator', 'produksi-hidup', 'produksi-mati') ? 'expand' : '' }} ">
                    <li class="{{ request()->is('produksi-inkubator') ? 'active' : '' }}"><a
                            href="{{ route('produksi.inkubator') }}" class="link"><span>Inkubator</span></a>
                    </li>
                    <li class="{{ request()->is('produksi-hidup') ? 'active' : '' }}"><a
                            href="{{ route('produksi.hidup') }}" class="link"><span>Hidup</span></a></li>
                    <li class="{{ request()->is('produksi-mati') ? 'active' : '' }}"><a
                            href="{{ route('produksi.mati') }}" class="link"><span>Mati</span></a>
                    </li>
                </ul>
            </li>
        @elseif (Auth::user()->role == 'pekerja')
            <li class="{{ request()->is('detail-kandang') ? 'active open' : '' }}">
                <a href="{{ route('detail.kandang') }}" class="link">
                    <i class="ti-home"></i>
                    <span>Kandang</span>
                </a>
            </li>
            <li
                class="{{ request()->is('produksi-inkubator', 'produksi-hidup', 'produksi-mati') ? 'active open' : '' }} ">
                <a href="#" class="main-menu has-dropdown">
                    <i class="ti-bar-chart"></i>
                    <span>Produksi</span>
                </a>
                <ul
                    class="sub-menu {{ request()->is('produksi-inkubator', 'produksi-hidup', 'produksi-mati') ? 'expand' : '' }} ">
                    <li class="{{ request()->is('produksi-inkubator') ? 'active' : '' }}"><a
                            href="{{ route('produksi.inkubator') }}" class="link"><span>Inkubator</span></a>
                    </li>
                    <li class="{{ request()->is('produksi-hidup') ? 'active' : '' }}"><a
                            href="{{ route('produksi.hidup') }}" class="link"><span>Hidup</span></a></li>
                    <li class="{{ request()->is('produksi-mati') ? 'active' : '' }}"><a
                            href="{{ route('produksi.mati') }}" class="link"><span>Mati</span></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('user.panduan') }}" class="link">
                    <i class="ti-book"></i>
                    <span>Panduan</span>
                </a>
            </li>
        @endif
    </ul>

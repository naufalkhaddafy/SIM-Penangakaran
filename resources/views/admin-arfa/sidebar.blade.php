<ul>
    <li class="{{ request()->is('dashboard') ? 'active open' : '' }}">
        <a href="{{ route('dashboard') }}" class="link">
            <i class="ti-home"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="{{ request()->is('produksi-inkubator', 'produksi-hidup', 'produksi-mati') ? 'active open' : '' }} ">
        <a href="#" class="main-menu has-dropdown">
            <i class="ti-desktop"></i>
            <span>Produksi</span>
        </a>
        <ul
            class="sub-menu {{ request()->is('produksi-inkubator', 'produksi-hidup', 'produksi-mati') ? 'expand' : '' }} ">
            <li><a href="{{ route('produksi.inkubator') }}" class="active"><span>Inkubator</span></a>
            </li>
            <li><a href="{{ route('produksi.hidup') }}" class="active"><span>Hidup</span></a></li>
            <li><a href="{{ route('produksi.mati') }}" class="active"><span>Mati</span></a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#" class="main-menu has-dropdown">
            <i class="ti-desktop"></i>
            <span>UI Elements</span>
        </a>
        <ul class="sub-menu ">
            <li><a href="element-ui.html" class="link"><span>Elements</span></a></li>
            <li><a href="element-accordion.html" class="link"><span>Accordion</span></a></li>
            <li><a href="element-tabs-collapse.html" class="link"><span>Tabs & Collapse</span></a>
            </li>
            <li><a href="element-card.html" class="link"><span>Card</span></a></li>
            <li><a href="element-button.html" class="link"><span>Buttons</span></a></li>
            <li><a href="element-alert.html" class="link"><span>Alert</span></a></li>
            <li><a href="element-themify-icons.html" class="link"><span>Themify Icons</span></a>
            </li>
            <li><a href="element-modal.html" class="link"><span>Modal</span></a></li>
        </ul>
    </li>
    <li>
        <a href="#" class="main-menu has-dropdown">
            <i class="ti-book"></i>
            <span>Form</span>
        </a>
        <ul class="sub-menu ">
            <li><a href="form-element.html" class="link">
                    <span>Form Element</span></a>
            </li>
            <li><a href="form-datepicker.html" class="link">
                    <span>Datepicker</span></a>
            </li>
            <li><a href="form-select2.html" class="link">
                    <span>Select2</span></a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#" class="main-menu has-dropdown">
            <i class="ti-notepad"></i>
            <span>Utilities</span>
        </a>
        <ul class="sub-menu">
            <li><a href="error-404.html" target="_blank" class="link"><span>Error 404</span></a>
            </li>
            <li><a href="error-403.html" target="_blank" class="link"><span>Error 403</span></a>
            </li>
            <li><a href="error-500.html" target="_blank" class="link"><span>Error 500</span></a>
            </li>
        </ul>
    </li>

</ul>

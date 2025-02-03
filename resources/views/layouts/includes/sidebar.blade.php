<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html"><img src="{{ asset('assets/images/sig.png') }}" alt="Logo" srcset="" style="width: 100px; height: 100px;"></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item {{ Request::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item  has-sub  {{ Request::is('product') || Request::is('product-from-db') ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="mdi mdi-database"></i>
                        <span>Master Data</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item {{ Request::is('product') ? 'active' : '' }}">
                            <a href="{{ route('product') }}">Product from API</a>
                        </li>
                        <li class="submenu-item  {{ Request::is(patterns: 'product-from-db') ? 'active' : '' }}">
                            <a href="{{ route('productFromDb') }}">Product from DB</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  {{ Request::is('fetch-data-from-api') ? 'active' : '' }}">
                    <a href="{{ route('fetchDataFromApi') }}" class='sidebar-link'>
                        <i class="mdi mdi-api"></i>
                        <span>Fetch data API to DB</span>
                    </a>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
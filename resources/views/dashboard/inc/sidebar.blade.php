<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link {{ request()->routeIs('brands') ? 'active' : '' }}" href="{{ route('brands') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Brands
                </a>
                <a class="nav-link {{ request()->routeIs('products') || request()->routeIs('products.create') || request()->routeIs('products.edit') ? 'active' : '' }}" href="{{ route('products') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Products
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth::user()->name }}
        </div>
    </nav>
</div>
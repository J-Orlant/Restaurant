<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        {{-- title --}}
        <div class="sidebar-brand-text mx-3">
            @if (Auth::user()->level == 'ADMIN')
                Admin Panel
                @elseif (Auth::user()->level == 'WAITER')
                Waiter Panel
                @elseif (Auth::user()->level == 'CASHIER')
                Cashier Panel
            @endif
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    @if (Auth::user()->level == 'ADMIN')
        <li class="nav-item {{ Route::currentRouteNamed('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        @elseif (Auth::user()->level == 'WAITER')
        <li class="nav-item {{ Route::currentRouteNamed('dashboardWaiter') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboardWaiter') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        @elseif (Auth::user()->level == 'CASHIER')
        <li class="nav-item {{ Route::currentRouteNamed('dashboardCashier') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboardCashier') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
    @endif


    <!-- Heading -->
    @if (Auth::user()->level == 'CASHIER')
        <div></div>
        @else
        <!-- Divider -->
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Tables
        </div>
    @endif

    @if (Auth::user()->level == 'ADMIN')
        <!-- Nav Item - Charts -->
        <li class="nav-item {{ Route::currentRouteNamed('menu.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('menu.index') }}">
                <i class="fas fa-fw fa-book"></i>
                <span>Menu</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item {{ Route::currentRouteNamed('meja.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('meja.index') }}">
                <i class="fas fa-table fa-fw"></i>
                <span>Meja</span></a>
        </li>

        <li class="nav-item {{ Route::currentRouteNamed('user.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.index') }}">
                <i class="fas fa-user fa-fw"></i>
                <span>Users</span></a>
        </li>
        @elseif (Auth::user()->level == 'WAITER')
        <li class="nav-item {{ Route::currentRouteNamed(['waiter-order', 'waiter-order-menu']) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('waiter-order') }}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Order</span></a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->

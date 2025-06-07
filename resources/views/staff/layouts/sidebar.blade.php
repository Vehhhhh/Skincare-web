<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a></li>
        </ul>

    </form>
    <ul class="navbar-nav navbar-right">

        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset(auth()->user()->avatar) }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title"></div>
                <a href="{{ route('staff.profile') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                {{-- <a href="{{ route('staff.setting.index') }}" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a> --}}
                <div class="dropdown-divider"></div>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="#"
                        onclick="event.preventDefault();
                    this.closest('form').submit();"
                        class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </form>

            </div>
        </li>
    </ul>
</nav>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('staff.dashboard') }}">House of Beauty</a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>

            <li class="{{ setSidebarActive(['staff.dashboard']) }}"><a class="nav-link"
                    href="{{ route('staff.dashboard') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>

            <li class="menu-header">Starter</li>

            <li
                class="dropdown {{ setSidebarActive([
                    'staff.orders.*',
                    'staff.pending-orders',
                    'staff.inprocess-orders',
                    'staff.delivered-orders',
                    'staff.declined-orders',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-box"></i>
                    <span>Orders</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setSidebarActive(['staff.orders.*']) }}"><a class="nav-link"
                            href="{{ route('staff.orders.index') }}">All Orders</a>
                    </li>
                    <li class="{{ setSidebarActive(['staff.pending-orders']) }}"><a class="nav-link"
                            href="{{ route('staff.pending-orders') }}">Pending Orders</a>
                    </li>
                    <li class="{{ setSidebarActive(['staff.inprocess-orders']) }}"><a class="nav-link"
                            href="{{ route('staff.inprocess-orders') }}">In Process Orders</a>
                    </li>
                    <li class="{{ setSidebarActive(['staff.delivered-orders']) }}"><a class="nav-link"
                            href="{{ route('staff.delivered-orders') }}">Delivered Orders</a>
                    </li>
                    <li class="{{ setSidebarActive(['staff.declined-orders']) }}"><a class="nav-link"
                            href="{{ route('staff.declined-orders') }}">Declined Orders</a>
                    </li>
                </ul>
            </li>

            <li class="dropdown {{ setSidebarActive(['staff.delivery-area.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-store"></i>
                    <span>Manage Ecommerce</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setSidebarActive(['staff.delivery-area.*']) }}"><a class="nav-link"
                            href="{{ route('staff.delivery-area.index') }}">Delivery Area</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown {{ setSidebarActive(['staff.reservation-time.*', 'staff.reservation.*', 'staff.table.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-chair"></i>
                    <span>Manage Reservations</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setSidebarActive(['staff.reservation-time.*']) }}"><a class="nav-link"
                            href="{{ route('staff.reservation-time.index') }}">Reservation Times</a>
                    </li>
                    <li class="{{ setSidebarActive(['staff.reservation.*']) }}"><a class="nav-link"
                            href="{{ route('staff.reservation.index') }}">Reservation</a>
                    </li>
                    <li class="{{ setSidebarActive(['staff.table.*']) }}"><a class="nav-link"
                            href="{{ route('staff.table.index') }}">Tables</a>
                    </li>
                </ul>
            </li>
        </ul>


    </aside>
</div>

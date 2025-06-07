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
                <a href="{{ route('admin.profile') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <a href="{{ route('admin.setting.index') }}" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a>
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
            <a href="{{ route('admin.dashboard') }}">house of beauty</a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>

            <li class="{{ setSidebarActive(['admin.dashboard']) }}"><a class="nav-link"
                    href="{{ route('admin.dashboard') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>

            <li class="menu-header">Starter</li>
            <li class="{{ setSidebarActive(['admin.slider.*']) }}"><a class="nav-link"
                    href="{{ route('admin.slider.index') }}"><i class="fas fa-images"></i>
                    <span>Slider</span></a>
            </li>
            {{--  <li class="{{ setSidebarActive(['admin.why-choose-us.*']) }}"><a class="nav-link"
                    href="{{ route('admin.why-choose-us.index') }}"><i class="fas fa-file-word"></i>
                    <span>Why Choose Us</span></a>
            </li> --}}

            <li class="dropdown {{ setSidebarActive(['admin.category.*', 'admin.product.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Manage Products</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setSidebarActive(['admin.category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.category.index') }}">Product Categories</a>
                    </li>
                    <li class="{{ setSidebarActive(['admin.product.*']) }}"><a class="nav-link"
                            href="{{ route('admin.product.index') }}">Products</a>
                    </li>
                </ul>
            </li>

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
                    <li class="{{ setSidebarActive(['admin.orders.*']) }}"><a class="nav-link"
                            href="{{ route('admin.orders.index') }}">All Orders</a>
                    </li>
                    <li class="{{ setSidebarActive(['admin.pending-orders']) }}"><a class="nav-link"
                            href="{{ route('admin.pending-orders') }}">Pending Orders</a>
                    </li>
                    <li class="{{ setSidebarActive(['admin.inprocess-orders']) }}"><a class="nav-link"
                            href="{{ route('admin.inprocess-orders') }}">In Process Orders</a>
                    </li>
                    <li class="{{ setSidebarActive(['admin.delivered-orders']) }}"><a class="nav-link"
                            href="{{ route('admin.delivered-orders') }}">Delivered Orders</a>
                    </li>
                    <li class="{{ setSidebarActive(['admin.declined-orders']) }}"><a class="nav-link"
                            href="{{ route('admin.declined-orders') }}">Declined Orders</a>
                    </li>
                </ul>
            </li>

            <li class="dropdown {{ setSidebarActive(['admin.about.*', 'admin.contact.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file"></i>
                    <span>Pages</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setSidebarActive(['admin.about.*']) }}"><a class="nav-link"
                            href="{{ route('admin.about.index') }}">About</a>
                    </li>
                    <li class="{{ setSidebarActive(['admin.contact.*']) }}"><a class="nav-link"
                            href="{{ route('admin.contact.index') }}">Contact</a>
                    </li>
                </ul>
            </li>

            <li class="{{ setSidebarActive(['admin.admin-management.*']) }}"><a class="nav-link"
                    href="{{ route('admin.admin-management.index') }}"><i class="fas fa-user-shield"></i>
                    <span>Admin Management</span></a>
            </li>

            <li class="dropdown {{ setSidebarActive(['admin.delivery-area.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-store"></i>
                    <span>Manage Ecommerce</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setSidebarActive(['admin.delivery-area.*']) }}"><a class="nav-link"
                            href="{{ route('admin.delivery-area.index') }}">Delivery Area</a>
                    </li>
                </ul>
            </li>

            <li class="{{ setSidebarActive(['admin.setting.*']) }}"><a class="nav-link"
                    href="{{ route('admin.setting.index') }}"><i class="fas fa-cogs"></i>
                    <span>Setting</span></a>
            </li>

        </ul>


    </aside>
</div>

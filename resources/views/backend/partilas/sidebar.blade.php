<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Book Share</div>
    </a>
    <hr class="sidebar-divider my-0">
    @if(Auth::check('auth:admin'))
    <li class="nav-item @yield('dashboard')">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item @yield('dashboard')">
        <a class="nav-link" href="{{ route('index') }}" target="_blank">
            <i class="fas fa-fw fa-award"></i>
            <strong class="text-success">Frontend</strong></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Interface</div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-book"></i>
            <span>Books</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage  Book & all</h6>
                <a class="collapse-item" href="{{ route('book.index') }}">Book</a>
                <a class="collapse-item" href="{{ route('book.approve.list') }}">Approved
                    <span class="badge badge-success">{{ bookApproved() }}</span></a>
                <a class="collapse-item" href="{{ route('book.unapprove.list') }}">Unapproved
                    <span class="badge badge-warning">{{ bookUnapproved() }}</span></a>
            </div>
        </div>
    </li>

    <li class="nav-item @yield('book')">
        <a class="nav-link" href="{{ route('book.index') }}">
            <i class="fas fa-fw fa-book"></i>
            <span>Books</span></a>
    </li>
    <li class="nav-item @yield('author')">
        <a class="nav-link" href="{{ route('author.index') }}">
            <i class="fa fa-user"></i>
            <span>Authors</span></a>
    </li>
    <li class="nav-item @yield('publisher')">
        <a class="nav-link" href="{{ route('publisher.index') }}">
            <i class="fas fa-certificate"></i>
            <span>Publisher</span></a>
    </li>
    <li class="nav-item @yield('category')">
        <a class="nav-link" href="{{ route('category.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Catergories</span></a>
    </li>
    <li class="nav-item @yield('banner')">
        <a class="nav-link" href="{{ route('banner.index') }}">
            <i class="fas fa-fw fa-balance-scale"></i>
            <span>Banner</span></a>
    </li>
    <li class="nav-item @yield('banner')">
        <a class="nav-link" href="{{ route('contact.index') }}">
            <i class="fas fa-fw fa-balance-scale"></i>
            <span>Contact</span></a>
    </li>
    @endif
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>

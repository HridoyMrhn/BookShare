<div class="top-header">
    <div class="container">
        <div class="dropdown float-right">
            <a class="dropdown-toggle pointer top-header-link" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if (Auth::check())
                <img class="img-profile rounded-circle" src="{{ asset('uploads/user/'.auth()->user()->image) }}" style="width:25px; height:25px">
                {{ auth()->user()->name }}
                @else
                <i class="fa fa-user"></i> My account
                @endif
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @if (Auth::check())
                <a class="dropdown-item" href="{{ route('user.dashboard') }}"><i class="far fa-user-circle"></i> Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

                @else
                <a class="dropdown-item" href="{{ route('login') }}"><i class="fas fa-user-plus"></i> Login</a>
                <a class="dropdown-item" href="{{ route('register') }}"><i class="far fa-user-circle"></i> Register</a>
                @endif
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="main-navbar">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand mr-5" href="{{ route('index') }}">
                <img src="{{ asset('uploads/default/book-logo.jpg') }}" class="logo-image rounded-circle">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('index') }}"> Home </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Category</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown01">
                            @foreach (all_categoty() as $data)
                                <a class="dropdown-item" href="{{ route('category', $data->category_slug) }}">{{ $data->category_name }}</a>
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item @yield('book-list')">
                        <a class="nav-link" href="{{ route('user.book.list') }}">All Book</a>
                    </li>
                    <li class="nav-item @yield('about')">
                        <a class="nav-link" href="{{ route('about') }}">About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contact us</a>
                    </li>
                    @auth
                    <li class="nav-item @yield('upload-book')">
                        <a class="nav-link" href="{{ route('user.book.create') }}">Upload Book</a>
                    </li>
                    @endauth
                </ul>
                <form class="form-inline my-2 my-lg-0" action="{{ route('user.book.search') }}" method="GET">
                    <input class="form-control mr-sm-2 search-form" type="text" name="value" id="value" value="{{ isset($search) ? $search:'' }}" placeholder="Search" aria-label="Search">
                    <button class="btn btn-secondary my-2 my-sm-0 search-button" type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </nav>
</div>

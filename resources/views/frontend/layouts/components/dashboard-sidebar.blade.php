<div class="col-md-3 p-1">
    <div class="profile-sidebar border">
        <div class="widget">
            <h5 class="mb-2 border-bottom pb-3">
                {{-- <i class="fa fa-user default-user"></i> --}}
                <img src="{{ asset('uploads/user/'.user()->image) }}" class="rounded-circle" style="width: 150px; height: 150px" alt="">
            </h5>
            <div class="list-group mt-3">
                <a href="{{ route('user.dashboard') }}"
                    class="list-group-item list-group-item-action @yield('dashboard')">Dashboard</a>
                <a href="{{ route('user.dashboard.book.upload') }}"
                    class="list-group-item list-group-item-action @yield('upload')"> My Books <span class="badge badge-info">{{ myBook() }}</span>
                </a>
                <a href="{{ route('user.dashboard.book.request') }}"
                    class="list-group-item list-group-item-action @yield('request')">Book Requests <span class="badge badge-info">{{ bookRequest() }}</span>
                </a>
                <a href="{{ route('user.dashboard.book.order') }}"
                    class="list-group-item list-group-item-action @yield('order')">Book Orders <span class="badge badge-info">{{ bookOrder() }}</span>
                </a>
            </div>
        </div>
    </div>
</div>

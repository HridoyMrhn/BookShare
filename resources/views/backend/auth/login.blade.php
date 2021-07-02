@extends('backend.master')

@section('content')

<div class="my-2">@include('backend.layouts.components.status')</div>

<div class="login-area page-area mx-auto">
    <div class="container">
        <div class="row my-5">
            <div class="col-md-8 border">
                <div class="card-header">
                    <h3>Login to Admin Account</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.login.submit') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter Your Password">
                        </div>
                        <div class="form-group form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember   ">Remember Me</label>
                        </div>
                        <div class="form-group row mb-0 ml-1">
                            <div class="">
                                <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('admin.password.request') }}">{{ __('Forgot Your Password?') }}</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

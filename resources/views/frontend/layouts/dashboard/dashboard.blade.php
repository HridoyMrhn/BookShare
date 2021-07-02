@extends('frontend.master')

@section('dashboard')
active
@endsection

@section('content')
@include('backend.layouts.components.status')

<div class="login-area page-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="profile-tab border">
                    <div class="bg-dark text-white">
                        <h2 class="d-inline-block p-1">{{ auth()->user()->name }}'s Dsahboard</h2>
                        <div class="float-right">
                            <a href="#profileEditModal" data-toggle="modal" class="btn btn-success d-inline-block"><i class="fa fa-edit"></i> Edit</a>
                        </div>
                    </div>
                    <div class="p-3">
                        <h5 class="">Designation: {{ user()->designation }}</h5>

                        {{-- <div class="clearfix"></div> --}}

                        <hr>
                        <div>
                            <strong>About: </strong>
                            <p>{{ user()->about }}</p>
                        </div>

                        <table class="table">
                            <thead>
                                <tr><th scope="col"><h4>Other info</h4></th></tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Email: </th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Phone Number: </th>
                                    <td>{{ $user->phone_number }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Address: </th>
                                    <td>{{ $user->address }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Profile Edit Modal -->
                        <div class="modal fade" id="profileEditModal" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Your Profile
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form method="POST" action="{{ route('user.dashboard.update', $user->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="name">Name: </label>
                                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="email">Email:</label>
                                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="col-lg-6">
                                                    <label for="password">Password:</label>
                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ $user->password }}" required autocomplete="password" autofocus>
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="user_name">Username</label>
                                                        <input type="text" name="user_name" id="user_name" class="form-control" @error('user_name') is-invalid @enderror value="{{ $user->user_name }}">
                                                        @error('user_name')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="phone_number">Phone Number</label>
                                                        <input type="text" name="phone_number" id="phone_number" class="form-control" @error('phone_number') is-invalid @enderror value="{{ $user->phone_number }}">
                                                        @error('phone_number')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="designation">Designation</label>
                                                        <input type="text" name="designation" id="designation" class="form-control" value="{{ $user->designation }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="image">image</label>
                                                        <input type="file" name="image" id="image" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="about">About You</label>
                                                        <textarea name="about" id="about" rows="5" class="form-control">{{$user->about }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="address">Your Address</label>
                                                        <textarea name="address" id="address" rows="5" class="form-control">{{$user->address }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('frontend.layouts.components.dashboard-sidebar')
        </div>
    </div>
</div>


@endsection

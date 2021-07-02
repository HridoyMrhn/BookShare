@extends('frontend.master')

@section('content')
@include('backend.layouts.components.status')

<div class="login-area page-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8 p-1 m-auto" class="tab-content" id="v-pills-tabContent">
                <div class="profile-tab border p-2">
                    <div class="float-left">
                        <img src="{{ asset('uploads/user/'.$user_profile->image) }}" class="rounded-circle" style="width: 150px; height: 150px" alt="">
                    </div>
                    <div class="float-right">
                        <h2>{{ $user_profile->name }}</h2>
                        <p>{{ $user_profile->designation }}</p>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div>
                        <strong>About: </strong>
                        <p>{{ $user_profile->about }}</p>
                    </div>

                    <table class="table">
                        <thead>
                            <tr><th scope="col"><h4>Other info</h4></th></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Email: </th>
                                <td>{{ $user_profile->email }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Phone Number: </th>
                                <td>{{ $user_profile->phone_number }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Address: </th>
                                <td>{{ $user_profile->address }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

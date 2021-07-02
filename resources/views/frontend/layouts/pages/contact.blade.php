@extends('frontend.master')
@section('title')
    All Contact
@endsection
@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="mx-auto my-5 text-center">@include('backend.layouts.components.status')</div>

        <div class="container mt-4 mb-4">
            <div class="login-form">
                <h2>Contact info</h2>
                <form action="{{ route('store.contact') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Your Name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter Your Email">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" name="subject" class="form-control" id="subject" aria-describedby="emailHelp" placeholder="Subjecet">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="number">Number</label>
                                <input type="number" name="number" class="form-control" id="number" aria-describedby="emailHelp" placeholder="Enter Your Number">
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea name="message" id="message" rows="5" class="form-control" placeholder="Your message Here"></textarea>
                            </div>
                        </div>
                    </div>
                    <p class="text-center">
                        <button type="submit" class="btn btn-outline-success btn-login btn-lg">Send Us</button>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

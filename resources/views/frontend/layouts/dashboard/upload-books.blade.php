@extends('frontend.master')

@section('upload')
active
@endsection

@section('content')
<div class="my-2">@include('backend.layouts.components.status')</div>

<div class="book-list-sidebar">
    <div class="container">
        <div class="row my-5">
            <div class="col-md-9">
                <div class="profile-tab border p-2">
                    <h3>My Uploaded Books</h3>
                    <hr>
                    @include('frontend.layouts.components.books')
                </div>
            </div>
            @include('frontend.layouts.components.dashboard-sidebar')
        </div>
        {{ $book->links() }}
    </div>
</div>

@endsection

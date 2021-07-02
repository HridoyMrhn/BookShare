@extends('frontend.master')

@section('content')


<div class="mt-5 col-6 mx-auto">@include('backend.layouts.components.status')</div>

<div class="book-list-sidebar">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-9">
                <div class="profile-tab border p-2">
                    <h3>{{ $category->category_name }}</h3>
                    <hr>
                    <div class="row">
                        @foreach ($books_pagination as $data)
                        <div class="col-md-4">
                            <div class="single-book">
                                <img src="{{ asset('uploads/book/'.$data->book_image) }}" style="width: 180px; height: 180px" alt="">
                                <div class="book-short-info my-2">
                                    <strong>{{ $data->book_name }}</strong>
                                    <p>
                                        <a href="{{ route('user.profile', $data->relationBookWithUser->user_name) }}" class=""><i class="fa fa-upload"></i> {{ $data->relationBookWithUser->name }}</a>
                                    </p>
                                        <a href="{{ route('user.book.details', $data->book_slug) }}" class="btn btn-outline-primary"><i class="fa fa-eye"></i> View</a>
                                        <a href="" class="btn btn-outline-danger"><i class="fa fa-heart"></i> Wishlist</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>

            <div class="col-md-3">
                <div class="widget">
                    <h5 class="mb-2 border-bottom pb-3"> Categories</h5>
                    {{-- @include('frontend.layouts.components.category') --}}
                    <div class="list-group mt-3">
                        @foreach (category() as $data)
                        <a href="{{ route('category', $data->category_slug) }}" class="list-group-item list-group-item-action {{ $data->id == $category->id ? 'active':'' }}">{{ $data->category_name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        {{ $books_pagination->links() }}
    </div>
</div>

@endsection

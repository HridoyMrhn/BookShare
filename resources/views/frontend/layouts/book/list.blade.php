@extends('frontend.master')

@section('book-list')
active
@endsection
@section('content')


<div class="mt-5 col-6 mx-auto">@include('backend.layouts.components.status')</div>
<div class="book-list-sidebar">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-9">
                <div class="profile-tab border p-2">
                    @if (isset($search))
                        <h3><strong class="text-success">{{ $search }}</strong> - Search Result is</h3>
                    @else
                        <h3>Recent Uploaded Books</h3>
                    @endif
                    <hr>

                    @include('frontend.layouts.components.books')
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget">
                    <h5 class="mb-2 border-bottom pb-3"> Categories</h5>
                    <div class="list-group mt-3">
                        @foreach (category() as $data)
                        <a href="{{ route('category', $data->category_slug) }}" class="list-group-item list-group-item-action">{{ $data->category_name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        {{ $book->withQueryString()->links() }}
    </div>
</div>

@endsection

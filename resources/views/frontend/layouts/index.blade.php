{{-- @php
error_reporting(0);
@endphp --}}

@extends('frontend.master')

@section('content')

<div class="my-2">@include('backend.layouts.components.status')</div>

<!-- Carousel -->
<div id="carouselExampleIndicators" class="carousel slide main-slider" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach ($banners as $data)
        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active':'' }}"></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach ($banners as $data)
            <div class="carousel-item {{ $loop->first ? 'active':'' }}">
                <img src="{{ asset('uploads/banner/'.$data->banner_image) }}" class="d-block w-100">
                <div class="carousel-caption d-none d-md-block">
                    <h3>{{ $data->banner_title }}</h3>
                    <p><a href="{{ $data->banner_link }}" class="btn btn-primary slider-link">{{ $data->banner_name }}</a></p>
                </div>
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
        data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
        data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- Carousel -->

<!-- Advance Search Start  -->
<div class="advance-search">
    <div class="container">
        <h3>Advance Search</h3>
        <form action="{{ route('advance.search') }}" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="title_info">Book Title/Description</label>
                        <input type="text" class="form-control" id="title_info" name="t_d" placeholder="Book Title/Description">
                    </div>
                </div>
                {{-- <div class="col-md-3">
                    <div class="form-group">
                        <label for="author">Author</label>
                        <select name="author" id="author" class="form-control">
                            <option value="">Select Author</option>
                            @foreach ($authors as $data)
                                <option value="{{ $data->id }}">{{ $data->author_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="publisher">Book Publication</label>
                        <select name="publisher" id="publisher" class="form-control">
                            <option value="">Select Publication</option>
                            @foreach ($publishers as $data)
                                <option value="{{ $data->id }}">{{ $data->publisher_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="category">Book Category</label>
                        <select name="category" id="category" class="form-control">
                            <option value="">Select Category</option>
                            @foreach ($categories as $data)
                                <option value="{{ $data->id }}">{{ $data->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-success btn-lg mt-2">
                        <i class="fa fa-search"></i>Search
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Advance Search End  -->

<!-- Books & Category Start  -->
<div class="book-list-sidebar">
    <div class="container">
        <div class="row">
            <div class="col-md-9 border p-2">
                <h3>Recent Uploaded Books</h3>
                <hr>
                @include('frontend.layouts.components.books')
            </div>
            <div class="col-md-3">
                <div class="widget">
                    <h5 class="mb-2 border-bottom pb-3">Categories</h5>
                    @include('frontend.layouts.components.category')
                </div> <!-- Single Widget -->
            </div>
        </div>
    </div>
</div>
<!-- Books & Category End  -->

@endsection

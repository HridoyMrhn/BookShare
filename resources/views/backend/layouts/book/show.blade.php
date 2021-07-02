@extends('backend.master')

@section('title')
Book Show || Book Share
@endsection

@section('book')
active
@endsection

@section('css')
<link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}"
    rel="stylesheet">
@endsection
@section('content')
@include('backend.layouts.components.status')

<div class="card shadow col-lg-8 my-4 mx-auto px-0">
    <div class="card-header py-3">
        <h2 class="m-0 d-inline-block font-weight-bold text-primary">Details: {{ $book->book_name }}</h2>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6 mb-3">
                <img src="{{ asset('uploads/book/'.$book->book_image) }}" alt="{{ $book->book_name }}" class="rounded-circle" style="width:200px; height:200px; line-height:200px">
           </div>
           <div class="col-lg-2 mb-3"></div>
           <div class="col-lg-4 mb-3">
              <ul class="list-unstyled">
                <li>
                    <strong>Book Status:</strong>
                    @if ($book->status == 'pending')
                        <span class="badge badge-danger">
                        <i class="fa fa-check"></i> Pending</span>
                    @else
                        <span class="badge badge-success">
                        <i class="fa fa-check"></i> Approved</span>
                    @endif
                </li>
                <li><strong>Total Search:</strong> {{ $book->total_search }}</li>
                <li><strong>Total View:</strong> {{ $book->total_view }}</li>
                <li><strong>Total Borrowed:</strong> {{ $book->total_borrowed }}</li>
              </ul>
           </div>
        </div>

        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <td>{{ $book->book_name }}</td>
                        </tr>
                        <tr>
                            <th>Book ISBN</th>
                            <td>{{ $book->book_isbn }}</td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td>{{ $book->relationBookWithCategory->category_name }}</td>
                        </tr>
                        <tr>
                            <th class="align-middle">Author</th>
                            <td>
                                @foreach ($book->realtionAuthorWithBook_author as $author)
                                    <li>{{ $author->author_name }}</li>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Publisher</th>
                            <td>
                                <li>{{ $book->relationBookWithPublisher->publisher_name }}</li>
                            </td>
                        </tr>
                        <tr>
                            <th>Translation Book</th>
                            <td>
                                @foreach ($book->translationBook as $data)
                                    {{ $data->book_name }}
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Publish Year</th>
                            <td>{{ $book->publish_year }}</td>
                        </tr>
                            <th>Uploaded by</th>
                            <td>{{ $book->relationBookWithUser->name }}</td>
                        </tr>
                    </thead>
                            {{-- <td>
                                @if ($data->status != 'pending')
                                    <span class="badge badge-success">
                                    <i class="fa fa-check"></i> Apprioved
                                    </span>
                                    @else
                                    <span class="badge badge-danger">
                                    <i class="fa fa-times"></i> Not Apprioved
                                    </span>
                                @endif
                            </td> --}}
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

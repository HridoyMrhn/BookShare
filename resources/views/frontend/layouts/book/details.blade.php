@extends('frontend.master')

@section('book-list')
active
@endsection
@section('content')

<div class="mt-5 col-6 mx-auto">@include('backend.layouts.components.status')</div>
<div class="book-show-area">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img src="{{ asset('uploads/book/'.$book->book_image) }}" class="img-fluid" style="width:300px; height:300px">
            </div>
            <div class="col-md-9">
                <h3>{{ $book->book_name }}</h3>
                <div>
                    <h5 class="text-muted d-inline-block">Writter: </h5>
                    @foreach ($book->realtionAuthorWithBook_author as $data)
                        <span class="text-primary">{{ $data->author_name }}</span> ||
                    @endforeach
                </div>
                <div>
                    <h5 class="text-muted d-inline-block">Category: </h5>
                    <a href="{{ route('category', $book->relationBookWithCategory->category_slug) }}"> <span class="text-info">{{ $book->relationBookWithCategory->category_name }}</span></a>
                </div>
                <hr>
                <div>
                    <p><strong>Uploaded By: </strong>{{ $book->relationBookWithUser->name }}</p>
                    <p><strong>Uploaded at: </strong>{{ $book->created_at->diffForHumans() }}</p>
                </div>
                <hr>
                <div>
                    <h4>Book info</h4>
                    <p><strong>ISBN No: </strong> {{ $book->book_isbn }}</p>
                    <p>
                        <strong>Tranlation Book: </strong>
                        @foreach ($book->translationBook as $data)
                            <a href="{{ route('user.book.details', $data->book_slug) }}">{{ $data->book_name }}</a>
                        @endforeach
                    </p>
                    <p><strong>Publish Year: </strong> {{ $book->publish_year }}</p>
                    <p><strong>Book Quantity: </strong> {{ $book->book_quantity }}</p>
                </div>
                <hr>
                <h5 class="book-description">About Book</h5>
                <p> {!! $book->book_info !!}</p>
                <hr>
                <div class="book-buttons mt-4">
                    @auth()
                        @if (!is_null(App\Models\User::bookRequested($book->id)))

                            @if (App\Models\User::bookRequested($book->id)->status == 1)
                                <div class="btn btn-group">
                                    <span class="badge badge-success" style="padding: 12px;border-radius: 0px;font-size: 14px;"><i class="fa fa-check"></i> Already Requested</span>
                                    <a href="#bookRequestUpdateModal{{ $book->id }}" data-toggle="modal" class="btn btn-outline-dark"><i class="fa fa-pen"></i> Update Request</a>
                                    <a href="{{ route('book.request.cancel', App\Models\User::bookRequested($book->id)) }}" class="btn btn-outline-danger"><i class="fa fa-trash"></i> Cancel Request</a>
                                </div>
                            @elseif (App\Models\User::bookRequested($book->id)->status == 2)
                                <span class="badge badge-success" style="padding:6px;border-radius:5px; font-size:16px;"><i class="fa fa-check"></i> Owner Accepted</span>
                            @elseif (App\Models\User::bookRequested($book->id)->status == 3)
                                <span class="badge badge-success" style="padding:6px;border-radius:5px; font-size:16px;"><i class="fa fa-times"></i> Owner Rejected</span>
                            @elseif (App\Models\User::bookRequested($book->id)->status == 4)
                                <span class="badge badge-success" style="padding:6px;border-radius:5px; font-size:16px;"><i class="fa fa-book-reader"></i> Reading...</span>
                                <a href="{{ route('book.return.request', App\Models\User::bookRequested($book->id)) }}" class="btn btn-outline-warning"><i class="fa fa-arrow-right"></i> Return Book</a>
                            @elseif (App\Models\User::bookRequested($book->id)->status == 5)
                                <span class="badge badge-danger" style="padding:6px;border-radius:5px; font-size:16px;"><i class="fa fa-times"></i> You Rejected</span>
                            @elseif (App\Models\User::bookRequested($book->id)->status == 6)
                                <span class="badge badge-primary" style="padding:6px;border-radius:5px; font-size:16px;"><i class="fas fa-chart-area"></i> Book Return Request Pending</span>
                            @elseif (App\Models\User::bookRequested($book->id)->status == 7)
                                <a href="#bookRequestModal{{ $book->id }}" data-toggle="modal" class="btn btn-outline-success"><i class="fa fa-check"></i> Again Book Request</a>
                            @endif
                            {{--Update Request Modal  --}}
                            <div class="modal fade" id="bookRequestUpdateModal{{ $book->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Send Request for <mark>{{ $book->book_name }}</mark> </h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('book.request.update', App\Models\User::bookRequested($book->id)->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <h5 class="text-success">Send request to the owner of this Book</h5>
                                                <div class="form-group">
                                                    <textarea name="user_msg" id="user_msg" rows="5" class="form-control" placeholder="Enter Your Message" required>{{ App\Models\User::bookRequested($book->id)->user_msg }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button class="btn btn-primary" type="submit">Send Request</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="#bookRequestModal{{ $book->id }}" data-toggle="modal" class="btn btn-outline-success"><i class="fa fa-check"></i> Book Request</a>
                        @endif
                    @endauth
                    <br><br>
                    <a href="book-view.html" class="btn btn-outline-warning"><i class="fa fa-cart-plus"></i> Add to Cart</a>
                    <a href="" class="btn btn-outline-danger"><i class="fa fa-heart"></i> Add to Wishlist</a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Send Request Modal  --}}
<div class="modal fade" id="bookRequestModal{{ $book->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Send Request for <mark>{{ $book->book_name }}</mark> </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('book.request', $book->book_slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <h5 class="text-success">Send request to the owner of this Book</h5>
                    <div class="form-group">
                        <textarea name="user_msg" id="user_msg" rows="5" class="form-control" placeholder="Enter Your Message" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Send Request</button>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection

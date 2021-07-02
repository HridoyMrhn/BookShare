@extends('frontend.master')

@section('order')
active
@endsection

@section('content')


<div class="mt-5 col-6 mx-auto">@include('backend.layouts.components.status')</div>
<div class="book-list-sidebar">
    <div class="container">
        <div class="row">
            <div class="col-md-9 border p-0">
                <div class="card-header">
                    <h2>Book Order List</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-responsive-lg">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Book</th>
                                <th scope="col">Owner</th>
                                <th scope="col">Owner Message</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($book_order as $key => $data)
                            <tr>
                                <td>{{ $key + $book_order->firstItem() }}</td>
                                <td>
                                    <a href="{{ route('user.book.details', $data->relationBook_requestWithBook->book_slug) }}">{{  $data->relationBook_requestWithBook->book_name }}</a>
                                </td>
                                <td>
                                    <li class="list-unstyled">
                                        <a href="{{ route('user.profile', $data->relationBook_orderWithUser->user_name) }}">
                                        {{ $data->relationBook_orderWithUser->user_name }}
                                    </a>
                                    </li>
                                    <li class="list-unstyled btn btn-group btn-group-sm px-0">
                                        <a href="tel:{{ $data->relationBook_orderWithUser->phone_number }}" class="btn btn-dark rounded-circle"><i class="fa fa-phone"></i></a>
                                        <a href="mailto:{{ $data->relationBook_orderWithUser->email }}" class="btn btn-primary"><i class="fa fa-mail-bulk"></i></a>
                                    </li>
                                </td>
                                <td>{{ $data->owner_msg }}</td>
                                <td>
                                    @if ($data->status == 1)
                                        <p class="text-dark text-center">Request Pending</p>
                                    @elseif ($data->status == 2)
                                        <p class="text-success">Owner Accepteed</p>
                                    @elseif ($data->status == 3)
                                        <p class="text-danger">Owner Rejected</p>
                                    @elseif ($data->status == 4)
                                        <p class="text-danger">Confirmed by You</p>
                                    @elseif ($data->status == 5)
                                        <p class="text-danger">Rejected by You</p>
                                    @elseif ($data->status == 6)
                                        <p class="text-primary">Book Return Request Pending</p>
                                    @elseif ($data->status == 7)
                                        <p class="text-primary">Book Return Request Confirmed</p>
                                    @endif
                                    @if ($data->status == 2)
                                        <div class="btn btn-group text-center">
                                            <form action="{{ route('book.order.approve', $data->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Confirm</button>
                                            </form>
                                            <form action="{{ route('book.order.unapprove', $data->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="50" class="text-center text-danger">
                                    <h3>No Book Order Here!</h3>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
          @include('frontend.layouts.components.dashboard-sidebar')
        </div>
    </div>
</div>

@endsection

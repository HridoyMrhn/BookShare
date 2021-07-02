@extends('frontend.master')

@section('request')
active
@endsection

@section('content')


<div class="mt-5 col-6 mx-auto">@include('backend.layouts.components.status')</div>
<div class="book-list-sidebar">
    <div class="container">
        <div class="row">
            <div class="col-md-9 border p-0">
                <div class="card-header">
                    <h2>Book Request</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-responsive-lg">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Book</th>
                                <th scope="col">Requetser</th>
                                <th scope="col">User Message</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($book_request as $data)
                            <tr>
                                <td>{{ $loop->index + $book_request->firstItem() }}</td>
                                <td>
                                    <a href="{{ route('user.book.details', $data->relationBook_requestWithBook->book_slug) }}">{{  $data->relationBook_requestWithBook->book_name }}</a>
                                </td>
                                <td>
                                    <li class="list-unstyled">
                                        <a href="{{ route('user.profile', $data->relationBook_requestWithUser->user_name) }}">
                                        {{ $data->relationBook_requestWithUser->name }}</a>
                                    </li>
                                    <li class="list-unstyled btn btn-group btn-group-sm px-0">
                                        <a href="tel:{{ $data->relationBook_requestWithUser->phone_number }}" class="btn btn-dark rounded-circle"><i class="fa fa-phone"></i></a>
                                        <a href="mailto:{{ $data->relationBook_requestWithUser->email }}" class="btn btn-primary"><i class="fa fa-mail-bulk"></i></a>
                                    </li>
                                </td>
                                <td>{{ $data->user_msg }}</td>
                                <td>
                                    @if ($data->status == 1)
                                        <p class="text-dark text-center">Request by User</p>
                                    @elseif ($data->status == 2)
                                        <p class="text-success">Approved by You</p>
                                    @elseif ($data->status == 3)
                                        <p class="text-danger">Rejected by You</p>
                                    @elseif ($data->status == 4)
                                        <p class="text-danger">Confirmed by User</p>
                                    @elseif ($data->status == 5)
                                        <p class="text-danger">Rejected by User</p>
                                    @elseif ($data->status == 6)
                                        <p class="text-danger">User Return Book</p>
                                    @elseif ($data->status == 7)
                                        <p class="text-success">Book Return Confirmed</p>
                                    @endif

                                    @if ($data->status == 1)
                                        <div class="btn btn-group text-center">
                                            <form action="{{ route('book.request.approve', $data->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                            </form>
                                            <form action="{{ route('book.request.unapprove', $data->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                            </form>
                                        </div>
                                    @elseif ($data->status == 6)
                                        <form action="{{ route('book.return.confirm', $data->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Confirm Return</button>
                                        </form>
                                    {{-- @elseif ($data->status == 3)
                                        <form action="{{ route('book.request.approve', $data->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Approve</button>
                                        </form> --}}
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="50" class="text-center text-danger">
                                    <h3>No Book Request Here!</h3>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @include('frontend.layouts.components.dashboard-sidebar')
        </div>
        <div class="mt-3">{{ $book_request->links() }}</div>
    </div>
</div>

@endsection

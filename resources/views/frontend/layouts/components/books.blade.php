<div class="row">
    @forelse ($book as $data)
    <div class="col-md-4">
        <div class="single-book">
            <img src="{{ asset('uploads/book/'.$data->book_image) }}" style="width: 180px; height: 180px" alt="">
            <div class="book-short-info my-2">
                <strong>{{ $data->book_name }}</strong>
                <p>
                    <a href="{{ route('user.profile', $data->relationBookWithUser->user_name) }}" class=""><i class="fa fa-upload"></i> {{ $data->relationBookWithUser->name }}</a>
                </p>

                @if (Route::is('user.dashboard.book.upload'))
                    <div class="btn-group">
                        <a href="{{ route('user.book.details', $data->book_slug) }}" class="btn btn-outline-success"><i class="fa fa-eye"></i></a>
                        <a href="{{ route('user.book.edit', $data->book_slug) }}" class="btn btn-outline-primary"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('user.book.delete', $data->book_slug) }}" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a>
                    </div>
                @else
                        <a href="{{ route('user.book.details', $data->book_slug) }}" class="btn btn-outline-primary"><i class="fa fa-eye"></i> View</a>
                        <a href="" class="btn btn-outline-danger"><i class="fa fa-heart"></i> Wishlist</a>
                @endif
            </div>
        </div>
    </div>
    @empty
    <tr>
        <td colspan="50" class="text-center text-danger">
            <h3>No Books Here!</h3>
        </td>
    </tr>
    @endforelse
</div>

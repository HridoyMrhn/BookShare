@extends('backend.master')

@section('title')
Edit Book || Book Share
@endsection

@section('book')
active
@endsection

@section('content')
@include('backend.layouts.components.status')

<div class="card shadow mb-4 mt-4">
    <div class="card-header py-3">
        <h3 class="m-0 d-inline-block font-weight-bold text-primary">Book Edit => {{ $book->book_name }}</h3>
    </div>
    <div class="card-body">
        <div class="col-lg-10 m-auto">
            <form action="{{ route('book.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="book_name" class="col-form-label">Name:</label>
                        <input type="text" name="book_name" id="book_name"
                            class="form-control" value="{{ $book->book_name }}">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="book_isbn" class="col-form-label">Isbn:</label>
                        <input type="text" name="book_isbn" id="book_isbn"
                            class="form-control" value="{{ $book->book_isbn }}">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="category_id" class="col-form-label">Category:</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Select Category</option>
                            @foreach ($categories as $data)
                            <option value="{{ $data->id }}" {{ $book->category_id == $data->id ? 'selected':'' }}>{{ $data->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="author_id" class="col-form-label">Author Name:</label>
                        <select name="author_id[]" id="author_id" class="multiple-select form-control" multiple>
                            <option value="">Select Book Author</option>
                            @foreach ($authors as $data)
                            <option value="{{ $data->id }}" {{ in_array($data->id, $book->realtionAuthorWithBook_author->pluck('id')->toArray()) ? 'selected':'' }}>{{ $data->author_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-lg-6">
                        <label for="publisher_id" class="col-form-label">Publisher Name:</label>
                        <select name="publisher_id" id="publisher_id"  class="form-control">
                            <option value="">Select Book Publisher</option>
                            @foreach ($publishers as $data)
                            <option value="{{ $data->id }}" @if ($book->publisher_id == $data->id) selected @endif>{{ $data->publisher_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="translator_id" class="col-form-label">Translation Book:</label>
                        <select name="translator_id" id="translator_id"  class="multiple-select form-control" multiple>
                            <option value="">Select Translation Book</option>
                            @foreach ($books as $data)
                                <option value="{{ $data->id }}"
                                    {{ $book->translator_id == $data->id ? 'selected':'' }}>{{ $data->book_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- {{ date('Y') }} --}}
                    <div class="form-group col-lg-6">
                        <label for="publish_year" class="col-form-label">Publish Year:</label>
                        <select name="publish_year" id="publish_year" class="form-control">
                            <option value="">Select Publish Year</option>
                            @for ($year = date('Y'); $year >= 1950; $year--)
                            <option value="{{ $year }}" {{ $book->publish_year == $year ? 'selected':'' }}>{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="publish_year" class="col-form-label">Book Quantity:</label>
                        <input type="number" name="book_quantity" id="book_quantity" min="1" class="form-control" value="{{ $book->book_quantity }}">
                    </div>
                    <div class="form-group">
                        <label for="book_image" class="col-form-label d-block"
                        ><span  class="float-left">image:</span>
                            <span  class="float-right"><a href="{{ asset('uploads/book/'.$book->book_image) }}" target="_blank">see old iamage</a></span></label>
                        <input type="file" name="book_image" id="book_image"
                            class="form-control">
                    </div>
                    <br>
                    <div class="form-group col-12">
                        <label for="book_image" class="col-form-label">Book Details:</label>
                        <textarea name="book_info" id="book_info" rows="5"
                            class="form-control">{!! $book->book_info !!}</textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('.multiple-select').select2();
    });
</script>
<script>
    ClassicEditor
        .create( document.querySelector( '#book_info' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection

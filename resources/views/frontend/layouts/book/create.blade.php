@extends('frontend.master')

@section('css')
 <!-- Select2 -->
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">


@section('content')
@include('backend.layouts.components.status')

<div class="container">
    <div class="row">
        <div class="card shadow mb-4 mt-4">
            <div class="card-header py-3">
                <h3 class="m-0 d-inline-block font-weight-bold text-primary">Book Add Form</h3>
            </div>
            <div class="card-body">
                <div class="col-lg-10 m-auto">
                    <form action="{{ route('user.book.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="book_name" class="col-form-label">Name:</label>
                                <input type="text" name="book_name" id="book_name"
                                    class="form-control" placeholder="Enter Book Name">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="book_isbn" class="col-form-label">Isbn:</label>
                                <input type="text" name="book_isbn" id="book_isbn"
                                    class="form-control" placeholder="Enter Book Isbn">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="category_id" class="col-form-label">Category:</label>
                                <select name="category_id" id="category_id"  class="form-control">
                                    <option value="">Select Category </option>
                                    @foreach ($categories as $data)
                                    <option value="{{ $data->id }}">{{ $data->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="author_id" class="col-form-label">Author Name:</label>
                                <select name="author_id[]" id="author_id" class="multiple-select form-control" multiple>
                                    <option value="">Select Book Author</option>
                                    @foreach ($authors as $data)
                                    <option value="{{ $data->id }}">{{ $data->author_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="publisher_id" class="col-form-label">Publisher Name:</label>
                                <select name="publisher_id" id="publisher_id"  class="form-control">
                                    <option value="">Select Book Publisher</option>
                                    @foreach ($publishers as $data)
                                    <option value="{{ $data->id }}">{{ $data->publisher_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="translator_id" class="col-form-label">Translator Book:</label>
                                <select name="translator_id" id="translator_id"  class="multiple-select form-control" multiple>
                                    <option value="">Select Translator Book</option>
                                    @foreach ($books as $data)
                                    <option value="{{ $data->id }}">{{ $data->book_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- {{ date('Y') }} --}}
                            <div class="form-group col-lg-6">
                                <label for="publish_year" class="col-form-label">Publish Year:</label>
                                <select name="publish_year" id="publish_year" class="form-control">
                                <option value="">Select Publish Year</option>
                                @for ($year = date('Y'); $year >= 1950; $year--)
                                <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="book_quantity" class="col-form-label">Book Quantity:</label>
                                <input type="number" name="book_quantity" id="book_quantity" min="1" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="book_image" class="col-form-label">image:</label>
                                <input type="file" name="book_image" id="book_image"
                                    class="form-control">
                            </div>
                            <br>
                            <div class="form-group col-12">
                                <label for="book_info" class="col-form-label">Book Details:</label>
                                <textarea name="book_info" id="book_info" rows="5"
                                    class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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

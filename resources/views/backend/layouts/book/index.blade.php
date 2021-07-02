@extends('backend.master')

@section('title')
Book List || Book Share
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

<div class="card shadow mb-4 mt-4">
    <div class="card-header py-3">
        <h1 class="m-0 d-inline-block font-weight-bold text-primary">Book List</h1>
        <a href="{{ route('book.create') }}" class="d-none float-right d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Add Book</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Publisher</th>
                        <th>T.B</th>
                        <th>Statics</th>
                        <th>image</th>
                        <th>Year</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->book_name }}</td>
                        <td>{{ $data->relationBookWithCategory->category_name }}</td>
                        <td>
                            {{-- {{ $data->realtionAuthorWithBook_author }} --}}
                            @foreach ($data->realtionAuthorWithBook_author as $author)
                                <li>{{ $author->author_name }}</li>
                            @endforeach

                        </td>
                        <td>{{ $data->relationBookWithPublisher->publisher_name }}</td>
                        <td>
                            @if ($data->translationBook)
                                @foreach ($data->translationBook as $t_b)
                                {{ $t_b->book_name }}
                                @endforeach
                            @else
                                --
                            @endif
                        </td>
                        <td>
                            <span class="d-block">QT: {{ $data->book_quantity }}</span>
                            <span class="d-block"><i class="fa fa-eye"></i> - {{ $data->total_view }}</span>
                            <span class="d-block"><i class="fa fa-search"></i> - {{ $data->total_search }}</span>
                            <span class="d-block"><i class="fa fa-eye"></i> - {{ $data->total_borrowed }}</span>
                        </td>
                        <td class="text-center">
                            <img src="{{ asset('uploads/book/'.$data->book_image) }}" alt="{{ $data->book_title }}" class="rounded-circle" style="width:60px; height:60px; line-height:60px">
                        </td>
                        <td>{{ $data->publish_year }}</td>


                        <td>
                            @if ($data->status == 'pending')
                                <form action="{{ route('book.approve', $data->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="badge badge-danger"><i class="fa fa-times"></i> Pending</button>
                                </form>
                                {{-- @else
                                <span class="badge badge-danger">
                                <i class="fa fa-times"></i> Not Apprioved
                                </span> --}}
                            @elseif($data->status == 'approved')
                                <form action="{{ route('book.unapprove', $data->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="badge badge-success"><i class="fa fa-check"></i> Approved</button>
                                </form>
                            @endif
                        </td>


                        <td>
                            <div class="btn-group btn-group-sm m-0">
                                <a href="{{ route('book.show', $data->id) }}" class="btn btn-success"> <i class="fa fa-eye"></i></a>
                                <a href="{{ route('book.edit', $data->id) }}" class="btn btn-primary"> <i class="fa fa-edit"></i></a>
                                <a href="#deleteModal{{ $data->id }}" data-toggle="modal" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <!-- Delete Modal-->
                    <div class="modal fade" id="deleteModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Book</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form action="{{ route('book.destroy', $data->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <h3>Are You Sure to Delete it!</h3>
                                            <hr>
                                            <h5 class="text-danger text-center">'{{ $data->publisher_name }}' will be Deleted!</h5>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                        <button class="btn btn-danger" type="submit">Yes, Confirm</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- Delete Modal End  --}}

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('js')
<!-- Page level plugins -->
<script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Page level custom scripts -->
<script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>
@endsection

@endsection

@extends('backend.master')
@section('css')
<link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}"
    rel="stylesheet">
@endsection
@section('content')

@if (session('author_status'))
    <div class="alert alert-success alert-dismissible fade show col-lg-6 m-auto mb-4" role="alert">
        <li class="font-weight-bold text-danger">{{ session('author_status') }}</li>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="my-2 col-8">@include('backend.layouts.components.status')</div>

<div class="card shadow mb-4 mt-4">
    <div class="card-header py-3">
        <h1 class="m-0 d-inline-block font-weight-bold text-primary">Author List</h1>
        <a href="#" data-toggle="modal" data-target="#authorModal"
            class="d-none float-right d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>Add Author</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>link</th>
                        <th>image</th>
                        <th>info</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($authors as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->author_name }}</td>
                        <td>{{ $data->author_link }}</td>
                        <td>{{ $data->author_image }}</td>
                        <td>{{ $data->author_info }}</td>
                        <td>
                            <div class="form-group btn-sm m-0">
                                <a href="index.html" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                    Edit
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal-->
<div class="modal fade" id="authorModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Author</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('author.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="author_name" class="col-form-label">Name:</label>
                        <input type="text" name="author_name" id="author_name" class="form-control" placeholder="Author Name">
                    </div>
                    <div class="form-group">
                        <label for="author_image" class="col-form-label">image:</label>
                        <input type="file" name="author_image" id="author_image" class="form-control">
                    </div>
                    <div class="form-group">
                        <textarea name="author_info" id="author_info" rows="5" class="form-control" placeholder="About Auhor"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
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

@extends('backend.master')
@section('title')
Category List || Book Share
@endsection

@section('category')
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
        <h1 class="m-0 d-inline-block font-weight-bold text-primary">Category List</h1>
        <a href="#" data-toggle="modal" data-target="#categoryModal"
            class="d-none float-right d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>Add Category</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>image</th>
                        <th>Parent</th>
                        <th>info</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $data)
                    {{-- {{ $data->child->category_name }} --}}
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->category_name }}</td>
                        <td class="text-center">
                            <img src="{{ asset('uploads/category/'.$data->category_image) }}" alt="{{ $data->category_name }}" class="rounded-circle" style="width:50px; height:50px; line-height:50px">
                        </td>
                        <td>
                            @if ($data->subCategory)
                            @foreach ($data->subCategory as $subCat)
                                <li>{{ $subCat->category_name }}</li>
                            @endforeach
                            @else
                            --
                            @endif
                        </td>
                        <td>{{ Str::limit($data->category_info, 40, '...') }}</td>
                        <td>
                            <div class="btn-group btn-sm m-0">
                                <a href="#editModal{{ $data->id }}" data-toggle="modal" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i></a>
                                <a href="#deleteModal{{ $data->id }}" data-toggle="modal" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>

                    {{-- Edit Modal  --}}
                    <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form action="{{ route('category.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="category_name" class="col-form-label">Category Name:</label>
                                            <input type="text" name="category_name" id="category_name" class="form-control" value="{{ $data->category_name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="parent_id" class="col-form-label">Parent Category:</label>
                                            <select class="form-control" name="parent_id" id="parent_id">
                                                <option value="">Select Category</option>
                                                @foreach ($parent_categories as $parent_category)
                                                <option value="{{ $parent_category->id }}" {{ $data->parent_id == $parent_category->id ? 'selected':'' }}>{{ $parent_category->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="category_image" class="col-form-label">Category image:</label>
                                            <input type="file" name="category_image" id="category_image" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="category_info" class="col-form-label">Category info:</label>
                                            <textarea name="category_info" id="category_info" rows="5" class="form-control">{{ $data->category_info }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="submit">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- Delete Modal  --}}
                    <div class="modal fade" id="deleteModal{{ $data->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="{{ route('category.destroy', $data->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <h3>Are You Sure to Delete it!</h3>
                                            <hr>
                                            <h5 class="text-danger text-center">'{{ $data->category_name }}' will be Deleted!</h5>
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
                    {{-- End Delete Modal --}}
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal-->
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Author</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category_name" class="col-form-label">Category Name:</label>
                        <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Category Name">
                    </div>
                    <div class="form-group">
                        <label for="category_image" class="col-form-label">Category image:</label>
                        <input type="file" name="category_image" id="category_image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="parent_id" class="col-form-label">Parent Category:</label>
                        <select class="form-control" name="parent_id" id="parent_id">
                            <option value="">Select Category</option>
                            @foreach ($parent_categories as $data)
                            <option value="{{ $data->id }}">{{ $data->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category_info" class="col-form-label">Category info:</label>
                        <textarea name="category_info" id="category_info" rows="5" class="form-control" placeholder="About Category"></textarea>
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

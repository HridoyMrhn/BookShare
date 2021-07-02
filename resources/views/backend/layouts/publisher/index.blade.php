@extends('backend.master')

@section('title')
Publisher List || Book Share
@endsection

@section('publisher')
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
        <h1 class="m-0 d-inline-block font-weight-bold text-primary">Publisher List</h1>
        <a href="#" data-toggle="modal" data-target="#publisherModal"
            class="d-none float-right d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>Add Publisher</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Website</th>
                        <th>Outlet</th>
                        <th>image</th>
                        <th>Address</th>
                        <th>info</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($publishers as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->publisher_name }}</td>
                        <td>{{ $data->publisher_link }}</td>
                        <td>{{ $data->publisher_outlet }}</td>
                        <td>
                            <img src="{{ asset('uploads/publisher/'.$data->publisher_image) }}" alt="{{ $data->publisher_image }}" class="rounded-circle" style="width:50px; height:50px; line-height:50px">
                        </td>
                        <td>{{ $data->publisher_address }}</td>
                        <td>{{ Str::limit($data->publisher_info, 40, '...') }}</td>
                        <td>
                            <div class="btn-group btn-group-sm m-0">
                                <a href="#editModal{{ $data->id }}" data-toggle="modal" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i></a>
                                <a href="#deleteModal{{ $data->id }}" data-toggle="modal" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>

                    <!-- Edit Modal-->
                    <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Publisher</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form action="{{ route('publisher.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="publisher_name" class="col-form-label">Name:</label>
                                            <input type="text" name="publisher_name" id="publisher_name" class="form-control" value="{{ $data->publisher_name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="publisher_link" class="col-form-label">Website:</label>
                                            <input type="text" name="publisher_link" id="publisher_link" class="form-control" value="{{ $data->publisher_link }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="publisher_outlet" class="col-form-label">Outlet:</label>
                                            <input type="text" name="publisher_outlet" id="publisher_outlet" class="form-control" value="{{ $data->publisher_outlet }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="publisher_address" class="col-form-label">Address:</label>
                                            <input type="text" name="publisher_address" id="publisher_address" class="form-control" value="{{ $data->publisher_address }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="publisher_image" class="col-form-label">image:</label>
                                            <input type="file" name="publisher_image" id="publisher_image" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="publisher_info" id="publisher_info" rows="5" class="form-control">{{ $data->publisher_info }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Delete Modal-->
                    <div class="modal fade" id="deleteModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Publisher</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form action="{{ route('publisher.destroy', $data->id) }}" method="POST" enctype="multipart/form-data">
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


<!-- Modal-->
<div class="modal fade" id="publisherModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Publisher</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('publisher.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="publisher_name" class="col-form-label">Name:</label>
                        <input type="text" name="publisher_name" id="publisher_name" class="form-control" placeholder="Publisher Name">
                    </div>
                    <div class="form-group">
                        <label for="publisher_link" class="col-form-label">Website:</label>
                        <input type="text" name="publisher_link" id="publisher_link" class="form-control" placeholder="Publisher Website">
                    </div>
                    <div class="form-group">
                        <label for="publisher_outlet" class="col-form-label">Outlet:</label>
                        <input type="text" name="publisher_outlet" id="publisher_outlet" class="form-control" placeholder="Publisher outlet">
                    </div>
                    <div class="form-group">
                        <label for="publisher_address" class="col-form-label">Address:</label>
                        <input type="text" name="publisher_address" id="publisher_address" class="form-control" placeholder="Publisher Address">
                    </div>
                    <div class="form-group">
                        <label for="publisher_image" class="col-form-label">image:</label>
                        <input type="file" name="publisher_image" id="publisher_image" class="form-control">
                    </div>
                    <div class="form-group">
                        <textarea name="publisher_info" id="publisher_info" rows="5" class="form-control" placeholder="About Publisher"></textarea>
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

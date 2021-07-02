@extends('backend.master')
@section('banner')
Banner List || Book Share
@endsection

@section('banner')
active
@endsection

@section('css')
<link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}"
    rel="stylesheet">
@endsection
@section('content')

<div class="my-2">@include('backend.layouts.components.status')</div>

<div class="card shadow mb-4 mt-4">
    <div class="card-header py-3">
        <h1 class="m-0 d-inline-block font-weight-bold text-primary">All Banner</h1>
        <a href="#" data-toggle="modal" data-target="#bannerModal"
            class="d-none float-right d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>Add Banner</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Ttile</th>
                        <th>Name</th>
                        <th>Link</th>
                        <th>image</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banner as $data)
                    <tr>
                        <td>{{ $loop->index + $banner->firstItem()  }}</td>
                        <td>{{ $data->banner_title }}</td>
                        <td>{{ $data->banner_name }}</td>
                        <td>{{ $data->banner_link }}</td>
                        <td class="text-center">
                            <img src="{{ asset('uploads/banner/'.$data->banner_image) }}" alt="{{ $data->banner_title }}" class="rounded-circle" style="width:50px; height:50px; line-height:50px">
                        </td>
                        <td>{{ Str::limit($data->banner_info, 40, '...') }}</td>
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
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Banner</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form action="{{ route('banner.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="banner_title" class="col-form-label">Banner Title:</label>
                                            <input type="text" name="banner_title" id="banner_title" class="form-control" value="{{ $data->banner_title }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="banner_name" class="col-form-label">Banner Name:</label>
                                            <input type="text" name="banner_name" id="banner_name" class="form-control" value="{{ $data->banner_name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="banner_link" class="col-form-label">Banner Link:</label>
                                            <input type="text" name="banner_link" id="banner_link" class="form-control" value="{{ $data->banner_link }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="banner_image" class="col-form-label">Banner image:</label>
                                            <input type="file" name="banner_image" id="banner_image" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="banner_info" class="col-form-label">Banner info:</label>
                                            <textarea name="banner_info" id="banner_info" rows="5" class="form-control">{{ $data->banner_info }}</textarea>
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
                                <form action="{{ route('banner.destroy', $data->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <h3>Are You Sure to Delete it!</h3>
                                            <hr>
                                            <h5 class="text-danger text-center">'{{ $data->banner_name }}' will be Deleted!</h5>
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
            {{-- {{ $banner->links() }} --}}
        </div>
    </div>
</div>


<!-- Modal-->
<div class="modal fade" id="bannerModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Banner</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="banner_title" class="col-form-label">Banner Title:</label>
                        <input type="text" name="banner_title" id="banner_title" class="form-control" placeholder="Enter Banner Title">
                    </div>
                    <div class="form-group">
                        <label for="banner_name" class="col-form-label">Banner Name:</label>
                        <input type="text" name="banner_name" id="banner_name" class="form-control" placeholder="Enter Banner Name">
                    </div>
                    <div class="form-group">
                        <label for="banner_link" class="col-form-label">Banner Link:</label>
                        <input type="text" name="banner_link" id="banner_link" class="form-control" placeholder="Enter Banner Link">
                    </div>
                    <div class="form-group">
                        <label for="banner_image" class="col-form-label">Banner image:</label>
                        <input type="file" name="banner_image" id="banner_image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="banner_info" class="col-form-label">Banner info:</label>
                        <textarea name="banner_info" id="banner_info" rows="5" placeholder="Entr Banner Details" class="form-control"></textarea>
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

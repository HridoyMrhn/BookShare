@extends('backend.master')
@section('banner')
Contact List || Book Share
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
        <h1 class="m-0 d-inline-block font-weight-bold text-primary">All Contact</h1>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Number</th>
                        <th scope="col">Message</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $key => $data)
                    <tr>
                        <td>{{ $key + $contacts->firstItem()  }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->subject }}</td>
                        <td>{{ $data->number }}</td>
                        <td>{{ $data->message }}</td>
                        <td>
                            <a href="{{ route('contact.delete', $data->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $contacts->links() }}
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

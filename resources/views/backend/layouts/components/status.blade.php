@if ($errors->any())
    <div class="alert alert-warning alert-dismissible fade show col-lg-6 m-auto text-center mb-4" role="alert">
        @foreach ($errors->all() as $data)
        <li class="font-weight-bold text-danger">{{ $data }}</li>
        @endforeach
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show col-lg-6 m-auto text-center mb-5" role="alert">
        <li class="font-weight-bold text-danger">{{ session('status') }}</li>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

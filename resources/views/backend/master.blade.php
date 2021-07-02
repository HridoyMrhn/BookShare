@include('backend.partilas.header')
<div id="wrapper">

    @include('backend.partilas.sidebar')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
           @include('backend.partilas.topbar')
            <!-- Begin Page Content -->
            <div class="container-fluid">

                @yield('content')

            </div>
            <!-- /.container-fluid -->
@include('backend.partilas.footer')

@include('layouts.header')

<body data-topbar="dark" style="width: 100%">
    <!-- Begin page -->
    <div class="container-fluid align-items-center justify-content-center">
        @yield('content')
    </div>
    

    @include('layouts.script')
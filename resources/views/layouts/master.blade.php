<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
</head>

<body>
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    @include('layouts.navbar')
    @include('layouts.search')
    <!-- hero area -->
    <!-- end hero area -->
    @yield('content')
    @include('layouts.footer');
    @include('layouts.script')
</body>

</html>

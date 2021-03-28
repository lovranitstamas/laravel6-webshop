<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('frontend.layout.head')

<body>

@include('frontend.layout.menu')
<div class="container m-5">
    @yield('content')
</div>

</body>
</html>

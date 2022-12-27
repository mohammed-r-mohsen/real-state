


@include('layouts.header')
@if(!isset($nonav))
@include('layouts.navbar')
@endif
@yield('content')


@include('layouts.footer')

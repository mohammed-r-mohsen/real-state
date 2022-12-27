
@include('admin.layouts.header')


@if(!isset($nonav))
@include('admin.layouts.navbar')
@endif
@if(!isset($nosidebar))
@include('admin.layouts.sidebar')
@endif

@yield('content')


@if(!isset($nofoot))
@include('admin.layouts.foot')
@endif

@include('admin.layouts.footer')

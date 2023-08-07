@include(blade_path('header'))
@yield('content')
@if(request()->is('/'))
@include('modal')
@endif
@include(blade_path('footer'))
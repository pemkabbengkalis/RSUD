@extends('layout')
@section('content')

@include(View::exists(get_view(get_view())) ? blade_path(get_view()) : blade_path(get_module_info('view_type')))

@endsection
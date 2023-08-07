@if(get_module_info('post_type')=='media')
@include('admin.form-media')
@else
@include('admin.form-default')
@endif

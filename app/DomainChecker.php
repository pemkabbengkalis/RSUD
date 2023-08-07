<?php
// namespace App\Modules;
// use App\Models\Post;
// use Request;
// class DomainChecker
// {
// function __construct(){
// $domain = $_SERVER['SERVER_NAME'];
// $check = Post::wherePostType('domain')->wherePostTitle($domain)->select('post_status','data_loop','data_field')->first();
// if(!empty($check)){
//     if($check->post_status=='draft')
//     return redirect('http://'.get_option('site_url'))->send();
//     config(['module.custom'=>_loop($check)]);
// }else{
//     if(request()->segment(1)== admin_path()){
//         config(['module.is_admin'=>true]);
//     }
// }
// }

// }
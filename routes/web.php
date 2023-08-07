<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\CustomController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Controller;

Route::controller(LoginController::class)->group(function() {
  Route::match(['post','get'],admin_path().'/login', 'login')->name('login');
  Route::match(['post','get'],admin_path().'/logout', 'logout')->name('logout');
});
if(empty(config('module.custom'))){
  Route::get('sendwa',function(){
    $i = App\Models\Post::withwherehas('group.group',function($q){
      $q->where('slug','desdda');
   })->wherePostType('desa')->wherePostStatus('publish')->select('post_id','post_title')->get();
   return $i;
    // return sendwa(request('number'),request('message'));
    });
if(!config('module.is_admin')):
Route::controller(PublicController::class)->group(function () {
  Route::get('/', 'home');
  Route::match(['get','post'],'author/{slug?}', 'author');
  Route::match(['get','post'],'search/{q?}', 'search');
if(count(get_module(true)) > 0):
  $values = collect(get_module(true))->where('name','halaman')->first();
  if($values):
    config(['module.info'=>[
      'post_type'=>$values['name'],
      'looping'=>$values['looping'],
      'custom_field'=>$values['custom_field'],
      'icon'=>$values['icon'],
      'index'=>$values['index'],
      'title'=>$values['title'],
      'view_type'=>request()->segment(2) == null ? 'detail' : '404',
      //add new change view blade
      'view'=>$values['name'].'.detail']]);
    Route::match(['get','post'],'{slug}', 'post');
    endif;
  foreach (collect(get_module(true))->where('public',true) as $key => $value) {
    if(!Request::is('/')){
    if(Request::is($value['name']) || Request::is($value['name'].'/kategori/*')|| Request::is($value['name'].'/*/*')){
      $view = match(true){
        Request::is($value['name'].'/kategori/*') && request()->segment(4) == null => $value['name'].'.group',
        Request::is($value['name']) => stous($value['name']).'.index',
        Request::is($value['name'].(isset($value['post_parent'][1]) ? '/'.$value['post_parent'][1].'/*' :null)) => isset($value['post_parent'][1]) ? stous($value['name']).'.index_parent' : stous($value['name']).'.index',
        Request::is($value['name'].'/arsip/*') || Request::is($value['name'].'/arsip/*/*') || Request::is($value['name'].'/arsip/*/*/*') => stous($value['name']).'.archive',
        default => '404'
      };
      $view_type = match(true){
        Request::is($value['name'].'/kategori/*') && request()->segment(4) == null => 'group',
        Request::is($value['name'].(isset($value['post_parent'][1]) ? '/'.$value['post_parent'][1].'/*' :'')) => 'index',
        Request::is($value['name']) => 'index',
        Request::is($value['name'].'/arsip/*') || Request::is($value['name'].'/arsip/*/*') || Request::is($value['name'].'/arsip/*/*/*') => 'index',
        default => '404'

      };
      // dd($view);
      config(['module.info'=>[
        'post_parent'=>$value['post_parent'],
        'thumbnail'=>$value['thumbnail'],
        'post_type'=>$value['name'],
        'icon'=>$value['icon'],
        'custom_field'=>$values['custom_field'],
        'looping'=>$values['looping'],
        'title'=>$value['title'],
        'index'=>$value['index'],
        'group'=>$value['group'],
        'view_type'=>$view_type,
        'detail'=>$value['detail'],
        'view'=>$view
        ]]);
    }elseif(Request::is($value['name'].'/*')){
      config(['module.info'=>[
        'post_parent'=>$value['post_parent'],
        'post_type'=>$value['name'],
        'thumbnail'=>$value['thumbnail'],
        'looping'=>$value['looping'],
        'custom_field'=>$value['custom_field'],
        'icon'=>$value['icon'],
        'title'=>$value['title'],
        'group'=>$value['group'],
        'index'=>$value['index'],
        'view_type'=>'detail',
        'history'=>$value['history'],
        //add new change view
        'view'=>stous($value['name']).'.detail'
        ]]);
    }elseif(Request::is('api/'.$value['name'].'/*') || Request::is('api/'.$value['name'])){

        config(['module.info'=>[
          'post_type'=>$value['name'],
          'icon'=>$value['icon'],
          'title'=>$value['title'],

          ]]);
    }
    elseif(Request::is('search/*')) {
      config(['module.info'=>[
        'view_type'=>'search',
        'view'=>'search'
        ]]);
    }elseif(Request::is('author') || Request::is('author/*')){
      $view = match(true){
        Request::is('author') => 'author',
        default => 'author_detail'
      };
      config(['module.info'=>[
        'view'=>$view,
        'view_type'=>'author',
        ]]);
    }
    else{

    }
  }else{
    config(['module.info'=>[
      'view'=>'home',
      'view_type'=>'home',
      ]]);
  }
    if($value['group']){
      Route::match(['get','post'],$value['name'].'/kategori/{slug?}', 'group');
    }
    if($value['index']){
  Route::match(['get','post'],$value['name'], 'post');

  if($value['archive']){
  Route::match(['get','post'],$value['name'].'/arsip/{year}/{month?}/{date?}', 'archive');
}
}
if($value['post_parent']){
  Route::match(['get','post'],$value['name'].'/'.Str::slug($value['post_parent'][0]).'/{perangkat}', 'post_parent');
}

if($value['api']){
  Route::match(['get','post'],'api/'.$value['name'].'/{id?}', 'api');
}
if($value['detail']){
  Route::match(['get','post'],$value['name'].'/{slug?}', 'post');
}
}
endif;
});
else:
  // Auth::routes();
  Route::controller(AdminController::class)->group(function () {

    foreach (collect(get_module(true))->where('data_title','!=',null) as $key => $value) {
      if(Request::is(admin_path().'/'.$value['name']) || Request::is(admin_path().'/'.$value['name'].'/*') || Request::is(admin_path().'/'.$value['name'].'/*/*') ){
        if(Request::is(admin_path().'/'.$value['name'].'/edit/*'))        {
          $title_crud = 'Edit '.$value['title'];
          config(['module.post_data'=>\App\Models\Post::with(['author','group'])->wherePostType($value['name'])->wherePostId(dec64(request()->segment(4)))]);
        }elseif(Request::is(admin_path().'/'.$value['name'].'/create')){
          $title_crud = 'Tambah '.$value['title'];
        }
        elseif(Request::is(admin_path().'/'.$value['name'])){
            $title_crud = $value['title'];
        }
        else {
          $title_crud = 'Kategori '.$value['title'];

        }

        config(['module.info'=>[
          'post_type'=>$value['name'],
          'description'=>$value['description'],
          'icon'=>$value['icon'],
          'title_crud'=>$title_crud,
          'title'=>$value['title'],
          'parent'=>$value['parent'],
          'post_parent'=>$value['post_parent'],
          'custom_column'=>$value['custom_column'],
          'data_title'=>$value['data_title'],
          'index'=>$value['index'],
          'custom_field'=>$value['custom_field'],
          'looping'=>$value['looping'],
          'looping_data'=>$value['looping_data'],
          'looping_for'=>$value['looping_for'],
          'thumbnail'=>$value['thumbnail'],
          'editor'=>$value['editor'],
          'group'=>$value['group'],
          'detail'=>$value['detail'],
          'operator'=>$value['operator'],
          ]]);
      }

    Route::match(['get','post'],admin_path().'/'.$value['name'], 'index');
    Route::match(['get','post'],admin_path().'/'.$value['name'].'/edit/{id}', 'form');
    Route::match(['get','post'],admin_path().'/'.$value['name'].'/delete/{id}', 'delete');
    Route::match(['get','post'],admin_path().'/'.$value['name'].'/create', 'form');
    Route::match(['get','post'],admin_path().'/'.$value['name'].'/dataindex/{thn?}/{bln?}/{tgl?}', 'dataindex');
    if($value['group']){
      Route::match(['get','post'],admin_path().'/'.$value['name'].'/group', 'group');
      Route::match(['get','post'],admin_path().'/'.$value['name'].'/group/delete/{id}', 'group');

    }
    if($value['editor']){
      Route::match(['get','post'],admin_path().'/'.$value['name'].'/upload_image/{id}', 'summer_image_upload');
      Route::match(['get','post'],admin_path().'/'.$value['name'].'/upload_file/{id}', 'summer_file_upload');
    }


  }
  Route::match(['get','post'],admin_path().'/dashboard','dashboard');
  Route::match(['get','post'],admin_path().'/comments','comments');
  Route::match(['get','post'],admin_path().'/unlink','delfile');
  Route::match(['get','post'],admin_path().'/visitor','visitor');

});

Route::controller(MasterController::class)->group(function () {
  $routemaster = array(
    // ['title'=>'Scraper Web','icon'=>'fa-clone','path'=>'scraper','function'=>'scraper'],
    ['title'=>'Pengguna','icon'=>'fa-users','path'=>'pengguna','function'=>'users' ],
    // ['title'=>'Template','icon'=>'fa-paint-brush','path'=>'template','function'=>'template'],
    // ['title'=>'Menus','icon'=>'fa-bars','path'=>'menus','function'=>'menu'],
    ['title'=>'Pengaturan','icon'=>'fa-cogs','path'=>'pengaturan','function'=>'settings'],
    ['title'=>'Akun','icon'=>'fa-lock','path'=>'akun','function'=>'account'],
    // ['title'=>'Backup & Restore','icon'=>'fa-database','path'=>'backup','function'=>'backup'],
    // ['title'=>'Backup & Resotre','icon'=>'fa-database','path'=>'backup-manager','function'=>'backup']
  );
  config(['module.master'=>$routemaster]);
  foreach ($routemaster as $v) {
    if(Request::is(admin_path().'/'.$v['path'])){
      config(['module.master_info'=>[
        'title' => $v['title'],
        'path' => $v['path']
        ]]);
    }
    Route::match(['get','post'],admin_path().'/'.$v['path'], $v['function']);
  }
});
endif;
}
else{

  foreach (config('module.custom') as $v) {
    // if(Request::is(admin_path().'/'.$v['path'])){
    //   config(['module.master_info'=>[
    //     'title' => $v['title'],
    //     'path' => $v['path']
    //     ]]);
    // }
    Route::match(['get','post'],$v->path, 'App\Http\Controllers\\'.$v->controller.'@'.$v->function);
  }

}

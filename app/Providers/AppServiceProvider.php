<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        //  app()->usePublicPath('../public_html');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      use_module(['berita'=>['position'=>1],'halaman'=>['custom_field'=>false],'agenda'=>['position'=>2],'sambutan'=>['position'=>6],'download'=>['position'=>3],'menu'=>true,'banner'=>['auto_load'=>true],'foto'=>['position'=>4],'video'=>['position'=>5],'media'=>['position'=>7,'icon'=>'fa-link']]);
      if(file_exists(base_path().'//templates/'.get_option('template').'/modules.php')){
        require_once(base_path().'//templates/'.get_option('template').'/modules.php');
      }
        // new \App\Modules\DomainChecker;
        if(request()->segment(1)==admin_path()){
            config(['module.is_admin'=>true]);
        if(empty(request()->segment(2))){
            return redirect(admin_url('login'))->send();
            }
        }
        // dd('o');
        // return session('flooding');
        // if(count(collect(session('flooding'))->where('ip',request()->ip())->where('session',session()->getId())->where('date',date('Y-m-d'))->where('page',url()->current())->where('last_activity','>=',time()-20)) > 5 )
        // exit('Are You Flooding Guys ?');

    }
}

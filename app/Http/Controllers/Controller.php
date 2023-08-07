<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Post;
use App\Models\Group;
use App\Models\Visitor;
use App\Models\Option;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Cache;


use Str;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    function media_store($parent,$mime,$path,$name,$title){
      $ext = explode('.', $name)[1];
      if(Str::of($mime)->contains('image')){
        $data = getimagesize(public_path($path));
       $width = $data[0];
       $height = $data[1];
      }
      Post::insert([
        'post_id'=>Str::random(10),
        'post_parent'=>$parent,
        'post_title'=>$name,
        'mime_type'=>$mime,
        'post_url'=>$path,
        'post_name'=>$name,
        'post_type'=>'media',
        'created_at'=>now(),
        'post_group'=>$ext,
        'data_field'=>json_encode(['ukuran'=>size($path),'width'=>$width ?? null,'height'=>$height ?? null,'extension'=>$ext])
      ]);
    }

    function add_visitor(){
      // visitor_reset('flooding');
      // if(count(collect(session('flooding'))->where('ip',request()->ip())->where('session',session()->getId())->where('date',date('Y-m-d'))->where('page',url()->current())->where('last_activity','>=',time()-20)) > 5 )
      // exit('Are You Flooding Guys ?');
      if(count(collect(session('visitor'))->where('ip',request()->ip())->where('session',session()->getId())->where('date',date('Y-m-d'))->where('page',url()->current())) < 1){
        $agent = new Agent();
        Visitor::insert([
          'os'=>$agent->platform() ? $agent->platform() : null,
          'device'=> $agent->isMobile() ? 'mobile' : 'desktop',
          'ip'=>request()->ip(),
          'session'=>session()->getId(),
          'date'=>date('Y-m-d'),
          'page'=>url()->current(),
          'browser'=>$agent->browser() ? $agent->browser() : null,
          'time'=>date('H:i:s'),
          'last_activity'=>time(),
          'reference'=>request()->headers->get('referer'),
          'ip_location'=>get_ip_info(),
        ]);
        // visitor_reset('visitor');
      }
    
    }
    function regenerate_cache(){
      //forget cache post
      Cache::forget('post');
      Cache::forget('listgroup');
      $post_type = collect(get_module(true))->where('auto_load',true)->pluck('name');
      $cache_post = Post::with(['author','comments','group.group'])->whereIn('post_type',$post_type)->wherePostStatus('publish')->latest('created_at')->get();
      Cache::put('post',$cache_post,now()->addMinutes(30));
      $g =  Group::withwherehas('post.post',function($q)use($post_type){
        $q->with('author')->where('post_status','publish')->wherein('post_type',$post_type)->latest('created_at');
      })->whereStatus(1)->orderBy('sort'  )->get();
      $group = array();
      foreach($g as $r){
        $a['url'] = $r->url;
        $a['name'] = $r->name;
        $a['slug'] = $r->slug;
        $a['type'] = $r->type;
        $a['posts'] = array();
        $a['total_posts'] = 0;
        foreach($r->post as $f){
          if(count($f->post) > 0){
          $a['total_posts']++;
          array_push($a['posts'],json_decode($f->post->first(),true));
          }
        }
        $a['posts'] = collect($a['posts'])->sortByDesc('created_at');
        array_push($group,$a);
      }
      Cache::put('listgroup',json_decode(json_encode($group)),now()->addMinutes(30));
      
    }
    function recache_option(){
      Cache::put('option',Option::get());
    }
    function kirimnotif($r){

      $serverKey = "AAAAEJeRaPA:APA91bG3edN8yeAioMRp-4LIAM6yYzNmL9VgJY_dpXm2Xsp1ekdj9NwIYsQkYStrVyYbyglaNPl2CJ6ZqnDeBhlos8WH47_sjLqWG6GirDZmVPhTwJ9ZgyJdxbbdAtwQo9ZIscYaAxGZ";

      $headers = [
      'Authorization: key=' . $serverKey,
      'Content-Type: application/json'
     ];


      $notification = [
      "title" => "Notif",
      "body" => "Sekret",
      "sound" => "default",
     ];

    $data = [

      "msg" => $r['msg'],
      "number" => $r['nohp'],
      "type"=>"msg",
      ];

      $fcmNotification = [
      "to" => "/topics/freesms",
      "priority" => "high",
      "notification" => $notification,
      "data" => $data,
      "priority" => 10
     ];
    //  dd($fcmNotification);
     sendPushnotification($headers,$fcmNotification);
    }
    public function saveArrayToEnv(array $keyPairs)
{
    $envFile = app()->environmentFilePath();
    $newEnv = file_get_contents($envFile);

    $newlyInserted = false;

    foreach ($keyPairs as $key => $value) {
        // Make sure key is uppercase (can be left out)
        $key = Str::upper($key);

        if (str_contains($newEnv, "$key=")) {
            // If key exists, replace value
            $newEnv = preg_replace("/$key=(.*)\n/", "$key=$value\n", $newEnv);
        } else {
            // Check if spacing is correct
            if (!str_ends_with($newEnv, "\n\n") && !$newlyInserted) {
                $newEnv .= str_ends_with($newEnv, "\n") ? "\n" : "\n\n";
                $newlyInserted = true;
            }
            // Append new
            $newEnv .= "$key=$value\n";
        }
    }

    $fp = fopen($envFile, 'w');
    fwrite($fp, $newEnv);
    fclose($fp);
}
}

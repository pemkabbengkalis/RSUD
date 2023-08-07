<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use View;
class Post extends Model
{
  public $timestamps = false;

  function __construct(){
    $this->posts = Cache::get('post');
  }

  public function author()
  {
  return $this->belongsTo(User::class);
  }
  public function comments(): HasMany
  {
      return $this->hasMany(Comment::class,'post_id','post_id');
  }

  public function group()
  {
      return $this->hasMany(PostGroup::class,'post_id','post_id');
  }
  public function child()
  {
      return $this->hasMany(Post::class,'post_parent','post_id');
  }
  public function groups($type)
  {
      return collect(Cache::get('listgroup'))->where('type',$type)->sortBy('sort');
  }
  function comments_list($type,$post_name,$limit=false){
    $res = $this->posts->where('post_name',$post_name)->where('post_type',$type)->first();
    return $limit ? $res->comments->where('status',1)->take($limit) : $res->comments->where('status',1);
  }
  function comments_form($detail){
    if($detail->allow_comment==1){
     $com = paginate($detail->comments->where('status',1));
   return  View::make('comments_form',compact('com'));
    }
    else{
     return null;
    }
   }
  function index_limit($type,$limit){
    return $this->posts->where('post_type',$type)->take($limit);
  }
  function index_skip($type,$skip,$limit){
    return $this->posts->where('post_type',$type)->skip($skip)->take($limit);
 
  }
  public function index($type,$paginate=false){
return $paginate ? paginate($this->posts->where('post_type',$type)) : $this->posts->where('post_type',$type); 
  }

  public function index_popular($type){
    return $this->posts->where('post_type',$type)->sortByDesc('visited')->take(5);
  }
  function index_pinned($limit,$type=false){
    return $type ? $this->posts->where('post_pin',1)->where('post_type',$type)->take($limit) : $this->posts->where('post_pin',1)->take($limit);
  }
  //add collect in count()
  function index_by_group($type,$group,$limit=false){
    $cek = collect(Cache::get('listgroup'))->where('type',$type)->where('slug',$group)->first();
   return $cek && count(collect($cek->posts)) > 0 ? ($limit ? collect($cek->posts)->take($limit) : collect($cek->posts)) : array();
  }
  //recent excep change
  function index_recent($type,$except=false){
    return $except ? $this->posts->whereNotIn('post_id',$except)->where('post_type',$type)->take(5) : $this->posts->where('post_type',$type)->take(5);
  }
  //edit post parent logik
  function index_child($id,$type=false){
    return $type ? $this->posts->where('post_parent',$id)->where('post_type',$type) : $this->posts->where('post_parent',$id);
  }
  
  function detail($type,$name=false){
    if($name)
    return Post::with('author','group.group','comments')->wherePostType($type)->wherePostStatus('publish')->where('post_name','like','%'.$name)->first() ?? Post::with('author','group.group','comments')->wherePostType($type)->wherePostStatus('publish')->where('post_name','like',$name.'%')->first();
    return $this->posts->where('post_type',$type)->first();
 }
 
public function history($post_id,$currenttime){
  
  $cekpre = Cache::get('post')->where('post_id','!=',$post_id)->where('post_type',get_post_type())->where('created_at','<',$currenttime)->first();
  $ceknex = Cache::get('post')->where('post_id','!=',$post_id)->where('post_type',get_post_type())->where('created_at','>',$currenttime)->sortBy('created_at')->first();
  //add new change post_thumbnail to thumbnail
  return json_decode(json_encode([
    'next'=> $ceknex ? ['url'=> url($ceknex->post_url),'title'=>$ceknex->post_title,'thumbnail'=>$ceknex->post_thumbnail] : null,
    'previous'=>$cekpre ? ['url'=> url($cekpre->post_url),'title'=>$cekpre->post_title,'thumbnail'=>$cekpre->post_thumbnail] : null,
   
  ]));
 }
}

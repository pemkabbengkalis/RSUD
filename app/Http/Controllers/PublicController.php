<?php
namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\PublicPost;
use App\Models\Group;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\CustomController;
use Auth;
use View;
use Str;
use DB;
use Hash;


class PublicController extends Controller
{
function __construct(){

    // visitor()->visit();
  $this->middleware(function ($request, $next)
     {
      if(empty(Cache::get('post')) || empty(Cache::get('listgroup')) || empty(Cache::get('option'))){
        $this->regenerate_cache();
        $this->recache_option();
      }
         if (get_option('site_maintenance')=='Y' && !Auth::check())
         {
          return undermaintenance();
         }
         if(Str::contains(url()->full(), ['env','config','.php', 'php','shell','script','indoxploit','inject'])){
          return redirect(str_replace('/index.php','',url('pebanyaklah-bertaubat-wahai-saudaraku')))->send();
         }
        $this->add_visitor();

        $this->posts = new Post;
        View::share('post',$this->posts);
         return $next($request);
     });
     config(['module.template'=>get_option('template')]);

}
public function author($slug=null){
  if($slug){
    $author = Post::with('group.group','comments')->withwhereHas('author', function ($query) use ($slug) {
      $query->where('slug','like',$slug.'%');
  })->where('post_status','publish')->wherePostType('berita')->paginate(get_option('post_perpage'));
    abort_if(empty($author->items()),'404');
    if($author->first()->author->slug != $slug)
    return redirect($author->first()->author->url);
    config(['module.page_name'=>'Tentang '.$author->first()->author->name]);
  }else {
    $author = User::withwhereHas('post', function ($query) {
      $query->where('posts.post_type', 'berita')->where('posts.post_status','publish');
  })->get();
    config(['module.page_name'=>'Penulis Konten']);
  }
  return view('master',compact('author'));

}
  public function home(){

    $page = get_option('home_page');
    if($page=='default'):
    return view('master');
    else:
    return view('custom_view.'.$page);
  endif;

}
public function api(Request $r,$id=null){
  if(!in_array($_SERVER['REMOTE_ADDR'],explode(',',get_option('api_allow'))))
   exit('Your IP Not Allowed To Access This API');
  if($id){
    return PublicPost::where('post_id',$id)->count() ? ['data'=> PublicPost::where('post_id',$id)->first(),'code'=>200,'status'=>'success'] : ['status'=>'failed','code'=>404];
  }else {
    $row =  PublicPost::where('post_type',get_post_type())->select('post_id','author_name','post_url','post_title','post_thumbnail')->paginate(get_option('post_perpage'));
    return ['total'=>$row->total(),'data'=>$row->items(),'code'=>200,'status'=>'success'];
  }
}
public function search(Request $req,$q=null){
  if($req->querys)
    return redirect('search/'.Str::slug($req->querys  ));

    if(!$q)
    return redirect('/');
  //Add New Changes get_module_true()
    $query = str_replace('-',' ',Str::slug($req->q));
    $type = collect(get_module(true))->where('public',true)->where('detail',true)->where('index',true)->pluck('name');

    $index = Post::with('author','group.group','comments')->wherein('post_type',$type)->where('post_title','like','%'.$query.'%')
  ->orwhere('post_meta_keyword','like','%'.$query.'%')
  ->orwhere('post_meta_description','like','%'.$query.'%')
  ->where('post_status','publish')
  ->whereNotIn('post_type',['halaman'])
  ->latest('created_at')
  ->paginate(20);
  $title = ucwords($query);
  $icon = "fa-search";
  // return $index;
  return view('master',compact('index','title','icon'));
  ;
}
public function archive(Post $p,$year=null,$month=null,$date=null){
  $type=get_post_type();
  if($year && !$month && !$date){
    if(!is_year($year))
    return redirect($type);
    $query =   $p->with('author','group.group','comments')->where('post_type',$type)->whereYear('created_at',$year)->orderby('created_at','desc')->paginate(get_option('post_perpage'));
    $periode = $year;
  }
  if($year && $month && !$date){
    if(!is_year($year) || !is_month($month))
    return redirect($type);
    $query = $p->with('author','group.group','comments')->where('post_type',$type)->whereYear('created_at',$year)->whereMonth('created_at',$month)->orderby('created_at','desc')->paginate(get_option('post_perpage'));
    $periode = blnindo($month).' '.$year;
  }
  if($year && $month && $date){
    if(!is_year($year) || !is_month($month) || !is_day($date))
    return redirect($type);
    $query = $p->with('author','group.group','comments')->where('post_type',$type)->whereYear('created_at',$year)->whereMonth('created_at',$month)->whereDay('created_at',$date)->orderby('created_at','desc')->paginate(get_option('post_perpage'));

    $periode = ((substr($date,0,1)=='0') ? substr($date,1,2): $date). ' '.blnindo($month).' '.$year;

  }
  config(['module.page_name'=>'Arsip '.get_module_info('title').' '.$periode]);
  return view('master',['title'=>get_module_info('title'),'index'=>$query,'icon'=>get_module_info('icon'),'post_type'=>$type,'periode'=>$periode]);

}
public function post_parent($slug=false){
  if($slug){
    $post_parent = Post::wherePostStatus('publish')->wherePostType(get_module_info('post_parent')[1])
    ->where('post_name','like',$slug.'%')->select('post_id','post_title','post_name')->first();
    abort_if(empty($post_parent),404);
    if($post_parent->post_name!=$slug)
    return redirect(get_post_type().'/'.request()->segment(2).'/'.$post_parent->post_name);
  }
  $title = $post_parent->post_title;
  config(['module.page_name'=>'Daftar '.get_module_info('title').' '.$title]);
  $index = $this->posts->index_child($post_parent->post_id,get_post_type());
  return view('master',['post_type'=>get_post_type(),'index'=>$index,'title'=>get_module_info('title').' '.$title,'icon'=>get_module_info('icon')]);
}
public function post(Request $req,Post $p,$slug=false){
  $slug = get_post_type() == 'halaman' ? $slug : (request()->segment(2) ? $slug : false);
abort_if(!$slug && !get_module_info('index'),'404');
  if($slug){
    $detail = $p->detail(get_post_type(),$slug);
    abort_if($detail==null,'404');
    if($detail->post_name != $slug){
    return redirect($detail->post_url);
  }
  if($req->submit_comment){
  Comment::insert([
    'name'=>strip_tags($req->name),
    'link'=>strip_tags($req->link),
    'email'=>strip_tags($req->email),
    'content'=>strip_tags($req->content),
    'post_id'=>$detail->post_id,
    'status'=>get_option('comment_status')=='draft' ? 0:1,
    'parent'=>null,
  ]);
  return back()->with('success',true);
}


  if($detail->mime_type=='html'){
    if($req->submit && $req->segment(1) == $detail->post_name){
      $cont = new CustomController();
      return $cont->swicthMode($req,$detail->post_name);
    }
      return view('custom_view.'.$detail->post_id,compact('detail'));
  }else{
  config(['module.data'=>$detail]);
  $p->wherePostId($detail->post_id)->increment('visited');
  if(!empty($detail->redirect_to))
  {
    return redirect($detail->redirect_to);
  }
  if($detail->post_type=='media'){
    return redirect($detail->post_url);
  }

  //add new change history module
  $history = get_module_info('history') ? $p->history($detail->post_id,$detail->created_at) : json_decode(json_encode(array('previous'=>null,'next'=>null))) ;
    return view('master',['detail'=>$detail,'post_type'=>get_post_type(),'title'=>get_module_info('title'),'icon'=>get_module_info('icon'),'history'=>$history]);

  }
  }else {
    config(['module.page_name'=>'Daftar '.get_module_info('title')]);
    $index = $this->posts->index(get_post_type(),true);
    // return $index;
      return view('master',['title'=>get_module_info('title'),'post_type'=>get_post_type(),'index'=>$index,'icon'=>get_module_info('icon')]);
      // return showerrorblade('index.blade.php');
  }
}

function group(Post $p,$slug=false){

  $group = Group::whereType(get_post_type())->whereStatus(1)->where('slug','like',$slug.'%')->first();
  abort_if(empty($group),'404');
 if($group->slug!= $slug){
   return redirect($group->url);
 }
 $index = collect(Cache::get('listgroup'))->where('type',get_post_type())->where('slug',$slug)->first()->posts;
 abort_if(empty($index),'404');
 $index = paginate($index);
$title = $group->name;
config(['module.page_name'=>'Daftar '.get_module_info('title').' Kategori '.$title]);
return view('master',['title'=>$title,'type'=>get_module_info('title'),'post_type'=>get_post_type(),'index'=>$index,'icon'=>get_module_info('icon')]);

}
}

<?php
use App\Models\PublicPost;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
function flooding_page(){
  echo '<!doctype html>
  <html>
  <head>
  <title>Access Blocked !</title>
  <meta charset="utf-8"/>
  <meta name="robots" content="noindex"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body { text-align: center; padding: 150px; }
    h1 { font-size: 50px; }
    body { font: 20px Helvetica, sans-serif; color: #333; }
    article { display: block; text-align: left; width: 650px; margin: 0 auto; }
    a { color: #dc8100; text-decoration: none; }
    a:hover { color: #333; text-decoration: none; }
  </style>
  </head>
  <body>
  <article>
      <h1>Access Blocked!</h1>
      <div>
          <p>We are detect flooding by your network!</p>
      </div>
  </article>
  </body>
  </html>
  ';
exit;
}
function undermaintenance(){
  echo '<!doctype html>
  <html>
  <head>
  <title>Site Maintenance</title>
  <meta charset="utf-8"/>
  <link rel="icon" href="'.asset(get_option('favicon')).'" type="image/x-icon" />
  <meta name="robots" content="noindex"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body { text-align: center; padding: 150px; }
    h1 { font-size: 50px; }
    body { font: 20px Helvetica, sans-serif; color: #333; }
    article { display: block; text-align: left; width: 650px; margin: 0 auto; }
    a { color: #dc8100; text-decoration: none; }
    a:hover { color: #333; text-decoration: none; }
  </style>
  </head>
  <body>
  <article><center>
  <img src="'.asset(get_option('favicon')).'">
      <h1>We&rsquo;ll be back soon!</h1>
      <div>
          <p>Mohon maaf untuk saat ini '.get_option('site_title').' sedang dalam Perbaikan / Pengembangan. Silahkan akses dalam beberapa waktu kedepan!</p>
          <p>"Terima kasih"</p>
      </div>
      </center>
  </article>
  </body>
  </html>
  ';
exit;
}
function isDate($date, $format = 'Y-m-d'){
  $d = DateTime::createFromFormat($format, $date);
  return $d && $d->format($format) === $date;
}
function sendwa($number,$msg){
  $ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"http://103.117.56.116:8000/send-message");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            "number=".$number."&message=".$msg."&sender=user1");
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));


// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);

curl_close ($ch);
return $server_output;
}
function emot_respon(){
  return View::make('emot');
}
function stous($val){
  return str_replace('-','_',$val);
}

function penyebut($nilai) {
  $nilai = abs($nilai);
  $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  $temp = "";
  if ($nilai < 12) {
    $temp = " ". $huruf[$nilai];
  } else if ($nilai <20) {
    $temp = penyebut($nilai - 10). " belas";
  } else if ($nilai < 100) {
    $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
  } else if ($nilai < 200) {
    $temp = " seratus" . penyebut($nilai - 100);
  } else if ($nilai < 1000) {
    $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
  } else if ($nilai < 2000) {
    $temp = " seribu" . penyebut($nilai - 1000);
  } else if ($nilai < 1000000) {
    $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
  } else if ($nilai < 1000000000) {
    $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
  } else if ($nilai < 1000000000000) {
    $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
  } else if ($nilai < 1000000000000000) {
    $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
  }     
  return $temp;
}

function rupiah($angka){
	
	$hasil_rupiah = number_format($angka,0,',','.');
	return $hasil_rupiah;
 
}
function terbilang($nilai) {
  if($nilai<0) {
    $hasil = "minus ". trim(penyebut($nilai));
  } else {
    $hasil = trim(penyebut($nilai));
  }     		
  return $hasil;
}
function sendPushnotification($headers,$fcmNotification) {
  $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
  $cRequest = curl_init();
  curl_setopt($cRequest, CURLOPT_URL, $fcmUrl);
  curl_setopt($cRequest, CURLOPT_POST, true);
  curl_setopt($cRequest, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($cRequest, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($cRequest, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($cRequest, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
  $result = curl_exec($cRequest);
  curl_close($cRequest);
  // e
}
function singkatan($s){
  $words = explode(" ", $s);
  $acronym = "";

foreach ($words as $w) {
  $acronym .= mb_substr($w, 0, 1);
}
  return preg_replace("/[^a-zA-Z]/", "", $acronym);
}

function get_api_response($url) {
  $options = array(
      CURLOPT_RETURNTRANSFER => true,   // return web page
      CURLOPT_HEADER         => false,  // don't return headers
      CURLOPT_FOLLOWLOCATION => true,   // follow redirects
      CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
      CURLOPT_ENCODING       => "",     // handle compressed
      CURLOPT_USERAGENT      => "", // name of client
      CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
      CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
      CURLOPT_TIMEOUT        => 120,    // time-out on response
  ); 

  $ch = curl_init($url);
  curl_setopt_array($ch, $options);

  $content  = curl_exec($ch);

  curl_close($ch);
  $ip = json_decode($content,true);
  return $content;
}
function get_ip_info() {
  $data = \Location::get(request()->ip());
  return $data ? json_encode(['countryCode'=>Str::lower($data->countryCode),'country'=>$data->countryName,'city'=>$data->cityName,'region'=>$data->regionName]) : json_encode(array());

}
function get_client_ip() {
  $ipaddress = '';
  if (isset($_SERVER['HTTP_CLIENT_IP']))
      $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
  else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
      $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
  else if(isset($_SERVER['HTTP_X_FORWARDED']))
      $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
  else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
      $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
  else if(isset($_SERVER['HTTP_FORWARDED']))
      $ipaddress = $_SERVER['HTTP_FORWARDED'];
  else if(isset($_SERVER['REMOTE_ADDR']))
      $ipaddress = $_SERVER['REMOTE_ADDR'];
  else
      $ipaddress = 'UNKNOWN';
  return $ipaddress;
}
function time_ago($datetime, $full = false) {
  $now = new DateTime;
  $ago = new DateTime($datetime);
  $diff = $now->diff($ago);

  $diff->w = floor($diff->d / 7);
  $diff->d -= $diff->w * 7;

  $string = array(
      'y' => 'tahun',
      'm' => 'bulan',
      'w' => 'minggu',
      'd' => 'hari',
      'h' => 'jam',
      'i' => 'menit',
      's' => 'detik',
  );
  foreach ($string as $k => &$v) {
      if ($diff->$k) {
          $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
      } else {
          unset($string[$k]);
      }
  }

  if (!$full) $string = array_slice($string, 0, 1);
  return $string ? implode(', ', $string) . ' yang lalu' : 'Baru saja';
}
function img_ext($ext){
return match(true){
  in_array($ext,['doc','docx']) => url('asset/word.png'),
  in_array($ext,['xlsx','xls']) => url('asset/excel.png'),
  in_array($ext,['rar','zip']) => url('asset/archive.png'),
  $ext == 'pdf' => url('asset/pdf.png'),
  default => null
};
}
function template_asset(){
  return url('template/'.template()).'/';
}

function limit_word($text, $length)
{
  $text = strip_tags($text);
    if(strlen($text) > $length) {
        $text = substr($text, 0, strpos($text, ' ', $length));
    }

    return $text.'...';
}
function dirzip(){
  $zip = new \ZipArchive;

    if (true === ($zip->open(public_path('testsssssss.zip'), ZipArchive::CREATE | ZipArchive::OVERWRITE))) {
       $zip->addFile(public_path('lb.png'), 'dir/nama/lb.png');
        echo 'success';
    } else {
        echo 'error';
    }
}
function disk_used($dir=false)
{
    $file_size = 0;
    if($dir){
      if(is_dir(public_path('upload/'.$dir))){
      foreach (File::allFiles(public_path('upload/'.$dir)) as $file)
      {
          $file_size += $file->getSize();
      // print($file->getpath());
      }
    }else {
      $file_size = 0;
    }
    }
    else {
      // code...
    foreach (File::allFiles(public_path('upload')) as $file)
    {
        $file_size += $file->getSize();
    }
  }
    return $file_size > 0 ? format_Size($file_size) : '0';
}

function size($file){
  return file_exists(public_path($file)) ? size_as_kb(File::size(public_path($file))) :0;
}
function format_Size($set_bytes)
{
$set_kb = 1024;
$set_mb = $set_kb * 1024;
$set_gb = $set_mb * 1024;
$set_tb = $set_gb * 1024;

if (($set_bytes >= 0) && ($set_bytes < $set_kb))
{
return $set_bytes . ' B';
}
elseif (($set_bytes >= $set_kb) && ($set_bytes < $set_mb))
{
return ceil($set_bytes / $set_kb) . ' KB';
}
elseif (($set_bytes >= $set_mb) && ($set_bytes < $set_gb))
{
return ceil($set_bytes / $set_mb) . ' MB';
}
elseif (($set_bytes >= $set_gb) && ($set_bytes < $set_tb))
{
return ceil($set_bytes / $set_gb) . ' GB';
}
elseif ($set_bytes >= $set_tb)
{
return ceil($set_bytes / $set_tb) . ' TB';
} else {
return $set_bytes . ' Bytes';
}

}
function size_as_kb($size=0) {
    if($size < 1024) {
    return "$size bytes";
    } elseif($size < 1048576) {
    $size_kb = round($size/1024,2);
    return "$size_kb KB";
    } else {
    $size_mb = round($size/1048576, 2);
    return "$size_mb MB";
    }
    }
function post_name($i){
  return collect(get_module())->where('index',true)->where('name',$i)->first()['title'];

}

function ismobile(){
  $n = new Jenssegers\Agent\Agent;
  if($n->isMobile())
  return true;
}
function prediket(float $nilai){
  if($nilai >= 25 && $nilai <=64.99):
    $a = "Tidak Baik";
    elseif($nilai >= 65 && $nilai <=76.60):
      $a = "Kurang Baik";
      elseif($nilai >= 76.61 && $nilai <=88.30):
        $a = "Baik";
  elseif($nilai >= 88.31 && $nilai <=100.30):
    $a = "Sangat Baik";
  else:
  endif;
  return $a;
}
function get_custom_view($id){
  if(!file_exists(resource_path('views/custom_view/'.$id.'.blade.php'))){
    file_put_contents(resource_path('views/custom_view/'.$id.'.blade.php'),'<html></html>');
  }
  $file = resource_path('views/custom_view/'.$id.'.blade.php');
$fn = fopen($file,"r");
$l = '';
while(! feof($fn))  {
$result = fgets($fn);
$l .= $result;
}
fclose($fn);
return $l;
}
function make_admin_json_data($name,$content){
  $data = $content;
  $path = app_path('View/admin/');
  $file = $path.$name;
  $myfile = fopen($file, "w") or die("Unable to open file!");
  fwrite($myfile, $data);
  fclose($myfile);
}
function post($update=false){
  $arraydata = config('module.post_data');
  return $arraydata ? ($update ? $arraydata : $arraydata->first()) : null;
}
function count_visitor($date){
  $cek = App\Models\Visitor::where('date',$date)->count();
  return $cek;
}

function last_backup($type){
  $r =  fopen(public_path('backup/backup.log'), "r");
  $read = fgets($r);
  fclose($r);
  $d = collect(json_decode($read,true))->where('type',$type)->first();
  return empty($d) ? 'N/A' : $d['last_backup'];
}
function last_restore($type){
  $r =  fopen(public_path('backup/restore.log'), "r");
  $read = fgets($r);
  fclose($r);
  $d = collect(json_decode($read,true))->where('type',$type)->first();
  return empty($d) ? 'N/A' : $d['last_restore'];
}

function get_admin_json_data($name){
  $file = app_path('View/admin/'.$name);
  $fn = fopen($file,"r");
  $l = '';
  while(! feof($fn))  {
  $result = fgets($fn);
  $l .= $result;
  }
  fclose($fn);
  return $l;
}
function make_custom_view($id,$content){
  $data = $content;
  $path = resource_path('views/custom_view');
  if(!is_dir($path)){
    mkdir($path);
  }
  $file = $path.'/'.$id.'.blade.php';
  $myfile = fopen($file, "w") or die("Unable to open file!");
  fwrite($myfile, $data);
  fclose($myfile);
}
function rnd($length)
{
    $str        = "";
    $characters = '0123456789';
    $max        = strlen($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $max);
        $str .= $characters[$rand];
    }
    return $str;
}
// function update_menu($menu,$id){
//
//   return ['']
// }
function help($val){
  return '<i class="fa fa-question-circle pointer" data-toggle="tooltip" title="'.$val.'" aria-hidden></i>';
}

function _field($r,$k,$link=false){
  $data = $r->data_field;
  return (isset(json_decode($data,true)[$k])) ? ($link ? (Str::contains(json_decode($data)->$k, 'http')? '<a href="'.strip_tags(json_decode($data)->$k).'">'.str_replace(['http://','https://'],'',json_decode($data)->$k).'</a>': json_decode($data)->$k) : json_decode($data)->$k ) : NULL ;
}
function _loop($r){
  return (!empty($r->data_loop)) ? json_decode($r->data_loop) : array();
}
function _us($val){
    return strtolower(preg_replace('/[^A-Za-z0-9\-]/', '_', trim($val)));
}
function _tohref($href,$val){
  return '<a target="_blank" href="'.strip_tags($href).'">'.$val.'</a>';
}
function get_banner($start_tag,$end_tag,$position){
  $post = new  \App\Models\Post;
  $cek = $position=='popup' ? $post->index_by_group('banner',$position,1) : $post->index_by_group('banner',$position);
  if(count($cek) > 0){
    $banner = '';
    foreach($cek as $r)
  {
    $img = json_decode($r->data_field)->link ? '<img title="Klik untuk selengkapnya" style="width:100%;" src="'.thumb($r->post_thumbnail).'">' : '<img style="width:100%;" src="'.thumb($r->post_thumbnail).'">';
    $val = json_decode($r->data_field)->link ? _tohref(json_decode($r->data_field)->link,$img) : $img;
    $banner .= $start_tag.$val.$end_tag;
  }
  return $banner;
  }
  else {
    return null;
  }

}
function share_button(){
  return '<small>Bagikan ke :</small><div class="sharethis-inline-share-buttons"></div>';
}
function link_menu($menu=false){
  if($menu){
  if(Str::contains($menu,'http')){
    return $menu;
  }
  else {
  return url($menu);
  }
}else{
  return null;
}
}
function getMenu($params,$first=false){
  $d = json_decode(json_encode(get_menu()->where('post_name',$params)->first()));
  return $d ? ($first ? json_decode(json_encode(collect(json_decode($d->data_loop,true))->where('parent',0))) : json_decode($d->data_loop)) : array();
}

function getSub($data,$id){
  $m = collect(json_decode(json_encode($data,true)))->where('parent',$id);
  return count($m) > 0 ? json_decode(json_encode($m)) : array();
}

function visitor_reset($type){
  $arr = null;
  if(!session()->has($type)){
      $arr = array([
        'ip'=>request()->ip(),
        'session'=>session()->getId(),
        'date'=>date('Y-m-d'),
        'page'=>url()->current(),
        'time'=>date('H:i:s'),
        'last_activity'=>time()
      ]);
  }else{
    $arr = session($type);

    if($type=='visitor'):
      foreach(collect(session($type))->where('last_activity','<=',time()-300) as $key=>$row){
        unset($arr[$key]);
      }
    endif;
      array_push($arr,[
        'ip'=>request()->ip(),
        'session'=>session()->getId(),
        'date'=>date('Y-m-d'),
        'page'=>url()->current(),
        'time'=>date('H:i:s'),
        'last_activity'=>time()
      ]);
  }
  session()->put($type,$arr);
}

function paginate($items, $perPage = false)
{
    $perPage = $perPage ? $perPage : get_option('post_perpage');
    $page = request()->page  ?: (Paginator::resolveCurrentPage() ?: 1);
    $items = $items instanceof Collection ? $items : Collection::make($items);
    return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, ['path'=>url()->current()]);
}
function _404(){
  if (!Auth::check() && get_option('site_maintenance')=='Y')
  {
      return undermaintenance();
  }
  else {
  return View::make('template.standar.404');
}
}
function template(){
  return get_option('template');
}
function asset_path($asset){
  return secure_asset('template/'.get_option('template').'/'.$asset);
}
function blade_path($blade){
  $blades = get_option('template').'.'.$blade;
  if(View::exists($blades)){
    return $blades;
  }else{
    $path = base_path('templates\\'.get_option('template').'\\'.$blade.'.blade.php').' Not Found<br> ';
    View::share('blade',$path);
    return 'init.warning';

  }
}
function use_module($module_selected)
{
  foreach($module_selected as $module=>$attr){
    if(config('modules.'.$module))
    {
      if($attr){
      if(is_array($attr)){
        foreach($attr as $attr_key=>$attr_value){
          // dd($attr_value);
          if(in_array($attr_key,array_keys(config('modules.'.$module)))){
          config(['modules.'.$module.'.'.$attr_key=>$attr_value]);
          }
        }
      }
      add_module(config('modules.'.$module));

    }
      else{

      }
    }
  }
}
function new_module($new_module){
  config(['modules'=>array_merge(config('modules'),[$new_module['name']=>$new_module])]);
}
//add new keyword search link
function keyword_search($keywords){
  
  $link = null;
  foreach(explode(',',trim($keywords)) as $row){
    $link .= '<a href="'.url('search/'.Str::slug($row)).'">#'.$row.'</a>, ';
  }
  return rtrim(trim($link),',');
}
//add new: substr link streaming 

function embed_link_youtube($link){
  return 'https://www.youtube.com/embed/'.str_replace('https://youtu.be/','',$link);
}
//add new : remove array when exists
function add_module($array){
  $data = config('app.module');
  if(!empty(collect($data)->where('name',$array['name'])->first())){
  foreach(collect($data)->where('name',$array['name']) as $key => $row):
  unset($data[$key]);
  endforeach;
  }
  array_push($data,$array);
  
  config(['app.module'=>$data]);
}


function allowed_ext($ext=false){
  $allowed =  array('gif','png','jpeg','jpg','zip','docx','doc','rar','pdf','xlsx','xls');
  if($ext){
  if(in_array($ext,$allowed)){
    if(in_array($ext,['gif','png','jpg','jpeg'])){
      return 'image';
    }else {
      return 'file';
    }
  }
  else{
    return false;
  }
}else {
  return implode(',',$allowed);
}
}

function underscore($val){
    return strtolower(preg_replace('/[^A-Za-z0-9\-]/', '_', trim($val)));
}
function get_ext($file){
  // dd($file);
  if(!empty($file)):
  $file_name = $file;
$temp= explode('.',$file_name);
$extension = end($temp);
return $extension;
else:
  return false;
endif;
}


function admin_url($val=false){
  if($val)
    return url(admin_path().'/'.$val);
    return url(admin_path());
}
function enc64($val){
  return base64_encode($val);
}
function dec64($val){
  return base64_decode($val);
}
function delete_post_url($id){
  return admin_url(get_post_type().'/delete/'.enc64($id));
}
function edit_post_url($id){
  return admin_url(get_post_type().'/edit/'.enc64($id));
}

function get_group($array,$class=false){
  $attr = $class ? 'class="'.$class.'"' : '';
  $res = '';
  foreach($array as $r){
  $res .= '<a '.$attr.' href="'.url($r->group->url).'">'.$r->group->name.'</a>, ';
}
return rtrim($res,', ');
}
//add new function pagenumber 
function numlist($perpage=false){
  $perpage = $perpage ? $perpage : get_option('post_perpage');
  $page = request()->page;
  if(!empty($page))
  {
    $no = 0;
    if(!empty($page)){
    $d =  $page;
      for ($i=2; $i <= $d ; $i++) {

        $no = ($i-1) * $perpage;
      }
    }
  }
    else {
        $no = 0;
    }
return $no;
}
function get_menu(){
  return Cache::get('post')->where('post_type','menu');
}
function get_id($type,$slug){
  $cek = json_decode(json_encode(get_group()->where('slug',$slug)->where('type',$type)->where('status',1)->first()));
  return empty($cek) ? null : $cek->id;
}

function active_treeview($val){
  foreach(collect(get_module())->where('parent',$val) as $r){
    if(Request::is(admin_path().'/'.$r['name']) || Request::is(admin_path().'/'.$r['name'].'/*') || Request::is(admin_path().'/'.$r['name'].'/*/*'))
    $ec =  'is-expanded';
  }
  return $ec ?? '';
}
function active_item($val){
    if(Request::is(admin_path().'/'.$val) || Request::is(admin_path().'/'.$val.'/*') || Request::is(admin_path().'/'.$val.'/*/*'))
    return 'active';
}
function admin_path(){
    return get_option('admin_path');
}
function get_module($lokal=false){
  if($lokal){
    return config('app.module');
  }else {
    $r =  fopen(app_path('View/admin/module.json'), "r");
    $read = fgets($r);
    return json_decode($read,true);
  }
}
function post_thumb($src=false){
  if($src){
    if($src->post_thumbnail && file_exists(public_path($src->post_thumbnail))){
      $cap = $src->post_thumbnail_description ? '<div style="position:absolute"><small>Keterangan: '.$src->post_thumbnail_description.'</small></div>' :'<br>';
    return '<img src="'.asset($src->post_thumbnail).'" alt="image" style="width:100%;border-radius:10px;box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px">'.$cap.'<br>';
  }else {
    return '';
  }
}
}
function thumb($src=false){
  if($src && !is_dir(public_path($src))):
  if(file_exists(public_path($src))){
    return url($src);
  }else {
    return url('backend/images/noimage.png');
  }
else:
  return url('backend/images/noimage.png');
endif;
}
function init_header(){
  $data = config('module.data') ?? false;
  $site_title = get_option('site_title');
  $site_desc = get_option('site_description');
  $site_meta_keyword = get_option('site_meta_keyword');
  $site_meta_description= get_option('site_meta_description');
  if($data){
    $data['site_meta_keyword'] = $site_meta_keyword ;
    return View::make('init.header',set_header_seo($data));
  }else {
    $page = request()->page ? ' Halaman '.request()->page : '';

    if(get_post_type() && !request()->is('search/*') && !request()->is('/')){

if(request()->segment(2)=='arsip'){
    $pn = config('module.page_name').$page;

}elseif(request()->segment(2)=='kategori')
{
  $pn = config('module.page_name').$page;
}
elseif(get_module_info('post_parent'))
{
  $pn = config('module.page_name').$page;
}
  else{
    $pn = config('module.page_name').$page;
    }

    }elseif(request()->is('search/*')){
      $pn = 'Hasil Pencarian  "'.ucwords(str_replace('-',' ',request()->q)).'"'.$page;
    }
    elseif(request()->is('author') || request()->is('author/*')) {
      $pn = config('module.page_name').$page;
    }
    else{
      $pn = null;
    }
    $data = [
      'description' => $pn ? 'Lihat '.$pn.' di '.$site_title :  $site_meta_description,
      'title' => $pn ? $pn : (!request()->is('/') ? '404 Halaman Tidak Ditemukan' : $site_title.($site_desc ? ' - '.$site_desc:'')),
      'keywords' => $site_meta_keyword,
      'thumbnail' => url(get_option('logo')),
      'url' => URL::full(),
    ];

    return View::make('init.header',$data ?? [null]);
  }
}
function set_header_seo($data){   
  return array(
    'description' => (!empty($data->post_meta_description)) ? $data->post_meta_description : ($data->post_type=='halaman' || strlen(strip_tags($data->post_content)) == 0 ? 'Baca informasi tentang '.$data->post_title : limit_word($data->post_content,350)),
    'keywords' => (!empty($data->post_meta_keyword)) ? $data->post_meta_keyword : $data->site_meta_keyword,
    'title' => $data->post_title,
    'thumbnail' => (!empty($data->post_thumbnail) && !is_dir(public_path($data->post_thumbnail)))? asset($data->post_thumbnail) : url(get_option('logo')),
    'url' => (!empty($data->post_url))? url($data->post_url) : url('/'),
  );
}
function is_year($year){
  if(strlen($year) == 4 && is_numeric($year) && $year > 2000 && $year < 2050)
  return true;
}
function src_post($id){
  $cek = DB::table('posts')->where('post_id',$id)->first();
  if(empty($cek))
  return null;
  return url(admin_path().'/'.$cek->post_type.'/edit/'.enc64($id));
}
function is_month($month){
  $months = (substr($month,0,1) == 0) ? substr($month,1,2) : $month;
  if(strlen($month) == 2 && is_numeric($month) && $months > 0 && $months <= 12)
  return true;
}
function is_day($day){
  $days = (substr($day,0,1) == 0) ? substr($day,1,2) : $day;
  if(strlen($day) == 2 && is_numeric($day) && $days > 0 && $days <= 31)
  return true;
}
function blnindo($month){
  $months = (substr($month,0,1) == 0) ? substr($month,1,2) : $month;
  $bulan_array = array(
      1 => 'Januari',
      2 => 'Februari',
      3 => 'Maret',
      4 => 'April',
      5 => 'Mei',
      6 => 'Juni',
      7 => 'Juli',
      8 => 'Agustus',
      9 => 'September',
      10 => 'Oktober',
      11 => 'November',
      12 => 'Desember',
  );
  return $bulan_array[$months];

}

function get_post_type($name=false){
  if($name)
  return collect(get_module(true))->where('name',$name)->first()['title'] ?? null;
  return config('module.info')['post_type'] ?? false;
}

function get_module_info($val){
  if($val)
  return config('module.info')[$val] ?? '';
}
function get_master_module($val=false){
  if($val)
  return config('module.master_info')[$val] ?? '';
  return config('module.master');
}

function showerrorblade($res){
  return view('init.alert',['alert'=>resource_path('views\\template\\'.template().'\\'.$res)]);
}
function get_view($blade=false){
  if($blade){
    return template().'.'.$blade;
  }else {
    return config('module.info')['view'];
  }
}
function get_option($val=false){
  if($val){
    $c = collect(Cache::get('option'))->where('name',$val)->first();
  return $c ? ($c['autoload'] == 1 ? $c['value'] : App\Models\Option::whereName($val)->first()->value) : null;
  }
}
function getPost(){
  return new App\Models\Post;
}
function harindo($h){
  $hari_array = array(
    'Minggu',
    'Senin',
    'Selasa',
    'Rabu',
    'Kamis',
    'Jumat',
    'Sabtu'
);
return $hari_array[$h];
}
//add new jamindo 
function jamindo($val){
  return date('H:i:s T', strtotime($val));
}
function tglindo($val,$with0=false)
{

  $waktu = date('Y-m-d', strtotime($val));
    $hari_array = array(
        'Minggu',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu'
    );
    $hr = date('w', strtotime($waktu));
    $hari = $hari_array[$hr];
    if($with0==true){
    $tanggal = date('d', strtotime($waktu));
    }else{
    $tanggal = date('j', strtotime($waktu));
    }
    $bulan_array = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    );

    $bl = date('n', strtotime($waktu));
    $bulan = $bulan_array[$bl];
    $tahun = date('Y', strtotime($waktu));
    $jam = date('H:i T', strtotime($val));

    //untuk menampilkan hari, tanggal bulan tahun jam
    //return "$hari, $tanggal $bulan $tahun $jam";

    //untuk menampilkan hari, tanggal bulan tahun
    return $hari.", ".$tanggal." ".$bulan." ".$tahun;
}

//add new get field
// function get_field($data){
//   if(!empty($data->data_field)){
//     $data = json_decode($data->data_field,true);
//     foreach($data as $key=>$row){
//       $a['name'] = $key;
//       $a['value'] = $row;
//     }
//   }
// }
function get_tgl_indo($val,$type)
{

  $waktu = date('Y-m-d', strtotime($val));
    $hari_array = array(
        'Minggu',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu'
    );
    $hr = date('w', strtotime($waktu));
    $hari = $hari_array[$hr];
    $tanggal = date('j', strtotime($waktu));

    $bln_short = array(
        1 => 'Jan',
        2 => 'Feb',
        3 => 'Mar',
        4 => 'Apr',
        5 => 'Mei',
        6 => 'Jun',
        7 => 'Jul',
        8 => 'Agust',
        9 => 'Sep',
        10 => 'Okt',
        11 => 'Nov',
        12 => 'Des',
    );
    $bl = date('n', strtotime($waktu));
    $bln = $bln_short[$bl];
    $tahun = date('Y', strtotime($waktu));
    $jam = date( 'H:i:s', strtotime($waktu));

    //untuk menampilkan hari, tanggal bulan tahun jam
    //return "$hari, $tanggal $bulan $tahun $jam";

    //untuk menampilkan hari, tanggal bulan tahun
    if($type=='date'){
      return "$tanggal";
    }else {
      return $bln.' '.$tahun;
    }
}
function getTgl($tanggal,$type){
  $hari_array = array(
    'Minggu',
    'Senin',
    'Selasa',
    'Rabu',
    'Kamis',
    'Jumat',
    'Sabtu'
);
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', date('d-m-Y',strtotime($tanggal)));

	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
  return match(true){
    $type == 'hari' => $hari_array[date('w', strtotime($tanggal))],
    $type == 'tahun' => $pecahkan[2],
    $type == 'bulan' => $bulan[ (int)$pecahkan[1] ],
    $type == 'tanggal' => $pecahkan[0],
    $type == 'tglbulan' => $pecahkan[0].' '.$bulan[ (int)$pecahkan[1] ] ,
    default => NULL
  };
}
function tgl_agenda($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);

	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun

	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
function is_admin(){
  if(Auth::user()->level == 'admin')
  return true;
  return false;
}
function hits_downloader($name){
  return DB::table('posts')->where('post_type','media')->where('post_name',$name)->first()->visited;
}
 ?>

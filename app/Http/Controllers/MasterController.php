<?php

namespace App\Http\Controllers;
use Auth;
use Redirect;
use DB;
use Hash;
use Image;
use App\Models\Post;
use App\Models\Group;
use App\Models\PostGroup;
use App\Models\Option;
use Str;
use ZipArchive;
use File;
use View;
use Illuminate\Http\Request;
class MasterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      
      $this->middleware('auth');

      $this->middleware(function ($request, $next){
      if(Auth::user()->level !=='admin'){
  return Redirect::to(admin_path().'/dashboard')->send()->with('danger','Akses Dibatasi');
}

if($_SERVER['SERVER_NAME']!=get_option('site_url')){
  return redirect(str_replace($_SERVER['SERVER_NAME'],get_option('site_url'),url()->current()))->send();
 }
  return $next($request);

});
    }


function template(Request $req){

  $data = array(
    [
        'id'=>1,
        'author'=>['name'=>'Heri Maulanan','email'=>'heri@gmail.com','website'=>'template.com'],
        'name'=>'Book Library',
        'path'=>'book',
        'thumb'=>'https://pustaka.get.web.id/upload/berita/2023/vYe8j9Pmqb/2023-06-07-112150-96979935746-zakat-satu.jpg',
        'version'=>'1.5',
        'type'=>'Instansi',
        'used'=>'200',
        'download'=>url('book-versi-1.zip'),
        'status'=>'beta',
    ],
    [
        'id'=>4,
        'author'=>['name'=>'Basmani','email'=>'basamani@gmail.com','website'=>'template.com'],
        'name'=>'Standard',
        'path'=>'metropolis',
        'thumb'=>'https://dinsos.bengkaliskab.go.id/upload/berita/24102022103201_inov1.jpg',
        'version'=>'1.2',
        'type'=>'sekolah',
        'used'=>'200',
        'download'=>'200',
        'status'=>'beta',
    ]
    );
    $selected_template =  collect($data)->where('id',$req->select)->first();

    $data = json_decode(json_encode($data));
    if($req->select){
  if(!empty($selected_template)){
    if($req->apply){

      $filename = 'template.zip';
      $tempImage = tempnam(sys_get_temp_dir(), $filename);
      copy($selected_template['download'], $tempImage);

      $zip = new ZipArchive;
      if ($zip->open($tempImage) === TRUE) {
      // dd('berhasil');
          // if($zip->setPassword(get_option('passbackup'))):
          // if($zip->getFromName($resfile['type'].".lw"))
          $zip->extractTo(base_path('templates'));
          $zip->close();
      if(File::moveDirectory(base_path('templates/'.$selected_template['path'].'/assets'), public_path('template/'.$selected_template['path']))){
        Option::whereName('template')->update(['value'=>$selected_template['path']]);
        $this->recache_option();
        return back()->with('success','Template Berhasil Diterapkan');
      }else{
        return back()->with('danger','Template Gagal Diterapkan');

      }             

      }
    
    }
  }
  else{
    return redirect(url()->current())->with('warning','Tempate Tidak Ditemukan');
  }
}
  return view('admin.template',['data'=>$data,'detail'=>json_decode(json_encode($selected_template))]);
}
    function scraper(Request $r){
      return view('admin.scraper');
    }
    function org(){
      return array(
        ['Nama Organisasi','nama_organisasi'],
        ['Singkatan Nama','singkatan_organisasi'],
        ['Deskripsi Organisasi','deskripsi_organisasi'],
        ['Alamat','alamat'],
        ['No Telpon','telp'],
        ['Fax','fax'],
        ['Email','email'],
        ['Latitude','latitude'],
        ['Longitude','longitude'],
        ['Facebook','facebook'],
        ['Youtube','youtube'],
        ['Instagram','instagram']);
    }
    function site(){
      return array(
        ['Alamat Situs Web','site_url','text'],
        ['Nama Situs Web','site_title','text'],
        ['Deskripsi Situs Web','site_description','text'],
        ['SEO Meta Keyword','site_meta_keyword','text'],
        ['SEO Meta Description','site_meta_description','text'],
        ['Postingan Perhalaman','post_perpage','number'],
      );
    }
    function cekop($key){
      return (Option::where('name',$key)->count() > 0) ? true : false;
    }
    public function settings(Request $req){
      if($req->save_setting){
        if(config('module.setting')):
        foreach(json_decode(json_encode(config('module.setting'))) as $r){
          foreach ($r->form as $value) {
            $v= $value->field;
            if(!$this->cekop($v)){
              if($req->$v):
              Option::insert(['name'=>$v,'value'=>($req->$v) ? ($value->type=='file' ? $this->upload_data($req->$v,$v,$r->id) : $req->$v) : null]);
            endif;
            }else {
              $old = $v.'_old';
              Option::where(['name'=>$v])->update(['value'=>($req->$v) ? ($value->type=='file' ? $this->upload_data($req->$v,$v,$r->id) : $req->$v) : $req->$old]);
            }
          }
        }
      endif;
        foreach ($this->site() as $key => $value) {
          if(!$this->cekop($value[1])){
            Option::insert(['name'=>$value[1],'value'=>$req->input($value[1])]);
          }else {
            Option::where(['name'=>$value[1]])->update(['value'=>$req->input($value[1])]);
          }
        }

        foreach ($this->org() as $key => $value) {
          if(!$this->cekop($value[1])){
            Option::insert(['name'=>$value[1],'value'=>$req->input($value[1])]);
          }else {
            Option::where(['name'=>$value[1]])->update(['value'=>$req->input($value[1])]);
          }
        }
        if($req->home_page){
          if(!$this->cekop('home_page')){
            Option::insert(['name'=>'home_page','value'=>$req->home_page]);
          }else {
            Option::where(['name'=>'home_page'])->update(['value'=>$req->home_page]);
          }
        }else {
          Option::where(['name'=>'home_page'])->update(['value'=>'default']);
        }
        if($req->site_maintenance){
          Option::where(['name'=>'site_maintenance'])->update(['value'=>$req->site_maintenance]);

        }
        if($req->admin_path){
          Option::where(['name'=>'admin_path'])->update(['value'=>$req->admin_path]);
          
        }
        if($req->file('logo')){
          $logoname = $this->upload_file($req->file('logo'),'logo');
          if($logoname){
            Option::where('name','logo')->update(['value'=>$logoname]);
          }
          }
          if($req->file('favicon')){
            $favname = $this->upload_file($req->file('favicon'),'favicon');
            if($favname){
              Option::where('name','favicon')->update(['value'=>$favname]);
            }
            }

            if($req->file('background')){
              $bgname = $this->upload_file($req->file('background'),'background');
              if($bgname){
                Option::where('name','background')->update(['value'=>$bgname]);
              }
              }

              if($req->admin_path != get_option('admin_path')):
             $this->recache_option();
              return redirect($req->admin_path.'/pengaturan')->with('success','Perubahan Pengaturan Tersimpan');
              else:
                $this->recache_option();

        return back()->with('success','Perubahan Pengaturan Tersimpan');
              endif;
      }

      return view('admin.setting',['site'=>$this->site(),'org'=>$this->org()]);
    }
    public function security(){
        return view('admin.security');
      }
      public function users(Request $req){
        if($req->delete){
            Posts::where('author_id',$req->delete)->update(['author_id'=>1]);
              DB::table('users')->where('id',$req->delete)->delete();
              return back()->with('success','Hapus Pengguna Sukses');

        }
        if($req->save){
          if($req->save=='add'){
            $data = array(
              'name'=>$req->name ?? '',
              'email'=>$req->email ?? '',
              'slug'=> Str::slug($req->name),
              'level'=> $req->level,
              'url'=> 'author/'.Str::slug($req->name),
              'photo'=> $this->upload_file($req->file('photo'),underscore($req->name).'_'.rand()) ?? 'user.png',
              'username'=>$req->username ?? '',
              'password'=> Hash::make($req->password) ?? '',
              'status'=>$req->status ?? 'Nonaktif'
            );
            DB::table('users')->insert($data);
            return back()->with('success','Tambah Pengguna Sukses');
          }else {
            DB::table('users')->where('id',dec64($req->save))
            ->update([
              'level'=> $req->level,'status'=>$req->status ?? 'Nonaktif','photo'=>($req->file('photo'))? $this->upload_file($req->file('photo'),underscore($req->name).'_'.rand()) : $req->oldphoto,'name'=>$req->name,'profile_url'=> 'author/'.Str::slug($req->name),'slug'=>Str::slug($req->name),'email'=>$req->email,'username'=>$req->username,'password'=> ($req->password)? Hash::make($req->password) : $req->oldpass]);
            return back()->with('success','Edit Pengguna Sukses');

          }
        }
          $users = DB::table('users')->where('id','!=',Auth::user()->id)->get();
          return view('admin.users',compact('users'));
        }
        function upload_file_temp($files,$fname){
          if ($files) {
                               $img = Image::make($files);
                               $path = public_path('profile/');
                               $name = $fname.'.' . $files->getClientOriginalExtension();
                               $img->resize(null, 500, function ($constraint) {
                                   $constraint->aspectRatio();
                                   $constraint->upsize();
                               });
                               $img = $img->save($path . $name);
                           }
            return $name;
        }

        function account(Request $req){
          $data = Auth::user();
          if($req->save){
            DB::table('users')->where('id',$data->id)
            ->update(['photo'=>($req->file('photo'))? $this->upload_file_temp($req->file('photo'),underscore($req->name).'_'.rand()) : $req->oldphoto,'name'=>$req->name,'email'=>$req->email,'username'=>$req->username,'password'=> ($req->password)? Hash::make($req->password) : $req->oldpass]);
            return back()->with('success','Perubahan Tersimpan');
          }
          return view('admin.akun',compact('data'));
        }
        function makedatabackup($type){
          $data = array('posts'=>json_decode(Post::where('post_type',$type)->get(),true),'group'=>json_decode(Group::with('group')->where('type',$type)->get(),true));
          $name = $type.'.lw';
          $path = public_path('backup/');
          $file = $path.$name;
          $myfile = fopen($file, "w") or die("Unable to open file!");
          fwrite($myfile, enc64(json_encode($data)));
          fclose($myfile);
          return $file;
        }
        function log_restore($type){
          $r =  fopen(public_path('backup/restore.log'), "r");
          $read = fgets($r);
          fclose($r);
          $data = json_decode($read,true);
          // dd($current);
          $cek = collect($data)->where('type',$type)->first();
          $current = $data !=null ? (empty($cek) ? $data : array()) : array();
          if(empty($cek)):
          array_push($current,['type'=>$type,'last_restore'=>date('Y-m-d H:i:s')]);
        else:
          foreach ($data as $key => $value) {
            if($value['type']==$type){
              $a['type']=$value['type'];
              $a['last_restore']=date('Y-m-d H:i:s');
            }
            else {
              $a['type']=$value['type'];
              $a['last_restore']=$value['last_restore'];
            }
            array_push($current,$a);
          }
        endif;
          $path = public_path('backup/');
          $file = $path.'restore.log';
          $myfile = fopen($file, "w") or die("Unable to open file!");
          fwrite($myfile, json_encode($current));
          fclose($myfile);
        }
        function log_backup($type){
          $r =  fopen(public_path('backup/backup.log'), "r");
          $read = fgets($r);
          fclose($r);
          $data = json_decode($read,true);
          // dd($current);
          $cek = collect($data)->where('type',$type)->first();
          $current = $data !=null ? (empty($cek) ? $data : array()) : array();
          if(empty($cek)):
          array_push($current,['type'=>$type,'last_backup'=>date('Y-m-d H:i:s')]);
        else:
          foreach ($data as $key => $value) {
            if($value['type']==$type){
              $a['type']=$value['type'];
              $a['last_backup']=date('Y-m-d H:i:s');
            }
            else {
              $a['type']=$value['type'];
              $a['last_backup']=$value['last_backup'];
            }
            array_push($current,$a);
          }
        endif;
          $path = public_path('backup/');
          $file = $path.'backup.log';
          $myfile = fopen($file, "w") or die("Unable to open file!");
          fwrite($myfile, json_encode($current));
          fclose($myfile);
        }

        public function backup(Request $req){
          if($req->type){
            
            $type = $req->type;
          // dd(public_path('upload/'.$type));

            $zip = new \ZipArchive;
            $zname = public_path('backup/'.Str::slug($type.' '.now()).'.zip');
              if (true === ($zip->open($zname, ZipArchive::CREATE | ZipArchive::OVERWRITE))) {
                $zip->setPassword(get_option('passbackup'));

                if(disk_used($type) != 0):
                foreach (File::allFiles(public_path('upload/'.$type)) as $file)
                {
                  // dd(public_path('upload/').' --- '.realpath($file).' --- '.Str::beforeLast(realpath($file),$type));
                    $fn = str_replace(Str::beforeLast(realpath($file),$type),'',realpath($file));
                    // dd($fn);
                    $zip->addFile(realPath($file), $fn);
                    $zip->setEncryptionName($fn, ZipArchive::EM_AES_256);

                }
              endif;
                $lw = $this->makedatabackup($type);
                $fn = $type.'.lw';
                $zip->addFile($lw,$fn);
                $zip->setEncryptionName($fn, ZipArchive::EM_AES_256);
              } else {
                  echo 'error';
              }
              $zip->close();
              unlink($lw);

              $this->log_backup($type);
              return response()->download($zname)->deleteFileAfterSend(true);
          }

          if($req->file('resfile')){
            return session()->put('restore',['type'=>dec64($req->typeres),'path'=>$this->upload_file($req->file('resfile'),time().'-'.dec64($req->typeres))]);
          }
          if(session()->has('restore')){
            // session()->forget('restore');
            $resfile = session()->get('restore');
            $zip = new ZipArchive;

if ($zip->open(public_path($resfile['path'])) === TRUE) {

    if($zip->setPassword(get_option('passbackup'))):
    if($zip->getFromName($resfile['type'].".lw"))
    $zip->extractTo(public_path('upload'));
    $zip->close();
    if(file_exists(public_path('upload/'.$resfile['type'].'.lw'))):
    $r =  fopen(public_path('upload/'.$resfile['type'].'.lw'), "r");
    $read = fgets($r);
    fclose($r);
    $data = json_decode(dec64($read),true);
    foreach ($data['posts'] as $key => $value) {
      if(Post::where('post_id',$value['post_id'])->count()==0){
      Post::insert($value);
    }
  }
    if(count($data['group']) > 0):
      // dd($data['group']);
    foreach ($data['group'] as $key => $value) {
      if(Group::where('id',$value['id'])->count()==0){
        if(count($value['group'])>0){
          foreach($value['group'] as $rv){
            if(PostGroup::wherePostId($rv['post_id'])->whereGroupId($rv['group_id'])->count()==0){
              PostGroup::insert($rv);
            }
          }
        }
        unset($value['group']);
      Group::insert($value);

    }
  }
  endif;
  // dd($resfile['type']);
    $this->log_restore($resfile['type']);
    unlink(public_path('upload/'.$resfile['type'].'.lw'));
    unlink(public_path($resfile['path']));
    session()->forget('restore');
    return redirect(admin_path().'/backup-manager')->with('success','Restore Data Berhasil');
  endif;

endif;
} else {
    unlink(public_path('upload/'.$resfile['type'].'.lw'));
    session()->forget('restore');
    return redirect(admin_path().'/backup-manager')->with('danger','Restore Data Gagal. Berkas Backup .ZIP Ilegal');
    dd('Unzipped Process failed');
}
unlink(public_path($resfile['path']));

session()->forget('restore');
return redirect(admin_path().'/backup-manager')->with('danger','Restore Data Gagal. Berkas Backup .ZIP Ilegal');
            return view('admin.restore');
          }else {
            return view('admin.backup');
          }
          }
          function upload_file($req,$fname){
          if(!allowed_ext($req->getClientOriginalExtension()))
          {
            return false;
          }
          else {
          $path = public_path('/');
          $name = $fname.".".$req->getClientOriginalExtension();
          $req->move($path, $name);
          return $name;
          }
          }

          function upload_data($req,$fname,$dir){
          if(!allowed_ext($req->getClientOriginalExtension()))
          {
            return false;
          }
          else {
          $path = public_path($dir.'/');
          if(!is_dir($path)){
          mkdir($path);
          }
          $name = $dir.'/'.$fname.".".$req->getClientOriginalExtension();
          $req->move($path, $name);
          return $name;
          }
          }
          function menu(){
          return view('admin.menu');
          }
}

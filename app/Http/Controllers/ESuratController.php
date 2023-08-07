<?php
namespace App\Http\Controllers;
use App\Models\Posts;
use App\Models\PostView;
use App\Models\Group;
use App\Models\User;
use App\Models\PublicPost;
use Illuminate\Http\Request;
use Str;
use View;
use Hash;
use Auth;
class ESuratController extends Controller
{
 function __construct(){
  $this->middleware(function ($request, $next)
  {
      // if (!session('rt'))
      // {
      //  return undermaintenance();
      // }
     
      $this->add_visitor();
    View::share('post',new PublicPost);
      return $next($request);
  });
   
 }
 function cek_rt_rw($user){
  $id = User::where('id',$user)->select('username')->first()->username;
  $cekrt = PublicPost::wherePostType('rt')->where('data_field','like','%"user":"'.$id.'"%')->first();
  $data['rt'] = _field($cekrt,'nama_pejabat');
  $cekrw = PublicPost::wherePostType('rw')->wherePostId($cekrt->post_parent)->first();
  $data['rw'] = _field($cekrw,'nama_pejabat');
  return $data;
 }
 function cetak_surat($id){

  $post = new PublicPost;
  $p = $post->wherePostId($id)->first();

  $kolom = collect(get_module())->where('name','permohonan')->first()['custom_field'];
  $cek = $post->wherePostId($p->post_parent)->wherePostType('layanan')->first();
  $template = new \PhpOffice\PhpWord\TemplateProcessor(public_path(_field($cek,'template')));
  $data_field = json_decode($p->data_field,true);
  foreach(collect($kolom)->where([1],'!=','array')->where([1],'!=','break') as $r){
    $field = underscore($r[0]);
    $data[$field] = $data_field[$field];
  }
  foreach(collect(_loop($cek))->where('jenis','!=','Break')->where('status','Aktif') as $r){
    $k = underscore($r->kolom);
    if($r->jenis!='File'){
      if($r->jenis=='Date'){

      $data[$k.'_ori'] = $data_field['data'][$k];
      $data[$k] = tglindo($data_field['data'][$k],true);
    }
    elseif($r->jenis=='Array'){
      $array_data =  $data_field['data'][$k];
    
    }
    else{

      $data[$k] = $data_field['data'][$k];
    }
    }
  
 }
 $cekttd = $post->wherePostId($p->mime_type)->first();

 $data['an'] = _field($cekttd,'nama_jabatan')=='Lurah Kota Bengkalis' ? '' : 'a.n.';
 $data['jabatan_an'] = _field($cekttd,'nama_jabatan')=='Lurah Kota Bengkalis' ? '' : Str::upper(_field($cekttd,'nama_jabatan')); 
 $data['pejabat_ttd'] = $cekttd->post_title;
 $data['pangkat_ttd'] = _field($cekttd,'pangkat');
 $data['nip_ttd'] = _field($cekttd,'nip');
 $data['filename'] = $p->post_title;
 $data['tanggal_cetak'] = tglindo($p->post_meta_description,true);
 $data['nomor_surat'] = $p->post_meta_keyword;
 $cekrtrw = $this->cek_rt_rw($p->author_id);
 $data['nama_rt'] = $cekrtrw['rt'];
 $data['nama_rw'] = $cekrtrw['rw'];
 $data['path'] = 'upload/permohonan/'.date('Y', strtotime($p->created_at)).'/'.$p->post_id;
 switch($cek->post_name){
  case 'surat-keterangan-kematian':
    $data['hari'] =  harindo(date('w',strtotime($data['tanggal_ori'])));
    $data['tgl'] =  date('d',strtotime($data['tanggal_ori']));
    $data['bln'] =  date('m',strtotime($data['tanggal_ori']));
    $data['thn'] =  date('Y',strtotime($data['tanggal_ori']));
    $data['sb'] = $data['penyebab_kematian'] == 'Sakit biasa/Tua' ? '√':'';
    $data['wp'] = $data['penyebab_kematian'] == 'Wabah Penyakit' ? '√':'';
    $data['kc'] = $data['penyebab_kematian'] == 'Kecelakaan' ? '√':'';
    $data['kr'] = $data['penyebab_kematian'] == 'Kriminalitas' ? '√':'';
    $data['bd'] = $data['penyebab_kematian'] == 'Bunuh diri' ? '√':'';
    $data['dll'] = $data['penyebab_kematian'] == 'Lainnya' ? '√':'';

    $data['dr'] = $data['yang_menerangkang'] == 'Dokter' ? '√':'';
    $data['tk'] = $data['yang_menerangkang'] == 'Tenaga Kesehatan' ? '√':'';
    $data['po'] = $data['yang_menerangkang'] == 'Kepolisian' ? '√':'';
    $data['ll'] = $data['yang_menerangkang'] == 'Lainnnya' ? '√':'';

    break;
  case 'surat-keterangan-kelahiran':
    $data['l'] = $data['jenis_kelamin'] == 'Laki-laki' ? '√':'';
    $data['p'] = $data['jenis_kelamin'] == 'Perempuan' ? '√':'';

    $data['rs'] = $data['tempat_dilahirkan'] == 'Rumah Sakit/Rumah Bidan' ? '√':'';
    $data['pk'] = $data['tempat_dilahirkan'] == 'Puskesmas' ? '√':'';
    $data['rm'] = $data['tempat_dilahirkan'] == 'Rumah' ? '√':'';

    $data['tg'] = $data['jenis_kelahiran'] == 'Tunggal' ? '√':'';
    $data['k2'] = $data['jenis_kelahiran'] == 'Kembar 2' ? '√':'';
    $data['k3'] = $data['jenis_kelahiran'] == 'Kembar 3' ? '√':'';

    $data['k_ke'] = $data['kelahiran_ke'];

    $data['dr'] = $data['penolong_kelahiran'] == 'Dokter' ? '√':'';
    $data['pr'] = $data['penolong_kelahiran'] == 'Bidan/Perawat' ? '√':'';
    $data['dk'] = $data['penolong_kelahiran'] == 'Dukun' ? '√':'';

    $data['bb'] = $data['berat_bayi'];
    $data['cm'] = $data['panjang_bayi'];
    $data['pkl'] =  $data['pukul'];

    $data['hari'] =  harindo(date('w',strtotime($data['tanggal_lahir_anak'])));
    $data['tgl'] =  date('d',strtotime($data['tanggal_lahir_anak']));
    $data['bln'] =  date('m',strtotime($data['tanggal_lahir_anak']));
    $data['tahun'] =  date('Y',strtotime($data['tanggal_lahir_anak']));
    break;
  case 'surat-keterangan-penghasilan-orang-tua':
    $data['terbilang'] = terbilang($data['penghasilan_perbulan']).' rupiah';
    $data['tg'] = terbilang($data['jumlah_tanggungan']);
    $data['penghasilan_perbulan'] = rupiah($data['penghasilan_perbulan']);
    $template->cloneRowAndSetValues('no2', $array_data);
    foreach ($array_data as $key => $vl) {
      $ky = $key+1;
      $template->setValue('no2'.'#'.$ky,$ky);
    }
    break;
  case 'surat-pengantar-pindah-antar-kabupaten-kota-provinsi':
  case 'surat-pengantar-pindah-antar-kecamatan-dalam-satu-kabupaten-kota':
    $thedata = array();
    foreach($array_data as $key=>$value){
        foreach(['nik_keluarga','nama_keluarga','masa_berlaku_ktp'] as $k){
            if($k!='masa_berlaku_ktp'){
            if(!is_null($value[$k]) ||$value[$k] != ''){
                $n[$k] = $value[$k];
            }
        }else{
            $n['masa_berlaku_ktp'] = $value[$k];
        }
        }
        if(isset($n))
        array_push($thedata,$n);
    }
    array_unshift($thedata,[
        'nik_keluarga'=>$data['nik_pemohon'],
        'nama_keluarga'=>$data['nama_pemohon'],
        'masa_berlaku_ktp'=>null,
        ]);
    $data['rt_p'] = $data['rt_tujuan'];
    $data['rw_p'] = $data['rw_tujuan'];
    $data['ap'] = match($data['alasan_pindah']){
      'Pekerjaan' => '1',
      'Pendidikan' => '2',
      'Keamanan' => '3',
      'Kesehatan' => '4',
      'Perumahan' => '5',
      'Keluarga' => '6',
      default=>''
    };
    $data['jp'] = match($data['jenis_kepindahan']){
      'Kep. Keluarga'=>'1',
      'Kep. Keluarga dan Seluruh Anggota Keluarga'=>'2',
      'Kep. Keluarga dan Sbg Angg.Keluarga'=>'3',
      'Angg.Keluarga'=>'4',
      default=>''
    };
    $data['t'] = match($data['status_kk_bagi_yang_tidak_pindah']){
      'Numpang KK'=>'1',
      'Membuat KK Baru'=>'2',
      'Nomor KK Tetap'=>'3',
      default=>''
    };
    $data['kabupaten_kota'] = $data['kabupaten___kota'];
    $data['p'] = match($data['status_kk_bagi_yang_tidak_pindah']){
      'Numpang KK'=>'1',
      'Membuat KK Baru'=>'2',
      'Nomor KK Tetap'=>'3',
      default=>''
    };
    break;
  case 'surat-pengantar-nikah':
    if($data['agama']!='Islam'){
  $template = new \PhpOffice\PhpWord\TemplateProcessor(public_path(_field($cek,'template2')));
    }
  if($data['jenis_kelamin']=='Laki-laki'){
    $data['bin_pemohon'] = 'Bin';
    $data['bin_pasangan'] = 'Binti';
    $data['status_jejaka'] =  $data['status'];
    $data['status_perawan'] =  '-';
    $data['jk_pasangan'] =  'Perempuan';
  }else{
    $data['bin_pemohon'] = 'Binti';
    $data['bin_pasangan'] = 'Bin';
    $data['status_jejaka'] =  '-';
    $data['status_perawan'] =  $data['status'];
    $data['jk_pasangan'] =  'Laki-laki';

  }
  break;
  case 'surat-keterangan-pindah-antar-desa':
    $thedata = array();
    foreach($array_data as $key=>$value){
        foreach(['nama_pengikut','jenis_kelamin_pengikut','status_pengikut','pendidikan_pengikut','nik_pengikut'] as $k){
            if(!is_null($value[$k]) ||$value[$k] != ''){
                $n[$k] = $value[$k];
            }
           
        }
        if(isset($n))
        array_push($thedata,$n);
    }
    array_unshift($thedata,[
    'nama_pengikut'=>$data['nama_pemohon'],
    'jenis_kelamin_pengikut'=>$data['jenis_kelamin'],
    'status_pengikut'=>$data['status_kawin'],
    'pendidikan_pengikut'=>$data['pendidikan'],
    'nik_pengikut'=>$data['nik_pemohon']
    ]);

    $data['islam'] = $data['agama']=='Islam' ? 'X' :'';
    $data['kristen'] = $data['agama']=='Kristen Protestan' ? 'X' :'';
    $data['katholik'] = $data['agama']=='Katholik' ? 'X' :'';
    $data['budha'] = $data['agama']=='Budha' ? 'X' :'';
    $data['hindu'] = $data['agama']=='Hindu' ? 'X' :'';

    $data['bk'] = $data['status_kawin']=='Belum Kawin' ? 'X' :'';
    $data['kw'] = $data['status_kawin']=='Kawin' ? 'X' :'';
    $data['janda'] = $data['status_kawin']=='Janda/Duda' ? 'X' :'';

    $data['sd'] = $data['pendidikan']=='SD' ? 'X' :'';
    $data['sltp'] = $data['pendidikan']=='SLTP' ? 'X' :'';
    $data['slta'] = $data['pendidikan']=='SLTA' ? 'X' :'';
    $data['univ'] = $data['pendidikan']=='Universitas' ? 'X' :'';
    $data['ts'] = $data['pendidikan']=='Tidak Sekolah' ? 'X' :'';
    $data['tt'] = $data['pendidikan']=='Tidak Tamat SD' ? 'X' :'';
    $data['wni'] = $data['kewarganegaraan']=='WNRI' ? 'X' :'';
    $data['asing'] = $data['kewarganegaraan']=='Orang Asing' ? 'X' :'';
    

    break;
  default:
  break;
 }
 if(isset($array_data)){
  $template->cloneRowAndSetValues('no', $thedata ?? $array_data);
  foreach ($thedata  ?? $array_data as $key => $vl) {
    $ky = $key+1;
    $template->setValue('no'.'#'.$ky,$ky);
  }

 }
  $template->setValues($data);
  $docname = $data['path'].'/'.$data['filename'].'.docx';
  $docpath = public_path($docname);
  $template->saveAs($docpath);
  return response()->download($docpath)->deleteFileAfterSend(true);
}
  function index(Request $req, PublicPost $ps)
  {
    $p = null;
    if($req->lacak){
      $p = $ps->wherePostTitle(Str::upper($req->kode))->first();
      if(empty($p))
      return back()->with('danger','Kode Permohonan <b>'.$req->kode.'</b> Tidak Ditemukan');

    }
    return view('e-surat.index',compact('p'));
  }
  function needsession(){
    if(!session()->has('rt')){
      return redirect('login')->send()->with('danger','Mohon login terlebih dahulu');
    }
  }
  function logout(){
    session()->flush();
    return redirect('login')->send()->with('danger','Anda telah keluar');
  }
  function login(Request $req){
    if($req->login){
      $cek = User::whereLevel('rt')->whereUsername($req->username)->first();
      if($cek && Hash::check($req->password,$cek->password)){
        $rt = Posts::where('data_field','like','%"user":"'.$req->username.'"%')->first();
        session()->put('rt',$cek->id);
        session()->put('rtname',$rt->post_title);
        session()->put('rwname',_field($rt,'rw'));
        return redirect('rt');
      }else{
        return back()->with('danger','Username atau Password Salah!');
      }
    }
    if(session('rt'))
    return redirect('rt');
    return view('e-surat.login');
  }
  function rt(Request $req,Posts $post,$id=null){
    $this->needsession();
    $data = $post->wherePostType('permohonan')->whereAuthor(session('rt'))->orderBy('created_at','desc')->get();
    if($id){
      $p = $data->where('post_id',$id)->first();
      if(empty($p))
      return redirect('rt')->with('danger','Data Tidak Ditemukan');

      if($req->validasi){
        if($req->status == 0){
          $pesan = "Ditolak dg Catatan : ".$req->post_content;
        }else{
          $pesan = "telah diterima & diteruskan ke admin Kelurahan";
        }
        $this->kirimnotif(['msg'=>'Permohonan dgn Kode REG '.$p->post_title.' '.$pesan,'nohp'=>_field($p,'nomor_telp_atau_wa_pemohon')]);

        $post->wherePostId($id)->update(['post_pin'=>$req->status,'post_content'=>$req->post_content]);
        return back()->with('success','Data Berhasil Divalidasi');
      }
    return view('e-surat.detail',compact('p'));

    }
    return view('e-surat.ruangrt',compact('data'));
  }
  function dashboard(){
    dd('ok');
  }
function checkrt(Request $req, Posts $p, $id=null){
  $cekidrw = $p->wherePostTitle($id)->wherePostType('rw')->first();
  if(empty($cekidrw))
  return abort('404');
  $checkrt = $p->wherePostParent($cekidrw->post_id)->wherePostType('rt')->pluck('post_title');
  $v = null;
  foreach($checkrt as $r){
    $v .= '<option value="'.$r.'">'.$r.'</option>';
  }
  return $v;


}
  function permohonan(Request $req, Posts $post,$jenis=null){

    $ac = new \App\Http\Controllers\AdminController;
    $kolom = collect(get_module())->where('name','permohonan')->first()['custom_field'];
    if(!empty($jenis)){
      $cek = $post->wherePostName($jenis)->wherePostType('layanan')->first();
      if(empty($cek))
      return redirect('/');
      switch($cek->post_name){
        case 'surat-keterangan-kematian':
          $rukun = 'Warga yang dilapor';
          break;
          case 'surat-keterangan-usaha':
          $rukun = 'Tempat Usaha';

            break;
            default:
          $rukun = 'Pemohon';

            break;
      }
      if($req->proses){
        // elseif($value->field_type=='array_data'){
        //   $a[$value->field] = array();
        //    $cd = null;
        //   foreach (json_decode($value->desc) as $k => $ar) {
        //     $cd .= $ar->field.',';
        //   }
        //   $jmlh = 0;
        //   foreach (explode(",",rtrim($cd,",")) as $key => $y) {
        //     $jmlh = count($req->$y);
        //   }
        //   for ($i=0; $i<$jmlh; $i++) {
        //     foreach (explode(",",rtrim($cd,",")) as $key => $y) {
        //       $as = $req->$y;
        //       $h[$y] = $as[$i];
        //     }
        //     array_push($a[$value->field],$h);
        //   }
    
        // }
        $idrw = $post->wherePostType('rw')->wherePostTitle($req->rw)->first()->post_id;
        $cekrt = $post->wherePostParent($idrw)->wherePostType('rt')->wherePostTitle($req->rt)->select('data_field','post_title')->first();
        $cfrt = json_decode($cekrt->data_field,true);
        $userrt = \App\Models\User::whereUsername($cfrt['user'])->select('id')->first()->id;
        $id = Str::random(10);
        $time = now();
        $noreg = singkatan($cek->post_title).'-'.date('YmdHis');
        // dd($req->all());
        $post->insert([
          'post_id'=>$id,
          'author'=>$userrt,
          'post_type'=>'permohonan',
          'post_title'=>$noreg,
          'post_status'=>'draft',
          'created_at'=>$time,
          'post_parent'=>$cek->post_id
        ]);
        foreach(collect($kolom)->where([1],'!=','array')->where([1],'!=','break') as $r){
          $field = underscore($r[0]);
          $default[$field] = $req->$field;
        }
        foreach(collect(_loop($cek))->where('jenis','!=','Break')->where('status','Aktif')->sortBy('sort') as $r){
          $k = underscore($r->kolom);
          if($r->jenis=='File'){
            $data[$k] = $ac->upload_file($req->file($k),'permohonan',$id,$time);
          }elseif($r->jenis=='Array'){
          $data[$k] = array();
           $cd = null;
          foreach (json_decode($r->deskripsi) as $m => $ar) {
            $cd .= $ar->field.',';
          }
          $jmlh = 0;
          foreach (explode(",",rtrim($cd,",")) as $key => $y) {
            $jmlh = count($req->$y);
          }

          for ($i=0; $i<$jmlh; $i++) {
            foreach (explode(",",rtrim($cd,",")) as $key => $y) {
              $as = $req->$y;
              $h[$y] = isDate($as[$i]) ? tglindo($as[$i],true) : $as[$i];
            }

            array_push($data[$k],$h);
          }
         
          }
          else{
            $data[$k] = $req->$k;
          }
        }
       
        $default['data'] = $data ?? null;
        $default['jenis_pelayanan'] = $cek->post_title;
        // dd($default);
        $post->wherePostId($id)->update([
          'data_field'=> json_encode($default)
        ]);
        $this->kirimnotif(['msg'=>'1 Permohonan baru harus diverifikasi. Klik di '.url('rt/'.$id),'nohp'=>$cfrt['no_hanphone']]);
        $this->kirimnotif(['msg'=>'Permohonan '.$cek->post_title.' berhasil diajukan dgn kode REG : '.Str::upper($noreg),'nohp'=>$req->nomor_telp_atau_wa_pemohon]);
      
        return back()->with('success',$noreg);
      }
      return view('e-surat.form',['jenis'=>$cek,'kolom'=>$kolom,'rukun'=>$rukun]);  
    }else{
return redirect('/');
    }
  }
  
}
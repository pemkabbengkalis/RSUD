<?php
namespace App\Http\Controllers;
use App\Models\Posts;
use App\Models\PostView;
use App\Models\Group;
use Illuminate\Http\Request;

class CustomController
{
  function swicthMode($req,$func){
    switch ($func) {
      case 'survei-kepuasan-masyarakat':
        return $this->skm($req,$func);
      break;

      default:
        // code...
        break;
    }
  }
  function skm($req){
    $layanan = Posts::where('post_id',$req->layanan);
    $data = !empty($layanan->first()->data_loop) ? json_decode($layanan->first()->data_loop,true) : array();
    array_push($data,[
      'tanggal_survei' => date('Y-m-d'),
      'jam_survei' => date('H:i'),
      'jenis_kelamin' => $req->jenis_kelamin,
      'usia' => $req->usia,
      'pendidikan' => $req->pendidikan,
      'pekerjaan' => $req->pekerjaan,
      'u1' => $req->u1,
      'u2' => $req->u2,
      'u3' => $req->u3,
      'u4' => $req->u4,
      'u5' => $req->u5,
      'u6' => $req->u6,
      'u7' => $req->u7,
      'u8' => $req->u8,
      'u9' => $req->u9,
      'saran' => $req->saran
    ]);
    $layanan->update(['data_loop'=>json_encode($data)]);
    dd($layanan->first());
  }
}

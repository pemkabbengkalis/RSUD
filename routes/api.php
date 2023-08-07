<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('template-store/{type?}',function (){
    $data = array(
        [
            'id'=>1,
            'author'=>['name'=>'Basmani','email'=>'basamani@gmail.com'],
            'author'=>'Basmani',
            'thumb'=>'https://dinsos.bengkaliskab.go.id/upload/berita/01122022090205_juara1.jpg',
            'version'=>'1.2',
            'type'=>'sekolah',
            'used'=>'200',
            'path_download'=>'200',
            'status'=>'beta',
        ],
        [
            'id'=>4,
            'author'=>['name'=>'Basmani','email'=>'basamani@gmail.com'],
            'author'=>'Basmani',
            'thumb'=>'https://dinsos.bengkaliskab.go.id/upload/berita/24102022103201_inov1.jpg',
            'version'=>'1.2',
            'type'=>'sekolah',
            'used'=>'200',
            'path_download'=>'200',
            'status'=>'beta',
        ]
        );
        return response()->json($data);
  });
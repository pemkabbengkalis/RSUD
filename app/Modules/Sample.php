<?php
namespace App\Modules;
class Sample
{

  function __construct()
  {
    new_module([
      'position'=>100,
      'name'=>'buku',
      'title'=>'Perpustakaan',
      'description'=>'Menu Untuk Mengelola Buku',
      'parent'=>false,
      'icon'=>'fa-book',
      'data_title'=>'Judul Buku',
      'custom_column'=>'Penerbit',
      'post_parent'=>false,
      'custom_field'=> array(['Penerbit','text'],
        ['Pengarang','text'],
        ['Penanggung Jawab','text'],
        ['Tempat Terbit','text'],
        ['Tahun Terbit','number'],
        ['ISBN','text'],
      ),
      'looping'=> false,
      'looping_data'=> false,
      'looping_for'=> 'Di Isi Hanya Untuk Kecamatan',
      'thumbnail'=> true,
      'editor'=> false,
      'group'=>true,
      'api'=>true,
      'archive'=>true,
      'index'=>true,
      'detail'=>true,
      'operator'=>true,
      'public'=>true,
      'history'=>false,
      'auto_query'=>false,
      'auto_load'=>true,
      'crud'=>false
    ]);
  use_module(['buku'=>true,'unit-kerja'=>['group'=>true],'kepegawaian'=>['group'=>false,'index'=>true,'detail'=>false],'video'=>['editor'=>false,'custom_field'=>[['Link Youtube','text','required']]],
  'pengumuman'=>['looping'=>'Lampiran'],
  'agenda'=>['custom_field'=>[['Tanggal','date'],['Jam','time'],['Tempat','text'],['Alamat','text']]]
]);

  }
}


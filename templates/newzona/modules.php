<?php 

add_module([
    'position'=>19,
    'name'=>'unit-kerja',
    'title'=>'Unit Kerja',
    'description'=>'Menu Untuk Mengelola Unit Kerja',
    'parent'=>false,
    'icon'=>'fa-desktop',
    'data_title'=>'Nama Unit Kerja',
    'custom_column'=>false,
    'post_parent'=>false,
    'custom_field'=> false,
    'looping'=> false,
    'looping_data'=>array(
      ['Jabatan','text'],
      ['Nama Pejabat','text'],
      ['NIP','text'],
      ['Foto','file']
    ),
    'looping_for'=> 'Silahkan Masukkan Informasi Jabatan',
    'thumbnail'=> false,
    'editor'=> true,
    'group'=>true,
    'api'=>false,
    'archive'=>false,
    'index'=>true,
    'detail'=>true,
    'operator'=>true,
    'public'=>true,
    'history'=>false,
    'auto_query'=>false,
    'auto_load'=>true,
    'status'=>false,
    'crud'=>false
  ]
  );

  add_module([
    'position'=>19,
    'name'=>'kepegawaian',
    'title'=>'Kepegawaian',
    'description'=>'Menu Untuk Mengelola Kepegawaian',
    'parent'=>false,
    'icon'=>'fa-address-card',
    'data_title'=>'Nama Pegawai',
    'custom_column'=>'NIP',
    'post_parent'=>['Unit Kerja','unit-kerja'],
    'custom_field'=>[
      ['NIP','text','required'],
      ['Jabatan','text','required'],
      ['Pendidikan','text','required'],
    ],
    'looping'=> false,
    'looping_data'=>false,
    'looping_for'=> 'Silahkan Masukkan Informasi Jabatan',
    'thumbnail'=> true,
    'editor'=> false,
    'group'=>true,
    'api'=>false,
    'archive'=>false,
    'index'=>true,
    'detail'=>false,
    'operator'=>true,
    'public'=>true,
    'history'=>false,
    'auto_query'=>false,
    'auto_load'=>true,
    'status'=>false,
    'crud'=>false
  ]
  );

  use_module([
    'unit-kerja'=>['group'=>true],
    'sakip'=>true,
    'pengumuman'=>true,
    'kepegawaian'=>['group'=>false,'index'=>true,'detail'=>false],
]);
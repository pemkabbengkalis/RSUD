<?php

use Illuminate\Support\Facades\Facade;
return [
  'info' => null,
  'option' => null,
  'group' => null,
  'master' => null,
  'custom' => null,
  'data' => null,
  'is_admin' => false,
  'master_info' => null,
  'template' => 'none',
  'setting' => array(['id'=>'bs','name'=>'Backup & Restore',
  'form'=>array(['field'=>'passbackup','type'=>'text','name'=>'Password'])],

  ['id'=>'tokenapi','name'=>'Allow API Access','form'=>array(['field'=>'api_allow','type'=>'text','name'=>'List IP Adress'])],
  ['id'=>'komentar','name'=>'Komentar','form'=>array(['field'=>'comment_status','type'=>'text','name'=>'Moderasi Komentar'])]
),
  
  'page_name' => null,
  'post_data' => null,
  'post_id' => null,

];

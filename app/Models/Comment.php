<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = false;
    // protected $fillable = ['name','link','email','post_id','content',''];
public function post()
  {
  return $this->belongsTo(Post::class,'post_id','post_id');
  }
}

<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
class PostGroup extends Model
{
  public $timestamps = false;
  public $incrementing = false;

  public function group(){
    return $this->belongsTo(Group::class);
}
public function post(){
  return $this->hasMany(Post::class,'post_id','post_id');
}

}

<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Group extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    public function post()
    {
        return $this->hasMany(PostGroup::class,'group_id');
    }

}

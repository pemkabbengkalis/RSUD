<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Visitor extends Model
{
    protected $connection = "sqlite";
    protected $table = "tbl_visitor";

}

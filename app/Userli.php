<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userli extends Model
{
  //指定表名
    protected $table='user';
    protected $primarykey='user_id';
    public $timestamps=false;

    // //黑名单
    protected $guarded=[];  
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    //指定表名
    protected $table='Login';
    protected $primarykey='id';
    public $timestamps=false;

    // //黑名单
    protected $guarded=[];  
}

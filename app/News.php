<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //指定表名
    protected $table='news';
    protected $primarykey='news_id';
    public $timestamps=false;

    // //黑名单
    protected $guarded=[];  
}

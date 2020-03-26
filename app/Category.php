<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //指定表名
    protected $table='category';
    protected $primarykey='cate_id';
    public $timestamps=false;

    // //黑名单
    protected $guarded=[];    

}

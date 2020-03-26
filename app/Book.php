<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //指定表名
    protected $table='Book';
    protected $primarykey='Book_id';
    public $timestamps=false;

    // //黑名单
    protected $guarded=[];}

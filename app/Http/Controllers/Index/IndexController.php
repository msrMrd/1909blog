<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller
{

    public function index(){
    	$fine_res=Cache::get('is_fine');
    	if(!$fine_res){
    		$fine_res=Goods::where('is_fine',1)->take(4)->get();
    		Cache::put('is_fine',$fine_res,60*60*24);
    	}
    	$hot_res=Cache::get('is_hot');
    	if(!$hot_res){
    		$hot_res=Goods::where('is_hot',1)->take(4)->get();
    		Cache::put('is_hot',$hot_res,60*60*24);
    	}


        // Redis::flushall();
    	$goods=Redis::get('is_slide');
        // dump($goods);
    	if(!$goods){
    		$goods=Goods::where('is_slide',1)->take(4)->get();
            $goods=serialize($goods);
    		Redis::setex('is_slide',60*60*24,$goods);
    	}
        $goods=unserialize($goods);
        // dump($goods);

    	$pid_res=Cache::get('pid');
    	if(!$pid_res){
    		$pid_res=Category::where('pid',1)->take(4)->get();
    		Cache::put('pid',$pid_res,60*60*24);
    	}
    	//先缓存
    	// $goods=Cache::get('is_slide');
    	// if(!$goods){
    	// $fine_res=Goods::where('is_fine',1)->take(4)->get();
    	// $hot_res=Goods::where('is_hot',1)->take(4)->get();
    	// $pid_res=Category::where('pid',0)->get();
    	// $goods=Goods::select('goods_id','goods_img')->where('is_slide',1)->orderBy('goods_id','desc')->take(5)->get();
    	// // dd($goods);

    	// //存入memcache
    	// Cache::put('is_slide',$goods,60*60*24);
    	// }
    	return view('index.index',['is_fine'=>$fine_res,'is_hot'=>$hot_res,'goods'=>$goods,'pid'=>$pid_res]);
   		
    }

  
}

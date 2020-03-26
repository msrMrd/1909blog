<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Cart;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class GoodsController extends Controller
{
    public function index($id){
        // $count=Cache::add('count_'.$id,1) ? Cache::get('count_'.$id) : Cache::increment('count_'.$id);
        $count=Redis::setnx('count_'.$id,1) ? Redis::get('count_'.$id):Redis::incr('count_'.$id);
        
    	$goods=Goods::where('goods_id',$id)->first();
    	// dd($goods);
    	return view('index.goods',['goods_id'=>$goods,'count'=>$count]);
    }

    public function addcart(Request $request){
        //判断有没有登陆
        $user=session('user');
        if(!$user){
        	return json_encode(['code'=>'00003','msg'=>'用户未登录']);
        }

    	$goods_id=request()->goods_id;
    	$buy_number=request()->buy_number;
    	//根据商品id 查询商品信息

    	$goods=Goods::where('goods_id',$goods_id)->first();
    	// dd($goods_id);
    	if($goods->goods_num<$buy_number){
    		return json_encode(['code'=>'00004','msg'=>'库存不足！']);
    	}
    	//判断用户之前是否添加过商品，如果添加过就更改购买数量即可
    	 $cart=Cart::where(['user_id'=>$user->user_id,'goods_id'=>$goods_id])->first();
    	 // dd($cart->buy_number);
    	 if($cart){
    	 	$buy_number=$cart->buy_number+$buy_number;
    	 	if($goods->goods_num<$buy_number){
    	 		$buy_number=$goods->goods_num;
    	 	}
    	 	$res=Cart::where('cart_id',$cart->cart_id)->update(['buy_number'=>$buy_number]);
    	 }else{
    	 	//添加购物车
    	 	 $data=[
	    		'user_id'=>$user->user_id,
	    		'goods_id'=>$goods_id,
	    		'buy_number'=>$buy_number,
	    		'goods_name'=>$goods->goods_name,
	    		'goods_price'=>$goods->goods_price,
	    		'goods_img'=>$goods->goods_img,
	    		'addtime'=>time()
    		];
    		// dd($data);
    		$res=Cart::insert($data);
    	 }
    	// dd($resa);
    	if($res){
    		return json_encode(['code'=>'00000','msg'=>'添加成功']);    		
    	}
    }

}

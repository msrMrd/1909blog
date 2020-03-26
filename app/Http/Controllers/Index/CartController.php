<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cart;
use App\Goods;
class CartController extends Controller
{
    public function cartlist(){
    	$cart=Cart::all();
    	// dd($cart);
    	return view('index.cartlist',['cart'=>$cart]);
    }
    //购物车总价
    public function getMoney(){
    	$goods_id=request()->goods_id;
    	// echo $goods_id;
    	$user=request()->session()->get('user');
    	// echo $user;
    	$user_id=$user['user_id'];
    

    	$goods_id=explode(',',$goods_id);
    	$res=Cart::whereIn('goods_id',$goods_id)->get();
    	// dump($res);
   		$money=0;
   		foreach($res as $k=>$v){
   			$money+=$v['goods_price']*$v['buy_number'];
  		}
   		// echo $money;
		    return $money;
    }

    //去结算
    public function confirm(){
        $goods_id=request()->goods_id;
        $user=request()->session()->get('user');
        $user_id=$user['user_id'];
        $goods_id=explode(',',$goods_id);
        $res=Cart::whereIn('goods_id',$goods_id)->where('user_id',$user_id)->get();
        // dd($res);
        // //获取总价
        $money=0;
        foreach($res as $k=>$v){
            $money+=$v['goods_price']*$v['buy_number'];
        }
        return view('index.pay',['money'=>$money,'res'=>$res]);
    }
    public function site(){
      return view('index.sitedo');
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
    	echo '我是商品首页';
    }
       public function goods(){
    	echo '来啦老弟！';
    }
    //让文本框显示
    public function add(){
    	// if(request()->isMethod('get')){
    	// 	// redirect('/goods'); //跳转 redirect
    	// 	return view('add');
    	// }
    	// if(request()->isMethod('post')){
    		
    	// echo request()->name;
    	// }
    	// dd(request()->isMethod('get'));die; //用dd 查看是否正确 是true对的 false错的
    	if(request()->isMethod('get')){
    		return view('/add');
    	}
    	if(request()->isMethod('post')){
    		echo request()->name;
    		return redirect('/goods');  //返回数据 再用redirec跳页面  
    	}
    	
    }
     //显示文本框的值
     public function adddo(){
     	echo request()->name;
     	// return redirect('/goods');
     	return redirect('/index');
     }
     public function show($id,$name){
         echo $id."==".$name;
     }
     public function aa($id=null,$name=null){
         echo "Y(^o^)Y";
        echo $id."->".$name;
     }
     public function ne($id=null,$name){
//         echo "为空了";
        echo $id.'->'.$name;
     }
}
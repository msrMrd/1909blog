<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Cookie; 
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
    	return view('/login');
    }
    // public function logindo(){
    // 	$data=request()->except('_token');

    // 	$adminuser=Admin::where('admin_name',$data['admin_name'])->first();

    // 	//如果密码不一致
    // 	if(decrypt($adminuser->admin_pwd)!=$data['admin_pwd']){
    // 		return redirect('/login')->with('msg','用户名或密码错误!');
    // 	}

    //     if(isset($data['rember'])){
    //         //七天免登陆  把用户信息存cookie中
    //         Cookie::queue('adminuser',$adminuser,7*24*60);
    //     }
    // 		session(['adminuser'=>$adminuser]);
    // 		return redirect('/brand/index');
    // }

    public function logindo(){
        $data=request()->except('_token');
        if(Auth::attempt(['email'=>$data['admin_name'],'password'=>$data['admin_pwd']])){
            echo "登陆";
                     return redirect('/brand/index');

            // return redirect()->intended('dashboard');
        }
    
    }
}

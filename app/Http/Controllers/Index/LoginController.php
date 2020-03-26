<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
//短信验证码
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
// 邮箱
use App\Mail\SendCode;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie; //引入门面

use App\Userli as User;
class LoginController extends Controller
{
    public function log(){
    	return view('index.login');
    }

    public function reg(){
    	return view('index.reg');
    }

      //注册手机号
    public function regdo(){
        $arr = request()->except("_token");
        $nameInfo = session('nameInfo');
        // dd($nameInfo);
        //判断账号是否为空是否存在
        if(empty($arr["user_name"])){
            return redirect("/reg")->with("msg","账号不能为空");
        }

        $count=User::where('user_name',$arr['user_name'])->count();
        if($count>0){
            return redirect("/reg")->with("msg","账号已被注册");
        }
        //验证验证码是否为空
        if(empty($arr["user_code"])){
            return redirect("/reg")->with("msg","验证码不能为空");
        }
        //验证密码
        $ags = "/^\w{6,18}$/";
        if(empty($arr["user_pwd"])){
            return redirect("/reg")->with("msg","密码不能为空");
        }else if(!preg_match($ags,$arr["user_pwd"])){
            return redirect("/reg")->with("msg","密码必须由6-18位以上数字，字母，下划线组成");
        }
        if($arr["user_pwd"]!=$arr["user_pwds"]){
            return redirect("/reg")->with("msg","密码跟确认密码不一致");
        }
        $arr["user_pwd"] = encrypt($arr["user_pwd"]);
        $arr["user_pwds"] = encrypt($arr["user_pwds"]);
        //成功
        $arr["user_time"] = time();
        $res = User::create($arr);
        if($res){
            return redirect("/log");
        }
    }
    public function sendSMS(){
    	$name=request()->name;

    	//php 验证手机号

    	$reg='/^1[3|5|6|7|8|9]\d{9}$/';
    	if(!preg_match($reg,$name)){
    		return json_encode(['code'=>'00001','msg'=>'请你输入一个对的手机号或邮箱好不好！']);
    	}

      $count=User::where('user_name',$name)->count();
      // dd($count);
        if($count>0){
          return json_encode(['code'=>'00001','msg'=>'账号已被注册']);
        }

    	$code=rand(100000,999999);
    	$result=$this->send($name,$code);
    	//发送成功
    	if($result['Message']=='OK'){
    		session(['code'=>$code]);
    		return json_encode(['code'=>'00000','msg'=>'发送成功']);	
    	}
    		//发送失败
    	   	return json_encode(['code'=>'00000','msg'=>$result['Message']]);
    }
    public function loginDo(){
   		// $name=request()->admin_name;
   		// $pwd=request()->admin_pwd;
     $post= request()->all();
     // dd($post);
   		$res=User::where('user_name',$post['user_name'])->first();
   		// dd($res);
      if(decrypt($res->user_pwd)!=$post['user_pwd']){
        return redirect('/log')->with('msg','用户名或者密码错误！');
      }
      session(['user'=>$res]);

      if($post['refer']){
        return redirect($post['refer']);
      }

      return redirect('/');
   		// if($res){
   		// 	$res['user_pwd']=decrypt($res['user_pwd']);
   		// 	if($res['user_pwd']==$pwd){
   		// 		session(['admin'=>$name]);
   		// 		return redirect('/');
   		// 	}
   		// }

    }
    //发送短信验证码
    public function send($name,$code){


  		// Download：https://github.com/aliyun/openapi-sdk-php
  		// Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md

  		AlibabaCloud::accessKeyClient('LTAI4FroQ78nyYHWPEHrv4x9', 'uzOxjVuKojKi42U30I4CSmO6jmlaQp')
  		                        ->regionId('cn-hangzhou')
  		                        ->asDefaultClient();

  		try {
  		    $result = AlibabaCloud::rpc()
  		                          ->product('Dysmsapi')
  		                          // ->scheme('https') // https | http
  		                          ->version('2017-05-25')
  		                          ->action('SendSms')
  		                          ->method('POST')
  		                          ->host('dysmsapi.aliyuncs.com')
  		                          ->options([
  		                                        'query' => [
  		                                          'RegionId' => "cn-hangzhou",
  		                                          'PhoneNumbers' => $name,
  		                                          'SignName' => "锤子哥撸串",
  		                                          'TemplateCode' => "SMS_183261709",
  		                                          'TemplateParam' => "{code:$code}",
  		                                        ],
  		                                    ])
  		                          ->request();
  		 	return $result->toArray();
  		} catch (ClientException $e) {
  		    return $e->getErrorMessage() . PHP_EOL;
  		} catch (ServerException $e) {
  		    return $e->getErrorMessage() . PHP_EOL;
  		}
    }

    public function sendEmail(){
      $name=request()->name;

      $reg='/^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/';
      if(!preg_match($reg,$name)){
        return json_encode(['code'=>'00001','msg'=>'请你输入一个对的手机号或邮箱好不好！']);
      }
      //生成验证码
      $code=rand(100000,999999);
      // 发送邮件
      Mail::to($name)->send(new SendCode($code));
      session(['code'=>$code]); //发送成功存session
      return json_encode(['code'=>'00001','msg'=>'发送成功！']);
    }

    public function addcookie(){
      // return response('hello 1909!')->cookie('name','zhhangse',1);
      Cookie::queue(Cookie::make('num','lisi',1));
      // Cookie::queue('age','100',1);
    }

    public function getcookie(){
      echo request()->cookie('age');
    }

    //退出
    public function out(){
      request()->session()->forget('user');
      return redirect('/log');
    }
}

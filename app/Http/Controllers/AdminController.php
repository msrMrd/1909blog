<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Illuminate\validation\Rule;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name=request()->name;
        $pwd=request()->pwd;
        // dump($name);
        // dump($pwd);
        $where=[];

        if($name){
            $where[]=['admin_name','like',"%$name%"];
        }
        if($pwd){
            $where[]=['admin_pwd','like',"%$pwd%"];
        }
        // dump($where);
        $res=Admin::where($where)->paginate(2);
        // dd($res);
        $query=request()->all();
        return view('admin.index',['res'=>$res,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo 123456;
        request()->validate([

            'admin_name'=>'regex:/^[\x{4e00}-\x{9fa5}\w]{2,16}$/u|unique:admin',
            'admin_pwd'=>'required|min:6',
            'admin_email'=>'required|regex:/^\w{3,}@[a-z]{2,}\.com$/',
            'admin_tel'=>'required|regex:/^1[3,5,6,7,8]\d{9}$/'
            ],[
                'admin_name.regex'=>'管理员名字必须我中文，数字，字母，下划线2-16位',
                'admin_name.unique'=>'名称已存在',
                'admin_pwd.required'=>'密码不能为空',
                'admin_pwd.min'=>'密码最少为6位',
                'admin_email.required'=>'邮箱不能为空',
                'admin_email.regex'=>'邮箱格式不对',
                'admin_tel.required'=>'手机号不能为空',
                'admin_tel.regex'=>'手机号不对'
            ]);
        $data=request()->except('_token');
        // dd($data);
        $data['admin_pwd']=md5($data['admin_pwd']);
        if(request()->hasFile('admin_img')){
            $data['admin_img']=upload('admin_img');
            // dd($data['admin_img']);
        }
        $res=Admin::insert($data);
        // dd($res);
        if($res){
            return redirect('admin/index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // echo 12121;
     
        $da=Admin::where('admin_id',$id)->first();
        // dd($da);
        return view('admin.edit',['da'=>$da]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ds=request()->except('_token');
        $ds['admin_pwd']=md5($ds['admin_pwd']);
        request()->validate([
            // 'admin_name'=>'regex:/^[\x{4e00}-\x{9fa5}\w]{2,16}$/u|unique:admin',
             'admin_name'=>[
                'regex:/^[\x{4e00}-\x{9fa5}\w]{2,16}$/u',
                Rule::unique('admin')->ignore($id,'admin_id'),
            ],
            'admin_pwd'=>'required|min:6',
            'admin_email'=>'required|regex:/^\w{3,}@[a-z]{2,}\.com$/',
            'admin_tel'=>'required|regex:/^1[3,5,6,7,8]\d{9}$/'
            ],[
                'admin_name.regex'=>'管理员名字必须我中文，数字，字母，下划线2-16位',
                'admin_name.unique'=>'名称已存在',
                'admin_pwd.required'=>'密码不能为空',
                'admin_pwd.min'=>'密码最少为6位',
                'admin_email.required'=>'邮箱不能为空',
                'admin_email.regex'=>'邮箱格式不对',
                'admin_tel.required'=>'手机号不能为空',
                'admin_tel.regex'=>'手机号不对'
            ]);
        if(request()->hasFile('admin_img')){
            $ds['admin_img']=upload('admin_img');
            // dd($ds['admin_img']);
        }
        $res=Admin::where('admin_id',$id)->update($ds);
        // dd($res);
        if($res!==false){
            return redirect('admin/index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destory($id)
    {
       $res= Admin::where('admin_id',$id)->delete();
       if($res){
            return redirect('admin/index');
       }
    }
}

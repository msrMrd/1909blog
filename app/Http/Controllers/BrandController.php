<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use DB;
use App\Brand;
use App\Http\Requests\StoreBrandPost;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //展示
    public function index()
    {
        // dd(encrypt(123456));
        $name=request()->name;
        // dd($name);
        $where=[];
        if($name){
            $where[]=['brand_name','like',"%$name%"];
        }
        $url=request()->url;
        if($url){
            $where[]=['brand_url','like',"%$url%"];
        }

        // $data=DB::table('brand')->get(); //查询数据
        $data=Brand::where($where)->orderby('brand_id','desc')->paginate(2);
        $query=request()->all();
        return view('brand.index',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //添加展示
    public function create()
    {
        // return view('brand.create');
        return view('brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //添加执行
    public function store(StoreBrandPost $request)
    {

        //第一种验证
        // $validatedData=request()->validate([
        //     'brand_name'=>'required|unique:brand|max:20',
        //     'brand_url'=>'required',
        //     ],[
        //         'brand_name.required'=>'品牌名称必填',
        //         'brand_name.unique'=>'品牌名称已存在',
        //         'brand_name.max'=>'品牌名称最大长度不超过20',
        //         'brand_url.required'=>'品牌网站必填',


        //     ]);
        $post=request()->except('_token');
        // dd($post);
        //文件上传
        if($request->hasFile('brand_logo')){
            $post['brand_logo']=upload('brand_logo');
            // dd($img);
            // echo "ok";die;
        }

        //多文件上传
        if(request()->hasFile('brand_imgs')){
            $brand_imgs=duoupload('brand_imgs');
            // dd($brand_imgs);
            $post['brand_imgs']=implode('|',$brand_imgs);
        }

        // dd($post);
        // $res=DB::table('brand')->insert($post);
        $res=Brand::insert($post); //save 也可以
        // dd($res);
        if ($res) {
            return redirect('brand/index');
        }else{
            return redirect('brand/create');
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
    //修改展示
    public function edit($id)
    {
        // $res=DB::table('brand')->where('brand_id',$id)->first();
        // $Brand=new Brand;
        $res=Brand::where('brand_id',$id)->first();
        // dd($res);
        return view('brand.edit',['res'=>$res]);
        // echo 1111;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //修改执行
    public function update(Request $request,$id)
    {
        $da=$request->except('_token');

        if($request->hasFile('brand_logo')){
            $da['brand_logo']=upload('brand_logo');
            // dd($img);
            // echo "ok";die;
        }
        // dd($da);
        // $res=DB::table('brand')->where('brand_id',$id)->update($da);
        $res=Brand::where('brand_id',$id)->update($da);
        // dd($res);
        if($res !==false){
            return  redirect('brand/index');
        }
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //删除
    public function destory($id)
    {
        // echo 11111;
        // $res=DB::table('brand')->where('brand_id',$id)->delete();
        $res=Brand::where('brand_id',$id)->delete();
        // dd($res);
        if($res){
            return redirect('/index');
        }
    }
}

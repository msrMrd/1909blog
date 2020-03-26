<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use Illuminate\Support\Facades\Redis;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // echo 123456;
            // //存储session
            // session(['name'=>'zhangde']);
            // request()->session()->put('number',200);
            // request()->session()->save();
            // //删除 
            // session (['name'=>null]);
            // request()->session()->forget('number');
            // //删除所有
            // // request()->session()->flush();
            // //获取session
            // echo session('name');
            // echo request()->session()->get('number');
            // //获取所有
            // dump(request()->session()->all());
            // //存
            // session(['name'=>'夏雨']);
            // request()->session()->put('number','夏雪');
            // request()->session()->put('text','夏冰雹');
            // request()->session()->save();
            // //删除
            // session(['name'=>null]);
            // request()->session()->forget('number');
            // request()->session()->forget('text');
            // //取值
            // echo session('name');
            // echo request()->session()->get('number');
            // echo request()->session()->get('text');
            // dump(request()->session()->all());
        // Redis::flushall();
        $page=request()->page??1;
        $name=request()->name??'';       
        $man=request()->man??'';
        $news=Redis::get('goodslist'.$page.'_'.$name.'_'.$man);

        if(!$news){
            echo "DB =====";
            $where=[];
            if($name){
                $where[]=['news_name','like',"%$name%"];
            }

            if($man){
                 $where[]=['news_man','like',"%$man%"];
            }
            $news=News::where($where)->orderby('news_id','desc')->paginate(2);
            // dd($news);
            $query=request()->all();
            $news=serialize($news);
            Redis::setex('goodslist_'.$page.'_'.$name.'_'.$man,5*60,$news);
        } 
            $news=unserialize($news);
            return view('news.index',['news'=>$news,'a'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $news=News::all();
        // dd($news);
        $new=NewsTree($news);
        return view('news.create',['news'=>$news]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function score(Request $request)
    {
        $date=request()->except('_token');
        // dd($date);
        request()->validate([
                'news_name'=>'required|regex:/^[\x{4e00}-\x{9fa5}\w]{2,16}$/u|unique:news',
                'pid'=>'required',
                'news_man'=>'required'
                ],[
                'news_name.required'=>'新闻名称不能为空',
                'news_name.regex'=>'长度为2-30位，需是中文、字母、数字、下划线组成',
                'pid.required'=>'必填',
                'news_name.unique'=>'已存在',
                'news_man.required'=>'作者不能为空',
            ]);
        $res=News::insert($date);
        // dd($res);
        if($res){
            return redirect('news/index');
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

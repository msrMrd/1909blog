<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\Article;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $article_name=request()->name;
        $where=[];
        if($article_name){
            $where[]=['article_name','like',"%$article_name%"];
        }
        // dd($article_name);

        $article=Article::select('article.*','brand.brand_name')
        ->leftjoin('brand','article.brand_id','=','brand.brand_id')
        ->orderby('article_id','desc')
        ->where($where)
        ->paginate(1);
        // dd($article);
        $query=request()->all();
        return view('article/index',['article'=>$article,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $da=Brand::get();
        // dd($da);
        return view('article.create',['da'=>$da]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post=request()->except('_token');
        // dd($post);
        request()->validate([
            'article_name'=>'required|regex:/^[\x{4e00}-\x{9fa5}\w]{2,16}$/u|unique:article',
            'brand_id'=>'required',
            'article_zy'=>'required',
            'article_show'=>'required',
            ],[
            'article_name.required'=>'文章标题不能为空',
            'article_name.regex'=>'文章标题必须为中文',
            'article_name.unique'=>'名字已存在',
            'brand_id.required'=>'分类不能为空',
            'article_zy.required'=>'文章重要性不能为空',
            'article_show.required'=>'文章是否显示不能为空',
            ]);
        if(request()->hasFile('article_img')){
            $post['article_img']=upload('article_img');
        }
        // dd($post);

        $res=Article::insert($post);
        // dd($res);
        if($res){
            return redirect('article/index');
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
        // // echo 123456;
        $da=Brand::get();
        // dd($da);
        $res=Article::where('article_id',$id)->first();
        // dd($res);
        return view('article.edit',['res'=>$res,'da'=>$da]);


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
        $post=request()->except('_token');
        // dd($post);
         request()->validate([
                // 'article_name'=>'required|regex:/^[\x{4e00}-\x{9fa5}\w]{2,16}$/u|unique:article',
                'article_name'=>[
                    'regex:/^[\x{4e00}-\x{9fa5}\w]{2,16}$/u',
                    Rule::unique('article')->ignore($id,'article_id'),
                ],
                'brand_id'=>'required',
                'article_zy'=>'required',
                'article_show'=>'required',
                ],[
                'article_name.required'=>'文章标题不能为空',
                'article_name.regex'=>'文章标题必须为中文',
                'article_name.unique'=>'名字已存在',
                'brand_id.required'=>'分类不能为空',
                'article_zy.required'=>'文章重要性不能为空',
                'article_show.required'=>'文章是否显示不能为空',
                ]);
        if(request()->hasFile('article_img')){
             $post['article_img']=upload('article_img');
            }    

        $res=Article::where('article_id',$id)->update($post);
        // dd($res);
        if($res !==false){
            return redirect('article/index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Article::where('article_id',$id)->delete();
        if($res){
            return redirect('article/index');
        }
    }
}

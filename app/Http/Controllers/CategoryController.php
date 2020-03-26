<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category()
    {
        $res=Category::all();

        return view('category.category',['res'=>$res]);    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cate_tj(Request $request)
    {
        // echo 'wwww';
        $date=request()->except('_token');
        // dd($date);
       $res=Category::insert($date);
        // dd($res);
       if($res){
            return redirect('category/cate_show');
       }else{
            return redirect('category/category');
       }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cate_show()
    {
        $data=Category::orderby('cate_id','desc')->paginate(2);
        // dd($data);die;
        return view('category.cate_show',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // echo $id;
        $data=Category::where('cate_id',$id)->first();
        // dd($res);
        $res=Category::all();
        return view('category.edit',['res'=>$res,'data'=>$data]);
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
        // echo $id;
       $res=$request->except('_token');
        $ca=Category::where('cate_id',$id)->update($res);
        // dd($ca);
        if($ca!==false){
            return redirect('category/cate_show');
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
        $res=Category::where('cate_id',$id)->delete();
        // echo $id;
        if($res){
            return redirect('category/cate_show');
        }
    }
}

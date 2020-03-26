<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Http\Requests\StoreBookPost;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function book_tj()
    {
        return view('book.book_tj');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function book_zx(StoreBookPost $request)
    {
        $data=request()->except('_token');
        // dd($data);
        if(request()->hasFile('book_img')){
            $data['book_img']=$this->uloads('book_img');
            // dd($img);
        }
        $res=Book::insert($data);
        // dd($res);
        if($res){
            return redirect('/book_show');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //文件上传
    public function uloads($img){
        $file=request()->$img;
        // dd($file);
        if($file->isValid()){
            $store=$file->store('uploads');
            return $store;
        }

    }

    public function book_show()
    {
        $name=request()->name;
        $where=[];
        if($name){
            $where[]=['book_name','like',"%$name%"];
        }
        $man=request()->man;
        if($man){
            $where[]=['book_man','like',"%$man%"];
        }
        // echo 1321321;
        $res=Book::where($where)->paginate(2);
        // dd($res);
        $da=request()->all();
        return view('book.book_show',['res'=>$res,'da'=>$da]);
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

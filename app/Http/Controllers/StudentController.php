<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tj()
    {
        return view('student.tj');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function aaa()
    {
        // $da=request()->get();
        // dd($da);
        // echo 111;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function zx(Request $request)
    {
        // echo 111;
        $da=$request->except('_token');
        // dd($da);
        $res=DB::table('student')->insert($da);
        // dd($res);
        if($res){
            return redirect('/show');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // echo 22222;
        $res=DB::table('student')->get();   
        // dd($res); 
        return view('student.show',['res'=>$res]);
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
    public function delete($id)
    {
        // echo 33333;
        $res=DB::table('student')->where('id',$id)->delete();
        // dd($res);
        if($res){
            return redirect('/show');
        }
    }
}

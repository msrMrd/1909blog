<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\Category;
use App\Goods;

use App\Http\Requests\StoreGoodsPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        // echo 123;
        // $use =Auth::user(); //获取用户信息
        // $useid =Auth::id(); //获取用户id
        // $useid =request()->user(); //获取用户信息
        // dd($useid);
        // Auth::logout(); //退出
        // dd(Auth::check()); //检查是否登陆
        // Redis::flushall();
        $page=request()->page??1;
        // dd($page);
        $name=request()->name??'';
        $score=request()->score??'';

        $goods=Redis::get('goodslist_'.$page.'_'.$name.$score);
        // dump('goodslist_'.$page.'_'.$name.$score)
        // dd($goods);

        if(!$goods){
        // echo "DB ===";
        $where=[];
        if($name){
        	$where[]=['goods_name','like',"%$name%"];
        }

        if($score){
        	$where[]=['goods_score','like',"%$score%"];
        }

        $goods=Goods::select('goods.*','brand.brand_name','category.cate_name')
        ->leftjoin('category','goods.cate_id','=','category.cate_id')
        ->leftjoin('brand','goods.brand_id','=','brand.brand_id')
        ->orderby('goods_id','desc')
        ->where($where)
        ->paginate(2);
        // dd($query);
        $goods=serialize($goods);
        $query=request()->all();
        // dd($goods);
        Redis::setnx('goodslist_'.$page.'_'.$name.'_'.$score,5*60,$goods);
      }
        $goods=unserialize($goods);

        return view('goods/index',['goods'=>$goods,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
    	$brand=Brand::get(); //品牌
    	$cate=Category::get(); //分类
    	$cate=CreateTree($cate); //无限极分类
        return view('goods.create',['brand'=>$brand,'cate'=>$cate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function score(Request $request)
    public function score(StoreGoodsPost $request){
        // echo 123;
        $data=request()->except('_token');
        // dd($data);
        // request()->validate([
        //         'goods_name'=>'required|regex:/^[\x{4e00}-\x{9fa5}\w]{2,16}$/u|unique:goods',
        //         'cate_id'=>'required',
        //         'goods_price'=>'required|numeric',
        //         'brand_id'=>'required',
        //         'goods_num'=>'required|max:99999999',
        //         ],[
        //         'goods_name.required'=>'商品名称不能为空',
        //         'goods_name.regex'=>'商品格式不对！长度为2-30位，需是中文、字母、数字、下划线组成',
        //         'cate_id.required'=>'商品分类必填',
        //         'goods_name.unique'=>'已存在',
        //         'goods_price.required'=>'价格不能为空',
        //         'goods_price.numeric'=>'价格必须为数字',
        //         'brand_id.required'=>'商品品牌必填',
        //         'goods_num.required'=>'商品库存必填！',
        //         'goods_num.max'=>'商品库存不能超过8位',
        //     ]);
        //文件上传
        if(request()->hasFile('goods_img')){
        	$data['goods_img']=upload('goods_img');
        	// dd($data['goods_img']);
        }
        //多文件上传
        if(request()->hasFile('goods_imgs')){
        	$goods_imgs=duoupload('goods_imgs');
        	$data['goods_imgs']=implode('|',$goods_imgs);
        	// dd($data['goods_imgs']);
        }
        $res=Goods::insert($data);
        // dd($res);
        if($res){
        	return redirect('goods/index');
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
       	$brand=Brand::get(); //品牌
    	$cate=Category::get(); //分类
    	$goods=Goods::where('goods_id',$id)->first(); //商品
    	$cate=CreateTree($cate); //无限极分类
        return view('goods.edit',['goods'=>$goods,'brand'=>$brand,'cate'=>$cate]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGoodsPost $request, $id)
    {	
    	$data=request()->except('_token');
        // dd($date);
    	//验证
    	 // request()->validate([
      //           // 'goods_name'=>'required|regex:/^[\x{4e00}-\x{9fa5}\w]{2,16}$/u|unique:goods',
    	 // 		'goods_name'=>[
    	 // 			'regex:/^[\x{4e00}-\x{9fa5}\w]{2,16}$/u',
    	 // 			Rule::unique('goods')->ignore($id,'goods_id'),
    	 // 		],
      //           'cate_id'=>'required',
      //           'goods_price'=>'required|numeric',
      //           'brand_id'=>'required',
      //           'goods_num'=>'required|max:99999999',
      //           ],[
      //           'goods_name.required'=>'商品名称不能为空',
      //           'goods_name.regex'=>'商品格式不对！长度为2-30位，需是中文、字母、数字、下划线组成',
      //           'cate_id.required'=>'商品分类必填',
      //           'goods_name.unique'=>'已存在',
      //           'goods_price.required'=>'价格不能为空',
      //           'goods_price.numeric'=>'价格必须为数字',
      //           'brand_id.required'=>'商品品牌必填',
      //           'goods_num.required'=>'商品库存必填！',
      //           'goods_num.max'=>'商品库存不能超过8位',
      //       ]);
    	 //文件上传
        if(request()->hasFile('goods_img')){
        	$data['goods_img']=upload('goods_img');
        	// dd($data['goods_img']);
        }
        //多文件上传
        if(request()->hasFile('goods_imgs')){
        	$goods_imgs=duoupload('goods_imgs');
        	$data['goods_imgs']=implode('|',$goods_imgs);
        	// dd($data['goods_imgs']);
        }
        $res=Goods::where('goods_id',$id)->update($data);
        // dd($res);
        if($res!==false){
        	return redirect('goods/index');
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
        $res=Goods::where('goods_id',$id)->delete();
        if($res){
        	return redirect('goods/index');
        }
    }
}

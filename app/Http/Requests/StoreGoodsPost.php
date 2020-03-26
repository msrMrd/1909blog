<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\validation\Rule;
class StoreGoodsPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $name=\Route::currentRouteName();
        if($name=='goodsscore'){
            // 添加
            return [
                'goods_name'=>'required|regex:/^[\x{4e00}-\x{9fa5}\w]{2,16}$/u|unique:goods',
                'cate_id'=>'required',
                'goods_price'=>'required|numeric',
                'brand_id'=>'required',
                'goods_num'=>'required|max:99999999',
        ];
        }

        if ($name=='goodsupdate') {
            return [
                    'goods_name'=>[
                        'regex:/^[\x{4e00}-\x{9fa5}\w]{2,16}$/u',
                        Rule::unique('goods')->ignore(request()->id,'goods_id'),
                    ],
                    'cate_id'=>'required',
                    'goods_price'=>'required|numeric',
                    'brand_id'=>'required',
                    'goods_num'=>'required|max:99999999',
                
                ];
        }
        
  
    }

    public function messages(){
        return [
                'goods_name.required'=>'商品名称不能为空',
                'goods_name.regex'=>'商品格式不对！长度为2-30位，需是中文、字母、数字、下划线组成',
                'cate_id.required'=>'商品分类必填',
                'goods_name.unique'=>'已存在',
                'goods_price.required'=>'价格不能为空',
                'goods_price.numeric'=>'价格必须为数字',
                'brand_id.required'=>'商品品牌必填',
                'goods_num.required'=>'商品库存必填！',
                'goods_num.max'=>'商品库存不能超过8位',
                ];
    }
}

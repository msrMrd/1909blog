@extends('layouts.shop')
@section('title', '购物车列表')
@section('content')

 <meta name="csrf-token" content="{{ csrf_token() }}">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="static/index/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">2</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(static/index/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     
     <div class="dingdanlist">
        <table>
           <tr>
             <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" /></a></td>
           </tr>
           @foreach($cart as $v)
           <tr>
              <td width="4%"><input type="checkbox" name="1" class="box" goods_id="{{$v->goods_id}}" /></td>
              <td class="dingimg" width="15%"><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}"/></td>
              <td width="50%"  >
             <h3>{{$v->goods_name}}</h3>
             <time>下单时间：{{date("Y-m-d H:i:s",$v->addtime)}}</time>
             <th colspan="4"><strong class="orange">¥{{$v->goods_price}}</strong></th>
             </td>
              <td align="right">
                  <div class="c_num">
                        <input type="text" value="{{$v->buy_number}}" class="car_ipt buy_number">
                  </div>
              </td>
           </tr>
           <tr>
              <th colspan="4"><strong class="orange">¥{{$v->goods_price*$v->buy_number}}</strong></th>
           </tr>
           @endforeach
        </table>
        
     </div><!--dingdanlist/-->
     
     <div class="dingdanlist">
          <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" /> 删除</a></td>
     </div><!--dingdanlist/-->
     <div class="height1"></div>
     <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="money">¥0</strong></td>
       <td width="40%"><a href="javascript:;" class="jiesuan" id="confirm">去结算</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->
<script>
//总价
$(document).on("click",".box",function(){
  // alert(121313);
  var _this=$(this);
  
  var _box=$(".box:checked");
  var goods_id='';
  _box.each(function(index){
    //每个选中的复选框
    goods_id+= $(this).attr("goods_id")+',';
  })

  //取出右边的，截取
  goods_id=goods_id.substr(0,goods_id.length-1);
  // console.log(goods_id);
$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});

    $.post(
        "{{url('/cart/getMoney')}}",
        {goods_id:goods_id},
        function(res){
          // alert(res)
          $(".money").text('￥'+res);
        }
      )
    
})

//去结算
$(document).on("click","#confirm",function(){
  var _box=$(".box:checked");
  if(_box.length>0){
    //得到选中的商品id
    var goods_id='';
    _box.each(function(index){
      goods_id+=$(this).attr('goods_id')+',';

    })
    goods_id=goods_id.substr(0,goods_id.length-1);
    // alert(goods_id);
    location.href="{{url('/confirm')}}?goods_id="+goods_id;

  }else{
    //一件商品未选中
    alert('请至少选择一件商品进行下单');
  }
})
</script>
@endsection

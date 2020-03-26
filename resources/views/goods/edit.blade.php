<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h3>商品表单编辑</h3></center>
<a style="float:right" href="{{url('goods/create')}}" class="btn btn-default">展示</a>
<form action="{{url('goods/update/'.$goods->goods_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-6">
			@csrf
			<input type="text" class="form-control" id="firstname" 
				 name="goods_name"  placeholder="请输入商品名字" value="{{$goods->goods_name}}">
				<b style="color:red">{{$errors->first('goods_name')}}</b>

		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品货号</label>
		<div class="col-sm-6">
			<input type="text" class="form-control" id="lastname" placeholder="请输入商品货号" name="goods_score" value="{{$goods->goods_score}}">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品分类</label>
		<div class="col-sm-6">
			<select class="form-control" name="cate_id">
					<option value="">请选择</option>
					@foreach($cate as $k=>$v)
					<option value="{{$v->cate_id}}"{{$goods->cate_id==$v->cate_id ? "selected" :''}}>{{str_repeat('|--',$v->level)}}{{$v->cate_name}}</option>
					@endforeach
			</select>
			<b style="color:red">{{$errors->first('cate_id')}}</b>

		</div>
	</div>
		<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品商品品牌</label>
		<div class="col-sm-6">
			<select class="form-control"  name="brand_id">
						<!-- <b style="color:red">{{$errors->first('brand_url')}}</b> -->
						<option value="">请选择</option>
						@foreach($brand as $k=>$v)
						<option value="{{$v->brand_id}}"{{$goods->brand_id==$v->brand_id ? "selected" :''}}>{{$v->brand_name}}</option>
						@endforeach
			</select>
			<b style="color:red">{{$errors->first('brand_id')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-6">
			<input type="text" name="goods_price" value="{{$goods->goods_price}}">
			<b style="color:red">{{$errors->first('goods_price')}}</b>

		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-6">
			<input type="text" name="goods_num" value="{{$goods->goods_num}}">
			<b style="color:red">{{$errors->first('goods_num')}}</b>

		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-6">
			<input type="radio" name="is_fine" value="1" {{$goods->is_fine=='1' ? "checked" : ''}}>是
			<input type="radio" name="is_fine" value="2"  {{$goods->is_fine=='2' ? "checked" : ''}}>否
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否热销</label>
		<div class="col-sm-6">
			<input type="radio" name="is_hot" value="1" {{$goods->is_hot=='1' ? "checked" : ''}}>是
			<input type="radio" name="is_hot" value="2" {{$goods->is_hot=='2' ? "checked" : ''}}>否
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品主图</label>
		<div class="col-sm-6">
			<input type="file" name="goods_img">
			<img src="{{env('UPLOADS_URL')}}{{$goods->goods_img}}" width="50" height="50">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品相册</label>
		<div class="col-sm-6">
			<input type="file" name="goods_imgs[]" multiple="multiple">
			@php $goods_imgs=explode('|',$goods->goods_imgs); @endphp
			@foreach($goods_imgs as $kk=>$vv)
				<img src="{{env('UPLOADS_URL')}}{{$vv}}" width="50" height="50">
			@endforeach
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品描述</label>
		<div class="col-sm-10">
			<textarea type="" name="goods_desc">
				{{$goods->goods_desc}}
			</textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
			<button type="submit" class="btn btn-default">编辑</button>
		</div>
	</div>
</form>

</body>
</html>


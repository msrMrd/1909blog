<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 边框表格</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<table class="table table-bordered">
	<caption>商品表显示的数据</caption>
	<a style="float:right" href="{{url('goods/create')}}" class="btn btn-default">添加</a>
	<form>
		商品名称<input type="text" name="name" value="{{$query['name']??''}}">
		货号<input type="text" name="score" value="{{$query['score']??''}}">
		<input type="submit" value="搜索">
	</form>
	<thead>
		<tr>
			<th>id</th>
			<th>商品名称</th>
			<th>商品货号</th>
			<th>商品分类</th>
			<th>商品品牌</th>
			<th>商品价格</th>
			<th>商品库存</th>
			<th>是否显示</th>
			<th>是否热销</th>
			<th>商品主图</th>
			<th>商品相册</th>
			<th>商品描述</th>
		</tr>
	</thead>
	<tbody>
		@foreach($goods as $k=>$v)
		<tr>
		<td>{{$v->goods_id}}</td>
		<td>{{$v->goods_name}}</td>
		<td>{{$v->goods_score}}</td>
		<td>{{$v->cate_name}}</td>
		<td>{{$v->brand_name}}</td>
		<td>{{$v->goods_price}}</td>
		<td>{{$v->goods_num}}</td>
		<td>{{$v->is_fine=='1' ? "√":"×"}}</td>
		<td>{{$v->is_hot=='1' ? "√ ":"×"}}</td>
		<td>@if($v->goods_img)
			<img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" width="50" height="50">
			@endif</td>
		<td>
			@if($v->goods_imgs)
			@php $goods_imgs=explode('|',$v->goods_imgs); @endphp
			@foreach($goods_imgs as $kk=>$vv)
				<img src="{{env('UPLOADS_URL')}}{{$vv}}" width="50" height="50">
			@endforeach
			@endif
		</td>
		<td>
			<a href="{{url('goods/'.$v->goods_id)}}" class="btn btn-success">预览</a>
			<a href="{{url('goods/edit/'.$v->goods_id)}}" class="btn btn-success">编辑</a>
			<a href="{{url('goods/destroy/'.$v->goods_id)}}" class="btn btn-success">删除</a>
		</td>
		</tr>
		@endforeach
	</tbody>
</table>
{{$goods->appends($query)->links()}}

</body>
</html>


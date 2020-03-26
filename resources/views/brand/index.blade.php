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
	<caption>品牌表显示的数据</caption>
	<form>
		品牌名称<input type="text" name="name" value="{{$query['name']??''}}">
		品牌网站<input type="text" name="url" value="{{$query['url']??''}}">
		<input type="submit" value="搜索">
	</form>
	<thead>
		<tr>
			<th>id</th>
			<th>品牌名称</th>
			<th>图片</th>
			<th>相册</th>
			<th>网站</th>
			<th>描述</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $k=>$v)
		<tr>
		<td>{{$v->brand_id}}</td>
		<td>{{$v->brand_name}}</td>
		<td>@if($v->brand_logo)
			<img src="{{env('UPLOADS_URL')}}{{$v->brand_logo}}" width="50" height="50">
			
			@endif</td>
		<td>
			@if($v->brand_imgs)
			@php $brand_imgs=explode('|',$v->brand_imgs); @endphp
			@foreach($brand_imgs as $kk=>$vv)
				<img src="{{env('UPLOADS_URL')}}{{$vv}}" width="50" height="50">
			@endforeach
			@endif
		</td>

		<td>{{$v->brand_url}}</td>
		<td>{{$v->brand_crea}}</td>
		<td>
			<a href="{{url('brand/edit/'.$v->brand_id)}}">编辑</a>
			<a href="{{url('brand/destory/'.$v->brand_id)}}">删除</a>
		</td>
		</tr>
		@endforeach
	</tbody>
</table>
{{$data->appends($query)->links()}}

</body>
</html>

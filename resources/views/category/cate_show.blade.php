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
	<caption>分类表显示的数据</caption>

	<thead>
		<tr>
			<th>id</th>
			<th>分类名称</th>
			<th>父级分类id</th>
			<th>分类描述</th>
			<th>是否显示在导航中</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $v)
		<tr>
		<td>{{$v->cate_id}}</td>
		<td>{{$v->cate_name}}</td>
		<td>{{$v->pid}}</td>
		<td>{{$v->cate_desc}}</td>
		<td>{{$v->cate_nav_show=='1' ? "是":"否"}}</td>
		<td>
			<a href="{{url('category/edit/'.$v->cate_id)}}">编辑</a>
			<a href="{{url('category/destory/'.$v->cate_id)}}">删除</a>
		</td>
		</tr>
		@endforeach
	</tbody>
</table>
	
{{$data->links()}}
</body>
</html>

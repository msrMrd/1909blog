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
<center><h3>表单编辑</h3></center>
<form action="{{url('brand/update/'.$res->brand_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌名称</label>
		<div class="col-sm-6">
			@csrf
			<input type="text" class="form-control" id="firstname" 
				 name="brand_name"  placeholder="请输入品牌名字" value="{{$res->brand_name}}">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌logo</label>
		<div class="col-sm-6">
			<input type="file" class="form-control" id="lastname" name="brand_logo">
			<img src="{{env('UPLOADS_URL')}}{{$res->brand_logo}}" width="50" height="50">

		</div>
	</div>
		<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌网站</label>
		<div class="col-sm-6">
			<input type="text" class="form-control" id="lastname" 
				   placeholder="请输入品牌网站" name="brand_url" value="{{$res->brand_url}}">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌描述</label>
		<div class="col-sm-6">
			<textarea type="text" class="form-control" id="lastname" 
				   placeholder="请输入描述" name="brand_crea">{{$res->brand_crea}}
				</textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
			<button type="submit" class="btn btn-default">修改</button>
		</div>
	</div>
</form>

</body>
</html>


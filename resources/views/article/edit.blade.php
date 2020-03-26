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
<center><h3>文章表单编辑</h3></center>

<form action="{{url('article/update/'.$res->article_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章名称</label>
		<div class="col-sm-6">
			@csrf
			<input type="text" class="form-control" id="firstname" 
				 name="article_name"  placeholder="请输入文章名字" value="{{$res->article_name}}">
				  <b style="color:red">{{$errors->first('article_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章logo</label>
		<div class="col-sm-6">
			<input type="file" class="form-control" id="lastname" name="article_img">
			<img src="{{env('UPLOADS_URL')}}{{$res->article_img}}" width="50" height="50">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章分类</label>
		<div class="col-sm-6">
			<select name="brand_id" id="">
				<option value="">请选择</option>
				@foreach($da as $k=>$v)
				<option value="{{$v->brand_id}}"{{$res->brand_id==$v->brand_id ? "selected":''}}>{{$v->brand_name}}</option>
				@endforeach
			</select>
		<b style="color:red">{{$errors->first('brand_id')}}</b>

		</div>
	</div>
	
	
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章重要性</label>
		<div class="col-sm-6">
			<input type="radio" name="article_zy" value="1" {{$res->article_zy=='1' ? "checked" :''}}>普通
			<input type="radio" name="article_zy" value="2" {{$res->article_zy=='2' ? "checked" :''}}>置顶
			<b style="color:red">{{$errors->first('article_zy')}}</b>

		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-6">
			<input type="radio" name="article_show" value="1" {{$res->article_show=='1' ? "checked" :''}}>显示
			<input type="radio" name="article_show" value="2" {{$res->article_show=='2' ? "checked" :''}}>不显示
			<b style="color:red">{{$errors->first('article_show')}}</b>

		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章作者</label>
		<div class="col-sm-6">
			<input type="text" name="article_man" value="{{$res->article_man}}">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">作者邮箱</label>
		<div class="col-sm-6">
			<input type="email" name="article_email" value="{{$res->article_email}}">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">关键字</label>
		<div class="col-sm-6">
			<input type="text" name="article_gjz" value="{{$res->article_gjz}}">
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网页描述</label>
		<div class="col-sm-6">
			<textarea type="text" class="form-control" id="lastname" 
				   placeholder="请输入描述" name="article_crea">
				   {{$res->article_crea}}
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

 

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
<center><h3>管理员表单编辑</h3></center>
<form action="{{url('admin/update/'.$da->admin_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">管理名称</label>
		<div class="col-sm-6">
			@csrf
			<input type="text" class="form-control" id="firstname" 
				 name="admin_name"  placeholder="请输入管理员名字" value="{{$da->admin_name}}">
				<b style="color:red">{{$errors->first('admin_name')}}</b>

		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员密码</label>
		<div class="col-sm-6">
			<input type="password" class="form-control" id="lastname" placeholder="请输入管理员密码" name="admin_pwd" value="{{$da->admin_pwd}}">
							<b style="color:red">{{$errors->first('admin_pwd')}}</b>

		</div>
	</div>
	
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">邮箱</label>
		<div class="col-sm-6">
			<input type="text" name="admin_email" placeholder="邮箱" value="{{$da->admin_email}}">
					<b style="color:red">{{$errors->first('admin_email')}}</b>

		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">手机号</label>
		<div class="col-sm-6">
			<input type="tel" name="admin_tel" placeholder="手机号" value="{{$da->admin_tel}}">
			<b style="color:red">{{$errors->first('admin_tel')}}</b>
		</div>
	</div>
	

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">头像</label>
		<div class="col-sm-6">
			<input type="file" name="admin_img">
			<img src="{{env('UPLOADS_URL')}}{{$da->admin_img}}" width="50" height="50">
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

 



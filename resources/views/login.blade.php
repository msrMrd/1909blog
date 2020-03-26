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
<center><h3>后台登陆</h3></center>
@if(session('msg'))
<div class="alert alert-danger">{{session('msg')}}</div>
@endif
<form action="{{url('/logindo')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">用户名：</label>
		<div class="col-sm-7">
			@csrf
			<input type="text" class="form-control" id="firstname" 
				 name="admin_name"  placeholder="请输入管理员名字">
				<b style="color:red">{{$errors->first('admin_name')}}</b>

		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">密码：</label>
		<div class="col-sm-7">
			<input type="password" class="form-control" id="lastname" placeholder="请输入管理员密码" name="admin_pwd">

		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<div class="checkbox">
				<label>
					<input name="rember" type="checkbox">七天免登陆
				</label>
			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
			<button type="submit" class="btn btn-default">登陆</button>
		</div>
	</div>
</form>

</body>
</html>

 

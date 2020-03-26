<form action="{{url('/zx')}}" method="post">
	
	名字<input type="text" name="name"><br>
	@csrf
	性别<input type="radio" name="sex" value="男">男
	<input type="radio" name="sex" value="女">女 <br>
	班级 <select name="ban" >
	<option>1909</option>
	<option>1908</option>
	</select>
	<input type="submit" value="添加">
</form>
<center><h2>分类编辑</h2>
<form action="{{url('category/update/'.$data->cate_id)}}" method="post">
	@csrf
	分类名称<input type="text" name="cate_name" value="{{$data->cate_name}}"><br>
	品牌<select name="pid" id="">
		<option value="">顶级分类</option>
		@foreach($res as $k=>$v)
		<option value="{{$v->cate_id}}" {{$data->pid==$v->cate_id ? "selected" :''}}>{{$v->cate_name}}</option>
		@endforeach
	</select><br>
	分类描述<textarea name="cate_desc"cols="30" rows="10">{{$data->cate_desc}}</textarea><br>
	是否在导航栏显示<input type="radio" name="cate_nav_show" value="1" {{$data->cate_nav_show =='1' ? "checked" :''}}>是
				<input type="radio" name="cate_nav_show"value="2"  {{$data->cate_nav_show =='2' ? "checked" :''}}>否<br>
				<input type="submit" value="编辑">
</form>
</center>

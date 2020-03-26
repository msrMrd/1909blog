<center><h2>分类添加</h2>
<form action="{{url('category/cate_tj')}}" method="post">
	@csrf
	分类名称<input type="text" name="cate_name"><br>
	品牌<select name="pid" id="">
		<option value="">顶级分类</option>
		@foreach($res as $k=>$v)
		<option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
		@endforeach
	</select><br>
	分类描述<textarea name="cate_desc"cols="30" rows="10"></textarea><br>
	是否在导航栏显示<input type="radio" name="cate_nav_show" value="1">是
				<input type="radio" name="cate_nav_show"value="2">否<br>
				<input type="submit" value="添加">
</form>
</center>
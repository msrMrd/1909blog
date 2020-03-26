<form action="{{url('news/score')}}" method="post">
	@csrf
	新闻标题<input type="text" name="news_name">
	<b style="color:red">{{$errors->first('news_name')}}</b>

	<br>

	新闻分类<select name="pid">
		<option value="">请选择</option>
		@foreach($news as $k=>$v)
		<option value="{{$v->news_id}}">{{str_repeat('|--',$v->level)}}{{$v->news_name}}</option>
		@endforeach
	</select>
		<b style="color:red">{{$errors->first('pid')}}</b>

	<br>
	新闻作者<input type="text" name="news_man">
	<b style="color:red">{{$errors->first('news_man')}}</b>
	<br>
			

	<input type="submit" value="添加">
</form>


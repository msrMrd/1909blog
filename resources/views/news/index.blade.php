<form>
	新闻标题：<input type="text" name="name" value="{{$a['name']??''}}">
	新闻作者：<input type="text" name="man" value="{{$a['man']??''}}">
	<input type="submit" value="搜素">
</form>
<table>
<tr>
	<td>id</td>
	<td>新闻标题</td>
	<td>分类</td>
	<td>作者</td>
	<td>时间</td>
	<td>操作</td>
</tr>
@foreach($news as $k=>$v)
<tr>
	<td>{{$v->news_id}}</td>
	<td>{{$v->news_name}}</td>
	<td>{{$v->pid}}</td>
	<td>{{$v->news_man}}</td>
	<td>{{date("Y-m-d h:i:s",$v->news_time)}}</td>
	<td>
		<button>编辑</button>
		<button>删除</button>
	</td>
</tr>
@endforeach
</table>
{{$news->appends($a)->links()}}
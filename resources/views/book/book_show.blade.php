<form>
	书名<input type="text" name="name" value="{{$da['name']??''}}">
	作者<input type="text" name="man" value="{{$da['man']??''}}">
	<input type="submit" value="搜索"> 
</form>
<table>
	<tr>
		<td>id</td>
		<td>书名</td>
		<td>作者</td>
		<td>售价</td>
		<td>图片</td>
		<td>操作</td>
	</tr>
	@foreach($res as $k=>$v)
	<tr>
		<td>{{$v->book_id}}</td>
		<td>{{$v->book_name}}</td>
		<td>{{$v->book_man}}</td>
		<td>{{$v->book_price}}</td>
		<td><img src="{{env('UPLOADS_URL')}}{{$v->book_img}}" width="50" height="50"></td>
		<td>
			<button>删除</button>
			<button>编辑</button>

		</td>
	</tr>
	@endforeach
</table>
{{$res->appends($da)->links()}}

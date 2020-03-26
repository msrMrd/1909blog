<table>
	<tr>
		<td>id</td>
		<td>姓名</td>
		<td>性别</td>
		<td>班级</td>
		<td>编辑</td>
	</tr>
	@foreach($res as $k=>$v)
	<tr>
		<td>{{$v->id}}</td>
		<td>{{$v->name}}</td>
		<td>{{$v->sex}}</td>
		<td>{{$v->ban}}</td>
		<td>
			<a href="{{url('/delete/'.$v->id)}}">删除</a>
			<a href="">编辑</a>
		</td>
	</tr>
	@endforeach
</table>

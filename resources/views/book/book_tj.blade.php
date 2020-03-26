<form action="{{url('/book_zx')}}" method="post" enctype="multipart/form-data">
	@csrf
	书名<input type="text" name="book_name">{{$errors->first('book_name')}}<br>
	作者<input type="text" name="book_man">{{$errors->first('book_man')}}<br>
	售价<input type="text" name="book_price"><br>
	图片<input type="file" name="book_img"><br>
	<input type="submit" value="添加">
</form>

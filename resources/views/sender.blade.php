

<form action="/sender" method="post">
	<b>Name  </b> <input type="text" name="name" placeholder="name"><br><br>
	<b>Comment  </b><input type="text" name="comment1" placeholder="comment"><br><br>
	<input type="submit" name="">
	{{ csrf_field() }}
</form>

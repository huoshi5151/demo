<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>书籍搜索页</title>
</head>
<body>
	<h1>书籍搜索页</h1>
	<form action="result.php" method="post">
		Choose Search Type:<br />
		<select name="searchtype" id="">
			<option value="">请选择搜索类型</option>
			<option value="author">Author</option>
			<option value="title">Title</option>
			<option value="isbn">ISBN</option>
		</select><br />
		Enter Search Term:<br />
		<input type="text" name="searchterm">
		<input type="submit" value="search">
	</form>
</body>
</html>
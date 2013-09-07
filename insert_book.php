<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>插入新书</title>
</head>
<body>
<?php
	$isbn=trim($_POST['isbn']);
	$author=trim($_POST['author']);
	$title=trim($_POST['title']);
	$price=trim($_POST['price']);
	if (!$isbn || !$author || !$title || !$price ) {
		echo "请将信息补充完整";
		exit;
	}

	if (!get_magic_quotes_gpc()) {
		$isbn=addslashes($isbn);
		$author=addslashes($author);
		$title=addcslashes($title);
		$price=doubleval($price);
	}
	@ $db=new mysqli('localhost' , 'bookorama' ,'bookorama123' ,'books');
	if (mysqli_connect_errno()) {
		echo '数据库连接失败';
		exit;
	}
	$query="insert into books (isbn,author,title,price) values ('".$isbn."','".$author."','".$title."','".$price."')";
	echo $query.'<br />';
	$result=$db->query($query);
	var_dump($result);
	if ($result) {
		echo $db->affected_rows."本书被插入成功";
	}else{
		echo "插入失败";
	}
	$db->close();
?>
</body>
</html>
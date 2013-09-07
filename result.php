<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>书籍搜索结果页</title>
</head>
<body>
	<h1>书籍搜索结果页</h1>
<?php
$searchtype=$_POST['searchtype'];
// trim()函数过滤用户输入的两头儿的空格
$searchterm=trim($_POST['searchterm']);

if (!$searchtype || !$searchterm) {
	echo '您没有输入任何搜索条件,请返回输入';
	exit;
}
var_dump(get_magic_quotes_gpc());
// 检测是否开启了魔术引号，针对get，post，cookie，如果没有，则对特殊字符进行转义
if (!get_magic_quotes_gpc()) {
	$searchtype=addslashes($searchtype);
	$searchterm=addslashes($searchterm);
}

@ $db = new mysqli('localhost','bookorama','bookorama123','books');
if (mysqli_connect_errno()) {
	echo '未能连接上数据库，请稍后重试';
	exit;
}
$query="select * from books where ".$searchtype." like '%".$searchterm."%'";
echo $query.'<br />';
$result=$db->query($query);
//获取结果的条数
$num_results=$result->num_rows;

echo "<p>搜索到的结果：".$num_results."条</p>";
for ($i=0; $i < $num_results; $i++) { 
	$row=$result->fetch_assoc();
	//fetch_row() 读取的数组是数字下标，而fetch_assoc()读取的数组是以数据库中的字段名为下标
	//$row=$result->fetch_row();
	print_r($row);
	echo '<br />';
	echo "<p><strong>".($i+1)."Title:";
	echo htmlspecialchars(stripslashes($row['title']));
	// echo stripcslashes($row['title']);
	echo "</strong><br />Author:";
	echo stripslashes($row['author']);
	echo "<br />ISBN:";
	echo stripslashes($row['isbn']);
	echo "<br />Price:";
	echo stripslashes($row['price']);
	echo "</p>";
}

$result->free();
$db->close();

?>
</body>
</html>
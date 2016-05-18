<?php
header("content-type:text/html;charset=utf-8");
$title = $_POST["title"];
$content = $_POST["content"];
$Blogcontent = $_POST["Blogcontent"];
$type = $_POST["type"];

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "blog";

$db = mysql_connect($servername, $username, $password);
if (!$db) {
	echo "连接失败";
} else {
	mysql_select_db($dbname);
	mysql_query("set names 'utf8'");
	$sql = "INSERT INTO blog1(title,content,ptime,person,type,Blogcontent) VALUES('" . $title . "','" . $content . "',NOW(),1,'" . $type . "','" . $Blogcontent . "')";
	$result = mysql_query($sql);
	if (!$result) {
		echo "发表博客失败";
	} else {
		header("location:1.php");
	}
}
mysql_close($db);
?>
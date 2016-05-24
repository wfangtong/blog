<?php 
header("content-type:text/html;charset=utf-8");
//所有通过问号传值的方式传递的值都是GET方式
//获取博客列表页面传递过来的博客编号
$id = $_GET["id"];
//根据博客编号查询博客的详细信息
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "blog";
$db = mysql_connect($servername, $username, $password);
if (!$db) {
	echo "连接失败";
} else {

	mysql_select_db($dbname);
	//设置编码
	mysql_query("set names 'utf8'");
	$sql = "SELECT  B.id,B.title,B.content,B.Blogcontent,B.ptime,B.t_name,a.name FROM(SELECT b1.id,b1.title,b1.content,b1.Blogcontent,b1.ptime,B1.person,b2.t_name FROM blog1 b1 JOIN type b2 ON b1.type=b2.Id  WHERE B1.id=" . $id . ")B JOIN admin a ON B.person=a.Id;";
	$result = mysql_query($sql);
	if ($result == false) {
		echo "查询失败";
	} else {
		$row = mysql_fetch_assoc($result);
		

		echo "标题:" . $row["title"];
		echo "<br/>";

		echo "简介:" . $row["content"];
		echo "<br/>";

		echo "发表时间:" . $row["ptime"];
		echo "<br/>";

		echo "类型名称:" . $row["t_name"];
		echo "<br/>";

		echo "作者:" . $row["name"];
		echo "<br/>";

		echo "内容:" . $row["Blogcontent"];
		echo "<br/>";
	}

}

?>


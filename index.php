<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link href="http://cdn.bootcss.com/bootstrap/4.0.0-alpha.2/css/bootstrap.css" rel="stylesheet">
	<style type="text/css">
body{font-size: 12px;}
	</style>
</head>
<body>
<a href="blogadd.php">撰写博客</a>
	<table class="table table-striped table-bordered table-hover table-condensed">
<tr>

<th>标题</th>
<th>简介</th>
<th>发表时间</th>
<th>作者</th>
<th>类型</th>
<th>详情</th>
<th>编辑</th>
<th>删除</th>
</tr>
<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "blog";

$pageindex=1;
$pagesize=5;
if (isset($_GET["pageindex"])) {
	$pageindex=$_GET["pageindex"];
}
$db = mysql_connect($servername, $username, $password);
if (!$db) {
	echo "连接失败";
}else{

	mysql_select_db($dbname);
	mysql_query("set names 'utf8'");
	$start=($pageindex - 1) * $pagesize;
	$sql="SELECT  B.id,B.title,B.content,B.Blogcontent,B.ptime,B.t_name,a.name FROM(SELECT b1.id,CONCAT(SUBSTR(b1.title,1,10),'....')title,CONCAT(SUBSTR(b1.content,1,10),'....')content,b1.Blogcontent,b1.ptime,B1.person,b2.t_name FROM blog1 b1 JOIN type b2 ON b1.type=b2.Id)B JOIN admin a ON B.person=a.Id ORDER BY B.id DESC LIMIT ".$start.",5;";
	$result=mysql_query($sql);
	if ($result==false) {
		echo "查询出错";
	}else{

		while ($row=mysql_fetch_assoc($result)) {
			echo "<tr>";
            
			echo "<td>" . $row["title"] . "</td>";
			echo "<td>" . $row["content"] . "</td>";
			echo "<td>" . $row["ptime"] . "</td>";
			echo "<td>" . $row["name"] . "</td>";
			echo "<td>" . $row["t_name"] . "</td>";
			echo "<td><a href='detail.php?id=" . $row["id"] . "'>详情</a></td>";
			echo "<td><a href='edituser.php?id=" . $row["id"] . "'>编辑</a></td>";
			echo "<td><a href='delete.php?id=" . $row["id"] . "'>删除</a></td>";
			echo "</tr>";
		}
	}
	$res=mysql_query("SELECT CEIL(COUNT(*)/5) FROM blog1;");
	$lastrow=mysql_fetch_row($res);
	$lastpageindex=$lastrow[0];
}
?>
</table>
<div style="position: relative;left: 1100px;width: 300px;height: 50px;">
	<a href="1.php?pageindex=1">第一页</a>
    <a href=1.php?pageindex=<?php echo $a = $pageindex <= 1 ? 1 : $pageindex - 1;?>>上一页</a>
    <a href=1.php?pageindex=<?php echo $b = $pageindex>=$lastpageindex ? $pageindex : $pageindex+1; ?>>下一页</a>
    <a href=1.php?pageindex=<?php echo $lastpageindex; ?>>末页</a>
    当前第<?php echo $pageindex ?>页

</div>
</body>
</html>
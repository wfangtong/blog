<?php
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
	$sql = "SELECT * FROM Type";
	$result = mysql_query($sql);
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>撰写博客</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<form action="processadd.php" method="post">
<div class="divmain">

<div class="divtitle">标题:<input type="text" name="title"></input> </div>
<div class="content">简介:<input type="text" name="content"></input></div>
<div class="Blogcontent">
内容:  
	<!-- 加载编辑器的容器 -->
    <script id="container" name="Blogcontent" type="text/plain">
        这里写你的初始化内容
    </script>
    </div>
<div class="divtype">类型:<select name="type">
<?php
while ($row = mysql_fetch_assoc($result)) {
	echo "<option value=" . $row["Id"] . ">";
	echo $row["t_name"];
	echo "</option>";
}
mysql_free_result($result);
mysql_close($db);
?>
	</select>
	</div>
	<div class="divbutton"><input type="submit" value="发表"></input></div>
</div>
</form>
</body>
</html>
<!-- 配置文件 -->
    <script type="text/javascript" src="editor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="editor/ueditor.all.js"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
    </script>
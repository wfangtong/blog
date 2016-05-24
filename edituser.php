<?php
header("content-type:text/html;charset=utf-8");
/*获取从博客列表页面传递过来的博客编号，然后根据博客编号去数据库中的blogs表中查询此博客的详细信息*/
//获取编号
$id = $_GET["id"];

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "blog";

//创建连接
$db = mysql_connect($servername, $username, $password);
//如果创建连接失败，返回false,如果成功，则返回一个连接
if (!$db) {
	echo "和数据库的连接失败";
} else {
	//指定要操作的数据库
	mysql_select_db($dbname);
	//指定编码
	mysql_query("set names 'utf8'");

	//拼接SQL语句，查询博客详细信息
	$sql = "SELECT * FROM Blog1 WHERE id=" . $id;
	//将SQL语句发送到数据库执行
	$result = mysql_query($sql);
	if (!$result) {
		echo "查询失败";
	} else {
		$row = mysql_fetch_assoc($result);
	}

	//拼接SQL语句查询所有的博客类型
	$sqltype = "SELECT * FROM Type";
	$res = mysql_query($sqltype);
}
?>
<link rel="stylesheet" type="text/css" href="main.css">
<form action="processedit.php" method="post">
<div class="divmain">
<!-- 方式1：将编号隐藏，但是仍然将id可以提交到服务器 -->
	<!-- 编号:<input type="hidden" name="id" value=<?php echo $id; ?>></input> -->

	<!-- 方式2 -->
	
	<div class="divtitle">标题:<input type="text" name="title" value=<?php echo $row["title"] ?>></input></div>

	<div class="content">简介:<input type="text" name="content" value=<?php echo $row["content"]; ?>></input></div>
	
	<div class="Blogcontent">内容:
		<!-- 加载编辑器的容器 -->
    <script id="container" name="Blogcontent" type="text/plain">
     <?php echo $row["Blogcontent"]; ?>
    </script>
    </div>

	<div class="divtype">类型:<select name="type">
		<?php
while ($typerow = mysql_fetch_assoc($res)) {
	if ($typerow["Id"] == $row["Type"]) {
		echo "<option selected='selected' value=" . $typerow["Id"] . ">";
		echo $typerow["t_name"];
		echo "</option>";
	} else {
		echo "<option value=" . $typerow["Id"] . ">";
		echo $typerow["t_name"];
		echo "</option>";
	}
}
mysql_free_result($result);
mysql_free_result($res);
mysql_close($db);
?>
	</select>
	</div>
	
	<div class="divbutton"><input type="submit" value="保存"></input></div>
	</div>
</form>
<!-- 配置文件 -->
    <script type="text/javascript" src="editor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="editor/ueditor.all.js"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
    </script>
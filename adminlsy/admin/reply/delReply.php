<?php
//帖子管理管理回复 中  回复删除的处理代码
	header('content-type:text/html; charset=utf-8');
	var_dump($_GET);
	//接受数据
	$rid = $_GET['rid'];
	$id = $_GET['id'];
	//链接数据库
	$link=mysqli_connect('localhost','root','');
	//选择数据库
	mysqli_select_db($link,'test');
	//设置字符集
	mysqli_set_charset($link,'utf8');
	//准备SQL语句
	$SQL="delete from reply where id={$rid}";
	//执行SQl语句
	mysqli_query($link,$SQL);//执行
	//判断结果集
	if( mysqli_affected_rows($link) >0){
		header("location:./reply_manage.php?id={$id}");
		exit;
	}
	//关闭数据库
	mysqli_close($link);
?>
<?php
	header('content-type:text/html; charset=utf-8');
	
	//获取用户ID
	$uid = $_GET['uid'];
	$status = $_GET['status'];
	//var_dump($status);
	//连库
	$link = mysqli_connect('localhost','root','');
	
	//选库
	mysqli_select_db($link,'test');
	//设置字符集 
	mysqli_set_charset($link,'utf8');
	
	
	//执行sql语句
	$sql = "update user set status={$status} where id={$uid}";
	
	mysqli_query($link,$sql);

	//执行成功 
	if(mysqli_affected_rows($link) > 0){
		header("location:./user_list.php?&userName={$_GET['userName']}");
	}
	
	mysqli_close($link);
?>
<?php
	header('content-type:text/html; charset=utf-8');
	
	//获取用户ID
	$uid = $_GET['uid'];
	$status = $_GET['status'];
	//var_dump($status);
	//连库
	$con = mysql_connect('localhost','root','');
	
	//选库
	mysql_select_db('lamp111');
	//设置字符集 
	mysql_set_charset('utf8');
	
	
	//执行sql语句
	$sql = "update user set status={$status} where id={$uid}";
	
	mysql_query($sql);

	//执行成功 
	if(mysql_affected_rows() > 0){
		header("location:./user_list.php?&userName={$_GET['userName']}");
	}
	
	mysql_close();
?>
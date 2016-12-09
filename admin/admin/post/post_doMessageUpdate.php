<?php
	var_dump($_POST);
	
	//连接数据库
	mysql_connect('localhost','root','');
	
	//选择数据库
	mysql_select_db('lamp111');
	
	mysql_set_charset('utf8');
	
	//准备SQL语句
	$SQL = "update post set title='{$_POST['nTitle']}' , content='{$_POST['nContent']}' where id={$_POST['id']}";
	
	//echo "<hr/>";
	//var_dump($SQL);
	
	//执行SQL语句
	mysql_query($SQL);
	
	//处理结果集
	if (mysql_affected_rows() > 0){
		header('location:./post_message.php');
	}
	else{
		header('location:./post_messageUpdate.php');
	}
	
	//关闭数据库
	mysql_close();
?>
<?php
	var_dump($_POST);
	
	//连接数据库
	$link=mysqli_connect('localhost','root','');
	
	//选择数据库
	mysqli_select_db($link,'test');
	
	mysqli_set_charset($link,'utf8');
	
	//准备SQL语句
	$SQL = "update post set title='{$_POST['nTitle']}' , content='{$_POST['nContent']}' where id={$_POST['id']}";
	
	//echo "<hr/>";
	//var_dump($SQL);
	
	//执行SQL语句
	mysqli_query($link,$SQL);
	
	//处理结果集
	if (mysqli_affected_rows() > 0){
		header('location:./post_message.php');
	}
	else{
		header('location:./post_messageUpdate.php');
	}
	
	//关闭数据库
	mysqli_close($link);
?>
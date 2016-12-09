<?php
	$id = $_GET['id'];
	//echo $id;
	
	
	$name=$_POST['bankuai'];
	//echo $name;
	
	//链接数据库
	mysql_connect('localhost', 'root','');
	
	//选库
	mysql_select_db('lamp111');
	
	mysql_set_charset('utf8');
	
	//写sql
	$sql = "update type set name='{$name}' where id='{$id}'";
	
	//执行
	mysql_query($sql);
	
	//判断 读取结果集
	if(mysql_affected_rows() > 0){
		header('location:./type_menu.php');	
	}
	else{
		header('location:./type_updateFQ.php?id='.$id);
	}
	
?>
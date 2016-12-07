<?php
	$id=$_GET['id'];
	//echo $id;
	$name=$_POST['bankuai'];
	//echo $name;
	
	//链接数据库
	$link=mysqli_connect('localhost', 'root','');
	
	//选库
	mysqli_select_db($link,'test');
	
	mysqli_set_charset($link,'utf8');
	
	//写sql
	$sql = "update type set name='{$name}' where id='{$id}'";
	
	//执行
	mysqli_query($link,$sql);
	
	//判断 读取结果集
	if(mysqli_affected_rows($link) > 0){
		header('location:./type_menu.php');	
	}
	else{
		header('location:./type_update.php?id='.$id);
	}
	
?>
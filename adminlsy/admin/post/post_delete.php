<?php

    $id=$_GET['id'];
   
   
	//连库
	$link=mysqli_connect('localhost','root','');
	
	//选库
	mysqli_select_db($link,'test');
	
	mysqli_set_charset($link,'utf8');
	
	//写sql语句
    $sql="delete from post where id=$id";
	
	//执行
    mysqli_query($link,$sql);
	
	if (mysqli_affected_rows($link) > 0){
	
		header('location:./post_message.php');
	
	}
	
	
    mysqli_close($link);
    
?>

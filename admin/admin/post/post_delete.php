<?php

    $id=$_GET['id'];
   
   
	//连库
	mysql_connect('localhost','root','');
	
	//选库
	mysql_select_db('lamp111');
	
	mysql_set_charset('utf8');
	
	//写sql语句
    $sql="delete from post where id=$id";
	
	//执行
    mysql_query($sql);
	
	if (mysql_affected_rows() > 0){
	
		header('location:./post_message.php');
	
	}
	
	
    mysql_close();
    
?>

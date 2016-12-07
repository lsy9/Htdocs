<?php
	//获取原来的加精状态
	$elite = $_GET['elite'];
	$id = $_GET['id'];
	
	//判断
	if($elite == 0){
		$nelite = 1;
	}else{
		$nelite = 0;
	}
	
	
	//连接数据库
	mysql_connect('localhost','root','');
	
	//选择数据库
	mysql_select_db('lamp111');
	
	mysql_set_charset('utf8');
	
	//准备SQL语句
	$SQL = "update post set elite={$nelite} where id={$id}";
	
	//执行SQL语句
	mysql_query($SQL);
	
	//处理结果集
	if(mysql_affected_rows() > 0){
		
		header('location:./post_list.php');
	}
	
	//关闭数据库
	mysql_close();
	
	
?>
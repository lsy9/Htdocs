<?php
	//获取原来的加精状态
	$top = $_GET['top'];
	$id = $_GET['id'];
	
	//判断
	if($top == 0){
		$ntop = 1;
	}else{
		$ntop = 0;
	}
	

	
	//连接数据库
	mysql_connect('localhost','root','');
	
	//选择数据库
	mysql_select_db('lamp111');
	
	mysql_set_charset('utf8');
	
	//准备SQL语句
	$SQL = "update post set top={$ntop} where id={$id}";
	
	//执行SQL语句
	mysql_query($SQL);
	
	//处理结果集
	if(mysql_affected_rows() > 0){
		
		header('location:./post_message.php');
	}
	
	//关闭数据库
	mysql_close();
	
	
?>
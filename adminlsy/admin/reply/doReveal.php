<?php
//帖子管理   显示 的处理代码
	header('content-type:text/html; charset=utf-8');
	//var_dump($_GET);
	//接受数据
	$reveal=$_GET['reveal'];
	$id=$_GET['id'];
	//链接数据库
	mysql_connect('localhost','root','');
	//选择数据库
	mysql_select_db('lamp111');
	//设置字符集
	mysql_set_charset('utf8');
	//判断
	if($reveal === 0){
		$SQL="update reply set reveal=1 where id={$id}";
	}else{
		$SQL="update reply set reveal=0 where id={$id}";
	}
	mysql_query($SQL);//执行
	
	//判断结果集
	if(mysql_affected_rows() > 0){
		header("location:./reply_manage.php?id={$id}");
	}
	//关闭数据库
	mysql_close();
?>
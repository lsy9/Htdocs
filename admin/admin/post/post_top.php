<?php
	header('content-type:text/html;charset=utf8');

	//接收top和 要被加精的 id值
	$top = $_GET['top'];
	$id = $_GET['id'];

	//链接数据库
	mysql_connect('localhost','root','');

	mysql_select_db('lamp111');
	
	mysql_set_charset('utf8');
	
	//判断 top 值
	if($top === '0'){
	
		//准备sql语句
		$SQL = " update post set top = 1 where id={$id} ";

	}

	else if($top === '1') { 
		$SQL = "update post set top=0 where id={$id}";
		// var_dump($SQL);

	}
	mysql_query($SQL);
	// 判断是否写入
	//var_dump($result);
	if( mysql_affected_rows()>0 ){

		header('location:./post_message.php?id='.$uid);

	}

	mysql_close();
	?>	   
<?php
	header('content-type:text/html;charset=utf8');

	//接收elite和 要被加精的 id值
	$elite = $_GET['elite'];
	$id = $_GET['id'];

	//链接数据库
	mysql_connect('localhost','root','');

	mysql_select_db('lamp111');
	
	mysql_set_charset('utf8');
	
	//判断 elite 值
	if($elite === '0'){
		//准备sql语句
		
		$SQL = " update post set elite = 1 where id={$id} ";

	}

	else if($elite === '1') { 
		$SQL = "update post set elite=0 where id={$id}";
		// var_dump($SQL);

	}
	mysql_query($SQL);
	
	// 判断是否写入
	
	if( mysql_affected_rows()>0 ){

		header('location:./post_message.php?id='.$uid);

	}

	mysql_close();
?>	   
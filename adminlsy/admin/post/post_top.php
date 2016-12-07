<?php
	header('content-type:text/html;charset=utf8');

	//接收top和 要被加精的 id值
	$top = $_GET['top'];
	$id = $_GET['id'];

	//链接数据库
	$link=mysqli_connect('localhost','root','');

	mysqli_select_db($link,'test');
	
	mysqli_set_charset($link,'utf8');
	
	//判断 top 值
	if($top === '0'){
	
		//准备sql语句
		$SQL = " update post set top = 1 where id={$id} ";

	}

	else if($top === '1') { 
		$SQL = "update post set top=0 where id={$id}";
		// var_dump($SQL);

	}
	mysqli_query($link,$SQL);
	// 判断是否写入
	//var_dump($result);
	if( mysqli_affected_rows($link)>0 ){

		header('location:./post_message.php?id='.$uid);

	}

	mysqli_close($link);
	?>	   
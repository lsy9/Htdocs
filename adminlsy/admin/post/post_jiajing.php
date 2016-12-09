<?php
	header('content-type:text/html;charset=utf8');

	//接收elite和 要被加精的 id值
	$elite = $_GET['elite'];
	$id = $_GET['id'];

	//链接数据库
	$link=mysqli_connect('localhost','root','');

	mysqli_select_db($link,'test');
	
	mysqli_set_charset($link,'utf8');
	
	//判断 elite 值
	if($elite === '0'){
		//准备sql语句
		
		$SQL = " update post set elite = 1 where id={$id} ";

	}

	else if($elite === '1') { 
		$SQL = "update post set elite=0 where id={$id}";
		// var_dump($SQL);

	}
	mysqli_query($link,$SQL);
	
	// 判断是否写入
	
	if( mysqli_affected_rows($link)>0 ){

		header('location:./post_message.php?id='.$uid);

	}

	mysqli_close($link);
?>	   
<?php
	header('content-type:text/html;charset=utf8');

	//接收recycle和 要被加精的 id值

	$recycle = $_GET['recycle'];


	$id = $_GET['id'];
	//echo $id; 

	//链接数据库
	$link=mysqli_connect('localhost','root','');

	mysqli_select_db($link,'test');
	mysqli_set_charset($link,'utf8');

	//判断 recycle 值
	if($recycle === '0'){

		//准备sql语句
		$SQL = " update post set recycle = 1 where id={$id} ";

		mysqli_query($link,$SQL);
		// 判断是否写入

		if( mysqli_affected_rows($link)>0 ){
				//echo "成功";
				header('location:./post_message.php'); /* */

			}
	}

	else if($recycle === '1') { 
		$SQL = "update post set recycle=0 where id={$id}";
		// var_dump($SQL);

		mysqli_query($link,$SQL);
		// 判断是否写入


		if( mysqli_affected_rows($link)>0 ){
			//echo "成功";
			header('location:./post_HuiShouZhan.php'); /* */

		}
	}


	mysqli_close($link); 
?>	   

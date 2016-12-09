<?php
	header('content-type:text/html;charset=utf8');

	//接收recycle和 要被加精的 id值

	$recycle = $_GET['recycle'];


	$id = $_GET['id'];
	//echo $id; 

	//链接数据库
	mysql_connect('localhost','root','');

	mysql_select_db('lamp111');
	mysql_set_charset('utf8');

	//判断 recycle 值
	if($recycle === '0'){

		//准备sql语句
		$SQL = " update post set recycle = 1 where id={$id} ";

		mysql_query($SQL);
		// 判断是否写入

		if( mysql_affected_rows()>0 ){
				//echo "成功";
				header('location:./post_message.php'); /* */

			}
	}

	else if($recycle === '1') { 
		$SQL = "update post set recycle=0 where id={$id}";
		// var_dump($SQL);

		mysql_query($SQL);
		// 判断是否写入


		if( mysql_affected_rows()>0 ){
			//echo "成功";
			header('location:./post_HuiShouZhan.php'); /* */

		}
	}


	mysql_close(); 
?>	   

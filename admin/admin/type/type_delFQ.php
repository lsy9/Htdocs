<?php
    //用户传递过来的uid
    $id = $_GET['id'];
	//echo $id;
	$pid = $_GET['id'];
	 
    //链接数据库
     mysql_connect('localhost','root','');

    //选择数据库
    mysql_select_db('lamp111');

    mysql_set_charset('utf8');

    //准备SQL语句
	$sql = "select * from type where pid ='{$pid}'";
	//echo $sql;
	
	//$sql = "delete from type where pid={$id}";	
	$result = mysql_query($sql);
	
	if(mysql_num_rows($result) > 0){
		header('location:./type_menu.php');
		exit;
	}
	else{
		$SQL = "delete from type where id='{$pid}'";
		mysql_query($SQL);
		if(mysql_affected_rows() > 0){
			header('location:./type_menu.php');
		}
	}


    mysql_close(); 
?>

<?php
    //用户传递过来的uid
    $id = $_GET['id'];
	//echo $id;
	$pid = $_GET['id'];
	 
    //链接数据库
    $link=mysqli_connect('localhost','root','');

    //选择数据库
    mysqli_select_db($link,'test');

    mysqli_set_charset($link,'utf8');

    //准备SQL语句
	$sql = "select * from type where pid ='{$pid}'";
	//echo $sql;
	
	//$sql = "delete from type where pid={$id}";	
	$result = mysqli_query($link,$sql);
	
	if(mysqli_num_rows($result) > 0){
		header('location:./type_menu.php');
		exit;
	}
	else{
		$SQL = "delete from type where id='{$pid}'";
		mysqli_query($link,$SQL);
		if(mysqli_affected_rows() > 0){
			header('location:./type_menu.php');
		}
	}


    mysqli_close($link); 
?>

<?php
	header('content-type:text/html; charset=utf-8');
	//var_dump($_POST);
	//获取所有提交的数据
	$userName = $_GET['userName'];
	$uid = $_POST['uid'];                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
	$password = md5($_POST['password']);
	$rePassword = md5($_POST['rePassword']);
	$auth = $_POST['auth'];
	$status = $_POST['status'];

	
	//密码不能为空
	if((trim($_POST['password']) == '') || ($_POST['rePassword'] == '')){
		header("location:./user_update.php?uid={$uid}&userName={$_GET['userName']}");
		
		exit;//('俩密码不能为空');
	}
	
	//判断密码和确认密码是否相同
	if($password !== $rePassword){
		header('location:./user_update.php?uid='.$uid.'&userName='.$userName);
		exit;
	}
	
	//连库
	$con = mysql_connect('localhost','root','');
	
	//设置字符集 选择库
	mysql_select_db('lamp111');
	mysql_set_charset('utf8');
	
	//SQL 执行
	$sql = "update user set password='{$password}',auth='{$auth}',status='{$status}' where id='{$uid}'";
	mysql_query($sql);
	
	//判断  读取结果集
	if(mysql_affected_rows() > 0){
		header('location:./user_list.php');
	}else{
		header('location:./user_update.php?uid='.$uid.'&userName='.$userName);
	}
	
	mysql_close();
	

?>
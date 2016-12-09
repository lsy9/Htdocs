<?php
	header('content-type:text/html;charset=utf-8');
	//var_dump($POST);
	 
	//名
	$userName = $_POST['userName'];
	
	//密码
	$password = md5($_POST['password']);
	$rePassword = md5($_POST['rePassword']);
	$time = time();
	
	//判断密码和确认密码是否相同，若不同，返回
	if($password !== $rePassword){
		header('location:./addUser.php');
		exit;
	}
	
	//连库
	$link = mysqli_connect('localhost','root','');
	//选库
	mysqli_select_db($link,'test');
	
	mysqli_set_charset($link,'utf8');
	//写SQL语句
	$SQL = "insert into user (userName,password,auth) values ('{$userName}','{$password}',1)";

	
	/* //执行 */
	$query1 = mysqli_query($link,$SQL);
	
	$uid = mysqli_insert_id($link);

	//var_dump(mysqli_affected_rows($link));

	
	//判断是否插入成功
	if(mysqli_affected_rows($link) > 0){
		$detailSql = "insert into userdetail(id,nickName,email,qq,sheng,shi,qu,question,answer,time)
		values({$uid},'昵称叫版主','buzhidao@no.com','99391919','jilin','cc','jt','1','不喜欢',{$time}) ";
		$query2 = mysqli_query($link,$detailSql);
	
		//跳到user_list.php
		header('location:./user_list.php');
	}
	
	mysqli_close($link);
?>
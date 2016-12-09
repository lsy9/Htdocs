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
	$con = mysql_connect('localhost','root','');
	//选库
	mysql_select_db('lamp111');
	
	mysql_set_charset('utf8');
	//写SQL语句
	$SQL = "insert into user (userName,password,auth) values ('{$userName}','{$password}',1)";

	
	/* //执行 */
	$query1 = mysql_query($SQL);
	
	$uid = mysql_insert_id($con);

	VAR_DUMP(mysql_affected_rows());

	
	//判断是否插入成功
	if(mysql_affected_rows() > 0){
		$detailSql = "insert into userdetail(id,nickName,email,qq,sheng,shi,qu,question,answer,time)
		values({$uid},'昵称叫版主','buzhidao@no.com','99391919','jilin','cc','jt','1','不喜欢',{$time}) ";
		$query2 = mysql_query($detailSql);
	
		//跳到user_list.php
		header('location:./user_list.php');
	}
	
	mysql_close();
?>
<?php
	$id=$_GET['id'];
	//echo $id;
	$name=$_POST['bankuai'];
	//echo $name;
	
	//�������ݿ�
	$link=mysqli_connect('localhost', 'root','');
	
	//ѡ��
	mysqli_select_db($link,'test');
	
	mysqli_set_charset($link,'utf8');
	
	//дsql
	$sql = "update type set name='{$name}' where id='{$id}'";
	
	//ִ��
	mysqli_query($link,$sql);
	
	//�ж� ��ȡ�����
	if(mysqli_affected_rows($link) > 0){
		header('location:./type_menu.php');	
	}
	else{
		header('location:./type_update.php?id='.$id);
	}
	
?>
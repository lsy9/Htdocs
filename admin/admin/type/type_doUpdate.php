<?php
	$id=$_GET['id'];
	//echo $id;
	$name=$_POST['bankuai'];
	//echo $name;
	
	//�������ݿ�
	mysql_connect('localhost', 'root','');
	
	//ѡ��
	mysql_select_db('lamp111');
	
	mysql_set_charset('utf8');
	
	//дsql
	$sql = "update type set name='{$name}' where id='{$id}'";
	
	//ִ��
	mysql_query($sql);
	
	//�ж� ��ȡ�����
	if(mysql_affected_rows() > 0){
		header('location:./type_menu.php');	
	}
	else{
		header('location:./type_update.php?id='.$id);
	}
	
?>
<?php
	//��ȡԭ���ļӾ�״̬
	$elite = $_GET['elite'];
	$id = $_GET['id'];
	
	//�ж�
	if($elite == 0){
		$nelite = 1;
	}else{
		$nelite = 0;
	}
	
	
	//�������ݿ�
	mysql_connect('localhost','root','');
	
	//ѡ�����ݿ�
	mysql_select_db('lamp111');
	
	mysql_set_charset('utf8');
	
	//׼��SQL���
	$SQL = "update post set elite={$nelite} where id={$id}";
	
	//ִ��SQL���
	mysql_query($SQL);
	
	//��������
	if(mysql_affected_rows() > 0){
		
		header('location:./post_list.php');
	}
	
	//�ر����ݿ�
	mysql_close();
	
	
?>
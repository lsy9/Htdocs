<?php
//���ӹ���   ��ʾ �Ĵ������
	header('content-type:text/html; charset=utf-8');
	//var_dump($_GET);
	//��������
	$reveal=$_GET['reveal'];
	$id=$_GET['id'];
	//�������ݿ�
	mysql_connect('localhost','root','');
	//ѡ�����ݿ�
	mysql_select_db('lamp111');
	//�����ַ���
	mysql_set_charset('utf8');
	//�ж�
	if($reveal === 0){
		$SQL="update reply set reveal=1 where id={$id}";
	}else{
		$SQL="update reply set reveal=0 where id={$id}";
	}
	mysql_query($SQL);//ִ��
	
	//�жϽ����
	if(mysql_affected_rows() > 0){
		header("location:./reply_manage.php?id={$id}");
	}
	//�ر����ݿ�
	mysql_close();
?>
<?php
//���ӹ������ظ� ��  �ظ�ɾ���Ĵ������
	header('content-type:text/html; charset=utf-8');
	var_dump($_GET);
	//��������
	$rid = $_GET['rid'];
	$id = $_GET['id'];
	//�������ݿ�
	$link=mysqli_connect('localhost','root','');
	//ѡ�����ݿ�
	mysqli_select_db($link,'test');
	//�����ַ���
	mysqli_set_charset($link,'utf8');
	//׼��SQL���
	$SQL="delete from reply where id={$rid}";
	//ִ��SQl���
	mysqli_query($link,$SQL);//ִ��
	//�жϽ����
	if( mysqli_affected_rows($link) >0){
		header("location:./reply_manage.php?id={$id}");
		exit;
	}
	//�ر����ݿ�
	mysqli_close($link);
?>
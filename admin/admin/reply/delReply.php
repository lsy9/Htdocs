<?php
//���ӹ������ظ� ��  �ظ�ɾ���Ĵ������
	header('content-type:text/html; charset=utf-8');
	var_dump($_GET);
	//��������
	$rid = $_GET['rid'];
	$id = $_GET['id'];
	//�������ݿ�
	mysql_connect('localhost','root','');
	//ѡ�����ݿ�
	mysql_select_db('lamp111');
	//�����ַ���
	mysql_set_charset('utf8');
	//׼��SQL���
	$SQL="delete from reply where id={$rid}";
	//ִ��SQl���
	mysql_query($SQL);//ִ��
	//�жϽ����
	if( mysql_affected_rows() >0){
		header("location:./reply_manage.php?id={$id}");
		exit;
	}
	//�ر����ݿ�
	mysql_close();
?>
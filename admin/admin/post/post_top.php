<?php
	header('content-type:text/html;charset=utf8');

	//����top�� Ҫ���Ӿ��� idֵ
	$top = $_GET['top'];
	$id = $_GET['id'];

	//�������ݿ�
	mysql_connect('localhost','root','');

	mysql_select_db('lamp111');
	
	mysql_set_charset('utf8');
	
	//�ж� top ֵ
	if($top === '0'){
	
		//׼��sql���
		$SQL = " update post set top = 1 where id={$id} ";

	}

	else if($top === '1') { 
		$SQL = "update post set top=0 where id={$id}";
		// var_dump($SQL);

	}
	mysql_query($SQL);
	// �ж��Ƿ�д��
	//var_dump($result);
	if( mysql_affected_rows()>0 ){

		header('location:./post_message.php?id='.$uid);

	}

	mysql_close();
	?>	   
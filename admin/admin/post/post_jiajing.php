<?php
	header('content-type:text/html;charset=utf8');

	//����elite�� Ҫ���Ӿ��� idֵ
	$elite = $_GET['elite'];
	$id = $_GET['id'];

	//�������ݿ�
	mysql_connect('localhost','root','');

	mysql_select_db('lamp111');
	
	mysql_set_charset('utf8');
	
	//�ж� elite ֵ
	if($elite === '0'){
		//׼��sql���
		
		$SQL = " update post set elite = 1 where id={$id} ";

	}

	else if($elite === '1') { 
		$SQL = "update post set elite=0 where id={$id}";
		// var_dump($SQL);

	}
	mysql_query($SQL);
	
	// �ж��Ƿ�д��
	
	if( mysql_affected_rows()>0 ){

		header('location:./post_message.php?id='.$uid);

	}

	mysql_close();
?>	   
<?php
	header('content-type:text/html;charset=utf8');

	//����top�� Ҫ���Ӿ��� idֵ
	$top = $_GET['top'];
	$id = $_GET['id'];

	//�������ݿ�
	$link=mysqli_connect('localhost','root','');

	mysqli_select_db($link,'test');
	
	mysqli_set_charset($link,'utf8');
	
	//�ж� top ֵ
	if($top === '0'){
	
		//׼��sql���
		$SQL = " update post set top = 1 where id={$id} ";

	}

	else if($top === '1') { 
		$SQL = "update post set top=0 where id={$id}";
		// var_dump($SQL);

	}
	mysqli_query($link,$SQL);
	// �ж��Ƿ�д��
	//var_dump($result);
	if( mysqli_affected_rows($link)>0 ){

		header('location:./post_message.php?id='.$uid);

	}

	mysqli_close($link);
	?>	   
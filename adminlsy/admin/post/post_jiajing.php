<?php
	header('content-type:text/html;charset=utf8');

	//����elite�� Ҫ���Ӿ��� idֵ
	$elite = $_GET['elite'];
	$id = $_GET['id'];

	//�������ݿ�
	$link=mysqli_connect('localhost','root','');

	mysqli_select_db($link,'test');
	
	mysqli_set_charset($link,'utf8');
	
	//�ж� elite ֵ
	if($elite === '0'){
		//׼��sql���
		
		$SQL = " update post set elite = 1 where id={$id} ";

	}

	else if($elite === '1') { 
		$SQL = "update post set elite=0 where id={$id}";
		// var_dump($SQL);

	}
	mysqli_query($link,$SQL);
	
	// �ж��Ƿ�д��
	
	if( mysqli_affected_rows($link)>0 ){

		header('location:./post_message.php?id='.$uid);

	}

	mysqli_close($link);
?>	   
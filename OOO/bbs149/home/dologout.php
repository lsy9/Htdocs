<?php
	session_start();
	
	$_SESSION['uid'] = null;
	//unset($_SESSION);
	
	// session_destroy();
	
	// setcookie(session_name(),"",time()-1,"/");
	
	echo "<script>alert('注销成功');window.location.href='./index.php'</script>";
	die;
?>
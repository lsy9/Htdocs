<?php
	
	session_start();
	
	$_SESSION['id'] = null;
	
	// unset($_SESSION);
	
	// session_destroy();
	
	// setcookie(session_name(),"",time()-1,"/");
	
	echo "<script>alert('退出成功！');window.location.href='login.php'</script>";
		die;
?>
<?php
	// 开启session
	session_start();
	// 设置页面字符集
	header("Content-type:text/html;charset=utf-8");

	// 检测用户是否登录
	if(!empty($_SESSION['user'])){	// 已登录
		// 检测用户权限
		if($_SESSION['user']['level'] != 1){	// 不是管理员
			echo '<script>
				alert("用户权限不足！禁止访问");
				window.location.href="../index.php";
			</script>';
			exit;
		}
		// 权限正确，登录成功，进入后台
	} else { // 没有登录
		header('location:./login.php');
		// 终止
		exit;
	}
<?php
	//执行后台登录的界面
	//开启session
	session_start();
	
	//获取用户数据
	$uname = $_POST['uname'];
	$upass = md5($_POST['upass']);
	$ucode = $_POST['ucode'];
	
	if(empty($uname) || empty($upass)){
		echo "<script>alert('登录失败，账号或密码填写不完整！');window.location.href='login.php'</script>";
		die;
	}
	//判断验证码是否正确
	if($ucode != $_SESSION['code']){
		
		echo "<script>alert('验证码错误！');window.location.href='login.php'</script>";
		die;
	}
	//判断用户名和密码
	//0. 引入公共配置文件
		require("../public/config.php");
	
	//1.连接数据库，并判断
		$link = mysqli_connect(HOST,USER,PASS) or die("数据库连接失败！");
		
	//2.设置字符集
		mysqli_set_charset($link,CHARSET);
		
	//3.选择数据库
		mysqli_select_db($link,DBNAME);
	
	//4.定义sql语句，发送并执行
		$sql = "select * from user where userName='{$uname}' && password='{$upass}'";
		$result = mysqli_query($link,$sql);
		$row = mysqli_fetch_assoc($result);
	
		
		if(mysqli_num_rows($result)<=0){
				
				echo "<script>alert('账号或密码错误！请确认！');window.location.href='./login.php'</script>";	
				die;
			}
			
		
		
		$sql = "select * from user where userName='{$uname}' && auth='1'";
		$result = mysqli_query($link,$sql);
		
	//5.解析结果集
		if($result && mysqli_num_rows($result)>0){
			
			//解析结果集
			$row = mysqli_fetch_assoc($result);
			$_SESSION['id'] = $row['id'];
			$_SESSION['uname'] = $row['userName'];
			
			
			echo "<script>alert('登录成功！');window.location.href='index.php'</script>";
		
		}else{
			echo "<script>alert('登录失败！没有登录权限！');window.location.href='login.php'</script>";
			die;
		}
	
	//6.释放结果集，关闭数据库
		mysqli_free_result($result);
		mysqli_close($link);
?>
<?php
	// 开启session
	session_start();
	// 设置页面字符集
	header("Content-type:text/html;charset=utf-8");

	// 设置默认时区
	date_default_timezone_set('PRC');

	// 引入数据库配置
	include('../public/common/config.php');

	// 接收用户操作
	$act = $_GET['act'];

	// 处理用户操作
	switch($act){
		case 'login':
			// 接收数据
			$username = htmlspecialchars(trim($_POST['username']));
			$userpwd = md5(htmlspecialchars(trim($_POST['userpwd'])));
			$vcode = trim($_POST['vcode']);
			// 检验验证码
			$vcode = strtolower($vcode);
			$code = strtolower($_SESSION['code']);
			if($vcode != $code){
				echo '<script>
					alert("验证码错误");
					window.location.href="./login.php";
				</script>';
				exit;
			}

			$sql = "select id,level,status from shop_user where username='{$username}' and userpwd='{$userpwd}'";

			// 执行操作
			$result = mysqli_query($link,$sql);

			// 检测
			if($result && mysqli_num_rows($result)){
				$row = mysqli_fetch_assoc($result);
				$id = $row['id'];
				$level = $row['level'];

				// 已禁用的用户不允许登录
				if($row['status']!=1){
					echo '<script>
						alert("用户已禁用，禁止登录\n请联系管理员");
						window.location.href="./index.php";
					</script>';
					exit;
				}
				
				// 检测是否是第一次登录
				$sql = "select gold,lasttime from shop_user_details where uid={$id}";
				
				$result = mysqli_query($link,$sql);
				if($result && mysqli_num_rows($result)){
					$row = mysqli_fetch_assoc($result);
					// 检测是否是每天第一次登录
					$time = time();
					$lasttime = $row['lasttime'];
					$now = date('Ymd',$time);
					$lasttime = date('Ymd',$lasttime);

					if(($now-$lasttime)>=1){
						$gold = $row['gold']+10;	// 每天第一次登录金币+10
						$gold = ",gold={$gold}";
					} else {
						$gold = '';
					}

					$sql = "update shop_user_details set lasttime={$time}{$gold} where uid={$id}";
					
					// 执行更新
					$result = mysqli_query($link,$sql);
					if($result && mysqli_affected_rows($link)){
						// 更新成功，登录成功
						$_SESSION['user']['id'] = $id;
						$_SESSION['user']['level'] = $level;

						// 输出提示信息
						if(!empty($gold)){
							echo '<script>
								alert("登录成功，金币+10");
								window.location.href="./index.php";
							</script>';
						} else {
							echo '<script>
								alert("登录成功");
								window.location.href="./index.php";
							</script>';
						}
						exit;
					} else {
						// 更新失败，登录失败
						echo '<script>
							alert("登录失败，重新登录");
							window.location.href="./login.php";
						</script>';
						exit;
					}

				} else {
					// 登录失败
					echo '<script>
						alert("用户名或密码错误，登录失败，重新登录");
						window.location.href="./login.php";
					</script>';
					exit;
				}

			} else {
				// 登录失败，重新登录
				echo '<script>
					alert("用户名或密码错误，登录失败，重新登录");
					window.location.href="./login.php";
				</script>';
				exit;
			}
		break;
		case 'layout':
			unset($_SESSION['user']);
			header('location:./login.php');
			exit;
		break;
	}
<?php
	// 判断网站是否被关闭
    include('./public/common/init.php');
	// 接收错误信息
	if(isset($_GET['errno']) && !empty($_GET['errno'])){
		$errno = $_GET['errno'];

		// 设置错误信息
		switch ($errno) {
			case 1:
				$yzm = '<span class="red">验证码错误</span>';
			break;
			case 2:
				$pwd = '<span class="red">两次密码不一致</span>';
			break;
			case 3:
				$user = '<span class="red">用户名已存在</span>';
			break;
		}
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>注册页面</title>
	<link rel="stylesheet" href="./public/css/common.css">
	<link rel="stylesheet" href="./public/css/login_reg.css">
</head>
<body bgcolor="#F2F2F2">
	<!-- 顶部区域 -->
	<?php include('./public/common/header.php'); ?>
	<!-- logo -->
	<div class="wm">
		<div class="regLogo">
			<a href="#"><img src="./public/images/reg_logo.gif" alt=""></a>
		</div>
	</div>
	<!-- 注册表单 -->
	<div class="wm">
		<div class="regWay">
			<ul>
				<li class="on">个人用户</li>
				<li>企业用户</li>
				<li>International Customers</li>
			</ul>
		</div>
		<div class="fr alreadyReg">
			我已经注册，现在就
			<a href="./login.php" class="link" style="margin-right:20px;">登录</a>
			<a href="#" class="link fr">English</a>
		</div>
		<div class="clear"></div>
		<!-- 注册表单DIV -->
		<div class="regFormBox">
			<!-- 手机快速注册 -->
			<div class="phoneReg fr">
				<h3>手机快速注册</h3>
				<p>
					中国大陆手机用户,<br>
					编辑短信“<span>JD</span>”发送到: <br>
					<span>12345678911</span>
				</p>
			</div>
			<!-- 注册表单 -->
			<div class="regForm">
				<ul>
				<form action="./doaction.php?act=reg" method="post">
					<li>
						<label for="">
							<i class="red">*</i>用户名:
						</label>
						<input type="text" name="username">
						<?php echo isset($user) ? $user : '';?>
					</li>
					<li>
						<label for="">
							<i class="red">*</i>
							请设置密码:
						</label>
						<input type="password" name="userpwd">
						<?php echo isset($pwd) ? $pwd : '';?>
					</li>
					<li>
						<label for="">
							<i class="red">*</i>
							请确认密码:
						</label>
						<input type="password" name="userpwd2">
					</li>
					<li>
						<label for="">
							<i class="red">*</i>
							验证码:
						</label>
						<input type="text" name="vcode" class="yzm">
						<span>
							<img src="./public/common/yzm.php" id="yzm">
							看不清？<a href="javascript:void(0);" class="link" id="change">换一张</a>
							<?php echo isset($yzm) ? $yzm : '';?>
						</span>
					</li>
					<li>
						<input type="checkbox" name="read" id="">
						我已阅读并同意<a href="#" class="link">《京东用户注册协议》</a>
					</li>
					<li>
						<input type="submit" value="立即注册">
					</li>
				</form>
				</ul>
			</div>
		</div>
	</div>
	<!-- 底部 -->
	<?php include('./public/common/footer.php'); ?>
</body>
<script>
	// 单击更改验证码
	var yzm = document.getElementById('yzm');
	var change = document.getElementById('change');

	yzm.onclick = function(){
		yzm.src = './public/common/yzm.php?id='+Math.random();
	}
	change.onclick = function(){
		yzm.src = './public/common/yzm.php?id='+Math.random();
		return false;
	}
</script>
</html>
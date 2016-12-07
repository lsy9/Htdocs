<?php
	// 引入初始化文件
    include('./public/common/init.php');

    // 防止二次登录
    if(!empty($_SESSION['user'])){
    	header("location:./index.php");
    	exit;
    }
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>欢迎登陆</title>
	<link rel="stylesheet" href="./public/css/common.css">
	<link rel="stylesheet" href="./public/css/login_reg.css">
</head>
<body>
	<div class="w100">
		<div class="wm">
			<img src="./public/images/login_logo.png" alt="">
		</div>
	</div>
	<div class="w100 loginBg">
		<div class="wm">
			<div class="login">
				<h2>京东会员 <a href="./reg.php">立即注册</a></h2>
				<p class="tip">公众场所不建议自动登录，以防账号丢失</p>
				<div class="form">
					<form action="./doaction.php?act=login" method="post">
						<ul>
							<li>
								<span class="uid"></span>
								<input type="text" name="username" placeholder="用户名">
							</li>
							<li>
								<span class="pwd"></span>
								<input type="password" name="userpwd" placeholder="密码">
							</li>
							<li>
								<input type="checkbox" checked>自动登录
								<input type="checkbox">安全控件登录
								<a href="./forget.php" class="fr">
									忘记密码？
								</a>
							</li>
							<li>
								<input type="submit" value="登录">
							</li>
						</ul>
					</form>
				</div>
				<div class="otherLogin">
					<p>使用合作网站账号登录京东:</p>
					<ul>
						<li><a href="#">京东钱包</a></li>
						<li>|</li>
						<li><a href="#">QQ</a></li>
						<li>|</li>
						<li><a href="#">微信</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="w100">
		<div class="wm">
			<div class="fr dc mt10">
				<a href="">登录页面，调查问卷</a>
			</div>
		</div>
	</div>
</body>
</html>
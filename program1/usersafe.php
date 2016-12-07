<?php
	// 引入初始化文件
	include('./public/common/init.php');
	
	// 防止未登录直接进入
	if(empty($_SESSION['user'])){
		header('location:./login.php');
		exit;
	}
	// 获取操作
	$act = isset($_GET['act']) ? $_GET['act'] : 'changepwd';
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>账号安全|个人中心</title>
	<link rel="stylesheet" href="./public/css/common.css">
	<link rel="stylesheet" href="./public/css/userinfo.css">
	<script src="./public/js/jquery.js" type="text/javascript"></script>
	<style>
		input[type=password]{
			padding:5px;
			outline: 0;
		}
		.setOpt li{
			cursor: pointer;
		}
	</style>
</head>
<body>
	<!-- 顶部区域 -->
	<?php include('./public/common/header.php'); ?>
	<!-- 用户中心导航 -->
	<?php include('./public/common/usernav.php'); ?>
	<!-- 主体信息 -->
	<div id="main" class="w100">
		<div class="wm mt10">
			<!-- 左侧设置 -->
			<?php include('./public/common/userset.php'); ?>
			<?php
				// 获取用户信息
				$id = $_SESSION['user']['id'];
				$level = $_SESSION['user']['level'];
				$fields = 'u.username,u.nickname,u.userpic,d.gold,d.sex,d.email,d.lasttime';
				$table = 'shop_user u,shop_user_details d';
				$where = "u.id=d.uid and u.id={$id}";
				$userinfo = getRow($link,$table,$fields,$where);
			?>
			<!-- 右侧详细信息设置 -->
			<div class="setInfo fr">
				<!-- 设置选项 -->
				<div class="setOpt fl">
					<ul>
						<li class="<?php echo $act=='changepwd'?'on':''; ?>"><a href="./usersafe.php?act=changepwd">修改密码</a></li>
						<li class="<?php echo $act=='changeemail'?'on':''; ?>"><a href="./usersafe.php?act=changeemail">修改邮箱</a></li>
					</ul>
				</div>
				<div class="clear"></div>
				<div class="setMsg fl">
					<?php
						switch($act){
							case 'changepwd':
					?>
					<!-- 修改密码 -->
					<ul>
					<form action="./doaction.php?act=changepwd" method="post">
						<li>
							<label for=""><i class="red">*</i>旧密码</label>
							<input type="password" name="oldpwd" required autocomplete="off" id="">
						</li>
						<li>
							<label for=""><i class="red">*</i>新密码</label>
							<input type="password" name="newpwd1" required autocomplete="off" id="">
						</li>
						<li>
							<label for=""><i class="red">*</i>确认密码</label>
							<input type="password" name="newpwd2" required autocomplete="off" id="">
						</li>
						<li>
							<label for=""></label>
							<input type="submit" value="修改" class="btn btn-danger">
							<input type="reset" value="重置" class="btn btn-success">
						</li>
					</form>
					</ul>
					<?php
						break;
						case 'changeemail':
					?>
					<!-- 修改邮箱 -->
					<ul>
					<form action="./doaction.php?act=changeemail" method="post">
						<li>
							<label for="">
								<i class="red">*</i>绑定邮箱:
							</label>
							<?php
								$email = strstr($userinfo['email'], '@',true);
								$suffix = strrchr($userinfo['email'],'@');
								echo substr_replace($email,'***',3,strlen($email)-3) . $suffix;
							?>
						</li>
						<li>
							<label for=""><i class="red">*</i>确认邮箱</label>
							<input type="text" name="oldemail" required>
						</li>
						<li>
							<label for=""><i class="red">*</i>新邮箱</label>
							<input type="text" name="newemail" required>
						</li>
						<li>
							<label for=""></label>
							<input type="submit" value="修改" class="btn btn-danger">
							<input type="reset" value="重置" class="btn btn-success">
						</li>
					</form>
					</ul>
					<?php
						break;
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<!-- 底部 -->
	<?php include('./public/common/footer.php'); ?>
</body>
</html>
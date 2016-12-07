<?php
	// 引入初始化文件
	include('./public/common/init.php');
	
	// 防止未登录直接进入
	if(empty($_SESSION['user'])){
		header('location:./login.php');
		exit;
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>个人中心</title>
	<link rel="stylesheet" href="./public/css/common.css">
	<link rel="stylesheet" href="./public/css/userinfo.css">
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
				/*$sql = "select u.username,u.nickname,u.userpic,d.gold,d.sex,d.email,d.lasttime from shop_user u,shop_user_details d where u.id=d.uid and u.id={$id}";
				// 执行查询
				$result = mysqli_query($link,$sql);
				if($result && mysqli_num_rows($result)>0){
					$row = mysqli_fetch_assoc($result);
				}
				// 引入函数库文件
				include('./public/common/functions.php');*/
				$fields = 'u.username,u.nickname,u.userpic,d.gold,d.sex,d.email,d.lasttime';
				$table = 'shop_user u,shop_user_details d';
				$where = "u.id=d.uid and u.id={$id}";
				$row = getRow($link,$table,$fields,$where);
			?>
			<!-- 右侧详细信息设置 -->
			<div class="setInfo fr">
				<!-- 个人信息 -->
				<div class="user fr">
					<div class="userMsg">
						<div class="fl">
							<img src="./public/uploads/<?php echo $row['userpic']; ?>" class="userpic">
						</div>
						<p class="fl">
							用户名：<?php echo $row['username'];?> <br>
							<a href="javascript:void(0);" class="link"><?php echo getLevel($level); ?></a> <br>
							购物行为评级<br>
							会员类型：个人用户
						</p>
					</div>
					<p style="text-align:right;">注：修改手机和邮箱请到<a href="./usersafe.php" class="link">账户安全</a></p>
				</div>
				<!-- 设置选项 -->
				<div class="setOpt fl">
					<ul>
						<li class="on">基本信息</li>
						<!-- <li><a href="#">头像照片</a></li>
						<li><a href="#">更多个人信息</a></li> -->
					</ul>
				</div>
				<div class="clear"></div>
				<div class="setMsg fl">
					<ul>
					<form action="./doaction.php?act=info" method="post" enctype="multipart/form-data">
						<li>
							<label for="">
								<i class="red">*</i>用户名：
							</label>
							<?php echo $row['username']; ?>
						</li>
						<li>
							<label for="">
								昵称：
							</label>
							<input type="text" name="nickname" value="<?php echo $row['nickname']; ?>">
						</li>
						<li>
							<label for="">
								<i class="red">*</i>性别：
							</label>
					        <input class="common-text" name="sex" value="1" type="radio" <?php echo $row['sex']==1?'checked':''; ?>> 男
                            <input class="common-text" name="sex" value="2" type="radio" <?php echo $row['sex']==2?'checked':''; ?>> 女
                            <input class="common-text" name="sex" value="3" type="radio" <?php echo $row['sex']==3?'checked':''; ?>> 保密
						</li>
						<li>
							<label for="">
								头像：
							</label>
							<?php if(!empty($row['userpic'])){?>
                                <img src="./public/uploads/<?php echo $row['userpic']?>" width="50" >
                            <?php } else {?>
                                <img src="./public/images/default.jpg" width="50" >
                            <?php }?>
                            <input name="userpic" type="file">
						</li>
						<li>
							<label for="">
								金币：
							</label>
							<?php echo $row['gold']; ?>
						</li>
						<li>
							<label for="">
								最后登录：
							</label>
							<?php echo date('Y-m-d H:i:s',$row['lasttime']); ?>
						</li>
						<li>
							<label for=""></label>
							<input type="submit" value="修改" class="btn btn-danger">
							<input type="reset" value="重置" class="btn btn-success">
						</li>
					</form>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- 底部 -->
	<?php include('./public/common/footer.php'); ?>
</body>
</html>
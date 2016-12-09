<?php
    // 引入初始化文件
	include('./public/common/init.php');

   	include './public/common/config.php';
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>找回密码</title>
	<link rel="stylesheet" href="./public/css/common.css">
	<style type="text/css" media="screen">
		.comment-box{
			background: #FFF;
			border:1px solid #ddd;
			min-height: 400px;
		}
		.comment-box table{
			border-collapse: collapse;
			width:700px;
			margin-top:20px;
		}
		.comment-box table th,.comment-box table td{
			padding:5px 0px;
		}
		.comment-box table th{
			width:120px;
			text-align: right;
			padding-right: 15px;
			color:orange;
		}
		.comment-box textarea{
			width: 98%;
			padding:5px 3px;
			line-height: 1.3;
		}
	</style>
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
	<!-- 忘记密码 -->
	<div class="comment-box wm">
		<table>
		<form action="./doaction.php?act=forget" method="post">
			<tr>
				<th>用户名：</th>
				<td><input type="text" name="username" id=""></td>
			</tr>
			<tr>
				<th>请输入邮箱：</th>
				<td><input type="text" name="email" id=""></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="找回密码"></td>
			</tr>
		</form>
		</table>
	</div>
	<!-- 底部 -->
	<?php include('./public/common/footer.php'); ?>
</body>
</html>
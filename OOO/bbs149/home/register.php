<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>LAMP兄弟连-注册页</title>
		
		<link rel="stylesheet" type="text/css" href="../public/home/css/register.css"/>
		
	</head>
	<body>
		<!--顶部条-->

		<!--顶部条结束-->
		
		<!--header头-->
			<?php
			include("./head.php");
			?>
		<!--header头结束-->
		
		<!--导航条-->

		<!--导航条结束-->
		
		<!--大盒子-->
		<div id="big">
			<div class="btfont">
				<h3>注册</h3>
			</div>
			<div class="biaodan">
				<div class="tishi">
					<p>请填写能正常收发邮件的邮箱</p>
				</div>
				<form action="./doAction.php?a=register" method="post">
					<table width="380" border="0" cellspacing="15">
						<tr>
							<td class="you">用户名<span> *</span></td>
							<td class="zuo"><input type="text" name="uname"/></td>
						</tr>
						<tr>
							<td class="you">密  码<span> *</span></td>
							<td class="zuo"><input type="password" name="upass"/></td>
						</tr>
						<tr>
							<td class="you">确认密码<span> *</span></td>
							<td class="zuo"><input type="passowrd" name="surepass"/></td>
						</tr>
						<tr>
							<td class="you">电子邮箱<span> *</span></td>
							<td class="zuo"><input type="email" name="uemail"/></td>
						</tr>
						<tr style="text-align:center;">
							<td class="btn" colspan="2">
								<input type="submit" value="注册"/>
								<input type="reset" value="重置"/>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<div class="butdl">
				<h3>已经注册？</h3>
				<a href="./login.php"><button>去登陆</button></a>
			</div>
		</div>
		<div id="clear"></div>
		<!--大盒子结束-->
			
		<!--页面尾开始-->
			<?php
				include("./foot.php");
			?>
		<!--页面尾结束-->
	</body>
</html>
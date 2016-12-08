<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>LAMP兄弟连-登陆页</title>
		<link rel="stylesheet" type="text/css" href="../public/home/css/login.css"/>
	</head>
	<body>
			<?php
			include("./head.php");
			?>
			
		<!--顶部条-->

		<!--顶部条结束-->
		
		<!--header头-->
		
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
					<p>错误次数不得超过五次，否则会被锁定！</p>
				</div>
				<form action="./doAction.php?a=doLogin" method="post">
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
							<td class="you">验证码<span> *</span></td>
							<td>
							<input type="text" name="ucode" style="height:30px;width:100px;"/>
								<img src='../public/code.php' onclick="this.src='../public/code.php?id='+Math.random(0,1)" align='right'/>
							</td>
						<tr>

						<tr style="text-align:center;">
							<td class="btn" colspan="2">
								<input type="submit" value="登陆"/>
								<input type="reset" value="重置"/>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<div class="butdl">
				<h3>还没有账号？</h3>
				<a href="./register.php"><button>去注册</button></a>
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
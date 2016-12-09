	<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>个人中心</title>
		<link rel="stylesheet" type="text/css" href="../public/home/css/login.css"/>
		
	</head>
	<body>
	
		<?php
		require("./head.php");
		?>
		
		<?php
				$uid = $_SESSION['uid'];
				//	1.连接数据库，并判断
				$link = mysqli_connect("localhost","root","") or die("数据库连接失败");
				
				//	2.设置字符集
				mysqli_set_charset($link,"utf8");
				
				//	3.选择数据库
				mysqli_select_db($link,"bbs");

				
				//	4.定义sql语句，并发送
				$sql = "select user.userName,userdetail.* from user,userdetail where user.id=userdetail.uid && userdetail.uid={$uid}";
				$result = mysqli_query($link,$sql);
				
				//	5.解析结果集
				if($result && mysqli_num_rows($result)>0){
					//解析
					$row = mysqli_fetch_assoc($result);
				
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
				<h3>个人中心</h3>
			</div>
			<div class="biaodan">
				<form action="./doAction.php?a=update" method="post">
					<table width="380" border="0" cellspacing="15">
						<tr>
							<td class="you">账号<span> *</span></td>
							<td class="zuo"><input type="text" name="uname" disabled value="<?php echo $row['userName']?>"/></td>
						</tr>
						
						<tr>
							<td class="you">昵称<span> *</span></td>
							<td class="zuo"><input type="text" name="unickName" value="<?php echo $row['nickName']?>"/></td>
						</tr>
						<tr>
							<td class="you">密  码<span> *</span></td>
							<td class="zuo"><input type="password" name="upass" value=""/></td>
						</tr>
					
						<tr>
							<td class="you">邮箱<span> *</span></td>
							<td class="zuo"><input type="email" name="uemal" value="<?php echo $row['email']?>"/></td>
						</tr>
						<tr>
							<td class="you">QQ号<span> *</span></td>
							<td class="zuo"><input type="text" name="uqq" value="<?php echo $row['qq']?>"/></td>
						</tr>
						<tr>
							<td class="you">性别<span> *</span></td>
							<td class="you" style="float:left;">
								<input type="radio" name="usex" value='m'<?php echo $row['sex']=='m'?"checked":""?>/>男
								<input type="radio" name="usex" value='w'<?php echo $row['sex']=='w'?"checked":""?>/>女
							</td>
						</tr>

						
						<tr style="text-align:center;">
							<td class="btn" colspan="2">
								<input type="submit" value="修改"/>
								<input type="reset" value="重置"/>
							</td>
						</tr>
					</table>
				</form>
				<?php
				}
				?>
			</div>
			<div class="butdl">

			</div>
		</div>
		<div id="clear"></div>
		<!--大盒子结束-->
			
		<!--页面尾开始-->
		<?php
			require("./foot.php");
		?>
		<!--页面尾结束-->
	</body>
</html>
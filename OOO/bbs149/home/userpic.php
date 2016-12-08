<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>LAMP兄弟连-注册页</title>
		
		<link rel="stylesheet" type="text/css" href="../public/home/css/register.css"/>
		
	</head>
	<body>
			<?php
			include("./head.php");
			?>
			
			<?php
				
				
				
				//	1.连接数据库，并判断
				$link = mysqli_connect(HOST,USER,PASS) or die("数据库连接失败");
				
				//	2.设置字符集
				mysqli_set_charset($link,CHARSET);
				
				//	3.选择数据库
				mysqli_select_db($link,DBNAME);
				
				$uid = @$_SESSION['uid'];
				
				//	4.定义sql语句，并发送
				$sql = "select photo from userdetail where uid={$uid}";

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
				<h3>头像更改</h3>
			</div>
			<div class="biaodan">
				<div class="tishi">
					<p>请选择不要超过2M的图片</p>
				</div>
				<img src='../public/uploads/l_<?php echo $row['photo']?>' style='margin-left:240px;'>
				<form action='./doAction.php?a=pic' method='post' enctype='multipart/form-data'>
					<table width="380" border="0" cellspacing="15">
							<tr>
							<td class="zuo"><input type="file" name="upic"/></td>
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
				include("./foot.php");
			?>
		<!--页面尾结束-->
	</body>
</html>
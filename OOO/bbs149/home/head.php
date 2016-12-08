		<?php session_start(); ?>
		<!--顶部条-->
		
		<div id="top">
			<div class="middlediv">
				<ul id="leftnav">
					<li><a href="#">设为首页</a></li>
					<li><a href="#">收藏LAMP兄弟连</a></li>
				</ul>
				<ul id="rightnav">
					<li><a href="#">|帮助</a></li>
					<li><a href="#">推广链接</a></li>
					<li><a href="#">社区应用</a></li>
					<li><a href="#">最新帖子</a></li>
					<li><a href="#">精华区</a></li>
					<li><a href="#">社区服务</a></li>
					<li><a href="#">会员列表</a></li>
					<li><a href="#">统计排行</a></li>
					<li><a href="#">搜索</a></li>
				</ul>
			</div>
		</div>
		<!--顶部条结束-->
		<?php
			//1. 连接数据库，并判断
			$link = mysqli_connect("localhost","root","") or die("数据库连接失败！");
	
			//2. 设置字符集
			mysqli_set_charset($link,"utf8");
		
			//3. 选择数据库
			mysqli_select_db($link,"bbs");
			
			//4.定义sql语句，发送并执行
			$sql = "select * from config";
			$result = mysqli_query($link,$sql);
			
			//5.解析结果集
			if($result && mysqli_num_rows($result)>0){
				
				$row = mysqli_fetch_assoc($result);
				
			}
		?>
		<!--header头-->
		
		
		<div id="header">
		<div id="logo">
				<img src="../public/uploads/<?php echo $row['logo'];?>" width='233' height='80'/>
			</div>
			<div id="nobrother">
				<img src="../public/home/img/nobrother.jpg"/>
			</div>
			<?php
			//判断uid是否存在
			if(!isset($_SESSION['uid'])){
				//	引入公共配置文件
				require("../public/config.php");
				
			?>
				<div id="login">
				<form action="doAction.php?a=login" method="post">
					<table>
						<tr>
							<td><input type="text" name="uname" placeholder="输入用户名"/></td>
							<td><input type="checkbox" name=""/>记住密码</td>
							<td><a href="#"/>找回密码</a></td>
						</tr>
						<tr>
							<td><input type="password" name="upass" placeholder=""/></td>
							<td><input type="submit" value="登陆"/></td>
							<td><a href="./register.php"><input type="button" value="注册"/></a></td>
						</tr>
					</table>
				</form>
			</div>
		<?php
			}else{
				
				//	引入公共配置文件
				require("../public/config.php");
				
				//	1.连接数据库，并判断
				$link = mysqli_connect(HOST,USER,PASS) or die("数据库连接失败");
				
				//	2.设置字符集
				mysqli_set_charset($link,CHARSET);
				
				//	3.选择数据库
				mysqli_select_db($link,DBNAME);
				
				$uid = @$_SESSION['uid'];
				
				//	4.定义sql语句，并发送
				$sql = "select * from userdetail where uid={$uid}";
				/* echo "$sql";
				die; */
				$result = mysqli_query($link,$sql);
				
				//	5.解析结果集
				if($result && mysqli_num_rows($result)>0){
					
					//解析
					$row = mysqli_fetch_assoc($result);
					
				}
				
				$sql1 = "select * from user where id={$row['uid']}";
				$result1 = mysqli_query($link,$sql1);
				if($result1 && mysqli_num_rows($result1)>0){
					
					$row1 = mysqli_fetch_assoc($result1);
					
				}
				
		?>	
		<div>
			<table border='0' width='350' height='80'>
				<tr align='center'>
					<td width='80'>欢迎你：</td>
					<td width='80'><?php echo isset($row['nickName'])?$row['nickName']: "<a href='./mycenter.php'>前去设置</a>" ?></td>
					<td width='80'><a href='./mycenter.php'>个人中心</a></td>
					<td rowspan='2'><a href='./userpic.php'><img src="../public/uploads/s_<?php echo $row['photo'];?>" style="border:5px solid white;" height='65'></a></td>
				</tr>
				<tr align='center'>
					<td width='80'>会员积分</td>
					<td width='80'><?php echo $row1['points'];?></td>
					<td width='80'><a href='./doLogout.php'>注销</a></td>
				</tr>
			</table>
		</div>
		<?php
			//	6.释放结果集，关闭数据库
			mysqli_free_result($result);
			mysqli_close($link);
			}
		?>
		</div>
		
		<!--header头结束-->
		
		<!--导航条-->
		<div id="nav">
			<div class="middlediv">
				<ul id="middlenav">
					<li><a href="#">培训课程</a></li>
					<span class="point"><li><a href="./index.php">主页</a></li></span>
					<li><a href="#">兄弟连云课堂</a></li>
					<li><a href="#">PHP视频</a></li>
					<li><a href="#">Linux视频</a></li>
					<li><a href="#">战地日记</a></li>
				</ul>
				<div id="fastroad">
					<a href="#"><img src="../public/home/img/fastroad.jpg"/></a>
				</div>
			</div>
		</div>
		<!--导航条结束-->
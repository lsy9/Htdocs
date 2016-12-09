<?php
			//1. 连接数据库，并判断
			$link = mysqli_connect("localhost","root","") or die("数据库连接失败！");
	
			//2. 设置字符集
			mysqli_set_charset($link,"utf8");
		
			//3. 选择数据库
			mysqli_select_db($link,"bbs");
			
			//4.定义sql语句，发送并执行
			$sql = "select * from config where status=1";
			$result = mysqli_query($link,$sql);
			
			//5.解析结果集
			if($result && mysqli_num_rows($result)>0){
				
				echo "<script>alert('网站维护中，请稍后再访问！');window.location.href='#'</script>";
				
				die;
			}
			
			//定义sql语句并执行
			$sql1 = "select * from config";
			$result1 = mysqli_query($link,$sql1);
			
			//5.解析结果集
			if($result1 && mysqli_num_rows($result1)>0){
				
				$row1 = mysqli_fetch_assoc($result1);
				
			}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title><?php echo $row1['webname']?></title>
		<link rel="stylesheet" type="text/css" href="../public/home/css/index.css"/>
		<meta name="keywords" value="<?php echo $row1['keywords']?>"/>
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
			<!--顶部搜索条-->
			<div id="search">
				<form action="#" method="post">
					<input type="text" placeholder="让学习成为一种习惯!" name=""/>
					<select name="">
						<option value="1">帖子</option>
						<option value="2">日志</option>
						<option value="3">用户</option>
						<option value="4">板块</option>
					</select>
					<input type="submit" value="搜索"/>
				</form>
				<ul id="hot">
					<li>热搜：</li>
					<li class="red">php</li>
					<li class="red">php视频</li>
					<li class="red">php教程</li>
				</ul>
				<div id="guanzhu">
					<ul>
						<li><a href="#"><img src="../public/home/img/sina_n.png" title="关注新浪微博"/></a></li>
						<li><a href="#"><img src="../public/home/img/qq_n.png" title="添加到QQ"/></a></li>
						<li><a href="#"><img src="../public/home/img/6.gif" title="添加笔记"/></a></li>
						<li><a href="#"><img src="../public/home/img/21.gif" title="百度浏览"/></a></li>
						<li><a href="#"><img src="../public/home/img/medal.png" title="排行榜"/></a></li>
					</ul>
				</div>
			</div>
			<!--顶部搜索条结束-->
			
			<!--banner开始-->
			<div id="banner">
				<div id="leftban">
					<img src="../public/home/img/banner2.jpg"/>
				</div>
				<div id="middleban">
					<div class="topban">
						<img src="../public/home/img/topban1.jpg"/>
					</div>
					<div class="bottomban">
						<img src="../public/home/img/bottomban1.jpg"/>
					</div>
				</div>
				<div id="rightban">
					<div class="bottomban">
						<img src="../public/home/img/bottomban2.jpg"/>
					</div>
					<div class="topban">
						<img src="../public/home/img/topban2.jpg"/>
					</div>
				</div>
			</div>
			<!--banner结束-->
			
			<!--统计开始-->
			<div id="count">
				<div id="tongzhi">
					<ul>
						<li><a href="#" id="one">跟兄弟连学php正式发售啦</a></li>
						<li><a href="#" id="two">兄弟连2016年PHP课程体系全面升级！</a></li>
						<li><a href="#" id="three">兄弟连视频教程免费下载地址汇总</a></li>
						<li><a href="#" id="four">HTML5就业班，包吃、包住、包就业！</a></li>
					</ul>
				</div>
				<div id="tongji">
					<ul>
						<li>今日:<a href="#">169</a>|</li>
						<li>昨日:<a href="#">47</a>|</li>
						<li>最高日:<a href="#">116787</a>|</li>
						<li>会员:<a href="#">382450</a>|</li>
						<li>新会员:<a href="#">我是大牛</a></li>
					</ul>
				</div>
			</div>
			<!--统计结束-->
			
			<!--技术交流开始-->
			<?php

					//1.连接数据库
						$link = mysqli_connect(HOST,USER,PASS) or die ("数据库连接失败！");
						
					//2.设置字符集
						mysqli_set_charset($link,CHARSET);
						
					//3.选择数据库
						mysqli_select_db($link,DBNAME);
						
					//4.定义sql语句并执行
						$sql = "select * from type where pid=0";
						$result = mysqli_query($link,$sql);
					
					//5.判断
						if($result && mysqli_num_rows($result)>0){
							
							while($rows = mysqli_fetch_assoc($result)){
								
								

			?>
			
			<div id="jishu">
				<div class="biaoti">
					<div class="dabiao"></div>
						<h5>:::.<?php echo $rows['name'];?>:::.</h5>
					<div class="topjian"></div>
				</div>
				
				<?php
					//遍历子板块
					
					$sql1 = "select * from type where pid={$rows['id']}";
					$result1 = mysqli_query($link,$sql1);
					
					if($result1 && mysqli_num_rows($result1)){
						
						while($rows1 = mysqli_fetch_assoc($result1)){
						
					
				?>
				<div class="neirong">
					<div class="bankuai">
						<div class="tu">
							<a href="#"><img src="../public/uploads/<?php echo $rows1['blogo']?>" width='60' height='60'/></a>
						</div>
						<div class="wen">
							<ul>
								<li><a href="list.php?id=<?php echo $rows1['id']; ?>" class="dbt"><?php echo $rows1['name'];?></a><span>（今日14）</span></li>
								<li>主题：10737 帖子：523554</li>
								<li>最后发帖:2016-02-17 17:42</li>
							</ul>
						</div>
					</div>
				
				</div>
				<?php
						}
					}
				?>
			</div>
			<?php
						}
					}
			?>
			<!--技术交流结束-->
			
			<!--兄弟连开始-->
			
			<!--议事厅结束-->
			
			<!--友情链接开始-->
			<div id="youqing">
				<div class="biaoti">
					<div class="dabiao"></div>
						<h5>:::.友情链接:::.</h5>
					<div class="topjian"></div>
				</div>
				<?php
				
				//定义SQL语句,传值
				$sql3="select * from friendlink ";
				$result3=mysqli_query($link,$sql3);
				
				
				//判断
				if($result3 && mysqli_num_rows($result3)>0){
					while($rows3=mysqli_fetch_assoc($result3)){
					
				?>
				
				<ul style="float:left">
					<img src='../public/uploads/<?php echo $rows3['logo'];?>' width='20' height='20'><li><a href="<?php  echo $rows3['url'];?>"><?php echo $rows3['linkname'];?></a></li>
				</ul>
				
							
				<?php
					}
				
				}
				?>
			</div>			
			<!--友情链接结束-->

			
		</div>
		<!--大盒子结束-->
			
		<!--页面尾开始-->
			<?php
				include("./foot.php");
			?>
		<!--页面尾结束-->
	</body>
</html>
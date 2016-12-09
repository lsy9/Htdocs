<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>LAMP兄弟连-列表页</title>
	<link rel="stylesheet" type="text/css" href="../public/home/css/details.css"/>
		
	</head>
	<body>
	
		<!--header头-->
		<?php
		require("./head.php");
		?>
		<!--header头结束-->
		<?php
			//	获取id
			$id = $_GET['id'];
			$title = $_GET['title'];
			
			//	1.链接数据库，并判断
					$link = mysqli_connect(HOST,USER,PASS) or die ("数据库链接失败");
		
			//	2.设置字符集
					mysqli_set_charset($link,CHARSET);
	
			//	3.选择数据库
					mysqli_select_db($link,DBNAME);
			
			//	4.定义sql语句，并发送执行
				
					$sql = "select * from post where id={$id}";
					$result = mysqli_query($link,$sql);
					
			//	5.判断
					if($result && mysqli_num_rows($result)>0){
						
						$row = mysqli_fetch_assoc($result);
						
					}
					$time = date("Y-m-d H:i:s",$row['ctime']);
					
				//	定义sql语句
					$sql1 = "select * from post where title='{$title}'";
					$result1 = mysqli_query($link,$sql1);
					
					if($result1 && mysqli_num_rows($result1)>0){
						
						$row1 = mysqli_fetch_assoc($result1);
						
					}
					
					
					$sql2 = "select * from user where id={$row1['uid']}";
					$result2 = mysqli_query($link,$sql2);
					
					
					if($result2 && mysqli_num_rows($result2)>0){
						
						$row2 = mysqli_fetch_assoc($result2);
						
					}	
					$sql3 = "select * from userdetail where uid={$row1['uid']}";
					$result3 = mysqli_query($link,$sql3);
					if($result3 && mysqli_num_rows($result3)>0){
						
						$row3 = mysqli_fetch_assoc($result3);
						
					}	
		?>
		
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
			
			<!--引导层开始-->
			<div id="yindao">
				<p><a href="#">LAMP兄弟连</a> > <a href="#">PHP技术交流</a> > <a href="#"><?php echo $row['title']; ?></a></p>
			</div>
			<!--引导层结束-->
			
			<!--分页开始-->
			<div id="list">
				<div id="page">
					<div id="pagefy">
						<ul>
							<li><a href="#">< 返回列表</a></li>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#">6</a></li>
							<li><a href="#">…537</a></li>
							<li><a href="#">下一页 ></a></li>
						</ul>
					</div>
					<div id="fatie">
						<a href="#"><button image="../public/home/img/fatie.png">发帖</button></a>
					</div>
				</div>
			</div>
			<!--分页结束-->
			
			<!--楼主帖子详情结束-->
			<div id="bigdetail">
				<div id="detail">
					<div id="lzinfo">
						<div id="read">
							<p><?php echo $row['count']; ?></p>
							<p>阅读</p>
						</div>
						<div id="reply">
							<p>641</p>
							<p>回复</p>
						</div>
						
						<div id="lztoux">
							<div id="uname">
								<a href="#"><?php echo $row2['userName'];?></a>
							</div>
							<div id="utoux">
								<img src="../public/uploads/s_<?php echo $row3['photo'];?>"/>
							</div>
							<div id="ulevel">
								<a href="#">上士</a><br/>
								<img src="../public/home/img/jindu.png"/>
							</div>
							<div id="uhuiz">
								<a href="#"><img src="../public/home/img/huiz.png"/></a>
							</div>
							<div id="uguanz">
								<a href="#" class="jia">加关注</a>
								<a href="#" class="fa">发消息</a>
							</div>
						</div>
					</div>
					<div id="tzinfo">
						<div id="tzbiaot">
							<p><?php echo $row['title']; ?><span><a href="#">[复制链接]</a></span></p>
						</div>
						<div id="tzxiangq">
							<div id="fttime">
								<p>楼主 发表于:<?php echo $time; ?></p>
							</div>
							<div id="tzneir">
								<p><?php echo $row['content']; ?></p>
							</div>
							<div id="tzfenx">
								<a href="#"><img src="../public/home/img/wechat.png"/></a>
								<a href="#"><img src="../public/home/img/QQ.png"/></a>
								<a href="#"><img src="../public/home/img/qzone.png"/></a>
								<a href="#"><img src="../public/home/img/weibo.png"/></a>
							</div>
							
							<div id="tzpingf">
								<p>共<span>2</span>条评分，兄弟连粮票<span>+10</span></p>
							</div>
							<div id="tzpingfxx">
								
							</div>
							<div id="tzpingfxx">
								
							</div>
							<div id="tzpingfxx">
								
							</div>
							<div id="tzhuif">
							
							</div>
							<div id="tzshare">
							
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--楼主帖子详情结束-->
			<?php
					
			//	1.链接数据库，并判断
					$link = mysqli_connect(HOST,USER,PASS) or die ("数据库链接失败");
		
			//	2.设置字符集
					mysqli_set_charset($link,CHARSET);
	
			//	3.选择数据库
					mysqli_select_db($link,DBNAME);
					
			//	4.定义sql语句，并发送执行		
					$sql1 = "select * from reply where pid={$id}";
					$result1 = mysqli_query($link,$sql1);
			
			//	5.判断		
					if($result1 && mysqli_num_rows($result)>0){
						while($rows1 = mysqli_fetch_assoc($result1)){
						
						$sql2 = "select * from user where id={$rows1['uid']}";
						$result2 = mysqli_query($link,$sql2);
						if($result2 && mysqli_num_rows($result2)>0){
							
							$rows2 = mysqli_fetch_assoc($result2);
							
						$sql3 = "select * from userdetail where uid={$rows1['uid']}";
						$result3 = mysqli_query($link,$sql3);
						if($result3 && mysqli_num_rows($result3)>0){
							
							$rows3 = mysqli_fetch_assoc($result3);
							
			?>
				<div id="detail">
					<div id="lzinfo">
						
						<div id="lztoux">
							<div id="uname">
								<a href="#"><?php echo $rows2['userName'];?></a>
							</div>
							<div id="utoux">
								<img src="../public/uploads/s_<?php echo $rows3['photo'];?>"/>
							</div>
							<div id="ulevel">
								<a href="#">上士</a><br/>
								<img src="../public/home/img/jindu.png"/>
							</div>
							<div id="uhuiz">
								<a href="#"><img src="../public/home/img/huiz.png"/></a>
							</div>
							<div id="uguanz">
								<a href="#" class="jia">加关注</a>
								<a href="#" class="fa">发消息</a>
							</div>
						</div>
					</div>
					<div id="tzinfo">
						<div id="tzxiangq">
							<div id="fttime">
								<p>回复时间:<?php echo $time; ?></p>
							</div>
							<div id="tzneir">
								<p><?php echo $rows1['content']; ?></p>
							</div>
						
						</div>
					</div>
				</div>
				<?php
								}
							}
						}
					}
				?>
			<!--用户帖子回复详情结束-->
		<	<div id="detail">
					<div id="lzinfo">
						
					</div>
					<div id="tzinfo">
						<div id="tzxiangq">
						<form action="doAction.php?a=details&id=<?php echo $id ?>&title=<?php echo $title;?>" method="POST">	
							<textarea rows='20' cols='130' name='content'  ></textarea>
							<center><input type="submit" value="提交"  />
							<input type="reset" value="重置" /></center>
						</form>
						</div>
					</div>
				</div>
			
			<!--楼主帖子详情结束-->
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
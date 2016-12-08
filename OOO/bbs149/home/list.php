<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>LAMP兄弟连-列表页</title>
		<link rel="stylesheet" type="text/css" href="../public/home/css/list.css"/>
	
	</head>
	<body>
		<!--顶部条-->
		
		<!--顶部条结束-->
		
		<!--header头-->
		<?php
		require("./head.php");
		?>
		<!--header头结束-->
		<?php
				//	1.链接数据库，并判断
					$link = mysqli_connect(HOST,USER,PASS) or die ("数据库链接失败");
		
				//	2.设置字符集
					mysqli_set_charset($link,CHARSET);
	
				//	3.选择数据库
					mysqli_select_db($link,DBNAME);
					
					$tid = $_GET['id'];
					
				//	4.定义sql语句并发送执行
					$sql = "select * from type where id={$tid}";
					$result = mysqli_query($link,$sql);
					
					if($result && mysqli_num_rows($result)>0){
						
						$row = mysqli_fetch_assoc($result);
						
					}
		?>
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
			
			<!--引导层开始-->
			<div id="yindao">
				<p><a href="#">LAMP兄弟连</a> > <a href="#"><?php echo $row['name'];?></a></p>
			</div>
			<!--引导层结束-->
			
			<!--列表开始-->
			<div id="list">
				<div id="listbt">
					<div id="bkname">
						<h4><?php echo $row['name'];?></h4>
					</div>
					<div id="bzname">
						<h4>版主：远飞</h4>
					</div>
				</div>
				<div id="bkinfo">
					<div id="bklogo">
						<img src="../public/uploads/<?php echo $row['blogo'];?>"/>
					</div>
					<div id="tjinfo">
						<ul>
							<li>今日:<span>3</span> |</li>
							<li>主题:<span>10736</span> |</li>
							<li>贴数:<span>93546</span></li>
						</ul>
					</div>
					<div id="bkjianj">
						<p>PHP基础编程、疑难解答、学习和开发中的经验总结等。</p>
					</div>
				</div>
				<div id="page">
<!--				<div id="pagefy">
						<ul>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#">6</a></li>
							<li><a href="#">…537</a></li>
							<li><a href="#">下一页</a></li>
						</ul>
					</div>
					
				</div>-->
				<div id="tiezifl">
					<ul>
						<li class="gaol"><a href="#">全部</a></li>
						<li><a href="#">精华</a></li>
						<li><a href="#">投票</a></li>
						<li><a href="#">悬赏</a></li>
						<li><a href="#">商品</a></li>
					</ul>
				</div>
				<div id="tiezifl2">
					<ul>
						<li><a href="#">全部</a> |</li>
						<li><a href="#">已解决</a> |</li>
						<li><a href="#">我要提问</a> |</li>
						<li><a href="#">PHP</a> |</li>
						<li><a href="#">其他</a> |</li>
						<li><a href="#">经验技巧</a> |</li>
					</ul>
				</div>
				<div id="biaotou">
					<ul>
						<li class="tiezibt">排序:<a href="#">最新发帖</a>|<a href="#">最后回复</a></li>
						<li><a href="#">作者</a></li>
						<li><a href="#">回复</a></li>
						<li><a href="#">最后发表</a></li>
					</ul>
				</div>
				
				<?php
						//================分页程序======================================
					
					$tid = $_GET['id'];
					//分页所需要的变量
					$page = isset($_GET['p'])?$_GET['p']:1;		//当前页
					$pageSize = 5; //每页显示条数
					$maxPage = 7;	//总页数
					$maxRows = 68;	//总数据条数
					
					//求得总数据条数
					$sql = "select * from post where recycle='0' && tid={$tid}";
					$result = mysqli_query($link,$sql);
					$maxRows = mysqli_num_rows($result);
					
					//求得总共能分成多少页
					$maxPage = ceil($maxRows/$pageSize);
					
					//限制页数的范围
					if($page<1){
						$page=1;
					}
					if($page>$maxPage){
						$page=$maxPage;
					}
					
					//拼装分页的语句
					$limit = " limit ".(($page-1)*$pageSize).",".$pageSize;
					
					/*  limit (1-1)*10,10;	limit 0,10;
						limit (2-1)*10,10;	limit 10,10;	
						limit (3-1)*10,10;	limit 20,10; */
					
					//==============================================================
				
				
				//4.定义sql语句，并发送执行
					
				
				//var_dump($tid);die;
					$sql = "select * from post where recycle='0' && tid={$tid} order by top desc".$limit;
				//var_dump($sql);
					$result = mysqli_query($link,$sql);
					
					
				
				//5.判断
					if($result && mysqli_num_rows($result)>0){
						//解析结果集
						while($row1 = mysqli_fetch_assoc($result)){
							
						$ctime = date("Y-m-d H:i:s",$row1['ctime']);
						$sql2 = "select * from user where id={$row1['uid']}";
						$result2 = mysqli_query($link,$sql2);
						$row2 = mysqli_fetch_assoc($result2);
						
						
				?>
				<div id="listks">
					
		

					<div class="invitationzt">
						<div class="invitalogo">
							<img src="../public/home/img/
							<?php
								if($row1['top']=='1'){
									echo 'zhiding.png';
								}else{
									echo $row1['elite']=='1'?'jiajing.png':'tongzhi.png';
								}
							?>"/>
						</div>
						<div class="invitationbt">
							<a href="./details.php?id=<?php echo $row1['id']; ?>&uid=<?php echo $row1['uid'];?>&title=<?php echo $row1['title'];?>"><?php echo $row1['title'];?></a>
						</div>
						<div class="custorzt">
							<img src="../public/home/img/zuanshi.png"/>
						</div>
						<div class="custor">
							<a href="#"><?php echo $row2['userName'];?></a>
						</div>
						<div class="reply">
							<a href="#"><?php echo $row1['count'];?></a>
						</div>
						<div class="last">
							<a href="#"><?php echo $ctime;?></a>
						</div>
					</div>
					<?php
									}
								}	
							 
						
					
					?>
				</div>
				<div id="page">
					<div id="pagefy">
					<?php	
						echo "当前页 {$page}/总页数 {$maxPage}/总条数 {$maxRows}&nbsp;";
						echo "<a href='./list.php?id={$tid}&p=1'>首页</a>&nbsp;";
						echo "<a href='./list.php?id={$tid}&p=".($page-1)."'>上一页</a>&nbsp;";
						echo "<a href='./list.php?id={$tid}&p=".($page+1)."'>下一页</a>&nbsp;";
						echo "<a href='./list.php?id={$tid}&p={$maxPage}'>末页</a>";
					?>
					</div>
					<div id="fatie">
						<a href="./fatie.php?id=<?php echo $tid;?>"><button image="../public/home/img/fatie.png">发帖</button></a>
					</div>
				</div>
			</div>
			<!--列表结束-->
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
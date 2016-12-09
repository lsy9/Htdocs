<!DOCTYPE html>
<html>
	<head>
		<title>发帖页</title>
		<meta charset="utf-8"/>
		<style>
		*{
			padding:0px;
			margin:0px;
		}
		body{
			background-color:#f1f2f6;
		}
		#nav{
			width:100%;
			height:29px;
			background-color:#e6e9ee;
			margin-bottom:1px solid white;
		}
			#nav ul li{
			float:left;
			list-style:none;
			padding-left:20px;
			padding-top:5px;
			}
			#nav ul li a{
				text-decoration:none;
				color:black;
				font-size:15px;
			}
			#nav .ulone{
				margin-left:200px;
			}
			#nav .ultwo{
				padding-left:460px;
			}
		#top{
			width:950px;
			height:80px;
			margin:0 auto;
		}
			#topleft{
				width:300px;
				height:80px;
				float:left;
			}
			#topcenter{
				width:290px;
				height:80px;
				float:left;
			}
			#topright{
				width:350px;
				height:80px;
				float:right;
			}
		#centernav{
			width:100%;
			height:45px;
			clear:both;
			background-color:#075992;
		}
			#centernav ul li{
				list-style:none;
				float:left;
				padding-left:30px;
			}
			#centernav ul{
				padding-left:200px;
				padding-top:12px;
			}
			#centernav ul li a{
				font-size:20px;
				color:white;
				text-decoration:none;
			}
			#centernav input[name='fast']{
				float:right;
				padding-right:220px;
		}
		#search{
			width:950px;
			height:40px;
			margin:0 auto;
			background:url("./webpic/searchA.jpg");
		}
		/*bodyer体开始*/
		#lujing{
			width:950px;
			height:40px;
			margin:0 auto;
			padding-top:14px;
		}
		#content{
			width:950px;
			
			margin:0 auto;
			background-color:#ffffff;
		}	
			#content #con1{
				width:950px;
				height:50px;
			}
		
		/*bodyer体结束*/
		
		/*footer脚开始*/
		#foot{
			width:950px;
			height:80px;
			margin:0px auto;
			margin-top:10px;
		}
		#foot ul{
			padding-top:10px;
			padding-left:300px;
		}
		#foot ul li{
			list-style:none;
			float:left;
		}
		#foot ul li a{
			text-decoration:none;
			padding-left:5px;
			color:black;
		}
		.clear{
			clear:both;
		}
		</style>
		<link rel="stylesheet" type="text/css" href="../public/home/css/index.css"/>
		
	</head>
	<body>
		<!--顶部条-->
		<?php require('./head.php');?>
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
			
		
		
		<!--bodyer体开始-->
		<div id='lujing'><img src='../public/home/img/ydjian.png'>LAMP兄弟连>战地日记>发表帖子</div>
		<div id='content'>
		<?php
			//	获取父id
			$tid = $_GET['id'];
			
			
			//	1.链接数据库，并判断
					$link = mysqli_connect(HOST,USER,PASS) or die ("数据库链接失败");
		
				//	2.设置字符集
					mysqli_set_charset($link,CHARSET);
	
				//	3.选择数据库
					mysqli_select_db($link,DBNAME);
					
				//	4.定义sql语句，并发送执行
					$sql1 = "select name from type where id={$tid}";
					$result1 = mysqli_query($link,$sql1);
					
					//	5判断
					if($result1 && mysqli_num_rows($result1)>0){
						$row1 = mysqli_fetch_assoc($result1);
						
					}

		?>
		
		
		<form method="post" action="./doAction.php?a=addpost&id=<?php echo $tid;?>" >
			<div id='con2'>
			
				<input type='text' name='tid' value='<?php echo $row1['name']; ?>' readonly style="height:30px"/>
				<input type='text' name='title' style='width:300px;height:30px'/>
			</div>
			
			<textarea rows='20' cols='130' name='content'  ></textarea><br/><br/>
		<input type='submit' value='提交'/>
		<input type='reset' value='重置'/>
		</div>	
		</form>	
					
		<!--bodyer体结束-->	
	<?php
	
	?>
	</body>
</html>






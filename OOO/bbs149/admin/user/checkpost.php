<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>主要内容区main</title>
		<link href="../../public/admin/css/css.css" type="text/css" rel="stylesheet" />
		<link href="../../public/admin/css/main.css" type="text/css" rel="stylesheet" />
		<link rel="shortcut icon" href="../../public/admin/img/main/favicon.ico" />
		<style>
			body{overflow-x:hidden; background:#f2f0f5; padding:15px 0px 10px 5px;}
			#searchmain{ font-size:12px;}
			#search{ font-size:12px; background:#548fc9; margin:10px 10px 0 0; display:inline; width:100%; color:#FFF; float:left}
			#search form span{height:40px; line-height:40px; padding:0 0px 0 10px; float:left;}
			#search form input.text-word{height:24px; line-height:24px; width:180px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
			#search form input.text-but{height:24px; line-height:24px; width:55px; background:url(../../public/admin/img/main/list_input.jpg) no-repeat left top; border:none; cursor:pointer; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666; float:left; margin:8px 0 0 6px; display:inline;}
			#search a.add{ background:url(../../public/admin/img/main/add.jpg) no-repeat -3px 7px #548fc9; padding:0 10px 0 26px; height:40px; line-height:40px; font-size:14px; font-weight:bold; color:#FFF; float:right}
			#search a:hover.add{ text-decoration:underline; color:#d2e9ff;}
			#main-tab{ border:1px solid #eaeaea; background:#FFF; font-size:12px;}
			#main-tab th{ font-size:12px; background:url(../../public/admin/img/main/list_bg.jpg) repeat-x; height:32px; line-height:32px;}
			#main-tab td{ font-size:12px; line-height:40px;}
			#main-tab td a{ font-size:12px; color:#548fc9;}
			#main-tab td a:hover{color:#565656; text-decoration:underline;}
			.bordertop{ border-top:1px solid #ebebeb}
			.borderright{ border-right:1px solid #ebebeb}
			.borderbottom{ border-bottom:1px solid #ebebeb}
			.borderleft{ border-left:1px solid #ebebeb}
			.gray{ color:#dbdbdb;}
			td.fenye{ padding:10px 0 0 0; text-align:right;}
			.bggray{ background:#f9f9f9}
		</style>
	</head>
	<body>
		<!--main_top-->
		<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
		  <tr>
			<td width="99%" align="left" valign="top">您的位置：帖子管理  >  帖子列表</td>
		  </tr>
		  <tr>
			<td align="left" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
				<tr>
				 <td width="80%" align="left" valign="middle">
					 <form method="get" action="./article_list.php">
					 <span>管理员：</span>
					 <input type="text" name="title" value="" class="text-word">				
					 <input name="" type="submit" value="查询" class="text-but">
					 </form>
				 </td>
				  <td width="10%" align="center" valign="middle" style="text-align:right; width:150px;"><a href="add.html" target="mainFrame" onFocus="this.blur()" class="add">新增管理员</a></td>
				</tr>
			</table>
			</td>
		  </tr>
		  <tr>
			<td align="left" valign="top">
			
			<table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
			  <tr>
				<th align="center" valign="middle" class="borderright">编号</th>
				<th align="center" valign="middle" class="borderright">回帖人</th>
				<th align="center" valign="middle" class="borderright">回帖时间</th>
				<th align="center" valign="middle">操作</th>
			  </tr>
			  
			  <?php
				   //引入配置文件
				   require("../../public/config.php");
				   
				   //1 链接数据库，并判断对否成功
				   $link = mysqli_connect(HOST,USER);
				   
				   //2 设置字符集
				   mysqli_set_charset($link,CHARSET);
				   
				   //3 选择数据库
				   mysqli_select_db($link,DBNAME);
				   
				   //接收变量
				   $pid = $_GET['id'];
				   
				   //定义一个存放搜索条件的变量
				   $whereList = array();
				   
				   //定义一个维持url地址条件的变量
				   $urlList = array();
				   
				   //判断有没有搜索title
				   if(!empty($_GET['title'])){
					   $whereList[] = "title like '%{$_GET['title']}%'";
					   $urlList[] = "title={$_GET['title']}";
				   }
				   
				   //定义一个存放where语句的变量
				   $where = "";
				   //定义一个存放url地址条件的变量
				   $url = "";
				   
				   //拼装where语句
			 	   if(count($whereList)>0){
					   $where = " where  pid={$pid} && ".implode("&&",$whereList);
					   $url = "&".implode("&",$urlList);
				   } else{
					   $where = "where  pid={$pid}";
					   $url = "&".implode("&",$urlList);
				   }
				   
				   //定义必要的变量
				   $page = isset($_GET['p'])?$_GET['p']:1; //设置当前页数的变量
				   $pageSize = 5;  //设置页大小为10
				   $maxPage = 0;  //总页数
				   $maxRows = 0;  //总条数
				   
				   //求得总条数
				   $sql = "select * from reply ".$where;
				   $result = mysqli_query($link,$sql);
				   $maxRows = mysqli_num_rows($result);
				 
				   //求得总页数
					$maxPage = ceil($maxRows/$pageSize);
				   
				   //限制页范围
				   if($page<1){
					   $page = 1;
				   }if($page>$maxPage){
					   $page = $maxPage;
				   }
				   
				   //拼装分页语句
				   $limit = " limit ".(($page-1)*$pageSize).",".$pageSize;
				   
				   //4 定义sql语句，并发送执行
				   $sql = "select * from reply  ".$where.$limit;
				  
				   $result = mysqli_query($link,$sql);
				   
				   //5 解析结果集
				   if($result && mysqli_num_rows($result)>0){
					   
					   //将结果集中的数据遍历出来
					   while($rows = mysqli_fetch_assoc($result)){
						 
						 //查询发帖人的信息
						 $sql1 = "select * from user where id={$rows['uid']}";
						 $result1 = mysqli_query($link,$sql1);
						 
						 //判断
						 if($result1 && mysqli_num_rows($result1)>0){
							 $rows1 = mysqli_fetch_assoc($result1);
						 }
						 
			?>
				<tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
					<td align="center" valign="middle" class="borderright borderbottom"><?php echo $rows['id'];?></td>
					<td align="center" valign="middle" class="borderright borderbottom"><?php echo $rows1['userName']; ?></td>
					<td align="center" valign="middle" class="borderright borderbottom"><?php echo date("Y-m-d H:i:s",$rows['ctime']); ?></td>
					<td align="center" valign="middle" class="borderbottom">
						<a href="./checkreply.php?pid=<?php echo $rows['pid']; ?>" target="mainFrame" onFocus="this.blur()" class="add">查看回复</a><span class="gray">&nbsp;|&nbsp;</span>
						<a href="./updatereply.php?id=<?php echo $rows['id']; ?>" target="mainFrame" onFocus="this.blur()" class="add">编辑</a><span class="gray">&nbsp;|&nbsp;</span>
						<a href="./doAction.php?a=deletereply&id=<?php echo $rows['id']; ?>&pid=<?php echo $rows['pid']; ?>" target="mainFrame" onFocus="this.blur()" class="add">删除</a>
					</td>
				</tr>
			<?php
				
					   }
				   }
				   
			  ?>
			 
			</table>
			</td>
			</tr>
		  <tr>
			<td align="left" valign="top" class="fenye">
				<?php 
					echo "当前页：{$page} / 总页数 {$maxPage}&nbsp;&nbsp;";
					echo "<a href='./article_list.php?p=1{$url}'>首页</a>&nbsp;&nbsp;";
					echo "<a href='./article_list.php?p=".($page-1)."{$url}'>上一页</a>&nbsp;&nbsp;";
					echo "<a href='./article_list.php?p=".($page+1)."{$url}'>下一页</a>&nbsp;&nbsp;";
					echo "<a href='./article_list.php?p={$maxPage}{$url}'>末页</a>";
				?>
			</td>
		  </tr>
		</table>
	</body>
</html>
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
			<td width="99%" align="left" valign="top">您的位置：友情链接列表</td>
		  </tr>
		  <tr>
			<td align="left" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
				<tr>
				 <td width="90%" align="left" valign="middle">
					<form  action="./tiezi_list.php" method="get">
					 <span>标题：	<input type="text" size="10" name="utitle"/></span>
					<!--<span>ID：	<input type="text" size="10" name="uid"/></span>-->
					<!--<span>AUTH：	<input type="text" size="5" name="auth"/></span>-->
					 <input type="submit" value="查询" class="text-but">
				 </form>
				 </td>
				  <td width="10%" align="center" valign="middle" style="text-align:right; width:150px;"><a href="add.php" target="mainFrame" onFocus="this.blur()" class="add">新增管理员</a></td>
				</tr>
			</table>
			</td>
		  </tr>
		  <tr>
			<td align="left" valign="top">
			
			<table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
			  <tr>
				<th align="center" valign="middle" class="borderright">ID</th>
				<th align="center" valign="middle" class="borderright">友情链接名称</th>
				<th align="center" valign="middle" class="borderright">友情链接地址</th>
				<th align="center" valign="middle" class="borderright">友情链接logo</th>
				<th align="center" valign="middle" class="borderright">友情链接描述</th>
				<th align="center" valign="middle" class="borderright">友情链接排序</th>
				<th align="center" valign="middle">操作</th>
			  </tr>
			  <?php
				//0.引入公共配置文件
				require("../../public/config.php");
					
				//1.连接数据库
					$link = mysqli_connect(HOST,USER,PASS) or die("数据库连接失败！");
					
				//2.设置字符集
					mysqli_set_charset($link,CHARSET);
					
				//3.选择数据库
					mysqli_select_db($link,DBNAME);
					
				//4.定义sql语句，并发送执行
					$sql = "select * from friendlink";
					$result = mysqli_query($link,$sql);
					
				//5.判断
					if($result && mysqli_num_rows($result)>0){
						while($rows = mysqli_fetch_assoc($result)){
							//var_dump($rows);die;
					
			
			?>
			  <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
				<td align="center" valign="middle" class="borderright borderbottom"><?php echo $rows['id']?></td>
				<td align="center" valign="middle" class="borderright borderbottom"><?php echo $rows['linkname']?></td>
				<td align="center" valign="middle" class="borderright borderbottom"><?php echo $rows['url']?></td>
			 
				<td align="center" valign="middle" class="borderright borderbottom"><img src="../../public/uploads/s_<?php echo $rows['logo']?> ">
						</td></td>
				<td align="center" valign="middle" class="borderright borderbottom"><?php echo  $rows['content']?></td>
				<td align="center" valign="middle" class="borderright borderbottom"><?php echo $rows['ordernum']?></td>
				
				<td align="center" valign="middle" class="borderbottom">
				<a href="doFriendLink.php?a=del&id=<?php echo $rows['id']?>" target="mainFrame" onFocus="this.blur()" class="add">删除</a>
				<span class="gray">&nbsp;|&nbsp;</span>
				<a href="editfriendLink.php?id=<?php echo $rows['id']?>" target="mainFrame" onFocus="this.blur()" class="add">编辑</a>
				
				
				</td>
			  </tr>
			   <?php
							}
						}
			  
			  ?>
			</table></td>
			</tr>
		  
		</table>
		<br/><br/>
		<center>
		<tr>
			<!--<?php 
				echo "当前页 {$page}/总页数 {$maxPage}/总条数 {$maxRows}&nbsp;";
				echo "<a href='./tiezi_list.php?p=1{$url}'>首页</a>&nbsp;";
				echo "<a href='./tiezi_list.php?p=".($page-1)."{$url}'>上一页</a>&nbsp;";
				echo "<a href='./tiezi_list.php?p=".($page+1)."{$url}'>下一页</a>&nbsp;";
				echo "<a href='./tiezi_list.php?p={$maxPage}{$url}'>末页</a>";
			?>-->
		  </tr>
		  </center>
	</body>
</html>
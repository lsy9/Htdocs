<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>主要内容区main</title>
<link href="../../public/admin/css/css.css" type="text/css" rel="stylesheet" />
<link href="../../public/admin/css/main.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="images/main/favicon.ico" />
<style>
body{overflow-x:hidden; background:#f2f0f5; padding:15px 0px 10px 5px;}
#searchmain{ font-size:12px;}
#search{ font-size:12px; background:#548fc9; margin:10px 10px 0 0; display:inline; width:100%; color:#FFF}
#search form span{height:40px; line-height:40px; padding:0 0px 0 10px; float:left;}
#search form input.text-word{height:24px; line-height:24px; width:180px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
#search form input.text-but{height:24px; line-height:24px; width:55px; background:url(../../public/admin/img/main/list_input.jpg) no-repeat left top; border:none; cursor:pointer; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666; float:left; margin:8px 0 0 6px; display:inline;}
#search a.add{ background:url(../../public/admin/img/main/add.jpg) no-repeat 0px 6px; padding:0 10px 0 26px; height:40px; line-height:40px; font-size:14px; font-weight:bold; color:#FFF}
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
#addinfo{ padding:0 0 10px 0;}
</style>
</head>
<body>
<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <td width="99%" align="left" valign="top" id="addinfo">您的位置：帖子管理&nbsp;&nbsp;>&nbsp;&nbsp;帖子列表&nbsp;&nbsp;>&nbsp;&nbsp;帖子回复</td>
  </tr>
  <tr>
    <td align="left" valign="top">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr>
        <th align="center" valign="middle" class="borderright">编号</th>
        <th align="center" valign="middle" class="borderright">回帖人</th>
  		<th align="center" valign="middle" class="borderright">标题</th>
        <th align="center" valign="middle" class="borderright">留言时间</th>
        <th align="center" valign="middle">操作</th>
      </tr>
	  <?php
		//链接数据库
		$con = mysql_connect('localhost','root','');
		
		//选择数据库
		mysql_select_db('lamp111');
		
		//设置字符集
		mysql_set_charset('utf8');
		
		//准备SQL语句
		$SQL = "select *,(select userName from user where user.id=reply.uid) as userName,(select title from post where post.id=reply.pid) as title from reply where pid=".$_GET['id'];
		
		//$SQL = "select *,(select userName from user where user.id=reply.uid) as userName,(select title from post where post.id=reply.pid) as title from reply where pid=".$_GET['id'];
		 
		echo $SQL;
		//执行SQl语句
		$result = mysql_query($SQL);
		
		
		$SQL1 = "select post.reveal from post,reply where post.id=reply.pid";
		$result1 = mysql_query($SQL1);
		@$arrayb = mysql_fetch_assoc($result1);
		//循环显示数据
		//编号
		$num = 1;
		while($array = mysql_fetch_assoc($result)){
		
		var_dump($array);
	?>
			  <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
				<td align="center" valign="middle" class="borderright borderbottom"><?php echo $num ?></td>
				<td align="center" valign="middle" class="borderright borderbottom"><?php echo $array['userName'] ?></td>
				<td align="center" valign="middle" class="borderright borderbottom"><a href="message_info.html" target="mainFrame" onFocus="this.blur()"><?php echo $array['title'] ?></a></td>
				<td align="center" valign="middle" class="borderright borderbottom"><?php echo date('Y-m-d H:i:s', $array['ctime']) ?></td>
				<td align="center" valign="middle" class="borderbottom">
				<!--<a href="./doReveal.php?id=<?php echo $array['id']?>&reveal=<?php  echo $arrayb['reveal']?>" target="mainFrame" onFocus="this.blur()" class="add"><?php if($arrayb['reveal'] == 0){ echo "允许显示"; }else{ echo "不允许显示";} ?></a><span class="gray">&nbsp;|&nbsp;</span>-->
				<a href="./delReply.php?rid=<?php echo $array['id'] ?>&id=<?php echo $_GET['id'] ?>" target="mainFrame" onFocus="this.blur()" class="add">删除</a><span class="gray">&nbsp;|&nbsp;</span>
				<a href="./lookReply.php?id=<?php echo $array['id'] ?>&name=<?php echo $array['userName'] ?>&title=<?php echo $array['title'] ?>&id=<?php echo $_GET['id'] ?>" target="mainFrame" onFocus="this.blur()" class="add">查看</a></td>
			  </tr>
	  <?php
			$num++;
		}
	  ?>
    </table></td>
    </tr>
  <tr>
    <td align="left" valign="top" class="fenye"></td>
  </tr>
</table>
</body>
</html>
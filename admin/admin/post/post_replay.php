<?php
	$id = $_GET['id'];

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查看帖子</title>
<link href="../../public/admin/css/css.css" type="text/css" rel="stylesheet" />
<link href="../../public/admin/css/main.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="../../public/admin/img/main/favicon.ico" />
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
.bggray{ background:#f9f9f9; font-size:14px; font-weight:bold; padding:10px 10px 10px 0; width:120px;}
.main-for{ padding:10px;}
.main-for input.text-word{ width:310px; height:36px; line-height:36px; border:#ebebeb 1px solid; background:#FFF; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; padding:0 10px;}
.main-for select{ width:310px; height:36px; line-height:36px; border:#ebebeb 1px solid; background:#FFF; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666;}
.main-for input.text-but{ width:100px; height:40px; line-height:30px; border: 1px solid #cdcdcd; background:#e6e6e6; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#969696; float:left; margin:0 10px 0 0; display:inline; cursor:pointer; font-size:14px; font-weight:bold;}
#addinfo a{ font-size:14px; font-weight:bold; background:url(../../public/admin/img/main/replayblack.jpg) no-repeat 0 0px; padding:0px 0 0px 20px; line-height:45px;}
#addinfo a:hover{ background:url(../../public/admin/img/main/replayblue.jpg) no-repeat 0 0px;}
</style>
</head>
<body>
<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <td width="99%" align="left" valign="top">您的位置：帖子管理&nbsp;&nbsp;>&nbsp;&nbsp;查看帖子</td>
  </tr>
  <tr>
    <td align="left" valign="top" id="addinfo">
    <a href="./post_message.php" target="mainFrame" onFocus="this.blur()" class="add">返回上一级</a>
    </td>
  </tr>
  <tr>
  
  
  <?php
		/***查询帖子的相关信息（开始）*****/
		//连接数据库
		mysql_connect('localhost','root','');
		
		//选择数据库
		mysql_select_db('lamp111');
		
		mysql_set_charset('utf8');
		
		//准备SQL语句
		$psql = "select id,uid,tid,title,content,ctime,count from post where id=$id";

		//执行SQL语句
		$presult = mysql_query($psql);
			
		//获取结果集
		$parray = mysql_fetch_assoc($presult);
		
		
		
		$sql = " select * from user where id ={$parray['uid']}";
		$result1=mysql_query($sql);
		$arraya=mysql_fetch_assoc($result1);
		
		/****查询帖子的相关信息（结束）*******/
		
		
	?>
	
	
	<?php
		
		/****查询帖子的所属版块（开始）******/
		
		//准备 SQL 语句  
		$tsql = "select name,pid from type where id={$parray['tid']}";//先查询出子版块的父类id即子版块的pid（查询主版块的第一步），name为子版块的名字
		
		//执行SQL语句
		$tresult = mysql_query($tsql);
		
		//获取结果集
		@$tarray = mysql_fetch_assoc($tresult);
		
		/*************************查询帖子的所属版块（结束）*****************************/
		
		
		/********************根据查询出来的子版块pid查询所属主版块（开始）**********************/
		
		//准备SQL语句
		$fraTypeSQL = "select name from type where id={$tarray['pid']}";//根据查询出来的子版块pid查询所属主版块
		
		//执行SQL语句
		$fraTypeResult = mysql_query($fraTypeSQL);
		
		//获取结果集
		@$fraTypeArray = mysql_fetch_assoc($fraTypeResult);
		
		
		/********************根据查询出来的子版块id查询所属主版块（结束）**********************/
  ?>
  
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
	  <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">帖子ID：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for"><?php echo "{$parray['id']}" ?></td>
      </tr>
	  <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">所属版块：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for"><?php echo "{$fraTypeArray['name']}",">>>>>","{$tarray['name']}" ?></td>
      </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">帖子名称：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for"><?php echo "{$parray['title']}" ?></td>
      </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">发帖人：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for"><?php echo "{$arraya['userName']}" ?></td>
        </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">帖子内容：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for"><?php echo "{$parray['content']}" ?></td>
      </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">发帖时间：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for"><?php echo "{$parray['ctime']}" ?></td>
      </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">阅读量：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for" ><?php echo "{$parray['count']}" ?></td>
      </tr>
    
    </table>
    </td>
	

	
    </tr>
</table>
</body>
</html>
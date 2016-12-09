<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>帖子编辑</title>
<link href="../../public/admin/css/css.css" type="text/css" rel="stylesheet" />
<link href="../../public/admin/css/main.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="../../public/admin/img/main/favicon.ico" />

		<link rel="stylesheet" type="text/css" href="../editor/styles/font-awesome.css" />
        <link rel="stylesheet" type="text/css" href="../editor/styles/simditor.css" />
        <link rel="stylesheet" type="text/css" href="../editor/styles/simditor-emoji.css" />

        <script type="text/javascript" src="../editor/scripts/jquery.min.js"></script>
        <script type="text/javascript" src="../editor/scripts/module.js"></script>
        <script type="text/javascript" src="../editor/scripts/uploader.js"></script>
        <script type="text/javascript" src="../editor/scripts/simditor.js"></script>
        <script type="text/javascript" src="../editor/scripts/simditor-emoji.js"></script>
		
        <script type="text/javascript" src="../editor/scripts/config.js"></script>

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
#addinfo a{ font-size:14px; font-weight:bold; background:url(../../public/admin/img/main/addinfoblack.jpg) no-repeat 0 1px; padding:0px 0 0px 20px; line-height:45px;}
#addinfo a:hover{ background:url(../../public/admin/img/main/addinfoblue.jpg) no-repeat 0 1px;}
</style>
</head>
<body>
<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <td width="99%" align="left" valign="top">您的位置：帖子管理&nbsp;&nbsp;>&nbsp;&nbsp;编辑帖子</td>
  </tr>
  <tr>
    <td align="left" valign="top" id="addinfo">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">
	
	
	<?php
		/**查询帖子的相关信息（开始）***/
		$id = $_GET['id'];
		
		//var_dump($_GET);
		//连接数据库
		$link=mysqli_connect('localhost','root','');
		
		//选择数据库
		mysqli_select_db($link,'test');
		
		mysqli_set_charset($link,'utf8');
		
		//准备SQL语句
		$sql = "select id,title,content from post where id=$id";
		
		//执行SQL语句
		$result = mysqli_query($link,$sql);
		
		//获取结果集
		$array = mysqli_fetch_assoc($result);
		
		/***查询帖子的相关信息（结束）***/
		
	?>
	
	
	
    <form method="post" action="./post_doMessageUpdate.php">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">	  
	  <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">帖子名：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="nTitle" value="<?php echo "{$array['title']}" ?>" class="text-word">
		<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
        </td>
      </tr>

      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">原帖子内容：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for"><?php echo "{$array['content']}" ?></td>
      </tr>
	  
	  <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">编辑帖子内容：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
		
		<textarea id="editor" placeholder="这里输入内容" autofocus name="nContent"></textarea>
		
        </td>
      </tr>
      
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">&nbsp;</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input name="" type="submit" value="提交" class="text-but">
        <input name="" type="reset" value="重置" class="text-but"></td>
      </tr>
    </table>
    </form>
	
	
	<?php
		//关闭数据库
		mysqli_close($link);
	?>
	
    </td>
    </tr>
</table>
</body>
</html>
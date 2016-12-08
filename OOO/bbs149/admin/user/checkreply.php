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
    <td width="99%" align="left" valign="top">您的位置：帖子管理&nbsp;&nbsp;>&nbsp;&nbsp;管理回复&nbsp;&nbsp;>&nbsp;&nbsp;查看回复</td>
  </tr>
  <tr>
    <td align="left" valign="top" id="addinfo">
    <a href="add.html" target="mainFrame" onFocus="this.blur()" class="add">查看回帖</a>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
	<?php 

		 //引入配置文件
		 require("../../public/config.php");
				   
		 //1 链接数据库，并判断对否成功
	     $link = mysqli_connect(HOST,USER);
				   
	     //2 设置字符集
	     mysqli_set_charset($link,CHARSET);
				   
		 //3 选择数据库
		 mysqli_select_db($link,DBNAME);
		 
		 //接收传值
		 $pid = $_GET['pid'];
		 
		 //4 定义sql查询帖子语句，并发送执行
		 $sql = "select * from reply where pid={$pid}";
		 $result = mysqli_query($link,$sql);
		 
		 //5 判断
		 if($result && mysqli_num_rows($result)>0){
			 while($rows = mysqli_fetch_assoc($result)){
			
			//查询发帖人的信息
			$sql1 = "select * from user where id={$rows['uid']}";
			$result1 = mysqli_query($link,$sql1);
			
			//判断
			if($result1 && mysqli_num_rows($result1)>0){
				$rows1 = mysqli_fetch_assoc($result1);
			}
	?>
    <form method="post" action="./reply.php?id=<?php echo $rows['pid']; ?>">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">回帖用户：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="userName"  readonly value="<?php echo $rows1['userName']; ?>" class="text-word">
        </td>
        </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">内容：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
		<textarea name='content' rows='8' cols='80' readonly ><?php echo $rows['content']; ?></textarea><br/><br/>
        </td>
      </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">发帖时间：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="ctime" readonly value="<?php echo date("Y-m-d H:i:s",$rows['ctime']); ?>" class="text-word" />
        </td>
      </tr>
	  <?php 
			 
			 }
		 }
	?>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">&nbsp;</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
			<a href="./reply.php?id=<?php echo $rows['pid']; ?>"/><button>返回列表</button></a>
		</td>
        </tr>
    </table>
    </form>
	
    </td>
    </tr>
</table>
</body>
</html>
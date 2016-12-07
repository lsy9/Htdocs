<?php
	$userName = $_GET['userName'];
?>
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
#search form input.text-but{height:24px; line-height:24px; width:55px; background:url(images/main/list_input.jpg) no-repeat left top; border:none; cursor:pointer; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666; float:left; margin:8px 0 0 6px; display:inline;}
#search a.add{ background:url(images/main/add.jpg) no-repeat 0px 6px; padding:0 10px 0 26px; height:40px; line-height:40px; font-size:14px; font-weight:bold; color:#FFF}
#search a:hover.add{ text-decoration:underline; color:#d2e9ff;}
#main-tab{ border:1px solid #eaeaea; background:#FFF; font-size:12px;}
#main-tab th{ font-size:12px; background:url(images/main/list_bg.jpg) repeat-x; height:32px; line-height:32px;}
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
#addinfo a{ font-size:14px; font-weight:bold; background:url(images/main/addinfoblack.jpg) no-repeat 0 1px; padding:0px 0 0px 20px; line-height:45px;}
#addinfo a:hover{ background:url(images/main/addinfoblue.jpg) no-repeat 0 1px;}
</style>
</head>
<body>
<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
	<tr>
		<td width="99%" align="left" valign="top">您的位置：用户管理&nbsp;&nbsp;>&nbsp;&nbsp;添加用户</td>
	</tr>
<tr>
	<td align="left" valign="top" id="addinfo">
		<a href="add.html" target="mainFrame" onFocus="this.blur()" class="add">修改资料</a>
	</td>
</tr>
<tr>
	<td align="left" valign="top">
	
	
	<?php  
	
	/* <label name="xianshi" class="text-word"><?php echo $array['userName'] ?></label>
			<input type="hidden" name="uid" value="<?php $array['userName'] ?>" > */
	
	
		//链接
		$link = mysqli_connect('localhost','root','');
		
		//字符集 数据库
		mysqli_select_db($link,'test');
		mysqli_set_charset($link,'utf8');
		
		$sql = "select id,userName,auth,status from user where userName='{$userName}'";
		$result = mysqli_query($link,$sql);
		
		//获取到当前用户的信息并显示
		$array = mysqli_fetch_assoc($result);
	?>
    <form method="post" action="./user_doUpdate.php?userName=<?php echo $array['userName'] ?>">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
		<tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
			<td align="right" valign="middle" class="borderright borderbottom bggray">用户名：</td>
			<td align="left" valign="middle" class="borderright borderbottom main-for">
			
			<input type="hidden" name="uid" value="<?php echo $array['id'] ?>" >
			<input disabled="true" type="text" name="userName" value="<?php echo $array['userName'] ?>" >
			</td>
		</tr>
		<tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
			<td align="right" valign="middle" class="borderright borderbottom bggray">用户密码：</td>
			<td align="left" valign="middle" class="borderright borderbottom main-for">
			<input type="password" name="password" value="" class="text-word">
			</td>
		</tr>
		<tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
			<td align="right" valign="middle" class="borderright borderbottom bggray">确认密码：</td>
			<td align="left" valign="middle" class="borderright borderbottom main-for">
			<input type="password" name="rePassword" value="" class="text-word">
			</td>
		</tr>
		<tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
			<td align="right" valign="middle" class="borderright borderbottom bggray">用户权限：</td>
			<td align="left" valign="middle" class="borderright borderbottom main-for">
				<input type='radio' name='auth' id='auth1' value='0' <?php echo $array['auth']==0 ? 'checked="checked"' : ''; ?>/>&nbsp;&nbsp;<label for='auth1' >普通用户</label>	
				<input type='radio' name='auth' id='auth2' value='1' <?php echo $array['auth']==1 ? 'checked="checked"' : ''; ?>/>&nbsp;&nbsp;<label for='auth2' >管理员</label>
			</td>
		</tr>
		<tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">	
			<td align="right" valign="middle" class="borderright borderbottom bggray">用户状态：</td>
			<td align="left" valign="middle" class="borderright borderbottom main-for">
				<input type='radio' name='status' id='status1' value='1' <?php echo $array['status']==1 ? 'checked="checked"' : ''; ?> />&nbsp;&nbsp;<label for='status1' >开启</label>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type='radio' name='status' id='status2' value='0' <?php echo $array['status']==0 ? 'checked="checked"' : ''; ?>/>&nbsp;&nbsp;<label for='status2' >禁用</label>
			</td>
		</tr>
		<tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
			<td align="right" valign="middle" class="borderright borderbottom bggray">&nbsp;</td>
			<td align="left" valign="middle" class="borderright borderbottom main-for">
			<input name="" type="submit" value="提交" class="text-but">
			<input name="" type="reset" value="重置" class="text-but">
			</td>
		</tr>
	</table>
    </form>
	<?php
		//关库
		mysqli_close($link);
	?>
	</td>
</tr>
</table>
</body>
</html>
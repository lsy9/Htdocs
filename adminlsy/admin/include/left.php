
<?php
	session_start();
	if(!isset($_SESSION['flag']) || $_SESSION['flag']!=md5($_SESSION['id']) ){
		header('location:./login.php');
		exit;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>左侧导航menu</title>
<link href="../../public/admin/css/css.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="../../public/admin/js/sdmenu.js"></script>
<script type="text/javascript">
	// <![CDATA[
	var myMenu;
	window.onload = function() {
		myMenu = new SDMenu("my_menu");
		myMenu.init();
	};
	// ]]>
</script>
<style type=text/css>
html{ SCROLLBAR-FACE-COLOR: #538ec6; SCROLLBAR-HIGHLIGHT-COLOR: #dce5f0; SCROLLBAR-SHADOW-COLOR: #2c6daa; SCROLLBAR-3DLIGHT-COLOR: #dce5f0; SCROLLBAR-ARROW-COLOR: #2c6daa;  SCROLLBAR-TRACK-COLOR: #dce5f0;  SCROLLBAR-DARKSHADOW-COLOR: #dce5f0; overflow-x:hidden;}
body{overflow-x:hidden; background:url(../../public/admin/img/main/leftbg.jpg) left top repeat-y #f2f0f5; width:194px;}
</style>
</head>
<body onselectstart="return false;" ondragstart="return false;" oncontextmenu="return false;">
<div id="left-top">
	<div><img src="../../public/admin/img/main/member.gif" width="44" height="44" /></div>
    <span>用户：<?php echo $_SESSION['user'] ?><br>角色：超级管理员</span>
</div>
    <div style="float: left" id="my_menu" class="sdmenu">
      <div class="collapsed">
        <span>用户管理</span>
        <a href="../user/user_list.php" target="mainFrame" onFocus="this.blur()">管理用户</a>
      
      </div>
      <div>
        <span>版块管理</span>
        <a href="../type/type_tjfq.php" target="mainFrame" onFocus="this.blur()">添加分区</a>
        <a href="../type/type_menu.php" target="mainFrame" onFocus="this.blur()">版块管理</a>
       
      </div>
      <div>
        <span>帖子管理</span>
        <a href="../post/post_message.php" target="mainFrame" onFocus="this.blur()">帖子管理</a>
        <a href="../post/post_HuiShouZhan.php" target="mainFrame" onFocus="this.blur()">回收站</a>
      
      </div>
      <div>
        <span>网站管理</span>
        <a href="../config/config_list.php" target="mainFrame" onFocus="this.blur()">更改网站</a>
		<a href="../config/config_logo.php" target="mainFrame" onFocus="this.blur()">logo</a>
      </div>
    </div>
</body>
</html>
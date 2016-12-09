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
			<span><?php session_start(); echo "用户：{$_SESSION['uname']}"?><br>角色：超级管理员</span>
		</div>
			<div style="float: left" id="my_menu" class="sdmenu">
			  <div class="collapsed">
				<span>用户管理</span>
				<a href="../user/wangzhantongji.php" target="mainFrame" onFocus="this.blur()">网站统计</a>
				<a href="../user/main_list.php" target="mainFrame" onFocus="this.blur()">浏览用户</a>
				<a href="../user/main_info.php" target="mainFrame" onFocus="this.blur()">添加用户</a>
			  </div>
			  <div>
				<span>板块管理</span>
				<a href="../user/tianjiafenqu.php" target="mainFrame" onFocus="this.blur()">添加分区</a>
				<a href="../user/main_menu.php" target="mainFrame" onFocus="this.blur()">浏览分区</a>
			  </div>
			  <div>
				<span>帖子管理</span>
				<a href="../user/tieziliebiao.php" target="mainFrame" onFocus="this.blur()">帖子列表</a>
				<a href="../user/huishouzhan.php" target="mainFrame" onFocus="this.blur()">回收站</a>
			  </div>
			  <div>
				<span>网站配置</span>
				<a href="../user/wangzhanpeizhi.php" target="mainFrame" onFocus="this.blur()">网站配置</a>
			  </div>
			  
			  <div>
				<span>友情链接</span>
				<a href="../user/friendlink.php" target="mainFrame" onFocus="this.blur()">友情链接浏览</a>
			  </div>
			</div>
		</body>
</html>
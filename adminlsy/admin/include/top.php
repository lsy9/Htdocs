<!doctype html>
<?php
	session_start();
	if(!isset($_SESSION['flag']) || $_SESSION['flag']!=md5($_SESSION['id']) ){
		header('location:./login.php');
		exit;
	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台页面头部</title>
<link href="../../public/admin/css/css.css" type="text/css" rel="stylesheet" />
</head>
<body onselectstart="return false" oncontextmenu=return(false) style="overflow-x:hidden;">
<!--禁止网页另存为-->
<noscript><iframe scr="*.htm"></iframe></noscript>
<!--禁止网页另存为-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="header">
  <tr>
    <td rowspan="2" align="left" valign="top" id="logo"><img src="../../public/admin/img/main/logo.jpg" width="74" height="64"></td>
    <td align="left" valign="bottom">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="bottom" id="header-name">侯马经济开发区</td>
        <td align="right" valign="top" id="header-right">
        	<a href="../login.php" target="_parent" onFocus="this.blur()" class="admin-out">注销</a>
            <a href="../index.php" target="top" onFocus="this.blur()" class="admin-home">管理首页</a>
        	<a href="../index.php" target="_blank" onFocus="this.blur()" class="admin-index">网站首页</a>       	
            <span>
<!-- 日历 -->
<SCRIPT type=text/javascript src="../../public/admin/js/clock.js"></SCRIPT>
<SCRIPT type=text/javascript>showcal();</SCRIPT>
            </span>
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="bottom">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top" id="header-admin">后台管理系统</td>
        <td align="left" valign="bottom" id="header-menu">
        <a href="../index.php" target="#" onFocus="this.blur()" id="menuon">后台首页</a>
        <a href="../user/user_left.php" target="leftFrame" onFocus="this.blur()">用户管理</a>
        <a href="../type/type_left.php" target="leftFrame" onFocus="this.blur()">版块管理</a>
        <a href="../post/post_left.php" target="leftFrame" onFocus="this.blur()">帖子管理</a>
        <a href="../config/config_left.php" target="leftFrame" onFocus="this.blur()">网站管理</a>
      
        </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>

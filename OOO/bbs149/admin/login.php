<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<?php
		session_start();
		
		if(isset($_SESSION['id'])){
			echo "<script>alert('您已登录，不能重复登录');window.location.href='index.php'</script>";
			die;
		}
	?>
<head runat="server">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>后台管理登录界面</title>
    <link href="../public/admin/css/alogin.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <form id="form1" runat="server" action="doLogin.php" method="post">
    <div class="Main">
        <ul>
            <li class="top"></li>
            <li class="top2"></li>
            <li class="topA"></li>
            <li class="topB"><span><img src="../public/admin/img/login/logo.gif" alt="" style="" /></span></li>
            <li class="topC"></li>
            <li class="topD">
                <ul class="login">
                    <li><span class="left login-text">用户名：</span> <span style="left">
                        <input id="Text1" type="text" class="txt" name="uname"/>  
                     
                    </span></li>
                    <li><span class="left login-text">密码：</span> <span style="left">
                       <input id="Text2" type="password" class="txt" name="upass" />  
                    </span></li>
					
                </ul>
            </li>
            <li class="topE"></li>
            <li class="middle_A"></li>
            <li class="middle_B"></li>
            <li class="middle_C"> <span class="left login-text">验证码：</span> <span style="left">
                       <input id="Text2" type="text" class="txt" style='width:80px;' name="ucode" />  
						</span>
						<img src='../public/code.php' onclick="this.src='../public/code.php?id='+Math.random(0,1)"/>
					<span class="btn"><input name="" type="image" src="../public/admin/img/login/btnlogin.gif" /></span></li>
            <li class="middle_D"></li>
            <li class="bottom_A"></li>
            <li class="bottom_B">网站后台管理系统&nbsp;&nbsp;www.php.com</li>
        </ul>
    </div>
    </form>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>后台管理登录界面</title>
    <link href="../public/admin/css/alogin.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">
	function check()
	{
		var userName=document.getElementById("userName");
		if(userName.value=="")
		{
			document.getElementById("index").innerHTML="<span>请填写帐号.....</span>";
			//alert("请填写帐号");
			userName.focus();
			return false;
		}
	}
</script>
</head>
<body>

    <form id="form1" runat="server" action="./doLogin.php" method="post">
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
                        <input id="Text1" type="text" class="txt" name="userName"/>  
                     
                    </span></li>
                    <li><span class="left login-text">密码：</span> <span style="left">
                       <input id="Text2" type="password" class="txt" name="password" />  
                    </span></li>
					
                </ul>
            </li>
            <li class="topE"></li>
            <li class="middle_A"></li>
            <li class="middle_B"></li>
            <li class="middle_C"><span class="btn"><input type="image" src="../public/admin/img/login/btnlogin.gif" /></span></li>
            <li class="middle_D"></li>
            <li class="bottom_A"></li>
            <li class="bottom_B">网站后台管理系统&nbsp;&nbsp;www.php.com</li>
        </ul>
    </div>
    </form>
	<?php 
if(isset($_REQUEST['login']))
{
	$userName=$_REQUEST["userName"];
	$password=$_REQUEST["password"];
	if($userName)
	{
		//连库
		require '../connect.ini.php';
		//语句
		$sql="select * from user where userName='$userName' and password='$password'";		
		//执行
		$result=mysql_query($sql);
		//处理结果
		$num=mysql_num_rows($result);
		if($num>0)
		{
			//成功
			session_start();
			$_SESSION["userName"]=$userName;
			header("location:index.php");
		}
		else 
		{//用户名或密码错误
			echo "<script>
			document.getElementById('index').innerHTML='<span>用户名或密码错误......</span>';
			document.getElementById('userName').focus();</script>";
		}
	}
	else 
	{	//信息丢失
		echo "<script>document.getElementById('index').innerHTML='<span>信息丢失.......</span>';document.getElementById('userName').focus();</script>";
		
	}
}

?>
</body>
</html>
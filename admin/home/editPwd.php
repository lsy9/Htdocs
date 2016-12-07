<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>修改密码</title>
		<meta charset="utf-8"/>
		<link href="./css/editPwd.css" rel="stylesheet" type="text/css"/>
	</head>
    <body>
         <?php
               
                 if((!isset($_SESSION['flag'])) || ($_SESSION['flag'] != md5($_SESSION['user']['userName']))){
                     echo 'header("location:./login.php")';
                 }                           
                ?>

        <form action="doeditPwd.php" method="post" enctype="multipart/form-data">
            <div id="head">
                <div >
                   
                    <a href="./index.php"><img src="./img/logo.png"></a>
                </div>
                <div ><img  id="tu2" src="./img/tou.jpg">
                </div>
            </div>
            <div id="body">
                <div id="zhuce">
                    修改密码
                </div>
                <div id="zhutizuo">
                    <div id="hang2">原&nbsp;密&nbsp;码&nbsp;&nbsp;<input type="text" name="old" size="35px"/></div>
                    <div id="hang6">新&nbsp;密&nbsp;码&nbsp;&nbsp;<input type="text" name="new" size="35px"/></div>
                    <div id="hang14">确认密码&nbsp;&nbsp; <input type="text" name="queren" size="34px"/></div>
                    <div id="hang13">
                        验证码&nbsp;&nbsp;<input type="text" name="code" size="10" /><img src="./code.php">
                    </div>
                    <div id="hang12">
                        <input type="submit" value="确认修改"/>
                    </div>
                </div>
                <div id="zhutiyou">
                    <div id="you1">已经拥有帐号？<br/>
                        <a href="./login.php"><img src="./img/mashangdenglu.jpg"/></a>
                    </div>
                    <div id="you2">
                        使用合作网站帐号登录：
                    </div>
                    <div id="you3">
                        <img src="./img/qqq.jpg"/> <a href>QQ帐号</a>
                    </div>
                    <div id="you4">
                        <img src="./img/weibo.jpg"/> <a href>微博帐号</a>
                    </div>
                    
                </div>
            </div>
            <div id="foot"><br/><br/>
                 <p>联系我们|无图版|手机浏览|清除Cookies </p>
				<p>Powered by phpwind v8.7 Certificate Copyright Time now is:03-20 15:09<br/>
					@2006-2015 LAMP兄弟连 版权所有Gzip disabled 京ICP备11018177号 Total 0.022546(s) query 0,
				<img src="./img/pic.gif" /></p>
            </div>
        </form>
	</body>
</html>



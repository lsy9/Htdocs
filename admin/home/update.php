<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>修改资料</title>
		<meta charset="utf-8"/>
		<link href="./css/register.css" rel="stylesheet" type="text/css"/>
	</head>
    <body>
         <?php
               
			if((!isset($_SESSION['flag'])) || ($_SESSION['flag'] != md5($_SESSION['user']['userName']))){
				echo 'header("location:./login.php")';
			}
        ?>

        
            <div id="head">
                <div >
                    <a href="./index.php"><img src="./img/logo.png"></a>
                </div>
                <div ><img  id="tu2" src="./img/tou.jpg">
                </div>
            </div>
            <div id="body">
                <div id="zhuce">
                    修改个人资料
                </div>
				<form action="./doupdate.php" method="post" enctype="multipart/form-data">
                <div id="zhutizuo">
                    <div id="hang2">用户名:&nbsp;&nbsp;<label type="text" name="userName" size="35px"><?php echo $_SESSION['user']['userName'] ?></label></div>
                    <div id="hang6">电子邮箱:&nbsp;&nbsp;<input type="text" name="email" size="35px"/></div>
                    <div id="hang14">昵称:&nbsp;&nbsp; <input type="text" name="nickName" size="35px"/></div>
                    <div id="hang7">QQ号码:&nbsp;&nbsp; <input type="text" name="qq" size="35px"/></div>
                    <div id="hang7">上传头像:&nbsp;&nbsp;<input type="file" name="upload"/></div>
                   
                    <div id="hang9">安全问题&nbsp;&nbsp;
                        <select name="question">
                            <option value="0" checked=checked>无安全问题</option>
							<option value="1">你喜欢吃水果吗？</option>
							<option value="2">你喜欢吃蔬菜吗？</option>
                        </select>
                        
                    </div>
                    <div id="hang10">您的答案:&nbsp;&nbsp;
                        <input type="text" name="answer" size="35px"/>
                    </div>
                    <div id="hang13">
                        验证码:&nbsp;&nbsp;<input type="text" name="code" size="10" /><img src="./code.php">
                    </div>
                
                    <div id="hang12">
                        <input type="submit" value="确认修改"/>
                    </div>
                </div>
                </form>
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
        
	</body>
</html>


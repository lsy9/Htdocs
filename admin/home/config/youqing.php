<?php session_start();  ?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			论坛
		</title>
		<meta charset="utf-8"/>
		<link href="../css/touwei.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
		<div id="zuishang">
			<div id="shouhang">
				<div id="sheweishouye"><a href="">设为首页</a>&nbsp;<a href="">收藏LAMP兄弟连</a></div>
				<div id="sousuo">
					<ul>
						<li><a href="">搜索</a></li>
						<li><a href="">统计排行</a></li>
						<li><a href="">会员列表</a></li>
						<li><a href="">社区服务</a></li>
						<li><a href="">精华区</a></li>
						<li><a href="">最新帖子</a></li>
						<li><a href="">社区应用</a></li>
						<li><a href="">推广链接</a></li>
							<li id="bang"><a href="">帮助</a></li>
					</ul>
				</div>
			</div>
		</div>	
    
    
        <div>
			<div id="hang1">
                <div id="hang1a">
                    <a href="../index.php"><img src="../../public/home/images/logo.png"></a>
				</div>
				<div id="hang1b"><img src="../../public/home/images/wxdbjc.gif">
				</div>
				<div id="hang1c"><img src="../../public/home/images/QQzhanghaodenglu.jpg">
				</div>
			    <div id='hang1d'>
                <?php
                //var_dump($_SESSION);
                 if((!isset($_SESSION['flag'])) || ($_SESSION['flag'] != md5($_SESSION['user']['userName']))){

                     echo "<form method='post' action='dologin 1.php'>
                            <input type='text' name='userName' placeholder='输入用户名'/>&nbsp;
                            <input type='checkbox' name='zhuangtai' value='1' checked/>记住登录&nbsp;<a href=''>找回密码</a>
                            <input type='password' name='passwd' placeholder='密码' id='dd'/>&nbsp;
                            <div>
                                <input type='image' src='../../public/home/images/denglu1.jpg'/ '></a>
                                <a href='./register.php'><img src='../../public/home/images/zhuce1.jpg'/></a>
                            </div>
                            </from>";

                           header("Location:../login.php");
                        }else{
                           $allauth=array(1=>'普通用户',2=>'管理员');
                                ?>
                                   <span style="position:relative;top:5px;">欢迎您，尊贵的会员：<?php echo $_SESSION['userDetail']['name']; ?></span><img src="../../public/home/img/<?php echo $_SESSION['userDetail']['photot']; ?>" style="float:right;width:50;height:50px;"><br/>
                                   <span style="position:relative;top:8px;"><a href="../user/usercenter.php?id=<?php echo $_SESSION['user']['id']; ?>">个人中心</a> | <a href="../user/exit.php">退出</a> | <a href="../register.php">注册 </a> | <a href="../../admin/index.php">后台管理</a></span><br/>
                            <span style="position:relative;top:10px;">身份：<?php echo $allauth[$_SESSION['user']['auth']]; ?> 积分：<?php echo $_SESSION['userDetail']['score']; ?></span>
                            
                <?php
                     }
                  ?>
                </div>
			</div>
		</div>
        
        
        <div id="zhucaidan">
			<div id="nei">
				<ul>
					<li><a href="">培训课堂</a></li>
					<li><a href="">论坛</a></li>
					<li><a href="">兄弟连云课堂</a></li>
					<li><a href="">PHP视频</a></li>
					<li><a href="">Android视频</a></li>
					<li><a href="">Lunux视频</a></li>
					<li><a href="">Cocos视频</a></li>
					<li><a href="">战地日记</a></li>
					<li><a href="">在线自测</a></li>
					<li>
						<select id="kuai" name="kuaijietongdao">
							<option value="0">
							快捷通道
							</option>
						</select>
					</li>
				</ul>
			</div>
        </div>
        <div id="body">
        
        <div id="hang2">
            <div id="hang2a">
                <img src="../../public/home/images/2015-05-12_121141.jpg">
                <form action="../search.php" method="post">
                    <input type="text" name="title" id="search">
                    <select name="" id="tie">
                        <option value="0">
                            帖子
                        </option>
                    </select>
                    <input type="image" src="../../public/home/images/sousuo.jpg" name="sousuo" id="sou">
                </form>
            </div>
			<div id="hang2b">热搜：<a href="">php</a>&nbsp;<a href="">php视频</a>&nbsp;<a href="">php教程</a></div>
			<div id="hang2c"><img src="../../public/home/images/tu1.png"/></div>
        </div>
            

            <div style="float:left;background-color:#fffaf0;;width:1010px;">   
                <div style="width:800px;height:300px;margin:0 auto;">
                    <h3 style="text-align:center;">申请成为友情网站</h3>
                    <div style="width:400px;margin:0 auto; border:1px solid #dddddd;padding:50px;background-color:#fafff0;">
                        <form action="./doyouqing.php" method="post">
                            <div>&nbsp;&nbsp;网站名：<input type="text" name='name' size=40px></div>
                            <div style="margin-top:20px;">网站链接：<input type="text" name='path' size=40px></div>
                            <div style="margin-top:20px;width:50px;margin-left:150px;"><input type="submit" value='我要申请' ></div>
                        </form>
                    </div>
                </div>
            </div>
            

            <div id="foot">
                <div id="foot1">
                    <ul>
                        <li class="xiamiande"><a href="">联系我们</a></li>
                        <li class="xiamiande"><a href="">无图版</a></li>
                        <li class="xiamiande"><a href="">手机浏览</a></li>
                        <li><a href="">清除Cookies</a></li>
                    </ul>
                </div>
                <div id="foot2">
                Powered by phpwind v8.7 Certificate Copyright Time now is:<?php echo date('m-d H:i:s',time()); ?><br/>
			&copy;2006-2015 LAMP兄弟连版权所有 Gzip disble 京ICP备11018177号 Total 0.022546(s) query 0,<img src="../../public/home/images/pic.gif">
                </div>
            </div>      
        </div>
    </body>
</html>













<?php session_start();  ?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			发帖
		</title>
		<meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="../css/detail.css" />
		
		 <link rel="stylesheet" type="text/css" href="../editor/styles/font-awesome.css" />
        <link rel="stylesheet" type="text/css" href="../editor/styles/simditor.css" />
        <link rel="stylesheet" type="text/css" href="../editor/styles/simditor-emoji.css" />

        <script type="text/javascript" src="../editor/scripts/jquery.min.js"></script>
        <script type="text/javascript" src="../editor/scripts/module.js"></script>
        <script type="text/javascript" src="../editor/scripts/uploader.js"></script>
        <script type="text/javascript" src="../editor/scripts/simditor.js"></script>
        <script type="text/javascript" src="../editor/scripts/simditor-emoji.js"></script>
		
        <script type="text/javascript" src="../editor/scripts/config.js"></script>
		
		
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
                    <a href="../index.php"><img src="../img/logo.png"></a>
				</div>
				<div id="hang1b"><img src="../img/wxdbjc.gif">
				</div>
				<div id="hang1c"><img src="../img/QQdenglu.jpg">
				</div>
			    <div id='hang1d'>
                     <?php
                //var_dump($_SESSION);
                 if((!isset($_SESSION['flag'])) || ($_SESSION['flag'] != md5($_SESSION['user']['userName']))){

                     echo "<form method='post' action='dologin1.php'>
                            <input type='text' name='userName' shuru='输入用户名'/>&nbsp;
                            <input type='checkbox' name='status' value='1' checked/>记住登录&nbsp;<a href=''>找回密码</a>
                            <input type='password' name='password' shuru='密码' id='dd'/>&nbsp;
                            <div>
                                <input type='image' src='../img/denglu1.jpg'/ '></a>
                                <a href='./register.php'><img src='../img/zhuce1.jpg'/></a>
                            </div>
                            </from>";
                        echo '<script> alert ("请登录后再发帖！");window.location.href="../login.php"</script>';
                          
                        }else{
                            $allauth=array(0=>'普通用户',1=>'管理员');
                ?>
                                 <span style="position:relative;top:5px;">欢迎您，尊贵的会员：<?php echo $_SESSION['userDetail']['nickName']; ?></span><img src="../img/<?php echo $_SESSION['userDetail']['photo']; ?>" style="float:right;width:50PX;height:50px;"><br/>
                                   <span style="position:relative;top:8px;"><a href="../usercenter.php?id=<?php echo $_SESSION['user']['id']; ?>">个人中心</a> | <a href="../exit.php">退出</a> | <a href="../register.php">注册 </a> | <a href="../admin/index.php">后台管理</a></span><br/>
                            <span style="position:relative;top:10px;">身份：<?php echo $allauth[$_SESSION['user']['auth']]; ?>  积分：<?php echo $_SESSION['userDetail']['score']; ?></span>
                            
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
							<option value="0">快捷通道</option>
						</select>	
					</li>
				</ul>
			</div>
        </div>
        <div id="body">
        
        <div id="hang2">
            <div id="hang2a">
                <img src="../img/ssss.jpg">
                <form action="../search.php" method="post">
                    <input type="text" name="title" id="search">
                    <select name="" id="tie">
                        <option value="0">
                            帖子
                        </option>
                    </select>
                    <input type="image" src="../img/sousuo.jpg" name="sousuo" id="sou">
                </form>
            </div>
			<div id="hang2b">热搜：<a href="">php</a>&nbsp;<a href="">php视频</a>&nbsp;<a href="">php教程</a></div>
			<div id="hang2c"><img src="../img/tu1.png"/></div>
        </div>
            <?php $tid=$_GET['tid']?>
        <form action="./doadd.php" method="post" />
            <br/>
                添加主题：<input type="text" name="title" size=40 /><br/><br/> 
                内容：<br/>
                        <textarea id="editor" placeholder="这里输入内容"  autofocus name='content'  style="resize:none"></textarea> <br/> 
                回复设置：<select name='reveal'>
                            <option value='1'>准许回复</option>
                            <option value='2'>不准许回复</option>
                        </select><br/>
                        <input type="hidden" name="tid" value="<?php echo $tid; ?>" />
                        <input type="image" src="../img/fabu.jpg">
                
           </form>



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
			&copy;2006-2015 LAMP兄弟连版权所有 Gzip disble 京ICP备11018177号 Total 0.022546(s) query 0,<img src="../img/jpg.gif">
            </div>
        </div>      

        </div>
    </div>
    </body>
</html>









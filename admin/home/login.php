<!DOCTYPE html>
<html>
	<head>
		<title>登录</title>
		<meta charset="utf-8"/>
		<link href="./css/login.css" rel="stylesheet" type="text/css"/>
	</head>
    <body>
             
        
		<div id="head">
            <div >
                <a href="./index.php"><img id="tu1" src="./img/log.jpg"></a>
			</div>
			<div ><img  id="tu2" src="./img/tou.jpg">
			</div>
		</div>
		<div id="body">
			<div id="denglu">
				<span>登录</span>
			</div>
			<div id="zhutizuo">
				<span id="hehe">如果您在网吧或者非个人电脑，建议设置Cookie有效期为即时，以保证账户安全</span>
              
				<form action="./dologin.php" method="post">
                    <div id="hang1">
                        <select name="userName1">
                            <option value="0">普通用户</option>
                            <option value="1">管理员</option>
                        </select>
                        &nbsp;<input type="text" name="userName"/>
                    </div>   
                    <div id="hang2">
                        密&nbsp;&nbsp;码：<input type="password" name="password"><!--<a href="./retrun.php">找回密码</a>-->
                     </div>
                  <div id="hang3">安全问题：
                         <select name="question">
                            <option value="0" checked=checked>无安全问题</option>
							<option value="1">你喜欢吃水果吗？</option>
							<option value="2">你喜欢吃蔬菜吗？</option>
                        </select>
						
                    </div>
                    <div id="hang4">      
                        您的答案：&nbsp;<input type="text" name="answer">
                    </div>
                    
                    <div id="hang5">如果您在网吧或者非个人电脑，建议设置Cookie有效期为即时，以保证账户安全</div>
                    <div id="hang6">隐身登录    
                        <input type="radio" value="1" name="status" id="kaiqi"/>开启
                        <input type="radio" value="2" name="status"  checked="checked" id="guanbi"/>关闭
                    </div>
                    <div id="hang13">
                        验证码&nbsp;&nbsp;<input type="text" name="code" size="10" /><img src="./code.php">
                    </div>
                    <div id="hang7">
                        <input type="checkbox" name="auto" value="1" checked>下次自动登录
                    </div>
                    <div id="hang8">
                        <input type="image" src="./img/denglu1.jpg" name="denglu"/>
                    </div>
                      
			    </form>
			</div>
			<div id="zhutiyou">
				<div id="you1">还没有帐号？<br/>
                    <a href="./register.php"><img src="./img/zhuce.jpg"/></a>
				</div>
				<div id="you2">
					使用合作网站帐号登录：
				</div>
				<div id="you3">
					<img src="./img/qqq.jpg"> <a href>QQ帐号</a>
				</div>
				<div id="you4">
					<img src="./img/weibo.jpg"> <a href>微博帐号</a>
				</div>
            </div>
        </div>
		<div id="foot">
			<p>&nbsp;&nbsp;&nbsp;&nbsp;联系我们|无图版|手机浏览|清除Cookies </p>
				<p>Powered by phpwind v8.7 Certificate Copyright Time now is:03-20 15:09<br/>
					@2006-2015 LAMP兄弟连 版权所有Gzip disabled 京ICP备11018177号 Total 0.022546(s) query 0,
				<img src="./img/pic.gif" /></p>
		</div>
	</body>
</html>

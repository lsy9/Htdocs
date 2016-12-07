<!DOCTYPE html>
<html>
	<head>
		<title>注册界面</title>
		<meta charset="utf-8"/>
		<link href="./css/register.css" rel="stylesheet" type="text/css"/>
	</head>
    <body>
        <form action="doregister.php" method="post">
            <div id="head">
                <div >
                    <?php //include('./config.php'); ?>
                    <a href="./index.php"><img src="./img/logo.png"></a>
                </div>
                <div ><img  id="tu2" src="./img/tou.jpg">
                </div>
            </div>
            <div id="body">
                <div id="zhuce">
                    注册
                </div>
                <div id="zhutizuo">
                    <div id="hang1">带红色<span>*</span>的都是必填项目，若填写不全将无法注册</div>
                    <div id="hang2">用户名<span>*</span>&nbsp;&nbsp;<input type="text" name="userName" size="35px"/></div>
                    <div id="hang3">密&nbsp;码<span>*</span>&nbsp;&nbsp;<input type="" name="password" size="35px"/></div>
                    <div id="hang4"><img src="./img/mimaqiangdu.jpg"></div>
                    <div id="hang5">确认密码<span>*</span>&nbsp;&nbsp;<input type="" name="repasswd" size="35px"/></div>
                    <div id="hang6">电子邮箱<span>*</span>&nbsp;&nbsp;<input type="text" name="email" size="35px"/></div>
                    <div id="hang14">昵称&nbsp;&nbsp; <input type="text" name="nickName" size="35px"/></div>
                    <div id="hang7">QQ号码&nbsp;&nbsp; <input type="text" name="qq" size="35px"/></div>
                    <div id="hang8">现居住地<span>*</span>&nbsp;&nbsp;
                        <select name="sheng">
                            <option value="1">请选择</option> 
                            <option value="jilin">吉林 </option>
                        </select>
						<select name="shi">
                            <option value="1">请选择</option> 
                            <option value="cc">长春 </option>
                        </select><select name="qu">
                            <option value="1">请选择</option> 
                            <option value="jt">九台 </option>
                        </select>
                       
                    </div>
                    <div id="hang9">安全问题&nbsp;&nbsp;
                        <select name="question">
                            <option value="0" checked=checked>无安全问题</option>
							<option value="1">你喜欢吃水果吗？</option>
							<option value="2">你喜欢吃蔬菜吗？</option>
                        </select>
                    </div>
                    <div id="hang10">您的答案&nbsp;&nbsp;
                        <input type="text" name="answer" size="35px"/>
                    </div>
                    <div id="hang13">
                        验证码<span>*</span>&nbsp;&nbsp;<input type="text" name="code" size="10" /><img src="./code.php">
                    </div>
                    <div id="hang11">
                        <input type="checkbox"name="tiaokuan" value="1"/><span>我已阅读并完全同意</span><a href>条款内容</a>
                    </div>
                    <div id="hang12">
                        <input type="image" src="./img/yejiaozhuce.jpg" name="tijiao"/>
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

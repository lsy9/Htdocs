<?php
    // 开启session
    session_start();
    if(!empty($_SESSION['user'])){
        // 禁止二次登录
        if($_SESSION['user']['level'] != 1){
            // 不是管理员登录，跳转到前台首页
            header('location:../index.php');
            exit;
        }
        header('location:./index.php');
        exit;
    }
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>『豪情』后台管理</title>
    <link href="./public/css/admin_login.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="admin_login_wrap">
    <h1>后台管理</h1>
    <div class="adming_login_border">
        <div class="admin_input">
            <form action="./doaction.php?act=login" method="post">
                <ul class="admin_items">
                    <li>
                        <label for="user">用户名：</label>
                        <input type="text" name="username" value="" id="user" size="40" class="admin_input_style" />
                    </li>
                    <li>
                        <label for="pwd">密码：</label>
                        <input type="password" name="userpwd" value="" id="pwd" size="40" class="admin_input_style" />
                    </li>
                    <li>
                        <label for="vcode">验证码：</label>
                        <input type="text" name="vcode" value="" id="vcode" size="10" class="admin_input_style" />
                        <img src="../public/common/yzm.php" id="yzm" style="vertical-align:middle;">
                    </li>
                    <li>
                        <input type="submit" tabindex="3" value="提交" class="btn btn-primary" />
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <p class="admin_copyright"><a tabindex="5" href="../index.php" target="_blank">返回首页</a> &copy; 2016 Powered by <a href="../index.php" target="_blank">毛攀峰</a></p>
</div>
</body>
<script>
    // 单击更改验证码
    var yzm = document.getElementById('yzm');

    yzm.onclick = function(){
        yzm.src = '../public/common/yzm.php?id='+Math.random();
    }
</script>
</html>
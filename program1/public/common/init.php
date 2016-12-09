<?php
    // 开启session
    session_start();
    header("content-type:text/html;charset=utf-8");
    if(!file_exists('./public/common/install.lock')){
        echo '网站未安装，<a href="./install/install.php">点击进行安装</a>';
        exit;
    }
    // 判断网站是否被关闭
    include('./public/common/webconf.php');
    if(WEBSITE_STATUS == 0){
        die('网站维护中。。。');
    }

    // 设置默认时区
    date_default_timezone_set("PRC");
    
    // 引入函数库文件
    include('./public/common/functions.php');

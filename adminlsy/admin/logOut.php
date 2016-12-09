<?php
    //开启session
    session_start();

    //清空session数组
    unset($_SESSION);

    //删除session文件
    session_destroy();

    //删除客户端sessionID
    setcookie(session_name(),'',time()-1,'/');
?>

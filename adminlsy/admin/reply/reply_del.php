<?php
    //用户传递过来的uid
    $uid = $_GET['uid'];

    //链接数据库
    mysql_connect('localhost','root','');

    //选择数据库
    mysql_select_db('lamp111');

    mysql_set_charset('utf8');

    //准备SQL语句
    $SQL = "delete from type where id={$uid}";
s
    //执行删除
    mysql_query($SQL);

    //判断是否删除成功

    if(mysql_affected_rows() > 0 ){
        header('location:./reply_menu.php');
    }
    mysql_close();
?>

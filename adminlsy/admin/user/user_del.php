<?php
    //用户传递过来的uid
    $uid = $_GET['uid'];

    //链接数据库
    $link=mysqli_connect('localhost','root','');

    //选择数据库
    mysqli_select_db($link,'test');

    mysqli_set_charset($link,'utf8');

    //准备SQL语句
    $SQL = "delete from user where id={$uid}";

    //执行删除
    mysqli_query($link,$SQL);

    //判断是否删除成功

    if(mysqli_affected_rows($link) > 0 ){
        header('location:./user_list.php');
    }
    mysqli_close($link);
?>

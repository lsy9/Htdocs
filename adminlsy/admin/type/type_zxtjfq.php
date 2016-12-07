<?php
    //这个页面是用来处理添加的分区的。
    header('content-type:text/html;charset=utf-8');

	//var_dump($_POST);
    $fenQu = $_POST['fenqu'];//分区名称

    $link=mysqli_connect('localhost','root','');

    mysqli_select_db($link,'test');

    mysqli_set_charset($link,'utf8');


    //准备SQL语句
    $SQL = "insert into type (name) values ('{$fenQu}')";

    //执行SQL语句
    mysqli_query($link,$SQL);

    //判断是否添加成功
    if(mysqli_affected_rows($link) > 0){
        header('location:./type_menu.php');
    } 

    mysqli_close($link);
?>

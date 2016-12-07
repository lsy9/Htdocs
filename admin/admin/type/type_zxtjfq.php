<?php
    //这个页面是用来处理添加的分区的。
    header('content-type:text/html;charset=utf-8');

	//var_dump($_POST);
    $fenQu = $_POST['fenqu'];//分区名称

    mysql_connect('localhost','root','');

    mysql_select_db('lamp111');

    mysql_set_charset('utf8');


    //准备SQL语句
    $SQL = "insert into type (name) values ('{$fenQu}')";

    //执行SQL语句
    mysql_query($SQL);

    //判断是否添加成功
    if(mysql_affected_rows() > 0){
        header('location:./type_menu.php');
    } 

    mysql_close();
?>

<?php
	//执行添加子版块
    var_dump($_GET);
    header('content-type:text/html;charset=utf-8');

    $ziBanKuai = $_POST['zibankuai'];//获得的子板块的名称
    $fId = $_POST['fid'];//当前的子版块的父类的ID

	//连库
    mysql_connect('localhost','root','');

	
    mysql_select_db('lamp111');

    mysql_set_charset('utf8');

    //准备SQL语句
    $SQL = "insert into type (name,pid,path) value ('{$ziBanKuai}',{$fId},'0-{$fId}')";

    //执行SQL语句
    mysql_query($SQL);

    //判断是否插入成功
    if(mysql_affected_rows() > 0){
        header('location:./type_menu.php');
    }

    mysql_close();
?>

<?php
	//执行添加子版块
    var_dump($_GET);
    header('content-type:text/html;charset=utf-8');

    $ziBanKuai = $_POST['zibankuai'];//获得的子板块的名称
    $fId = $_POST['fid'];//当前的子版块的父类的ID

	//连库
   $link= mysqli_connect('localhost','root','');

	
    mysqli_select_db($link,'test');

    mysqli_set_charset($link,'utf8');

    //准备SQL语句
    $SQL = "insert into type (name,pid,path) value ('{$ziBanKuai}',{$fId},'0-{$fId}')";

    //执行SQL语句
    mysqli_query($link,$SQL);

    //判断是否插入成功
    if(mysqli_affected_rows($link) > 0){
        header('location:./type_menu.php');
    }

    mysqli_close($link);
?>

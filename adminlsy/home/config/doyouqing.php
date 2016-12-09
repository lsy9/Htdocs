<?php
    header('Content-type:text/html;charset=utf-8');
    //var_dump($_POST);
    $name=$_POST['name'];
    $path=$_POST['path'];

    //判断数据是否为空
    if(empty($name) && empty($path)){
         echo '<script>alert("请填写完整信息！");window.location.href="./youqing.php"</script>';
        exit;
    }    
    
    include('../../install/dbconfig.php');
    mysql_connect(DB_HOST,DB_USER,DB_PASSWD);
    mysql_select_db(DB_NAME);
    mysql_set_charset(DB_CHARSET);

    $SQL="insert into youqing(name,path) values('{$name}','{$path}')";
    $res=mysql_query($SQL);
    
    if($res && mysql_affected_rows()>0){
         echo '<script>alert("申请成功，等待管理员审批！");window.location.href="../index.php"</script>';
        exit;
    }else{
         echo '<script>alert("申请失败，请检查！");window.location.href="../index.php"</script>';
        exit;
    }
    mysql_close();
?>

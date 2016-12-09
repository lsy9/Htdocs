<?php
    session_start();
    header('Content-type:text/html;charset=utf-8');
    //var_dump($_POST);

    $old=md5($_POST['old']);

    $new=md5($_POST['new']);
    $renew=md5($_POST['queren']);
    $code=$_POST['code'];
    $id=$_SESSION['user']['id'];
    //var_dump($id);

     //判断验证码是否正确
    if($code!==$_SESSION['vcode']){
        echo '<script>alert("验证码不正确！");window.location.href="./editPwd.php"</script>';
	exit;
     }

    //获得旧密码；
    //include('../../install/dbconfig.php');
    //链接数据库
    $link=mysqli_connect('localhost','root','');

    //选择数据库
    mysqli_select_db($link,'test');

    mysqli_set_charset($link,'utf8');
	//写sql语句
    $sql="select password from user where id='{$id}'";
	//执行
    $result=mysqli_query($link,$sql);
	//
    $array=mysqli_fetch_assoc($result);
    $oldpasswd=$array['password'];

    //判断旧密码是否相同
    if($old!==$oldpasswd){
        echo '<script>alert("原密码不正确！");window.location.href="./editPwd.php"</script>';
	exit;
    }
        
    //判断新密码是否相同
    if($new!==$renew){
        echo '<script>alert("两次新密码不相同！");window.location.href="./editPwd.php"</script>';
	exit;
    }
    //改密码；
    $NSQL="update user set password='{$new}' where id={$id}";
    $nres=mysqli_query($link,$NSQL);
    
    if($nres && mysqli_affected_rows()>0){
        echo '<script>alert("修改成功！");window.location.href="./login.php"</script>';
    }
	mysqli_close($link);	


?>

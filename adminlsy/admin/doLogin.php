<?php
    //打开session;
    session_start();

    $userName = $_POST['userName'];//用户传过来的账号
    $password = md5($_POST['password']);//用户传过来的密码

    //链接数据库
  $link=mysqli_connect('localhost','root','');

    //选择数据库
    mysqli_select_db($link,'test');

    mysqli_set_charset($link,'utf8');

    //准备SQL语句
    $SQL = "select id,userName from user where userName='{$userName}' and password='{$password}' and auth=1 and status=1";

    //执行SQL语句
    $result = mysqli_query($link,$SQL);
	//将
    if($result && mysqli_num_rows($result) > 0 ){
	
       $users = mysqli_fetch_assoc($result);
	//$_SESSION超全局变量，将user、id、flag值赋给session,存储在服务器上，每次应用时就会启动 
       $_SESSION['user'] = $users['userName'];
       $_SESSION['id'] = $users['id'];

       $_SESSION['flag'] = md5($users['id']);//也是用来做判断的

        header('location:./index.php');
    }else{
        header('location:./login.php');

    }
    mysqli_close();
?>

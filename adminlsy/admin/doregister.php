<?php
    session_start();
    header('Content-type:text/html;charset=utf-8');
	//接受传递过来的值
    
    //var_dump($_POST);
    $userName=$_POST['userName'];
    $password=md5($_POST['password']);
    $repsswd=md5($_POST['repasswd']);
    $email=$_POST['email'];
    $name=$_POST['name'];
    $qq=$_POST['qq'];
    $sheng=$_POST['sheng'];
    $shi=$_POST['shi'];
    $xian=$_POST['xian'];
    $question=$_POST['question'];
    $answer=$_POST['answer'];
    $ctime=time();
    $code=$_POST['code'];
    
    
    //用户名、密码、电邮、居住地、条款不能为空    
    
    
    if($userName==''){
        echo '<script>alert("用户名不能为空！");window.location.href="register.php"</script>';
	exit;
    }

    if($_POST['password']==''){
       echo '<script>alert("密码不能为空！");window.location.href="register.php"</script>';
	exit;
    }

     if($email==''){
        echo '<script>alert("邮箱不能为空！");window.location.href="register.php"</script>';
	exit;
     }

     if($sheng=='1'||$shi=='1'||$xian=='1'){
        echo '<script>alert("居住地不能为空！");window.location.href="register.php"</script>';
	exit;
    }
     
    if(!isset($_POST['tiaokuan'])){
         echo '<script>alert("请认真阅读条款并同意！");window.location.href="register.php"</script>';
	exit;
     }

    //判断密码是否相同
  
    if($password!==$repsswd){
        echo '<script>alert("两次密码不相同！");window.location.href="register.php"</script>';
	exit;
    }
    
    //判断验证码是否正确
   
    if($code!==$_SESSION['vcode']){
        echo '<script>alert("验证码不正确！");window.location.href="register.php"</script>';
	exit;
    }
    
     //判断传值是否为空：
    $a = array();
    $b= array();
    if(!empty($name)){
        $a[] = "'{$name}'";
        $b[] ="name";
    }

    if(!empty($qq)){
	    $a[] = "'{$qq}'";
        $b[] ="qq";
	}

    if(!empty($question)){
	    $a[] = "'{$question}'";
        $b[] ="question";
    }
    if(!empty($answer)){
	    $a[] = "'{$answer}'";
        $b[] ="answer";
    }
    
    $set='';
    $set1='';
    if(!empty($a)){
	//组合条件
	$set = ','.implode(", ",$a);
    }
    if(!empty($b)){
	//组合条件
	$set1 = ','.implode(", ",$b);
    }
    
    //把数据传递到数据库
/*****    include('../install/dbconfig.php');***/
    $link=mysqli_connect('localhost','root','');
    mysqli_select_db($link,'test');
    mysql_set_charset($link,'utf8');

    //判断用户是否存在
    $sql="select userName from user where userName='{$userName}'";
    $result=mysqli_query($sql);
   
    if(mysqli_num_rows($result)>0){
        $array=mysqli_fetch_assoc($result);
       //var_dump($array);
	   
        echo '<script> alert ("用户'.$array['userName'].'已存在");window.location.href="register.php"</script>';
	exit;
    }else{
        //写入数据库基本用户信息
        $sql="insert into user(userName,passwd) values('{$userName}','{$passwd}')";
        $result = mysqli_query($link,$sql);        
        $id=mysqli_insert_id($link);
        
        //写入数据库详细用户信息
        
        $sql1="insert into userDetail(ctime,id,email,sheng,shi,xian{$set1}) values('{$ctime}','{$id}','{$email}','{$sheng}','{$shi}','{$xian}'{$set})";
        $results = mysqli_query($sql1);
        echo "$sql1";
        if($result && $results){
            //创建一个默认头像；
            copy('./img/default.jpg','./img/default.jpg');
            header('location:./login.php');
             
        }else{
            echo "<script>alert('注册失败！');window.location.href='register.php'</script>";
            
	exit;
        }  
    }
    mysqli_close();


    

?>

<?php
    session_start();
    header('Content-type:text/html;charset=utf-8');
	//接受传递过来的值
    
    var_dump($_POST);
    $userName=$_POST['userName'];
    $password=md5($_POST['password']);
    $repsswd=md5($_POST['repasswd']);
    $email=$_POST['email'];
    $nickName=$_POST['nickName'];
    $qq=$_POST['qq'];
    $sheng=$_POST['sheng'];
    $shi=$_POST['shi'];
    $qu=$_POST['qu'];
    $question=$_POST['question'];
    $answer=$_POST['answer'];
    $time=time();
    $code=$_POST['code'];
    
    
    //判断用户名、密码、邮箱、居住地、条款不能为空    
    
    
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

     if($sheng=='1'||$shi=='1'||$qu=='1'){
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
    $aa = array();
    $bb= array();
    if(!empty($name)){
        $aa[] = "'{$name}'";
        $bb[] ="name";
    }

    if(!empty($qq)){
	    $aa[] = "'{$qq}'";
        $bb[] ="qq";
	}
	
	if(!empty($nickName)){
	    $aa[] = "'{$nickName}'";
        $bb[] ="nickName";
	}

    if(!empty($question)){
	    $aa[] = "'{$question}'";
        $bb[] ="question";
    }
    if(!empty($answer)){
	    $aa[] = "'{$answer}'";
        $bb[] ="answer";
    }
    
    $set='';
    $set1='';
    if(!empty($aa)){
	//组合条件
	$set = ','.implode(", ",$aa);
    }
    if(!empty($bb)){
	//组合条件
	$set1 = ','.implode(", ",$bb);
    }
    
    
    //链接数据库
    $link=mysqli_connect('localhost','root','');

    //选择数据库
    mysqli_select_db($link,'test');

    mysqli_set_charset($link,'utf8');
	
    //判断用户是否存在
    $sql="select userName from user where userName='{$userName}'";
    $result=mysqli_query($link,$sql);
   
    if(mysqli_num_rows($sresult)>0){
        $array=mysqli_fetch_assoc($result);
       //var_dump($array);
        
        echo '<script> alert ("用户'.$array['userName'].'已存在,请重新注册");window.location.href="register.php"</script>';
		exit;
    }else{
	
        //写入数据库基本用户信息
        $sql1="insert into user(userName,password) values('{$userName}','{$password}')";
		
        $result = mysqli_query($link,$sql1);        
        $id=mysqli_insert_id($link);//取得上一步得到的id值
        
        //写入数据库详细用户信息
        
        $sql2="insert into userDetail(time,id,email,sheng,shi,qu{$set1}) values('{$time}','{$id}','{$email}','{$sheng}','{$shi}','{$qu}'{$set})";
        
		
		 
		$results = mysqli_query($link,$sql2);
         // echo $sql2; 
		// exit; 
        if($result && $results){
		
            //创建一个默认头像；
            copy('./img/default.jpg','./img/default.jpg');
            header('location:./login.php');
             
        }else{
            echo "<script>alert('注册失败！');window.location.href='register.php'</script>";
            
	exit;
        }  
    }
    mysqli_close($link);


    

?>

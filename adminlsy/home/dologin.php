<?php

    session_start();
    header('Content-type:text/html;charset=utf-8');
	//var_dump($_POST);
    $userName=$_POST['userName'];
    $password=md5($_POST['password']);
    $question=$_POST['question'];
    $answer=$_POST['answer'];
    $status=$_POST['status'];
    $auto=$_POST['auto'];
    $code=$_POST['code'];
    $time=time();

    //判断验证码是否正确
    if($code !== $_SESSION['vcode']){
         echo '<script>alert("验证码不正确！");window.location.href="login.php"</script>';
	exit;
    }

    //连接数据库进行用户名
   /**** include('../install/dbconfig.php');****/
    
	
 	//链接数据库
    $link=mysqli_connect('localhost','root','');

    //选择数据库
    mysqli_select_db($link,'test');

    mysqli_set_charset($link,'utf8');
	//密码验证
    if(!empty($userName) && !empty($password)){
        $SQL1="select * from user where userName='{$userName}' and password='{$password}'";
        $result1=mysqli_query($link,$SQL1);
       // echo $SQL1;
        
        //判断用户、密码是否正确；
      if(mysqli_num_rows($result1)>0){
            $row=mysqli_fetch_assoc($result1);
            //var_dump($row);
            $SQL2="select * from userDetail where id='{$row['id']}'";
			//echo $SQL2;
            $res=mysqli_query($link,$SQL2);
            if(mysqli_num_rows($res)>0){
                $rows=mysqli_fetch_assoc($res);
                if(!empty($rows['question'])&& !empty($rows['answer'])){
                    if($rows['question']!=$question && $rows['answer']!=$answer){
						echo '<script>alert("请重新输入安全问题！！！");window.location.href="./login.php"</script>';
                        exit;
                    }else{
                        //记录登录时间比较，加积分；
                        $oldtime=$rows['time'];
                       
                        if(date('d',$time)!=date('d',$oldtime)){
                            $score=$rows['score']+3;
                            $SQLa="update userDetail set time='{$time}',score='{$score}' where id='{$row['id']}'";
                            mysqli_query($link,$SQLa);
                            $SQL3="select * from userDetail where id='{$row['id']}'";
                            $res3=mysqli_query($link,$SQL3);
                            $row3=mysqli_fetch_assoc($res3);
                            
                            $_SESSION['user'] = $row;
                            $_SESSION['userDetail']=$row3;
                            $_SESSION['flag'] = md5($_SESSION['user']['userName']);
                            // var_dump($_SESSION);
                            echo '<script>alert("登录成功！");window.location.href="./index.php"</script>';
	                            exit;
                        }else{
                            $SQLa="update  userDetail set time='{$time}' where id='{$row['id']}'";
                            mysqli_query($link,$SQLa);
                            $SQL3="select * from userDetail where id='{$row['id']}'";
                            $res3=mysqli_query($link,$SQL3);
                            $row3=mysqli_fetch_assoc($link,$res3);
                            
                            $_SESSION['user'] = $row;
                            $_SESSION['userDetail']=$row3;
                            $_SESSION['flag'] = md5($_SESSION['user']['userName']);
                            // var_dump($_SESSION);
                            echo '<script>alert("登录成功！");window.location.href="./index.php"</script>';
	                            exit;
                        }
                       
                    }
                }else{
                         //记录登录时间比较，加积分；
                        $oldtime=$rows['time'];
                        if(date('d',$time)!=date('d',$oldtime)){
                            $score=$rows['score']+3;
                            $SQLa="update userDetail set time='{$time}',score='{$score}' where id='{$row['id']}'";
                            mysqli_query($link,$SQLa);
                            $SQL3="select * from userDetail where id='{$row['id']}'";
                            $res3=mysqli_query($link,$SQL3);
                            $row3=mysqli_fetch_assoc($res3);
                            
                            $_SESSION['user'] = $row;
                            $_SESSION['userDetail']=$row3;
                            $_SESSION['flag'] = md5($_SESSION['user']['userName']); 
                            // var_dump($_SESSION);
                            echo '<script>alert("登录成功！");window.location.href="./index.php"</script>';
	                            exit;
                        }else{
                            $SQLa="update  userDetail set time='{$time}' where id='{$row['id']}'";
                            mysqli_query($link,$SQLa);
                            $SQL3="select * from userDetail where id='{$row['id']}'";
                            $res3=mysqli_query($link,$SQL3);
                            $row3=mysqli_fetch_assoc($res3);
                            
                            $_SESSION['user'] = $row;
                            $_SESSION['userDetail']=$row3;
                            $_SESSION['flag'] = md5($_SESSION['user']['userName']); 
                            //var_dump($_SESSION);
                          // echo '<script>alert("登录成功！");window.location.href="./index.php"</script>';
	                            exit;
                        }
                }     
          }
        }else{
		
				echo '<script>alert("请检查用户名和密码！");window.location.href="login.php"</script>';
            	exit;
        }
        
     }else{
        echo '<script>alert("用户名、密码不能为空！");window.location.href="login.php"</script>';
	exit;
    } 
    
 
    
  
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
   
?>

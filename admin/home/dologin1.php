<?php
    session_start();
    //ini_set('display_errors','0');
    header('Content-type:text/html;charset=utf-8');
	//var_dump($_POST);
    $userName=$_POST['userName'];
    $password=md5($_POST['password']);
    $status=$_POST['status'];
    $ctime=time();
   
   

   
   
    //连接数据库进行用户名，密码验证；
   // include('../install/dbconfig.php');
   //链接数据库
    mysql_connect('localhost','root','');

    //选择数据库
    mysql_select_db('lamp111');

    mysql_set_charset('utf8');
    
	//判断
    if(!empty($userName)&&!empty($password)){
        $sql="select * from user where userName='{$userName}' and password='{$password}'";
        $result1=mysql_query($sql);
        //echo $sql;
         
        //判断用户、密码是否正确；
      if(mysql_num_rows($result1)>0){
	   
            $row=mysql_fetch_assoc($result1);
            //var_dump($row);
            $sql1="select * from userDetail where id='{$row['id']}'";
            $result=mysql_query($sql1);
				// echo '1111';
				// var_dump(mysql_num_rows($result));
            if(mysql_num_rows($result)>0){
			
                $row1=mysql_fetch_assoc($result);
                //记录登录时间比较，加积分；
                $oldtime=$row1['time'];
              
				if(date('d',$ctime)!=date('d',$oldtime)){
					$score=$row1['score']+3;
					//在写入积分和时间
					$sql2="update userDetail set time='{$ctime}',score='{$score}' where id='{$row['id']}'";
					mysql_query($sql2);
					$sql3="select * from userDetail where id='{$row['id']}'";
					$result=mysql_query($sql3);
					$row3=mysql_fetch_assoc($result);
					
					$_SESSION['user'] = $row;
					$_SESSION['userDetail']=$row3;
					$_SESSION['flag'] = md5($_SESSION['user']['userName']);
					 //var_dump($_SESSION);
					echo '<script>alert("登录成功！");window.location.href="./index.php"</script>';
						exit;

				}else{
				
					$sql2="update userDetail set time='{$ctime}' where id='{$row['id']}'";
					mysql_query($sql2);
					$sql3="select * from userDetail where id='{$row['id']}'";
					$result=mysql_query($sql3);
					$row3=mysql_fetch_assoc($result);
					
					$_SESSION['user'] = $row;
					$_SESSION['userDetail']=$row3;
					$_SESSION['flag'] = md5($_SESSION['user']['userName']);
					echo '<script>alert("登录成功！");window.location.href="./index.php"</script>';
						exit;
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

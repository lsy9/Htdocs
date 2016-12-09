<?php
    session_start();
	header('Content-type:text/html;charset=utf-8');

    $email=$_POST['email'];
    $nickName=$_POST['nickName'];
    $qq=$_POST['qq'];
    
    
    $id=$_SESSION['user']['id'];
    $question=$_POST['question'];
    $answer=$_POST['answer'];
    $code=$_POST['code'];
	// var_dump($_POST);
    // exit;
     //判断验证码是否正确
    if($code!==$_SESSION['vcode']){
        echo '<script>alert("验证码不正确！");window.location.href="./update.php?id'.$id.'"</script>';
	exit;
     }

    if(!empty($_FILES['upload']['name'])){
        
        $photo=$_FILES['upload']['name'];
        $type=$_FILES['upload']['type'];
        $tmpName=$_FILES['upload']['tmp_name'];
        $error=$_FILES['upload']['error'];
        $size=$_FILES['upload']['size'];
		//var_dump($_FILES);

         //判断上传头像的错误
        switch($error){
            case 1:
                 echo '<script>alert("上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值,请重新上传！");window.location.href="./main_info.php"</script>';
                exit();
            break;
            case 2:
                echo '<script>alert("上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值,请重新上传！");window.location.href="./main_info.php"</script>';
                exit();
            break;
            case 3:
                echo '<script>alert("文件只有部分被上传,请重新上传！");window.location.href="./main_info.php"</script>';
                exit();
            break;
            case 4:
                echo '<script>alert("没有文件被上传,请重新上传！");window.location.href="./main_info.php"</script>';
                exit();
            break;
            case 6:
                echo '<script>alert("上传失败,请重新上传！");window.location.href="./main_info.php"</script>';
                exit();
            break;
        
            case 7:
                echo '<script>alert("上传失败,请重新上传！");window.location.href="./main_info.php"</script>';
                exit();
            break;   
        
        }

        $mimeTypes= array('image/png','image/jpeg','image/gif');
        $mime = $_FILES['upload']['type'];
        if(!in_array($mime,$mimeTypes)){
            echo '<script>alert("MIME类型不符,请重新上传！");window.location.href="./main_info.php"</script>';
            exit();
        }

        $allowSuffix=array('jpeg','jpg','png','gif','JPEG','JPG','PNG','GIF');
        $suffix=pathinfo($_FILES['upload']['name'])['extension'];
        if(!in_array($suffix,$allowSuffix)){
            echo '<script>alert("后缀名不对,请重新上传！");window.location.href="./main_info.php"</script>';
            exit();
        }

        $allowSize=1000000;
        $fileSize=$_FILES['upload']['size'];
        if($allowSize<$fileSize){
             echo '<script>alert("文件太大,请重新上传！");window.location.href="./main_info.php"</script>';
            exit();
        }

        $tmpName=$_FILES['upload']['tmp_name'];
       
        if(is_uploaded_file($tmpName)){
            $des='./img/'.$photo;
           
            move_uploaded_file($tmpName,$des);
            $_POST['photot']=$photo;
        }
    }

   //链接数据库
    mysql_connect('localhost','root','');

    //选择数据库
    mysql_select_db('lamp111');

    mysql_set_charset('utf8');

	//拼接SQL set 数据
	 $set=array();
    if(!empty($email)){
        $set[]="email='{$email}'";
    }
    if(!empty($nickName)){
        $set[]="nickName='{$nickName}'";
    }
    if(!empty($qq)){
        $set[]="qq='{$qq}'";
    }
    if(!empty($photo)){
        $set[]="photo='{$photo}'";
    }
    if(!empty($sheng)){
        $set[]="sheng='{$sheng}'";  
    }
    if(!empty($shi)){
        $set[]="shi='{$shi}'";
    }
    if(!empty($qu)){
        $set[]="qu='{$qu}'";
    }
    if(!empty($question)){
        $set[]="question='{$question}'";
    }
    if(!empty($answer)){
        $set[]="answer='{$answer}'";
    }

	// , 使用,号连接所有存在的字段和值
        $sets='';
    if(!empty($_POST)){
        $sets=implode(',',$set);
    }

	// echo $sets.'<br />';
	
    $SSQL="update userDetail set ".$sets." where id='{$id}'";  
	
    // echo $SSQL;exit;

	//资源
    $sres=mysql_query($SSQL);
	
	//判断是否存在该资源，是否执行成功
    if($sres && mysql_affected_rows()>0){
        //给session重新赋值；
        //var_dump($_SESSION);
        $QSQL="select * from userDetail where id='{$id}'";
        $qres=mysql_query($QSQL);
        $array=mysql_fetch_assoc($qres);
        //var_dump($array);
        
        $_SESSION['userDetail']=$array;
        
        //var_dump($_SESSION);
        $SQL1="select * from user where id='{$id}'";
        $res1=mysql_query($SQL1);
        $array1=mysql_fetch_assoc($res1);
        $_SESSION['user']=$array1;
        mysql_close();
        echo '<script> alert ("修改成功！");window.location.href="./usercenter.php?id='.$id.'"</script>';
        exit;
    }else{
		echo '<script> alert ("修改失败！");window.location.href="./update.php?id='.$id.'"</script>';
            exit;
    }


?>

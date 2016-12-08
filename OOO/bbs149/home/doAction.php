<?php
	//通过用户的动作，执行相应的操作
	
	//开启session
	session_start();
	
	//调用公共配置
	require("../public/config.php");
	
	//1.连接数据库
		$link = mysqli_connect(HOST,USER,PASS) or die ("数据库连接失败！");
		
	//2.设置字符集
		mysqli_set_charset($link,CHARSET);
		
	//3.选择数据库
		mysqli_select_db($link,DBNAME);
		
	switch($_GET['a']){
		case "register":	//执行注册动作
			$uname = $_POST['uname'];
			$upass = md5($_POST['upass']);
			$surepass = md5($_POST['surepass']);
			$uemail = $_POST['uemail'];
			
			//判断用户是否提交了空数据
			if(empty($uname) || empty($upass) || empty($surepass) || empty($uemail)){
				
				echo "<script>alert('信息填写不完整，请补全信息');window.location.href='./register.php'</script>";
				die;
			}
			
			//判断用户密码和确认密码是否一致
			if($upass != $surepass){
				
				echo "<script>alert('密码和确认密码不一致，请确认');window.location.href='./register.php'</script>";
				die;
			}
			
			//判断用户名是否存在
			//4.定义sql语句，发送并执行
			$sql = "select * from user where userName = '{$uname}'";
			$result = mysqli_query($link,$sql);
			
			if($result && mysqli_num_rows($result)>0){
				
				echo "<script>alert('用户名已存在！请更改后重试！');window.location.href='./register.php'</script>";
				die;
			}
			//如果以上判断都通过的话，将数据写入数据库，并告诉他注册成功
			$time = time();
			$sql="insert into user (id,userName,password,lastlogin) values(null,'{$uname}','{$upass}',{$time})";
			$result = mysqli_query($link,$sql);
		
			//判断是否添加成功
			if($result && mysqli_affected_rows($link)>0){
				
				//获取刚才插入数据的id
				$uid = mysqli_insert_id($link);
				
				//将email和用户的id插入第二张表(userdetail用户详情表)
				$sql = "insert into userdetail (uid,email) values({$uid},'{$uemail}')";
				$result = mysqli_query($link,$sql);
				
				//判断第二张表是否插入成功
				if($result && mysqli_affected_rows($link)>0){
					
					echo "<script>alert('注册成功！');window.location.href='./login.php'</script>";
				}
					
				
			}							
		break;
		
		case "login"://执行登录
			
			
			//接收用户提交的信息
			$uname = $_POST['uname'];
			$upass = md5($_POST['upass']);
			
			//4.定义sql语句，发送并执行
			$sql = "select * from user where userName='{$uname}' && password='{$upass}'";
			$result = mysqli_query($link,$sql);
			
			if(empty($uname) || empty($upass)){
				echo "<script>alert('没有输入账号或密码，请重新输入！');window.location.href='./login.php'</script>";
				die;
			}
			
			if(mysqli_num_rows($result)<=0){
				echo "<script>alert('账号或密码错误！请确认！');window.location.href='./login.php'</script>";	
				die;
			}
			
			//定义sql语句，发送并执行
			$sql = "select * from user where userName='{$uname}' && status='1'";
			$result = mysqli_query($link,$sql);
			if($result && mysqli_num_rows($result)>0){

				
				$row = mysqli_fetch_assoc($result);
				$_SESSION['uid'] = $row['id'];
				
				
			//执行加积分
			$sql1 = "select * from user where id={$_SESSION['uid']}";
			$result1 = mysqli_query($link,$sql1);
			$rows1 = mysqli_fetch_assoc($result1);
			
			
			$sql2 = "update user set points={$rows1['points']}+10 where id={$_SESSION['uid']}";
			$rows2=mysqli_query($link,$sql2);
			echo "<script>alert('恭喜您，登录成功！');window.location.href='./index.php'</script>";
			
			}else{
				
				echo "<script>alert('登录失败，账号被封禁！请联系管理员！');window.location.href='./index.php'</script>";
				die;
			}
			
		break;
		
		case "update":	//执行修改信息
			//接收用户提交的信息
			$uname = @$_POST['uname'];
			$unickName = $_POST['unickName'];
			$upass = $_POST['upass'];
			$uemail = $_POST['uemal'];
			$uqq = $_POST['uqq'];
			$usex = $_POST['usex'];
			//定义sql语句，并发送执行
			
			if(empty($upass) || empty($unickName) || empty($uemail) || empty($uqq) || empty($usex)){
				
				echo "<script>alert('信息填写不完整，请补全信息');window.location.href='./mycenter.php'</script>";
				die;
			}
			$upass = md5($upass);
			$uid = $_SESSION['uid'];

			$sql = "update userdetail set nickName='{$unickName}',email='{$uemail}',qq='{$uqq}',sex='{$usex}' where uid={$uid}";
			$result = mysqli_query($link,$sql);
			
			
				$sql1 = "update user set password='{$upass}' where id='{$uid}'";
				$result1 = mysqli_query($link,$sql1);
			
			if($result && mysqli_affected_rows($link)>0){
				
				
				
				if($result1 && mysqli_affected_rows($link)>0){
				
				echo "<script>alert('恭喜您，修改成功！');window.location.href='./mycenter.php'</script>";
				}
					
				
			}else{
				echo "<script>alert('恭喜您，修改成功！');window.location.href='./mycenter.php'</script>";
			}
		break;
		case "pic":	//执行头像上传
			
			//引入一下公共函数库
			require("../public/functions.php");
			
			//定义参数
			$path = "../public/uploads";
			$upfile = $_FILES['upic'];
			$typeList = array("image/jpeg","image/png","image/gif");
			
			$res = upload($path,$upfile,$typeList);
			
			if($res['error']==false){
				
				echo "<script>alert('{$res['info']}');window.location.href='./userpic.php'</script>";
			}
			
			if($res['error']==true){
				
				//获取原图片的名字
				$picname = $res['info'];
				
				//将图片裁剪成3份
				imageResize($path,$picname,75,75,"s_");
				imageResize($path,$picname,150,150,"m_");
				imageResize($path,$picname,230,230,"l_");
			
				//获取当前登录用户的id
				$uid = $_SESSION['uid'];
				
				//删除原来的头像
				
				$sql = "select photo from userdetail where uid={$uid}";
				$result = mysqli_query($link,$sql);	
				
				if($result && mysqli_num_rows($result)>0){
					
					$row = mysqli_fetch_assoc($result);
					
					
					if($row['photo']!='default.jpg'){
					//执行删除
					@unlink("../public/uploads/{$row['photo']}");
					@unlink("../public/uploads/s_{$row['photo']}");
					@unlink("../public/uploads/m_{$row['photo']}");
					@unlink("../public/uploads/l_{$row['photo']}");
					}
				}
				//将图片上传到数据库
				$sql = "update userdetail set photo='{$picname}' where uid={$uid}";
				$result = mysqli_query($link,$sql);
				
				if($result && mysqli_affected_rows($link)>0){
					
					
					echo "<script>alert('恭喜，头像上传成功！');window.location.href='./userpic.php'</script>";
				}
			}
		break;
		
		case "doLogin":		//下面的登录
			
			$uname = $_POST['uname'];
			$upass = md5($_POST['upass']);
			$ucode = $_POST['ucode'];
			
			if($ucode != $_SESSION['code']){
		
			//js弹窗	alter(弹窗);window.location.href='跳转页面';
			echo "<script>alert('登录失败！验证码错误');window.location.href='login.php'</script>";
			die;
			}
			
			//接收用户提交的信息
			$uname = $_POST['uname'];
			$upass = md5($_POST['upass']);
			
			//4.定义sql语句，发送并执行
			$sql = "select * from user where userName='{$uname}' && password='{$upass}'";
			$result = mysqli_query($link,$sql);
			
			if(empty($uname) || empty($upass)){
				echo "<script>alert('没有输入账号或密码，请重新输入！');window.location.href='./login.php'</script>";
				die;
			}
			
			if(mysqli_num_rows($result)<=0){
				echo "<script>alert('账号或密码错误！请确认！');window.location.href='./login.php'</script>";	
				die;
			}
			
			//定义sql语句，发送并执行
			$sql = "select * from user where userName='{$uname}' && status='1'";
			$result = mysqli_query($link,$sql);
			if($result && mysqli_num_rows($result)>0){

				echo "<script>alert('恭喜您，登录成功！');window.location.href='./index.php'</script>";
				$row = mysqli_fetch_assoc($result);
				$_SESSION['uid'] = $row['id'];
				
			}else{
				
				echo "<script>alert('登录失败，账号被封禁！请联系管理员！');window.location.href='./index.php'</script>";
				die;
			}
			
		break;
		
		case "update":	//执行修改信息
			//接收用户提交的信息
			$uname = @$_POST['uname'];
			$unickName = $_POST['unickName'];
			$upass = $_POST['upass'];
			$uemail = $_POST['uemal'];
			$uqq = $_POST['uqq'];
			$usex = $_POST['usex'];
			//定义sql语句，并发送执行
			
			if(empty($upass) || empty($unickName) || empty($uemail) || empty($uqq) || empty($usex)){
				
				echo "<script>alert('信息填写不完整，请补全信息');window.location.href='./mycenter.php'</script>";
				die;
			}
			$upass = md5($upass);
			$uid = $_SESSION['uid'];

			$sql = "update userdetail set nickName='{$unickName}',email='{$uemail}',qq='{$uqq}',sex='{$usex}' where uid={$uid}";
			$result = mysqli_query($link,$sql);
			
			
				$sql1 = "update user set password='{$upass}' where id='{$uid}'";
				$result1 = mysqli_query($link,$sql1);
			
			if($result && mysqli_affected_rows($link)>0){
				
				
				
				if($result1 && mysqli_affected_rows($link)>0){
				
				echo "<script>alert('恭喜您，修改成功！');window.location.href='./mycenter.php'</script>";
				}
					
				
			}else{
				echo "<script>alert('修改失败！没有更改信息');window.location.href='./mycenter.php'</script>";
			}
		
			
		break;
		
		case "addpost":
					//定义发帖人id
		$uid = @$_SESSION['uid'];
		if(!isset($uid)){
			echo "<script>alert('请前去登录后再来发帖！');window.location.href='index.php'</script>";
			die;
		}
			//	获取用户提交的信息
		$tid = $_GET['id'];
		$title = $_POST['title'];
		$content = $_POST['content'];
		$ctime = time();
		
				
		if(empty($title) || empty($content)){
	
		//js弹窗	alter(弹窗);window.location.href='跳转页面';
		echo "<script>alert('请填写完整帖子信息');window.location.href='fatie.php?id={$tid}'</script>";
		die;
		}
		
		//	4.定义sql语句，并发送执行
		$sql = "insert into post (id,uid,tid,title,content,ctime) values (null,{$uid},{$tid},'{$title}','{$content}','{$ctime}')";
		$result = mysqli_query($link,$sql);
		
		//	5判断
		if($result && mysqli_affected_rows($link)>0){
			
			echo "<script>alert('发帖成功！');window.location.href='list.php?id={$tid}'</script>";
		
		}
		
		//	6.关闭数据库
		mysqli_close($link);
		break;
		
		case "details":
			
			
			$uid = $_SESSION['uid'];
			$pid = $_GET['id'];
			$content = $_POST['content'];
			$date=time();		//定义时间戳
			$title = $_GET['title'];	
			
			//	定义sql语句，并发送执行
			
			$sql = "insert into reply (id,uid,pid,content,ctime) values (null,{$uid},{$pid},'{$content}','{$date}') ";
			$result = mysqli_query($link,$sql);
			
			if($result && mysqli_affected_rows($link)>0){
				
				echo "<script>alert('回复成功！');window.location.href='details.php?id={$pid}&title={$title}'</script>";
			
				
			}
			
			
		break;

	}
?>
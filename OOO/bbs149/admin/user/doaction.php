<?php
	//1. 连接数据库，并判断
		$link = mysqli_connect("localhost","root","") or die("数据库连接失败！");
	
	//2. 设置字符集
		mysqli_set_charset($link,"utf8");
		
	//3. 选择数据库
		mysqli_select_db($link,"bbs");
	
	switch ($_GET['a']){
		case "addFather":
			
			//将父类名称写入数据库
			$father = $_POST['father'];
			
			//4.将父类名添加到数据库当中
			$sql = "insert into type (name) values('{$father}')";
			$result =mysqli_query($link,$sql);
			
			//5.判断是否添加成功
			if($result && mysqli_affected_rows($link)>0){
				
				//告诉用户，添加成功
				echo "<script>alert('父类名称添加成功！');window.location.href='main_menu.php'</script>";
			}
		break;
	
		case "addChild":	//执行子类添加
			
			//引用公共函数库
			include("../../public/functions.php");
			
			//定义上传图片函数的变量
			$path = "../../public/uploads";
			$upfile = $_FILES['blogo'];
			$typeList = array("image/jpeg","image/png","image/gif");
			$res = upload($path,$upfile,$typeList);
			
			//获取子类名称，父类id
			$fid = $_POST['fid'];
			$child = $_POST['child'];
			
			//将这两个内容写到数据库当中
			$sql = "insert into type (name,pid,path,blogo) values ('{$child}',{$fid},'0-{$fid}','{$res['info']}')";
			$result = mysqli_query($link,$sql);
			
			//判断
			if($result && mysqli_affected_rows($link)>0){
				
				echo "<script>alert('子类名称添加成功！');window.location.href='main_menu.php'</script>";
				
			}
		break;
		
		case "update":  //修改子版块信息
			
			//引用公共函数库
			include("../../public/functions.php");
			
			
			//定义上传图片函数的变量
			$path = "../../public/uploads";
			$upfile = $_FILES['blogo'];
			$typeList = array("image/jpeg","image/png","image/gif");
			$res = upload($path,$upfile,$typeList);
			if($res['error']==false){
				
				echo "<script>alert('{$res['info']}');window.location.href='./main_menu.php'</script>";
				die;
			}
			//获取原图片的名字
				$picname = $res['info'];
				
			//将图片裁剪成3份
				imageResize($path,$picname,75,75,"s_");
				imageResize($path,$picname,150,150,"m_");
				imageResize($path,$picname,230,230,"l_");
				
			//获取用户提交的信息
			$id = $_GET['id'];
			$name = $_POST['child'];
			
			
			
			
			//定义sql语句，并发送执行
			$sql = "update type set name='{$name}',blogo='{$res['info']}' where id={$id}";
			$result = mysqli_query($link,$sql);
			
			//判断
			if($result && mysqli_affected_rows($link)>0){
				
				//提示
				echo "<script>alert('修改子类成功！');window.location.href='./main_menu.php';</script>";

			}
				
			
		break;
		
		case "adduser":		//执行添加用户
						//	获取用户提交的信息
			$uname = $_POST['uname'];
			$upass = md5($_POST['upass']);
			$surepass = md5($_POST['surepass']);
			$auth = $_POST['auth'];
			
			
			//	判断了用户是否提交了空数据
			if(empty($uname) || empty($upass) || empty($surepass)){
				
				//	提示信息
				echo "<script>alert('请填写完整注册数据');window.location.href='main_info.php'</script>";
				die;
			}
			
			//	判断用户的密码和确认密码是否一致
			if($upass != $surepass ){
				
				//	提示信息
				echo "<script>alert('两次输入的密码不一致');window.location.href='main_info.php'</script>";
				die;
			}
			
			//	判断用户是否已存在
			//	4,定义sql语句，并发送执行
				$sql = "select * from user where userName='{$uname}'";
				$result = mysqli_query($link,$sql);
				
			//	5.判断是否存在该用户
				if($result && mysqli_num_rows($result)>0){
					
					//	提示信息
					echo "<script>alert('用户名已存在，请重新输入');window.location.href='main_info.php'</script>";
					die;
				}
			
			$date= time();	//定义时间戳
			
			//	如果以上判断都通过的话，将用户数据写入数据库
				$sql = "insert into user (id,userName,password,lastlogin,auth) values (null,'{$uname}','{$upass}','{$date}','{$auth}')";
				$result = mysqli_query($link,$sql);
				
			//	判断是否添加成功
				if($result && mysqli_affected_rows($link)>0){
					
				//获取刚才插入数据的id
					$uid = mysqli_insert_id($link);
				//将email和用户的id插入第二张表(userdetail用户详情表)
					$sql = "insert into userdetail (uid) values({$uid})";
					$result = mysqli_query($link,$sql);
					if($result && mysqli_affected_rows($link)>0){
					echo "<script>alert('恭喜你，添加成功');window.location.href='main_info.php'</script>";
					}
				}
				
			//	6.关闭数据库
				mysqli_close($link);
			
		break;
		
				case "delete":		//执行删除
			
			//	获取要删除的id
				$id = $_GET['id'];
			
			//4. 定义sql语句，并发送执行
				$sql = "delete from user where id={$id}";
				$result = mysqli_query($link,$sql);
				
				//5.判断是否删除成功
				if($result && mysqli_affected_rows($link)>0){
					//提示添加信息
					echo "<script>alert('删除成功');window.location.href='./main_list.php';</script>";
					
				}
				
				//6.关闭数据库
				mysqli_close($link);
				
		break;
		
		case "updateuser":		//执行修改
			
			//获取用户提交的信息
			$id = $_GET['id'];
			
			$upass = $_POST['upass'];
			$surepass = $_POST['surepass'];
			$auth = $_POST['auth'];
			
			
			//	判断了用户是否提交了空数据
			if(empty($upass) || empty($surepass)){
				
				//	提示信息
				echo "<script>alert('请填写完整');window.location.href='main_list.php'</script>";
				die;
			}
			
			$upass = md5($_POST['upass']);
			$surepass = md5($_POST['surepass']);
			
			//	判断用户的密码和确认密码是否一致
			if($upass != $surepass ){
				
				//	提示信息
				echo "<script>alert('两次输入的密码不一致');window.location.href='main_list.php'</script>";
				die;
			}
			
			$date= time();		//定义时间戳
			
			//	如果以上判断都通过的话，将用户数据写入数据库
			
				$sql = "update user set password='{$upass}',lastlogin='{$date}',auth='{$auth}' where id={$id} ";
				$result = mysqli_query($link,$sql);
			
			//	判断是否添加成功
				if($result && mysqli_affected_rows($link)>0){
					
					echo "<script>alert('恭喜你，修改密码成功');window.location.href='main_list.php'</script>";
				}
				
			//	6.关闭数据库
				mysqli_close($link);
			
		break;
		
		case "idout":	//执行禁用id
			
			//获取用户提交的id
			$id = $_GET['id'];
			
			//4	定义sql语句，并发送执行
			$sql = "update user set status='0' where id='{$id}' ";
			$result = mysqli_query($link,$sql);
			
			//5 判断
			if($result && mysqli_affected_rows($link)>0 ){
				
				echo "<script>alert('已禁用！');window.location.href='main_list.php'</script>";
			
			}
				
			
			
			//	6.关闭数据库
			mysqli_close($link);
			
		break;
		
		case "idin":	//执行解禁id
			
			//获取用户提交的id
			$id = $_GET['id'];
			
			//4	定义sql语句，并发送执行
			$sql = "update user set status='1' where id='{$id}' ";
			$result = mysqli_query($link,$sql);
			
			//5 判断
			if($result && mysqli_affected_rows($link)>0 ){
				
				echo "<script>alert('解禁成功！');window.location.href='main_list.php'</script>";
			
			}
				
			
			
			//	6.关闭数据库
			mysqli_close($link);
			
		break;

		case "updatefather":	//执行修改父分区
			$father = $_POST['father'];
			$id = $_GET['fid'];
			
			//4.定义sql语句，并发送执行
			$sql = "update type set name='{$father}' where id={$id}";
			$result = mysqli_query($link,$sql);
			
			if($result && mysqli_affected_rows($link)>0 ){
				
				echo "<script>alert('修改成功！');window.location.href='main_list.php'</script>";
			
			}
				
			
				
			
		break;
		
		case "delectfather":	//执行删除父分区
			$id = $_GET['fid'];
			
			//定义sql语句，并发送执行
			$sql = "select * from type where path like '%{$id}'";
			$result = mysqli_query($link,$sql);
			
			//判断,若存在子类，则不能删除
			if($result && mysqli_num_rows($result)>0){
				echo "<script>alert('存在子分类，不能删除！');window.location.href='./main_menu.php';</script>";
			}else{
				$sql1 = "delete from type where id={$id}";
				$result1 = mysqli_query($link,$sql1);
				
				//判断
				if($result1 && mysqli_affected_rows($link)>0){
				
				//提示删除成功，并跳转到浏览分区页
				echo "<script>alert('删除父类成功！');window.location.href='./main_menu.php';</script>";

			}
			}
			
		break;
		
		case "deletechild":		//执行删除子分区
			$id = $_GET['id'];
			
			//4 定义sql语句，并发送执行
			$sql = "delete from type where id={$id}";
			$result = mysqli_query($link,$sql);
			
			//5 判断
			if($result && mysqli_affected_rows($link)>0){
				
				//提示
				echo "<script>alert('删除子类成功！');window.location.href='./main_menu.php';</script>";

			}
		break;
		
		case "putpost":		//执行将帖子放入回收站
			$id = $_GET['id'];
			
			//4.定义sql语句，发送并执行
			$sql = "update post set recycle='1' where id={$id}";
			$result = mysqli_query($link,$sql);
			
			if($result && mysqli_affected_rows($link)>0){
				
				echo "<script>alert('放入回收站成功！');window.location.href='./tieziliebiao.php';</script>";
			}
		break;
		
		case "recuver":		//执行恢复帖子
			$id = $_GET['id'];
			
			//4.定义sql语句，发送并执行
			$sql = "update post set recycle='0' where id={$id}";
			$result = mysqli_query($link,$sql);
			
			if($result && mysqli_affected_rows($link)>0){
				
				echo "<script>alert('恢复成功！');window.location.href='./huishouzhan.php';</script>";
			}
		break;
		
		case "delectpost":	//执行删除帖子
			$id = $_GET['id'];
			
			//4.定义sql语句，发送并执行
			$sql = "delete from post where id={$id}";
			$result = mysqli_query($link,$sql);
			
			if($result && mysqli_affected_rows($link)>0){
				
				echo "<script>alert('删除成功！');window.location.href='./huishouzhan.php';</script>";
			}
		break;
		
		case "updateweb":
			//接收提交的信息
		$wtitle = $_POST['wtitle'];
		$wbanquan = $_POST['wbanquan'];
		$wguanjian = $_POST['wguanjian'];
		$wlevel = $_POST['wlevel'];
		
			//引用公共函数库
		include("../../public/functions.php");
		
		//定义上传图片函数的变量
		$path = "../../public/uploads";
		$upfile = $_FILES['wlogo'];
		$typeList = array("image/jpeg","image/png","image/gif");
		$res = upload($path,$upfile,$typeList);
		
			
		//4.定义sql语句，发送并执行
			$sql ="update config set webname='{$wtitle}',keywords='{$wguanjian}',logo='{$res['info']}',copy='{$wbanquan}',status={$wlevel}";
			$result = mysqli_query($link,$sql);
			
		//5.解析结果集
			if($result && mysqli_affected_rows($link)>0){
				echo "<script>alert('修改成功！');window.location.href='wangzhanpeizhi.php'</script>";
			}
		break;
		
		case "friendlinkadd":	//执行友情链接添加
			//接收传值
			$linkname=$_POST['linkname'];
			$url=$_POST['url'];
			$logo = $_FILES['ulogo'];
			//引入一下公共函数库
				require("../../public/functions.php");
				
			//定义上传必须的变量
				$path = "../../public/uploads/";
				$upfile = $_FILES['ulogo'];
				$typeList = array("image/png","image/gif","image/jpeg");
				
			//执行头像上传
				$res = upload($path,$upfile,$typeList);
				
			//判断是否上传成功
				 if($res['error']==false){
					echo "<script>alert('{$res['info']}');window.location.href='addfriendLink.php'</script>";
					die;
				} 
				
			//如果成功
				if($res['error']==true){
		
			//获取原图片的名字
				$picname=$res['info'];
				

			//引入公共配置文件
				require("../../public/config.php");

			
			//1. 连接数据库，并判断
				$link = mysqli_connect(HOST,USER,PASS) or die("数据库连接失败！");
			
			//2. 设置字符集
				mysqli_set_charset($link,CHARSET);
				
			//3. 选择数据库
				mysqli_select_db($link,DBNAME);
			
			//定义sql语句传值执行
			$sql="insert into friendlink (linkname,url,logo) values ('{$linkname}','{$url}','{$picname}')";

			$result=mysqli_query($link,$sql);
			
			//判断
			if($result && mysqli_affected_rows($link)>0){
				
				echo "<script>alert('链接添加成功!');window.location.href='./friendlink.php'</script>";
			
			}
			
				}	
			
			
			break;
			
			case "friendlinkupdate":	//执行友情链接编辑
				
			
				  $linkname=$_POST['linkname'];//接收链接名称 
				  $url=$_POST['url'];//接收链接路径
				  $id=$_GET['id'];//接收id
				  
				  //引入一下公共函数库
				require("../../public/functions.php");
				
			//定义上传必须的变量
				$path = "../../public/uploads/";
				$upfile = $_FILES['ulogo'];
				$typeList = array("image/png","image/gif","image/jpeg");
				
			//执行头像上传
				$res = upload($path,$upfile,$typeList);
				
			//判断是否上传成功
				 if($res['error']==false){
					echo "<script>alert('{$res['info']}');window.location.href='addfriendLink.php'</script>";
					die;
				} 
				
			//如果成功
				if($res['error']==true){
		
			//获取原图片的名字
				$picname=$res['info'];
				
					
				//定义SQL语句，传值
				$sql="update  friendlink set linkname='{$linkname}',url='{$url}',logo='{$picname}' where id='{$id}'";
				$result=mysqli_query($link,$sql);
				
				//判断
				if($result && mysqli_affected_rows($link)>0){
					
					echo "<script>alert('恭喜编辑成功！');window.location.href='./friendlink.php'</script>";
					
				}
				}
			
				//关闭服务器
				mysqli_close($link);
		
				break;
				
			case "delectfriendlink":	//执行删除
				$id=$_GET['id'];//接收索要删除项的id
				
				//定义SQL语句执行 
				$sql="delete from friendlink where id='{$id}'";
				$result=mysqli_query($link,$sql);
				
				if($result && mysqli_affected_rows($link)>0){
					
					echo "<script>alert('恭喜删除成功！');window.location.href='./friendlink.php'</script>";
			
			}
			break;
			
			case "zhiding":		//执行置顶
				$id = $_GET['id'];
				$top = $_GET['top'];
				//定义sql语句并执行
				
				if($top==0){
				$sql = "update post set top='1' where id={$id}";
				$result = mysqli_query($link,$sql);
				
				if($result && mysqli_affected_rows($link)>0){
					
					echo "<script>alert('置顶成功！');window.location.href='./tieziliebiao.php'</script>";
			
			}
			}else{
				$sql1 = "update post set top='0' where id={$id}";
				$result1 = mysqli_query($link,$sql1);
				
				if($result1 && mysqli_affected_rows($link)>0){
					
					echo "<script>alert('取消置顶成功！');window.location.href='./tieziliebiao.php'</script>";
			
			}
				
			}
			
			break;
			
			case "jiajing":		//执行加精
				$id = $_GET['id'];
				$elite = $_GET['elite'];
				//定义sql语句并执行
				
				if($elite==0){
				$sql = "update post set elite='1' where id={$id}";
				$result = mysqli_query($link,$sql);
				
				if($result && mysqli_affected_rows($link)>0){
					
					echo "<script>alert('加精成功！');window.location.href='./tieziliebiao.php'</script>";
			
			}
			}else{
				$sql1 = "update post set elite='0' where id={$id}";
				$result1 = mysqli_query($link,$sql1);
				
				if($result1 && mysqli_affected_rows($link)>0){
					
					echo "<script>alert('取消加精成功！');window.location.href='./tieziliebiao.php'</script>";
			
			}
				
			}

			break;
			
			case "updatepost":		//执行帖子编辑
				
				$title = $_POST['title'];
				$content = $_POST['content'];
				$id = $_POST['id'];
				$sql = "update post set title='{$title}',content='{$content}' where id={$id}";
				$result = mysqli_query($link,$sql);
				
				if($result && mysqli_affected_rows($link)>0){
					
					echo "<script>alert('编辑成功');window.location.href='./tieziliebiao.php'</script>";
			
			}
			break;
			
			case "deletereply":	//执行删除回复
				//接收传值
			$id = $_GET['id'];
			$pid = $_GET['pid'];
			
			//4 定义sql删除回帖语句，并发送执行
			$sql = "delete from reply where id={$id}";
			$result = mysqli_query($link,$sql);
			
			//5 判断是否删除成功
			if($result && mysqli_affected_rows($link)>0){
				
				echo "<script>alert('删除回帖成功！');window.location.href='./checkpost.php?id={$pid}';</script>";
			}
			break;
			
			case "updatereply":		//执行编辑回复
				//接收传值
				$id = $_GET['id'];
				$content = $_POST['content'];
				$ctime = $_POST['ctime'];
				
				//4 定义sql修改reply语句，并发送执行
				$sql = "update reply set content='{$content}',ctime={$ctime} where id={$id}";
				$result = mysqli_query($link,$sql);
				
				//5 判断
				if($result && mysqli_affected_rows($link)>0){
					
					//查询该条回帖的详细信息
					$sql1 = "select * from reply where id={$id}";
					$result1 = mysqli_query($link,$sql1);
					
					//判断查询结果
					if($result1 && mysqli_num_rows($result1)>0){
						$rows1 = mysqli_fetch_assoc($result1);
					}
					
					echo "<script>alert('修改回帖成功！');window.location.href='./checkpost.php?id={$rows1['pid']}';</script>";
				}
			break;
	}
?>
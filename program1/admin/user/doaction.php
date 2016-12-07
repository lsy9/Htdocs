<?php
	// 开启session
	session_start();
	// 设置页面字符集
	header("Content-type:text/html;charset=utf-8");
	// 接收用户操作
	$act = $_GET['act'];

	// 设置默认时区
	date_default_timezone_set("PRC");
	// 引入数据库配置文件
	include('../../public/common/config.php');

	// 处理用户操作
	switch($act){
		case 'disable':
			// 接收id
			$id = $_GET['id'];
			// 禁用用户
			$sql = "update shop_user set status=0 where id={$id}";
			$result = mysqli_query($link,$sql);
			if($result && mysqli_affected_rows($link)){
				echo '<script>
					window.location.href="../user.php";
				</script>';
			} else {
				echo '<script>
					alert("禁用失败");
					window.location.href="../user.php";
				</script>';
			}
		break;
		case 'open':
			$id = $_GET['id'];
			// 启用用户
			$sql = "update shop_user set status=1 where id={$id}";
			$result = mysqli_query($link,$sql);
			if($result && mysqli_affected_rows($link)){
				echo '<script>
					window.location.href="../user.php";
				</script>';
			} else {
				echo '<script>
					alert("启用失败");
					window.location.href="../user.php";
				</script>';
			}
		break;
		case 'add':
			$username = htmlspecialchars(trim($_POST['username']));
			$userpwd = htmlspecialchars(trim($_POST['userpwd']));
			$userpwd2 = htmlspecialchars(trim($_POST['userpwd2']));
			$nickname = htmlspecialchars(trim($_POST['nickname']));
			$level = htmlspecialchars(trim($_POST['level']));
			$sex = htmlspecialchars(trim($_POST['sex']));
			$email = htmlspecialchars(trim($_POST['email']));
			$gold = htmlspecialchars(trim($_POST['gold']));
            $file = $_FILES['userpic'];

			// 验证密码是否一致
			if($userpwd != $userpwd2){
				// 错误号2代表两次密码不一致
				echo '<script>
					window.location.href = "./add.php?errno=2";
				</script>';
				exit;
			} else {
                $userpwd = md5($userpwd);
            }

            // 检测是否上传头像
            if($file['error'] != 4){    // 说明上传了文件
                // 对文件进行上传及缩放处理
                // 引入函数库文件
                include('../../public/common/functions.php');
                // 对上传的图像进行处理
                $path = '../../public/uploads/';
                $info = uploadFile($file,$path,array());
                // 判断是否上传成功
                if($info['isok']){
                    // 上传成功，则进行图片缩放
                    $userpic = $info['message'];
                    imageResize($path.$userpic,$path,80,80,'');
                } else {
                    // 上传失败，提示错误信息，返回添加用户页面
                    echo '<script>
                        alert("'.$info['message'].'");
                        window.location.href="./add.php?errno=1";   // 1表示头像上传失败
                    </script>';
                    exit;
                }
            } else {
                // 没有上传头像时
                $userpic = '';
            }

            // 拼接sql语句
            $sql = "insert into shop_user(username,userpwd,nickname,userpic,level) value('{$username}','{$userpwd}','{$nickname}','{$userpic}',{$level})";

            // 执行sql
            $result = mysqli_query($link,$sql);
            if($result && mysqli_affected_rows($link)>0){
                // 用户表添加成功，添加用户详情表
                $uid = mysqli_insert_id($link); // 获取最新的id
                // 1.由于Email是一个唯一的值，所以先判断Email是否存在
                if(!empty($email)){
                    $sql = "select email from shop_user_details where email={$email}";
                    // 执行并检测
                    $result = mysqli_query($link,$sql);
                    if($result && mysqli_num_rows($result)>0){
                        // 存在 注册失败，删除用户表中的数据
                        $sql = "delete from shop_user where id={$uid}";
                        mysqli_query($link,$sql);
                        // 弹窗提示错误信息
                        echo '<script>
                            alert("邮箱已存在，注册失败");
                            window.location.href = "./add.php?errno=4";
                        </script>';
                        exit;
                    }
                }
                // 2.Email不存在
                $regtime = $lasttime = time();
                $regip = $_SERVER['REMOTE_ADDR'];
                $sql = "insert into shop_user_details(uid,gold,email,regtime,lasttime,regip) value({$uid},{$gold},'{$email}',{$regtime},{$lasttime},'{$regip}')";
                $result = mysqli_query($link,$sql);
                if($result && mysqli_affected_rows($link)>0){
                    // 添加成功，提示信息，返回用户列表
                    echo '<script>
                            alert("添加成功");
                            window.location.href = "./add.php";
                        </script>';
                    exit;
                } else {
                    // 写入详情表失败，删除用户表数据，添加失败
                    $sql = "delete from shop_user where id={$uid}";
                    mysqli_query($link,$sql);
                    // 删除上传的头像
                    @unlink($path.$userpic);
                    // 弹窗提示错误信息
                    echo '<script>
                            alert("添加失败,请重新尝试");
                            window.location.href = "./add.php";
                        </script>';
                    exit;
                }
            } else {
                echo '<script>
                    alert("用户添加失败，请重新尝试");
					window.location.href = "./add.php";
				</script>';
            }
		break;
        case 'edit':
            $id = $_POST['id'];
            $nickname = htmlspecialchars(trim($_POST['nickname']));
            $level = $_POST['level'];
            $sex = $_POST['sex'];
            $email = htmlspecialchars(trim($_POST['email']));
            $gold = htmlspecialchars(trim($_POST['gold']));
            $file = $_FILES['userpic'];

            // 获取一下用户头像，用户更新头像时删除有头像文件
            $sql = "select userpic from shop_user where id={$id}";
            $result = mysqli_query($link,$sql);
            if($result && mysqli_num_rows($result)>0){
                $row = mysqli_fetch_assoc($result);
            }

            // 检测是否上传头像
            if($file['error'] != 4){    // 说明上传了文件
                // 对文件进行上传及缩放处理
                // 引入函数库文件
                include('../../public/common/functions.php');
                // 对上传的图像进行处理
                $path = '../../public/uploads/';
                $info = uploadFile($file,$path,array());
                // 判断是否上传成功
                if($info['isok']){
                    // 上传成功，则进行图片缩放
                    $filename = $info['message'];
                    imageResize($path.$filename,$path,80,80,'');
                    
                    // 拼接更新条件
                    $userpic = ",userpic='{$filename}'";
                } else {
                    // 上传失败，提示错误信息，返回添加用户页面
                    echo '<script>
                        alert("'.$info['message'].'");
                        window.location.href="./edit.php?errno=1&id={$id}";   // 1表示头像上传失败
                    </script>';
                    exit;
                }
            } else {
                // 没有上传头像时，设置头像文件为默认头像
                $userpic = '';
            }

            // 拼接sql语句
            $sql = "update shop_user set nickname='{$nickname}',level={$level}{$userpic} where id={$id}";

            // 执行sql
            $result = mysqli_query($link,$sql);
            if($result){
                // 删除原有头像文件
                @unlink($path.$row['userpic']);
                // 用户表更新成功，更新用户详情表
                $sql = "update shop_user_details set gold={$gold},sex={$sex},email='{$email}' where uid={$id}";
                $result = mysqli_query($link,$sql);
                if($result){
                    // 添加成功，提示信息，返回用户列表
                    echo '<script>
                            alert("修改成功");
                            window.location.href = "../user.php";
                        </script>';
                    exit;
                } else {
                    // 写入详情表失败
                    // 弹窗提示错误信息
                    echo '<script>
                            alert("修改详情失败,请重新尝试");
                            window.location.href = "./edit.php?id='.$id.'";
                        </script>';
                    exit;
                }
            } else {
                // 修改失败，如果修改了头像，则删除上传的文件
                if(!empty($userpic)){
                    @unlink($path.$filename);
                }
                echo '<script>
                    alert("修改用户失败，请重新尝试");
                    window.location.href = "./edit.php?id='.$id.'";
                </script>';
            }
        break;
	}
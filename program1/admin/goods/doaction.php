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
		case 'off':
			// 接收id
			$id = $_GET['id'];
			// 禁用用户
			$sql = "update shop_goods set status=0 where id={$id}";
			$result = mysqli_query($link,$sql);
			if($result && mysqli_affected_rows($link)){
				echo '<script>
					window.location.href="../goods.php";
				</script>';
			} else {
				echo '<script>
					alert("下架失败");
					window.location.href="../goods.php";
				</script>';
			}
		break;
		case 'on':
			$id = $_GET['id'];
			// 启用用户
			$sql = "update shop_goods set status=1 where id={$id}";
			$result = mysqli_query($link,$sql);
			if($result && mysqli_affected_rows($link)){
				echo '<script>
					window.location.href="../goods.php";
				</script>';
			} else {
				echo '<script>
					alert("上架失败");
					window.location.href="../goods.php";
				</script>';
			}
		break;
		case 'add':
			$goodsname = htmlspecialchars(trim($_POST['goodsname']));
			$tid = htmlspecialchars(trim($_POST['tid']));
			$goodsprice = htmlspecialchars(trim($_POST['goodsprice']));
			$goodsnum = htmlspecialchars(trim($_POST['goodsnum']));
			$goodsdes = htmlspecialchars(trim($_POST['goodsdes']));
            $file = $_FILES['goodspic'];

            // 检测是否上传图像
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
                    $goodspic = $info['message'];
                    //商品大图
                    imageResize($path.$goodspic,$path,350,350,'');
                    //商品小图
                    imageResize($path.$goodspic,$path,50,50,'s_');
                } else {
                    // 上传失败，提示错误信息，返回添加页面
                    echo '<script>
                        alert("'.$info['message'].'");
                        window.location.href="./add.php?errno=1";   // 1表示头图片上传失败
                    </script>';
                    exit;
                }
            } else {
                // 没有上传图片时
                echo '<script>
                    alert("请上传商品图片");
                    window.location.href="./add.php";
                </script>';
                exit;
            }

            // 拼接sql语句
            $sql = "insert into shop_goods(goodsname,tid,goodspic,goodsprice,goodsnum,goodsdes) value('{$goodsname}',{$tid},'{$goodspic}',{$goodsprice},{$goodsnum},'{$goodsdes}')";

            // 执行sql
            $result = mysqli_query($link,$sql);
            if($result && mysqli_affected_rows($link)>0){
                echo '<script>
                    alert("商品添加成功");
                    window.location.href = "../goods.php";
                </script>';
            } else {
                // 添加失败，删除上传的文件
                @unlink($path.$goodspic);
                @unlink($path.'s_'.$goodspic);
                echo '<script>
                    alert("商品添加失败，请重新尝试");
					window.location.href = "./add.php";
				</script>';
            }
		break;
        case 'edit':
            $id = $_POST['id'];
            $goodsname = htmlspecialchars(trim($_POST['goodsname']));
            $tid = $_POST['tid'];
            $goodsprice = $_POST['goodsprice'];
            $goodsnum = $_POST['goodsnum'];
            $goodsdes = htmlspecialchars(trim($_POST['goodsdes']));
            $file = $_FILES['goodspic'];

            // 获取一下商品图片，更新图片时删除原有图片文件
            $sql = "select goodspic from shop_goods where id={$id}";
            $result = mysqli_query($link,$sql);
            if($result && mysqli_num_rows($result)>0){
                $row = mysqli_fetch_assoc($result);
            }

            // 检测是否上传图片
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
                    imageResize($path.$filename,$path,350,350,'');
                    imageResize($path.$filename,$path,80,80,'s_');
                    // 删除原有文件
                    @unlink($path.$row['goodspic']);
                    @unlink($path.'s_'.$row['goodspic']);
                    // 拼接更新条件
                    $goodspic = ",goodspic='{$filename}'";
                } else {
                    // 上传失败，提示错误信息，返回修改页面
                    echo '<script>
                        alert("'.$info['message'].'");
                        window.location.href="./edit.php?errno=1&id={$id}";
                    </script>';
                    exit;
                }
            } else {
                // 没有上传图片时
                $goodspic = '';
            }

            // 拼接sql语句
            $sql = "update shop_goods set goodsname='{$goodsname}',tid={$tid},goodsprice={$goodsprice},goodsnum={$goodsnum},goodsdes='{$goodsdes}'{$goodspic} where id={$id}";

            // 执行sql
            $result = mysqli_query($link,$sql);
            if($result){
                // 商品更新成功
                echo '<script>
                        alert("修改成功");
                        window.location.href = "../goods.php";
                    </script>';
            } else {
                echo '<script>
                    alert("修改失败，请重新尝试");
                    window.location.href = "./edit.php?id='.$id.'";
                </script>';
            }
        break;
	}
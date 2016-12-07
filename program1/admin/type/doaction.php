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
	// 引入函数库文件
	include('../../public/common/functions.php');

	// 处理用户操作
	switch($act){
		case 'add':
			// 接收数据
			$typename = htmlspecialchars(trim($_POST['typename']));
			$pid = $_POST['pid'];
			// 检测分类名称是否存在(因为分类名称是唯一的)
			$sql = "select id from shop_types where typename={$typename}";
			$result = mysqli_query($link,$sql);
			if($result && mysqli_num_rows($result)>0){
				// 证明分类已存在
				echo '<script>
					alert("分类名称已存在，请更换分类名重新尝试");
					window.location.href="./add.php";
				</script>';
				exit;
			}

			// 设置path
			if($pid == 0){	// 说明是一级分类
				$path = '0,';
			} else {
				$sql = "select path from shop_types where id={$pid}";
				$result = mysqli_query($link,$sql);
				if($result && mysqli_num_rows($result)>0){
					$row = mysqli_fetch_assoc($result);
					$path = $row['path'] . $pid . ',';
				}
			}
			// 拼接sql语句 
			$sql = "insert into shop_types(typename,pid,path) value('{$typename}',{$pid},'{$path}')";
			// 执行sql
			$result = mysqli_query($link,$sql);
			// 检测
			if($result && mysqli_affected_rows($link)>0){
				echo '<script>
					alert("添加成功");
					window.location.href="./add.php";
				</script>';
			} else {
				echo '<script>
					alert("添加失败");
					window.location.href="./add.php";
				</script>';
			}
		break;
		case 'edit':
			// 接收数据
			$id = $_POST['id'];
			$typename = htmlspecialchars(trim($_POST['typename']));
			$pid = $_POST['pid'];

			// id不能和pid相同，不然自己是自己的父类，自己是自己的子类
			if($id == $pid){
				echo '<script>
					alert("上级分类不能选择自身");
					window.location.href="./edit.php?id='.$id.'";
				</script>';
				exit;
			}

			// 检测分类名称是否存在(因为分类名称是唯一的)
			$sql = "select id from shop_types where typename={$typename}";
			$result = mysqli_query($link,$sql);
			if($result && mysqli_num_rows($result)>0){
				// 证明分类已存在
				echo '<script>
					alert("分类名称已存在，请更换分类名重新尝试");
					window.location.href="./edit.php?id='.$id.'";
				</script>';
				exit;
			}

			// 设置path
			if($pid == 0){	// 说明是一级分类
				$path = '0,';
			} else {
				$sql = "select path from shop_types where id={$pid}";
				$result = mysqli_query($link,$sql);
				if($result && mysqli_num_rows($result)>0){
					$row = mysqli_fetch_assoc($result);
					$path = $row['path'] . $pid . ',';
				}
			}
			// 拼接sql语句 
			$sql = "update shop_types set typename='{$typename}',pid={$pid},path='{$path}' where id={$id}";
			// 执行sql
			$result = mysqli_query($link,$sql);
			// 检测
			if($result && mysqli_affected_rows($link)>0){
				echo '<script>
					alert("修改成功");
					window.location.href="../type.php";
				</script>';
			} else {
				echo '<script>
					alert("修改失败");
					window.location.href="./edit.php?id='.$id.'";
				</script>';
			}
		break;
		case 'hidden':
			$id = $_GET['id'];
			
			// 如果存在子分类，不能直接禁用
			$haveSon = getAll($link,'shop_types','*',"pid={$id}");
			if($haveSon){
				echo '<script>
					alert("存在子分类，禁止禁用");
					window.location.href="../type.php";
				</script>';
				exit;
			}
			
			// 执行更新操作，将该分类及子分类全部禁用
			$sql = "update shop_types set status=0 where id={$id}";
			// 执行更新，不确定子分类是否已经被禁用
			$result = mysqli_query($link,$sql);
			if($result && mysqli_affected_rows($link)>0){
				echo '<script>
					alert("禁用成功");
					window.location.href="./recycle.php";
				</script>';
			} else {
				echo '<script>
					alert("禁用失败");
					window.location.href="../type.php";
				</script>';
			}
		break;
		case 'show':
			$id = $_GET['id'];
			// 如果父级分类被禁用，则不能直接启用
			$pid = getOne($link,'shop_types','pid',"id={$id}");
			if($pid !=0 ){
				$status = getOne($link,'shop_types','status',"id={$pid}");
				if($status == 0){
					echo '<script>
						alert("父级分类被禁用，请先启用父级分类");
						window.location.href="./recycle.php";
					</script>';
					exit;
				}
			}

			$sql = "update shop_types set status=1 where id={$id}";
			$result = mysqli_query($link,$sql);
			if($result && mysqli_affected_rows($link)>0){
				echo '<script>
					alert("启用成功");
					window.location.href="../type.php";
				</script>';
			} else {
				echo '<script>
					alert("启用失败");
					window.location.href="./recycle.php";
				</script>';
			}
		break;
	}
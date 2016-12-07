<?php
    // 引入初始化文件
	include('./public/common/init.php');

   	// 判断用户是否登录
   	if(!isset($_SESSION['user'])){
   		echo '<script>
			alert("请登录！");
			window.location.href="./login.php";
   		</script>';
   		exit;
   	}
   	include './public/common/config.php';
    // 接收订单信息
    $ordernum = isset($_GET['ordernum']) ? $_GET['ordernum'] : 0;

    $uid = $_SESSION['user']['id'];
    $orderinfo = getRow($link,'shop_order o,shop_order_status s','o.*',"o.ordernum=s.ordernum and o.ordernum={$ordernum} and s.status=2 and o.uid={$uid}");
    
    // 如果获取到空，则终止
    if(!$orderinfo){
   		echo '<script>
			alert("没有评论权限！");
			window.location.href="./index.php";
   		</script>';
   		exit;
    }
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>评论页面</title>
	<link rel="stylesheet" href="./public/css/common.css">
	<style type="text/css" media="screen">
		.comment-box{
			background: #FFF;
			border:1px solid #ddd;
			min-height: 400px;
		}
		.comment-box table{
			border-collapse: collapse;
			width:700px;
			margin-top:20px;
		}
		.comment-box table th,.comment-box table td{
			padding:5px 0px;
		}
		.comment-box table th{
			width:120px;
			text-align: right;
			padding-right: 15px;
			color:orange;
		}
		.comment-box textarea{
			width: 98%;
			padding:5px 3px;
			line-height: 1.3;
		}
	</style>
</head>
<body bgcolor="#F2F2F2">
	<!-- 顶部区域 -->
	<?php include('./public/common/header.php'); ?>
	<!-- logo -->
	<div class="wm">
		<div class="regLogo">
			<a href="#"><img src="./public/images/reg_logo.gif" alt=""></a>
		</div>
	</div>
	<?php
		// 获取商品信息
        $goodsinfo = getRow($link,'shop_goods','goodsname,goodspic',"id={$orderinfo['gid']}");
	?>
	<!-- 评论表单 -->
	<div class="comment-box wm">
		<table class="wm">
			<form action="./doaction.php?act=comment" method="post">
			<tbody>
				<tr>
					<th>商品名称：</th>
					<td><?php echo $goodsinfo['goodsname']; ?></td>
				</tr>
				<tr>
					<th>评论内容：</th>
					<td>
						<textarea name="content" rows="10" placeholder="请输入10-255个字"></textarea>
					</td>
				</tr>
                <input type="hidden" name="gid" value="<?php echo $orderinfo['gid']; ?>">
				<input type="hidden" name="ordernum" value="<?php echo $ordernum; ?>">
				<tr>
					<th></th>
					<td><input type="submit" value="提交评论" class="btn btn-danger"></td>
				</tr>
			</tbody>
			</form>
		</table>
	</div>
	<!-- 底部 -->
	<?php include('./public/common/footer.php'); ?>
</body>
</html>
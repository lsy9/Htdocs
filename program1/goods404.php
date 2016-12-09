<?php
	// 引入初始化文件
	require('./public/common/init.php');

	// 引入数据库配置文件
    require('./public/common/config.php');
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>商品未找到</title>
	<link rel="stylesheet" href="./public/css/common.css">
	<link rel="stylesheet" href="./public/css/cart.css">
	<link rel="stylesheet" href="./public/css/list.css">
	<style type="text/css" media="screen">
		.show h2{
			text-align: center;
			font-weight:600;
			color:rgb(195,20,31);
		}
		.show .g404{
			text-align: center;
			font-size: 160px;
			font-weight:600;
			color:rgb(195,20,31);
		}
		.show ul li{
			max-width: 180px;
			padding:5px;
			float: left;
		}
		.show ul li img{
			width: 180px;
			max-height: 180px;
			display: block;
		}
	</style>
</head>
<body>
	<!-- 顶部区域 -->
	<?php include('./public/common/header.php'); ?>
	<!-- 导航条 -->
	<div class="w100 bdr">
		<div class="wm navbar">
			<?php include('./public/common/navbar.php'); ?>
		</div>
	</div>
	<!-- 主体区域 -->
	<div class="w100" style="background:#EDEDED">
		<div id="main" class="wm">
			<!-- 全部商品分类 -->
			<?php include('./public/common/navlist.php'); ?>
		</div>
		<div class="wm show">
			<h2>
				哎呀~商品未找到...
			</h2>
			<h1 class="g404">
				4 0 4
			</h1>
			<hr>
			<h3>看看其它商品吧</h3>
			<ul>
			<?php
				// 随机查询一条记录
				$randGoods = getAll($link,'shop_goods','id,goodsname,goodspic,rand() rand','status=1','rand','5');
				if($randGoods){
					foreach($randGoods as $value){
			?>
				<li>
					<a href="./goodsdetails.php?id=<?php echo $value['id'] ?>">
						<img src="./public/uploads/<?php echo $value['goodspic']; ?>" alt="<?php echo $value['goodsname']; ?>">
					</a>
					<a href="./goodsdetails.php?id=<?php echo $value['id'] ?>"><?php echo $value['goodsname']; ?></a>
				</li>
			<?php
					}
				}
			?>
			</ul>
		</div>
	</div>
	<!-- 底部 -->
	<?php include('./public/common/footer.php'); ?>
	<?php include('./public/common/fixed.php'); ?>
</body>
</html>
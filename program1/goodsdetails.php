<?php
	// 引入初始化文件
	require('./public/common/init.php');

	// 引入数据库配置文件
    require('./public/common/config.php');
	
	// 获取id
	$id = $_GET['id'];
	
	// 获取商品信息
	$fields = 'id,tid,goodsname,goodspic,goodsprice,goodsnum,goodsdes';
	$where = "status=1 and id={$id}";
	$ginfo = getRow($link,'shop_goods',$fields,$where);
	
	// 如果查不到商品，则跳转到错误页面
	if(!$ginfo){
		header('location:./goods404.php');
		exit;
	}

	// 记录到cookie中，保存足迹
	setcookie("goods[$id]",$ginfo['goodsname'],time()+3600);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $ginfo['goodsname']; ?>|商品详情页面</title>
	<link rel="stylesheet" href="./public/css/common.css">
	<link rel="stylesheet" href="./public/css/cart.css">
	<style type="text/css" media="screen">
		.comment{
			width: 100%;
			margin-top: 10px;
			overflow: visible;
			border:1px solid #ddd;
		}
		.comment table{
			border-collapse: collapse;
		}
		.comment table th{
			background: #CCC;
		}
		.comment table td{
			padding:5px;
			border-bottom: 1px dashed #ccc;
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
			<!-- 当前位置 -->
			<div class="position">
				<?php
					$tree = getTree($link,$ginfo['tid']);
					$first = array_shift($tree);
					echo '<span class="text-lg"><b>'.$first.'</b></span>';
					if(!empty($tree)){
						foreach($tree as $value){
							echo '><a href="./goodslist.php?cid='.$value['id'].'">'.$value['typename'].'</a>';
						}
					}
					// var_dump($tree);
					echo '>'.$ginfo['goodsname'];
				?>
			</div>
		</div>
		<div class="wm show">
			<div class="showLeft fl">
				<img src="./public/uploads/<?php echo $ginfo['goodspic']; ?>" alt="">
				<div class="clear"></div>
				<ul>
					<li class="on"><img src="./public/uploads/s_<?php echo $ginfo['goodspic']; ?>" alt=""></li>
				</ul>
				<div class="clear"></div>
				<p>
					商品编号: <?php echo $ginfo['id']; ?>
					<a href="./doaction.php?act=shoucang&id=<?php echo $ginfo['id']; ?>"><i class="red">♥</i>收藏商品</a>
					<a href="#"><i class="red"></i>分享</a>
				</p>
			</div>
			<div class="showMain fl">
				<h2 class="title"><?php echo $ginfo['goodsname']; ?></h2>
				<p class="cx">
					<?php echo $ginfo['goodsdes']; ?>
					<a href="#" class="link">打白条打白条打白条</a>
				</p>
				<div class="info">
					<div class="price fl">
						<p>
							<span class="text">京 东 价:</span>
							<i class="red text-lg">￥<?php echo $ginfo['goodsprice']; ?></i>
						</p>
						<p>
							<span class="text">促销商品:</span>
							<span class="bgr">赠品</span><span class="red">满3000元可减10%</span><a href="#">详情</a>
						</p>
					</div>
				</div>
				<div class="support">
					<p>
						<span class="text">支　　持:</span>
						<a href="#" class="link">以旧换新，闲置笔记本回收</a>
					</p>
					<p>
						<span class="text">配 送 区 :</span>
						<select name="address" id="">
							<option value="1">北京朝阳区</option>
						</select>
						<b>有货：</b>支持79免运费 | 货到付款
					</p>
					<p>
						<span class="text">服　　务:</span>由京东发货，<span class="red">Thinkpad官方旗舰店</span>提供售后服务
					</p>
				</div>
				<div class="select">
					<form action="./doaction.php?act=shopcar" method="post">
					<div>
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="number" name="goodsnum" value="1" min="1">
						<input type="submit" value="加入购物车">
						<p>温馨提示：1.支持7天无理由退货</p>
					</div>
					</form>
				</div>
				<!-- 商品评价 -->
				<a id="comment"></a>
				<div class="comment">
					<table class="w100">
						<tr>
							<th>评价心得</th>
							<th>评论者</th>
							<th>评论时间</th>
							<th>购买数量</th>
						</tr>
						<?php
							// 获取评价信息
							$fields = 'content,posttime,uid';
							$table = 'shop_goods_comment';
							$where = "gid=gid and gid={$id} and status=1";
							$cinfo = getAll($link,$table,$fields,$where);
							if($cinfo){
								foreach($cinfo as $key=>$value){
						?>
						<tr>
							<td><?php echo $value['content']; ?></td>
							<td>
							<?php
								// 获取用户信息
								$buyer = getRow($link,'shop_user u,shop_order o','u.nickname,u.username,u.level,o.num',"u.id={$value['uid']} and o.gid={$id} and o.uid={$value['uid']}");
								if(empty($buyer['nickname'])){
									echo $buyer['username'];
								} else {
									echo $buyer['nickname'];
								}
								echo '<br>'.getLevel($buyer['level']);
							?>
							</td>
							<td><?php echo date('Y-m-d H:i:s',$value['posttime']); ?></td>
							<td><?php echo $buyer['num']; ?></td>
						</tr>
						<?php
								}
							} else {
						?>
						<tr>
							<td align="center" colspan="4"><span class="red">暂无评论</span></td>
						</tr>
						<?php } ?>
					</table>
				</div>
			</div>
			<div class="showRight fl">
				<h3><img src="./public/images/thinkpad.jpg" alt=""></h3>
				<p><a href="#" class="link">Thinkpad旗舰店</a><span class="bgr">京东自营</span></p>
			</div>
		</div>
	</div>
	<!-- 底部 -->
	<?php include('./public/common/footer.php'); ?>
	<?php include('./public/common/fixed.php'); ?>
</body>
</html>
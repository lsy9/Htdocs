<?php
	// 引入初始化文件
	include('./public/common/init.php');

    // 获取 网站配置
    include('./public/common/config.php');
    $webconf = getRow($link,'shop_webconf','webname,keywords,description,logo','','','1');
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $webconf['webname']; ?></title>
	<meta name="keywords" content="<?php echo $webconf['keywords']; ?>">
	<meta name="description" content="<?php echo $webconf['description']; ?>">
	<link rel="stylesheet" href="./public/css/common.css">
	<link rel="stylesheet" href="./public/css/index.css">
</head>
<body>
	<!-- 顶部区域 -->
	<?php include('./public/common/header.php'); ?>
	<!-- banner区域 -->
	<div id="banner" class="w100">
		<div class="wm"><a href="#"><img src="./public/images/banner.png" alt=""></a></div>
	</div>
	<!-- 导航区域样式 -->
	<div id="nav" class="w100">
		<div class="wm">
			<!-- LOGO，搜索，购物车 -->
			<div class="lsc">
				<div class="logo fl">
					<a href="./index.php">
						<?php if(empty($webconf['logo'])){ ?>
						<img src="./public/images/logo.png" alt="" height="80">
						<?php } else { ?>
						<img src="./public/images/<?php echo $webconf['logo']; ?>" alt="" height="80">
						<?php } ?>
					</a>
				</div>
				<div class="search fl">
					<form action="./goodslist.php" method="get">
						<input type="text" name="goodsname" placeholder="显示器">
						<input type="submit" value="搜索">
					</form>
					<ul>
						<?php
							if(!empty($_COOKIE['goods'])){
								$i = 0;
								foreach($_COOKIE['goods'] as $key=>$value){
									if($i>3){
										break;
									}
									echo '<li><a href="./goodsdetails.php?id='.$key.'">'.mb_substr($value,0,4,'utf-8').'</a></li>';
									$i++;
								}
							} else {
								// 随机查询一条记录
								$randGoods = getAll($link,'shop_goods','id,goodsname,rand() rand','status=1','rand','3');
								if($randGoods){
									foreach($randGoods as $value){
										echo '<li><a href="./goodsdetails.php?id='.$value['id'].'">'.mb_substr($value['goodsname'],0,4,'utf-8').'</a></li>';
									}
								}
							}
						?>
					</ul>
				</div>
				<div class="cart fl">
					<a href="./shopcar.php" class="btn btn-danger">查看购物车</a>
				</div>
			</div>
		</div>
		<!-- 导航条 -->
		<div class="wm navbar">
			<?php include('./public/common/navbar.php'); ?>
			<div class="ads fr">
				魅族MX5赢免单
			</div>
		</div>
	</div>
	<!-- 主体区域 -->
	<div id="main" class="wm">
		<!-- 全部商品分类 -->
		<?php include('./public/common/navlist.php'); ?>
		<!-- 焦点图 -->
		<div class="jdt mt10 fl">
			<ul>
				<li><img src="./public/images/jd_01.jpg" alt=""></li>
				<li><img src="./public/images/jd_01.jpg" alt=""></li>
				<li><img src="./public/images/jd_01.jpg" alt=""></li>
			</ul>
			<ol>
				<li>1</li>
				<li>2</li>
				<li>3</li>
			</ol>
		</div>
		<!-- 新闻，服务 -->
		<div class="fr ns mt10">
			<!-- 新闻 -->
			<div class="news">
				<h3 class="title">京东快报<a href="#" class="fr">更多>></a></h3>
				<ul>
					<li><a href="#">[特价]京东年货大放送</a></li>
					<li><a href="#">[特价]京东年货大放送</a></li>
					<li><a href="#">[特价]京东年货大放送</a></li>
					<li><a href="#">[特价]京东年货大放送</a></li>
					<li><a href="#">[特价]京东年货大放送</a></li>
				</ul>
			</div>
			<!-- 服务 -->
			<div class="serve">
				<h3 class="title">生活服务</h3>
				<ul>
					<li>
						<i></i>
						<span>手机</span>
					</li>
					<li>
						<i></i>
						<span>话费</span>
					</li>
					<li>
						<i></i>
						<span>电影票</span>
					</li>
					<li>
						<i></i>
						<span>手机</span>
					</li>
					<li>
						<i></i>
						<span>话费</span>
					</li>
					<li>
						<i></i>
						<span>电影票</span>
					</li>
					<li>
						<i></i>
						<span>手机</span>
					</li>
					<li>
						<i></i>
						<span>话费</span>
					</li>
					<li>
						<i></i>
						<span>电影票</span>
					</li>
					<li>
						<i></i>
						<span>手机</span>
					</li>
					<li>
						<i></i>
						<span>话费</span>
					</li>
					<li>
						<i></i>
						<span>电影票</span>
					</li>
				</ul>
			</div>
		</div>
		<div class="clear"></div>
		<!-- 推荐商品 -->
		<div class="tj mt10">
			<div class="t1 fl">
				<img src="./public/images/tj_01.jpg" alt="" width="200">
			</div>
			<ul class="t2 fr">
				<?php
					// 推荐商品暂时按照最新发布的商品进行展示
					$tuijian = getAll($link,'shop_goods','id,goodsname,goodspic,rand() rand','status=1','rand',4);
					if($tuijian){
						foreach ($tuijian as $row) {
				?>
				<li>
					<a href="./goodsdetails.php?id=<?php echo $row['id']; ?>"><img src="./public/uploads/<?php echo $row['goodspic'] ?>" alt="<?php echo $row['goodsname']; ?>"></a>
				</li>
				<?php
						}
					}
				?>
			</ul>
		</div>

		<!-- 商品列表 -->
		<div class="wm mt10">
			<?php
				// 遍历楼层
				$allFloor = getAll($link,'shop_types','id,pid,typename','pid=0');
				if($allFloor){
					foreach($allFloor as $floor){
						// 查询所有子级分类
						
			?>
			<div class="floor">
				<div class="title">
					<h3><?php echo $floor['typename']; ?></h3>
				</div>
				<ul>
					<?php
						$allCates = getAll($link,'shop_types','id,pid,typename');
						// var_dump($allCates);
						$sons = getCateTree($allCates,$floor['id']);
						$sub = array($floor['id']);
						// 判断该分类是否是最后一级分类
					    if(!empty($sons)){
					        // 如果存在子级分类，则获取到子级分类的id
					        foreach($sons as $v){
					            $sub[] = $v['id'];
					        }
					    }
					    
					    // 设置商品分类所在范围
					    $in = implode(',',$sub);
					    // 查询商品
					    $allGoods = getAll($link,'shop_goods','id,goodsname,goodspic,goodsprice',"tid in({$in}) and status=1",'',12);
					    if($allGoods){
					    	foreach($allGoods as $row){
					?>
					<li>
						<a href="./goodsdetails.php?id=<?php echo $row['id']; ?>"><img src="./public/uploads/<?php echo $row['goodspic']; ?>" alt="<?php echo $row['goodsname']; ?>"></a>
						<a class="goods_name">
							<?php echo $row['goodsname']; ?>
						</a>
						<span class="price">￥<?php echo $row['goodsprice'] ?></span>
					</li>
					<?php
					    	}
					    }
					?>
				</ul>
			</div>
			<?php
				}
			}
			?>
		</div>
	</div>
	<!-- 底部 -->
	<?php include('./public/common/footer.php'); ?>
	<?php include('./public/common/fixed.php'); ?>
</body>
</html>
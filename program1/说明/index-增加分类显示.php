<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>京东首页</title>
	<link rel="stylesheet" href="./public/css/common.css">
	<link rel="stylesheet" href="./public/css/index.css">
	<!--<script src="./js/jquery.js"></script>
	<script src="./js/My.js"></script> -->
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
					<a href="#"><img src="./public/images/logo.png" alt="" height="80"></a>
				</div>
				<div class="search fl">
					<form action="">
						<input type="text" placeholder="显示器">
						<input type="submit" value="搜索">
					</form>
					<ul>
						<li><a href="#">商品一</a></li>
						<li><a href="#">商品2</a></li>
						<li><a href="#">商品3</a></li>
					</ul>
				</div>
				<div class="cart fl"></div>
			</div>
		</div>
		<!-- 导航条 -->
		<div class="wm navbar">
			<ul class="fl">
				<li><a href="#">服装城</a></li>
				<li><a href="#">美妆馆</a></li>
				<li><a href="#">超市</a></li>
				<li><a href="#">全球购</a></li>
				<li><a href="#">闪购</a></li>
				<li><a href="#">团购</a></li>
				<li><a href="#">拍卖</a></li>
				<li><a href="#">金融</a></li>
			</ul>
			<div class="ads fr">
				魅族MX5赢免单
			</div>
		</div>
	</div>
	<!-- 主体区域 -->
	<div id="main" class="wm">
		<!-- 全部商品分类 -->
		<div class="navList fl">
			<ul>
				<li class="all">全部商品分类</li>
				<!-- 连接数据库，查询所有父级id为0的数据 -->
				<?php
					$sql = 'select id,typename,path from shop_types where pid=0 order by concat(path,id)';
					$result = mysqli_query($link,$sql);
					while($row = mysqli_fetch_assoc($result)){
				?>
				<!-- while循环 -->
				<li>
					<a href="#"><?php echo $row['typename']; ?></a>
					<div class="subList">
						<ul>
							<?php
								$sql = 'select id,typename,path from shop_types where pid='.$row['id'].' order by concat(path,id)';
								$result1 = mysqli_query($link,$sql);
								while($row1 = mysqli_fetch_assoc($result1)){
							?>
							<li>
								<?php echo $row1['typename']; ?>
								<?php
									$sql = 'select id,typename,path from shop_types where pid='.$row1['id'].' order by concat(path,id)';
									$result2 = mysqli_query($link,$sql);
									while($row2 = mysqli_fetch_assoc($result2)){
								?>
								<a href="#"><?php echo $row2['typename'] ?></a>
								<?php } ?>
							</li>
							<?php } ?>
						</ul>
					</div>
				</li>
				<!-- while循环结束 -->
				<?php } ?>
			</ul>
		</div>
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
				<li>
					<a href="#"><img src="./public/images/tj_02.jpg" alt=""></a>
				</li>
				<li>
					<a href="#"><img src="./public/images/tj_03.jpg" alt=""></a>
				</li>
				<li>
					<a href="#"><img src="./public/images/tj_04.jpg" alt=""></a>
				</li>
				<li>
					<a href="#"><img src="./public/images/tj_05.jpg" alt=""></a>
				</li>
			</ul>
		</div>

		<!-- 商品列表 -->
		<div class="wm mt10">
			<div class="floor">
				<div class="title">
					<h3>猜你喜欢</h3>
				</div>
				<ul>
					<li>
						<a href="#"><img src="./public/images/nv_01.jpg" alt="女装"></a>
						<a class="goods_name">
							商品名称商品名称商品名称商品名称商品名称商品名称
						</a>
						<span class="price">￥98.8</span>
					</li>
					<li>
						<a href="#"><img src="./public/images/dm_01.jpg" alt="萌图"></a>
						<a class="goods_name">
							商品名称商品名称商品名称商品名称商品名称商品
						</a>
						<span class="price">￥98.8</span>
					</li>
					<li>
						<a href="#"><img src="./public/images/nv_01.jpg" alt="女装"></a>
						<a class="goods_name">
							商品名称商品名称商品名称商品名称商品名称商品名称
						</a>
						<span class="price">￥98.8</span>
					</li>
					<li>
						<a href="#"><img src="./public/images/dm_01.jpg" alt="萌图"></a>
						<a class="goods_name">
							商品名称商品名称商品名称商品名称商品名称商品
						</a>
						<span class="price">￥98.8</span>
					</li>
					<li>
						<a href="#"><img src="./public/images/nv_01.jpg" alt="女装"></a>
						<a class="goodsName">
							商品名称商品名称商品名称商品名称商品名称商品名称
						</a>
						<span class="price">￥98.8</span>
					</li>
					<li>
						<a href="#"><img src="./public/images/dm_01.jpg" alt="萌图"></a>
						<a class="goods_name">
							商品名称商品名称商品名称商品名称商品名称商品
						</a>
						<span class="price">￥98.8</span>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- 底部 -->
	<?php include('./public/common/footer.php'); ?>
	<!-- 悬浮窗 -->
	<div class="fixed">
		<div class="right">
			<a href="#">车</a>
			<a href="#">爱心</a>
			<a href="#">历史</a>
			<a href="#">留言</a>
			<a href="#">回</a>
		</div>
		<div class="backTop">
			<a href="#">^</a>
			<a href="#">写</a>
		</div>
	</div>
</body>
</html>
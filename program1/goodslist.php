<?php
	// 引入初始化文件
	include('./public/common/init.php');
	// 接收cid
	$cid = isset($_GET['cid'])&&!empty($_GET['cid']) ? $_GET['cid'] : 0;
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>商品列表页</title>
	<link rel="stylesheet" href="./public/css/common.css">
	<link rel="stylesheet" href="./public/css/list.css">
	<link rel="stylesheet" href="./public/css/cart.css">
	<style>
		#main .navList{top:-50px;}
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
	<!-- 主体部分 -->
	<div class="w100 wm" id="main">
		<div id="" class="wm" style="">
			<!-- 全部商品分类 -->
			<?php include('./public/common/navlist.php'); ?>
		</div>
		<div class="clear"></div>
		<div class="wm mt10">
			<div class="mLeft fl">
				<h3>推广商品</h3>
				<ul>
					<?php
						// 查询所有商品
						$allGoods = getAll($link,'shop_goods','id,goodsname,goodspic,goodsprice,rand() rand','status=1','rand',4);
						if($allGoods){
							foreach($allGoods as $row){
					?>
					<li>
						<a href="./goodsdetails.php?id=<?php echo $row['id']; ?>">
							<img src="./public/uploads/<?php echo $row['goodspic']; ?>" alt="<?php echo $row['goodsname']; ?>">
						</a>
						<ol>
							<li><img src="./public/uploads/s_<?php echo $row['goodspic'] ?>" alt="<?php echo $row['goodsname']; ?>" height="25"></li>
						</ol>
						<p class="clear">
							<span class="price">￥<?php echo $row['goodsprice']; ?></span>
							<a href="./goodsdetails.php?id=<?php echo $row['id']; ?>" class="goodsName"><?php echo $row['goodsname']; ?></a>
						</p>
						<p>
							<?php
								// 查询评价数量
								$commentNum = getOne($link,'shop_goods_comment','count(*)',"gid={$row['id']}");
							?>
							已有<a href="./goodsdetails.php?id=<?php echo $row['id']; ?>#comment" class="link"><?php echo $commentNum; ?></a>人评价
						</p>
					</li>
					<?php
							}
						}
					?>
				</ul>
			</div>
			<div class="mRight fr">
				<div class="sift">
					<!-- 按钮筛选 -->
					<div class="siftBtn">
						<div class="btnGroup fl">
							<button class="on">销量</button>
							<button>价格</button>
							<button>评论数</button>
							<button>上架时间</button>
						</div>
						<div class="search fl">
							<form action="./goodslist.php" method="get">
								<input type="hidden" name="cid" value="<?php echo $cid; ?>">
								<input type="search" name="goodsname" results placeholder="搜索">
								<input type="submit" value="确定">
							</form>
						</div>
						<?php
							// 查询所有的分类
						    $allCates = getAll($link,'shop_types','id,pid');

						    // 获取指定分类的下级分类
						    $sons = getCateTree($allCates,$cid);
						    // 存储当前分类的id
						    $sub = array($cid);

						    // 判断该分类是否是最后一级分类
						    if(!empty($sons)){
						        // 如果存在子级分类，则获取到子级分类的id
						        foreach($sons as $v){
						            $sub[] = $v['id'];
						        }
						    }

						    // 设置商品分类所在范围
						    $in = implode(',',$sub);

							// 设置搜索分页
							if(!empty($_GET['goodsname'])){
								$search_where = " and goodsname like '%{$_GET['goodsname']}%' ";
								$search_url = "&goodsname={$_GET['goodsname']}";
							}

							// 计算总共有多少条记录
							$total = getOne($link,'shop_goods','count(id)',"tid in({$in}){$search_where}");
							
							$pageSize   = 20;		// 设置分页大小
							$pageMax    = ceil($total/$pageSize);	// 设置最大页数
							$page       = isset($_GET['page']) ? $_GET['page'] : 1;	// 设置当前页数

							// 防止地址栏输入过大数值
							if($page>$pageMax){
								$page = 1;
							}

							$pageOffset = ($page-1)*$pageSize;	// 设置偏移量

							// 设置上一页，下一页
							if($page==1){
								$pagePrev = 1;
							} else {
								$pagePrev = $page-1;
							}

							if($page==$pageMax){
								$pageNext = $pageMax;
							} else {
								$pageNext = $page+1;
							}

						?>
						<div class="page fr">
							<span><i class="cur"><?php echo $page; ?></i>/<?php echo $pageMax; ?></span>
							<?php
								echo '<a href="./goodslist.php?cid=' . $cid . '&page=' . $pagePrev . $search_url . '">';
								echo '<button class="btn prev ' . ($page==1?'final" disabled':'"')  . '>＜</button>';
								echo '</a>';

								// 下一页连接
								echo '<a href="./goodslist.php?cid=' . $cid . '&page=' . $pageNext . $search_url . '">';
								echo '<button class="btn next ' . ($page==$pageMax?'final" disabled':'"')  . '>＞</button>';
								echo '</a>';
							?>
						</div>
					</div>
					<!-- 其它筛选 -->
					<div class="siftCheck">
						<form action="">
							收货地
							<select name="" id="">
								<option value="">北京昌平区回龙观</option>
							</select>
							<input type="checkbox">仅显示有货
							<input type="checkbox">京东配送
							<input type="checkbox">货到付款
						</form>
					</div>
				</div>
				<!-- 商品列表 -->
				<div class="goodsList">
					<ul>
						<?php
						    // 查询商品
						    $allGoods = getAll($link,'shop_goods','id,goodsname,goodspic,goodsprice',"tid in({$in}){$search_where}",'',"{$pageOffset},{$pageSize}");
							if($allGoods){
								foreach($allGoods as $row){
						?>
						<li>
							<a href="./goodsdetails.php?id=<?php echo $row['id']; ?>">
								<img src="./public/uploads/<?php echo $row['goodspic']; ?>" alt="<?php echo $row['goodsname']; ?>">
							</a>
							<ol>
								<li><img src="./public/uploads/s_<?php echo $row['goodspic'] ?>" alt="<?php echo $row['goodsname']; ?>" height="25"></li>
							</ol>
							<p class="clear">
								<span class="price">￥<?php echo $row['goodsprice']; ?></span>
								<a href="./goodsdetails.php?id=<?php echo $row['id']; ?>" class="goodsName"><?php echo $row['goodsname']; ?></a>
							</p>
							<p>
								已有<a href="./goodsdetails.php?id=<?php echo $row['id']; ?>#comment" class="link"><?php echo getOne($link,'shop_goods_comment','count(id)',"gid={$row['id']}"); ?></a>人评价
								<br>
								<span><?php echo getOne($link,'shop_types','typename',"id={$row['tid']}");$row['tid']; ?></span>
								<span class="company">自营</span>
							</p>
						</li>
						<?php
								}
							}
						?>
					</ul>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<!-- 底部 -->
	<?php include('./public/common/footer.php'); ?>
	<?php include('./public/common/fixed.php'); ?>
</body>
</html>
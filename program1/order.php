<?php
	// 引入初始化文件
	include('./public/common/init.php');
	
	// 防止未登录直接进入
	if(empty($_SESSION['user'])){
		header('location:./login.php');
		exit;
	}
	// 获取操作
	$act = isset($_GET['act']) ? $_GET['act'] : 'wei';
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>我的订单|个人中心</title>
	<link rel="stylesheet" href="./public/css/common.css">
	<link rel="stylesheet" href="./public/css/userinfo.css">
	<style>
		th,td{
			line-height: 2.0;
		}
	</style>
</head>
<body>
	<!-- 顶部区域 -->
	<?php include('./public/common/header.php'); ?>
	<!-- 用户中心导航 -->
	<?php include('./public/common/usernav.php'); ?>
	<!-- 主体信息 -->
	<div id="main" class="w100">
		<div class="wm mt10">
			<!-- 左侧设置 -->
			<?php include('./public/common/userset.php'); ?>
			<!-- 右侧详细信息设置 -->
			<div class="setInfo fr">
				<!-- 设置选项 -->
				<div class="setOpt fl">
					<ul>
						<?php
							// 获取操作
							switch ($act) {
								case 'wei':
								default:
									$pos = '未发货订单';
								break;
								case 'shou':
									$pos = '待确认收货';
								break;
								case 'ok':
									$pos = '待评价订单';
								break;
								case 'ypj':
									$pos = '已评价订单';
								break;
								case 'quxiao':
									$pos = '取消订单记录';
								break;
							}
						?>
						<li class="on"><?php echo $pos; ?></li>
					</ul>
				</div>
				<div class="clear"></div>
				<div class="setMsg fl">
					<table style="width:730px;text-align:left;">
						<tr>
							<th>订单编号</th>
							<th>商品名称</th>
							<th>商品数量</th>
							<th>操作</th>
						</tr>
						<?php
							// 获取操作
							switch ($act) {
								case 'wei':
								default:
									$status = ' s.status=0';
								break;
								case 'shou':
									$status = ' s.status=1';
								break;
								case 'ok':
									$status = ' s.status=2';
								break;
								case 'ypj':
									$status = ' s.status=7';
								break;
								case 'quxiao':
									$status = ' s.status=6';
								break;
							}
							
							// 设置分页
							/*$sql = "select count(o.id) num from shop_order o,shop_order_status s where{$status} and o.ordernum=s.ordernum and o.uid={$uid}";
							$result = mysqli_query($link,$sql);
							if($result && mysqli_num_rows($result)>0){
								$row = mysqli_fetch_assoc($result);
								$total = $row['num'];	// 总条数
							}*/
							$total = getOne($link,'shop_order o,shop_order_status s','count(*)',"{$status} and o.ordernum=s.ordernum and o.uid={$uid}");

							$page = isset($_GET['page']) ? $_GET['page'] : 1;
							$pageSize = 10;	// 每页显示条数
							$pageOffset = ($page-1)*$pageSize;
							// 总页数
							$pageMax = ceil($total/$pageSize);

							// 设置条件及连接
							if($page == 1){
								$pagePrev = 1;
							} else {
								$pagePrev = $page-1;
							}

							if($page == $pageMax){
								$pageNext = $pageMax;
							} else {
								$pageNext = $page+1;
							}

							// 查询订单
							/*$sql = "select o.ordernum,o.num,o.gid,g.goodspic,g.goodsname,s.id sid from shop_order o,shop_goods g,shop_order_status s where{$status} and o.gid=g.id and o.uid={$uid} and o.ordernum=s.ordernum limit {$pageOffset},{$pageSize}";
							$result = mysqli_query($link,$sql);
							if($result && mysqli_num_rows($result)>0){
								while($row = mysqli_fetch_assoc($result)){*/
							$fields = 'o.ordernum,o.num,o.gid,g.goodsname,g.goodspic';
							$table = 'shop_order o,shop_goods g,shop_order_status s';
							$where = "{$status} and o.gid=g.id and o.uid={$uid} and o.ordernum=s.ordernum";
							$limit = "{$pageOffset},{$pageSize}";
							$allOrder = getAll($link,$table,$fields,$where,'o.id desc',$limit);
							if($allOrder){
								foreach ($allOrder as $row) {
						?>
						<tr>
							<td><?php echo $row['ordernum']; ?></td>
							<td>
								<img src="./public/uploads/s_<?php echo $row['goodspic']; ?>" alt="<?php echo $row['goodsname']; ?>" style="vertical-align:middle">
								<a href="./goodsdetails.php?id=<?php echo $row['gid']; ?>"><?php echo $row['goodsname']; ?></a>
							</td>
							<td><?php echo $row['num']; ?></td>
							<td>
							<?php	
								// 获取操作
								switch ($act) {
									case 'wei':
									default:
										$url = '<a href="javascript:void(0);" onclick="alert(\'提醒发货成功\');this.onclick=\'\'" class="link">提醒发货</a>';
									break;
									case 'shou':
										$url = '<a href="./doaction.php?act=shouhuo&sid='.$row['sid'].'" class="link">确认收货</a>';
									break;
									case 'ok':
										$url = '<a href="./comment.php?ordernum='.$row['ordernum'].'" class="link">评价</a> ';
										$url .= '<a href="./doaction.php?act=tuihuo&sid='.$row['sid'].'" class="link">退货</a> ';
										$url .= '<a href="./doaction.php?act=huanhuo&sid='.$row['sid'].'" class="link">换货</a>';
									break;
									case 'ypj':
										$url = '<a href="./goodsdetails.php?id='.$row['gid'].'#comment" class="link">查看评价</a>';
									break;
									case 'quxiao':
										$url = '<a href="./goodsdetails.php?id='.$row['gid'].'" class="link">查看商品</a>';
									break;
								}
								echo $url;
							?>
							</td>
						</tr>
						<?php
								}
						?>
						<tr>
							<td colspan="4" align="center">
								<a href="./order.php?page=1&act=<?php echo $act; ?>">首页</a>
								<a href="./order.php?page=<?php echo $pagePrev; ?>&act=<?php echo $act; ?>">上一页</a>
								<span class="red" style="margin:0;"><?php echo $page; ?></span>
								<a href="./order.php?page=<?php echo $pageNext; ?>&act=<?php echo $act; ?>">下一页</a>
								<a href="./order.php?page=<?php echo $pageMax; ?>&act=<?php echo $act; ?>">尾页</a>
								<?php echo $page , '/' , $pageMax , ' 共 ' , $total , '条'; ?>
							</td>
						</tr>
						<?php
							} else {
						?>
						<tr>
							<td colspan="4" align="center"><span class="red">空空的</span></td>
						</tr>
						<?php
							}
						?>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- 底部 -->
	<?php include('./public/common/footer.php'); ?>
</body>
</html>
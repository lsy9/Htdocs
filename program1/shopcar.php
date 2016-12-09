<?php
	// 引入初始化文件
    include('./public/common/init.php');
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>购物车页面</title>
	<link rel="stylesheet" href="./public/css/common.css">
	<link rel="stylesheet" href="./public/css/shopcar.css">
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
	<!-- 购物车列表 -->
	<div class="w100">
		<div class="wm">
			<?php if(empty($_SESSION['user'])){ ?>
			<div class="nologin-tip">
				您还没有登录！登录后购物车的商品将保存到您账号中
				<a href="./login.php" class="btn btn-danger">立即登陆</a>
			</div>
			<?php } ?>
		</div>
		<div class="wm">
			<h2 class="red" style="font-family:'宋体'">全部商品</h2>
			<form action="./doaction.php?act=order" method="post">
			<table class="wm shopcar-table">
				<tr>
					<th>全选</th>
					<th>商品</th>
					<th>单价(元)</th>
					<th>数量</th>
					<th>小计(元)</th>
					<th>操作</th>
				</tr>
				<?php
					$shopcar = isset($_SESSION['shopcar']) ? $_SESSION['shopcar'] : array();
					if(!empty($_SESSION['shopcar'])){
						$total = 0;
						foreach($shopcar as $key=>$value){
							// 记录总价
							$total += $value['num']*$value['goodsprice'];
				?>
				<tr class="bg-pink">
					<td><input type="checkbox" name="id[]" value="<?php echo $value['id']; ?>" checked></td>
					<td class="goodsinfo">
						<img src="./public/uploads/s_<?php echo $value['goodspic']; ?>" alt="<?php echo $value['goodsname']; ?>">
						<a href="./goodsdetails.php?id=<?php echo $value['id']; ?>"><?php echo $value['goodsname']; ?></a>
					</td>
					<td><?php echo $value['goodsprice']; ?></td>
					<td class="num">
						<a href="./doaction.php?act=jiancar&id=<?php echo $value['id']; ?>"><button type="button">-</button></a>
						<span style="font-size:14px;padding:0 10px;"><?php echo $value['num']; ?></span>
						<a href="./doaction.php?act=jiacar&id=<?php echo $value['id']; ?>"><button type="button">+</button></a>
					</td>
					<td>
						<?php echo number_format($value['goodsprice']*$value['num'],2); ?>
					</td>
					<td><a href="./doaction.php?act=delcar&id=<?php echo $value['id']; ?>">移出购物车</a></td>
				</tr>
				<?php } ?>
				<tr>
					<td colspan="4"><a href="./goodslist.php" class="link">继续浏览</a></td>
					<?php
						if(!empty($_SESSION['user'])){
							// 判断用户是否有钱购买
							$sql = "select gold from shop_user_details where uid={$uid}";
							$result = mysqli_query($link,$sql);
							if($result && mysqli_num_rows($result)>0){
								$row = mysqli_fetch_assoc($result);
							}
					?>
					<td>
						共计：<?php echo $total; ?> 
						余额：<?php echo $row['gold']; ?>
					</td>
					<td>
						<?php
							if($row['gold']>=$total){
						?>
						<input type="submit" value="去结算" class="btn-checkout fr">
						<?php
							} else {
						?>
						<a href="./chongzhi.php" class="fr" style="color:red;line-height:30px;margin-left:10px;font-size:18px;">请充值</a><input type="submit" value="去结算" class="btn-disabled fr" disabled>
					<?php
							}
						} else {
					?>
						<a href="./login.php"><button type="button" class="btn-checkout fr">请先登录</button></a>
						<?php } ?>
					</td>
				</tr>
				<?php } else { ?>
				<tr>
					<td colspan="6">购物车空空如也。快去看看商品吧<a href="./goodslist.php" class="link">浏览商品</a></td>
				</tr>
				<?php } ?>
			</table>
			</form>
		</div>
	</div>
	<!-- 底部 -->
	<?php include('./public/common/footer.php'); ?>
</body>
</html>
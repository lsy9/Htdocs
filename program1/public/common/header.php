<?php
	// 引入数据库配置
	include_once('./public/common/config.php');
?>
<div id="top" class="w100">
	<div class="wm">
		<!-- 左侧地域选择 -->
		<div class="add fl">
			<ul>
				<li><a href="./index.php">返回首页</a>|</li>
				<li>进入,</li>
				<li><a href="#">北京</a></li>
			</ul>
		</div>
		<!-- 右侧信息 -->
		<div class="info fr">
			<ul>
				<li>
				<?php
					// 检测用户状态
					if(empty($_SESSION['user'])){
				?>
					<a href="./login.php">登录</a>
					<a href="./reg.php">注册</a>
				<?php
					} else {
						// 优先显示用户昵称
						$uid = $_SESSION['user']['id'];
						$loginUser = getRow($link,'shop_user','nickname,username',"id={$uid}");
						if($loginUser){
							if(empty($loginUser['nickname'])){
								echo '<a href="./ucenter.php">'.$loginUser['username'].'</a> ';
							} else {
								echo '<a href="./ucenter.php">'.$loginUser['nickname'].'</a> ';
							}
						}
				?>
					<a href="./doaction.php?act=layout">退出</a>
				<?php } ?>
				</li>
				<li><a href="./order.php">我的订单</a></li>
				<li><a href="./ucenter.php">我的京东</a></li>
				<li><a href="#">京东会员</a></li>
				<li><a href="#">企业采购</a></li>
				<li><a href="#">手机京东</a></li>
				<li><a href="#">关注京东</a></li>
				<li><a href="#">客户服务</a></li>
				<li><a href="#">网站导航</a></li>
			</ul>
		</div>
	</div>
</div>
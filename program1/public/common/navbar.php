<ul class="fl">
	<li><a href="./index.php">首页</a></li>
	<?php
		// 获取一级分类
		$nav = getAll($link,'shop_types','id,typename','pid=0 and status=1');
		if($nav){
			$i=0;
			foreach ($nav as $row) {
	?>
	<li><a href="./goodslist.php?cid=<?php echo $row['id']; ?>"><?php echo $row['typename']; ?></a></li>
	<?php
			if($i==8){
				break;
			}
			$i++;
		}
	}
	?>
</ul>
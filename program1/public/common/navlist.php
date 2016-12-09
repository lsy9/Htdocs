<div class="navList fl">
	<ul>
		<li class="all">全部商品分类</li>
		<!-- 连接数据库，查询所有父级id为0的数据 -->
		<?php
			$fields = 'id,typename';
			$order = 'concat(path,id)';
			$cate1 = getAll($link,'shop_types',$fields,'pid=0 and status=1',$order);
			if($cate1){
				foreach($cate1 as $row1){
		?>
		<li>
			<a href="./goodslist.php?cid=<?php echo $row1['id']; ?>"><?php echo $row1['typename']; ?></a>
			<div class="subList">
				<ul>
					<?php
						$cate2 = getAll($link,'shop_types',$fields,"pid={$row1['id']} and status=1",$order);
						if($cate2){
							foreach($cate2 as $row2){
					?>
					<li>
						<a href="./goodslist.php?cid=<?php echo $row2['id']; ?>"><?php echo $row2['typename']; ?></a>
						<?php
							$cate3 = getAll($link,'shop_types',$fields,"pid={$row2['id']} and status=1",$order);
							if($cate3){
								foreach($cate3 as $row3){
						?>
						<a href="./goodslist.php?cid=<?php echo $row3['id']; ?>"><?php echo $row3['typename']; ?></a>
						<?php 
								}
							}
						?>
					</li>
					<?php
						}
					}
					?>
				</ul>
			</div>
		</li>
		<?php 
			}
		}
		?>
	</ul>
</div>
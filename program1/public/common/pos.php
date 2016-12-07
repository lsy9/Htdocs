<?php
header("Content-type:text/html;charset=utf-8");
/**
 * getTid 获取指定商品id的tid
 * @param  int $id  商品id
 * @param  object $link mysqli对象
 * @return tid       商品tid
 */
function getTid($id,$link){
	$sql = "select tid from shop_goods where id=$id";
	$result = mysqli_query($link,$sql);
	$row = mysqli_fetch_assoc($result);
	return $row['tid'];
}
/**
 * getTypeName 获取分类名称
 * @param  int $id  要获取的id
 * @param  object $link mysqli对象
 * @return mixed       分类名称
 */
function getTypeName($id,$link){
	if($id==0){
		return false;
	}
	$sql = "select id,typename from shop_types where id={$id}";
	$result = mysqli_query($link,$sql);
	$row = mysqli_fetch_assoc($result);
	return $row;
}
/**
 * getTree 获取指定id的家谱树
 * @param  int $id   要获取的分类id
 * @param  object $link mysqli连接对象
 * @return mixed  分类名称或者分类信息       
 */
function getTree($id,$link){
	// 查询上级分类
	$sql = "select path,typename from shop_types where id={$id}";
	$result = mysqli_query($link,$sql);
	$row = mysqli_fetch_assoc($result);
	$arr = explode(',', $row['path']);
	array_pop($arr);
	if(count($arr) == 1){
		return $row['typename'];
	}
	$tree = array();
	foreach ($arr as $id) {
		if($id==0){
			continue;
		}
		$tree[] = getTypeName($id,$link);
	}
	return $tree;
}
/**
 * [getPos 生成面包屑导航]
 * @param  [mixed] $arr [传递的分类名称]
 */
function getPos($arr){
	if(is_string($arr)){
		echo '<span class="text-lg"><b>'.$arr.'</b></span>';
	}else{
		$arr1 = array_shift($arr);
		echo '<span class="text-lg"><b>'.$arr1['typename'].'</b></span>';
		// echo '<a href="./goodslist.php?id='.$arr1['id'].'">'.$arr1['typename'].'</a>';
		foreach($arr as $v){
			echo '><a href="./goodslist.php?id='.$v['id'].'">'.$v['typename'].'</a>';
		}
	}
}

// function hu($tid,$link){
// 	$tree=array();
// 	$sql="select typename,pid,path from shop_types where id={$tid}";
// 	$result = mysqli_query($link,$sql);
// 	$row = mysqli_fetch_assoc($result);
	
// 	if($row['pid']!=0){
// 		$tree[] = $row;
// 		$tree=array_merge(hu($row['pid'],$link),$tree);
// 	} else {
// 		$tree[] = $row['typename'];
// 	}
// 	return $tree;
// }
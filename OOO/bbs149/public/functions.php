<?php 
	//文件上传函数
	
	/**
	 *	文件上传函数
	 *	@param string $path 	定义文件上传到的路径
	 *	@param array  $upfile	上传文件的详细信息
	 *	@param array  $typeList	允许上传的文件类型
								($typeList = array("image/jpeg","image/png","image/gif");)
	 *	@param int	  $maxSize	允许上传的最大文件大小(默认为0，表示不限制大小)
	 *	return array  $res		返回文件上传成功或失败的信息(数组中info存放上传文件成功或失败的信息
								error为false，表示上传失败！error为true表示上传成功)
	 *							$res = array(
												"info"=>"",
												"error"=>false
											);
	 */
	
	function upload($path,$upfile,$typeList=array(),$maxSize=0){
		//定义存放返回信息的数组
		$res = array(
				"info"=>"",
				"error"=>false
				);
		
		// 格式化文件上传路径信息
		$path = rtrim($path,"/")."/";
		
		//1.判断上传文件的错误号
		if($upfile['error']>0){
			switch($upfile['error']){
				case 1:$info = "表示上传文件的大小超出了约定值！";break;
				case 2:$info = "表示上传文件大小超出了HTML表单隐藏域属性的MAX＿FILE＿SIZE元素所指定的最大值。";break;
				case 3:$info = "表示文件只被部分上传！";break;
				case 4:$info = "表示没有上传任何文件。";break;
				case 6:$info = "表示找不到临时文件夹。";break;
				case 7:$info = "表示文件写入失败。";break;
				default:$info = "未知的文件上传你错误！";break;
			}
			$res['info'] = "上传失败！原因：".$info;
			return $res;
		}
		
		//2.判断文件的上传类型是否合法
		if(@$typeList && count(@$typeList)>0){
			
			//判断用户上传的文件类型是否包含在服务器允许的类型之中
			if(!in_array($upfile['type'],$typeList)){
				$res['info'] = "上传失败！原因：不被允许的上传文件类型！";
				return $res;
			}
		}else{
			$res['info'] = "上传失败！原因：服务器没有设定允许上传的文件类型！";
			return $res;
		}
		
		//3.判断上传文件的大小是否合法
		if($maxSize>0 && $upfile['size']>$maxSize){
			$res['info'] = "上传失败！原因：上传文件大小越界！";
			return $res;
		}
		
		//4.随机一个文件名称
		$pathinfo = pathinfo($upfile['name']);	//获取上传那文件的文件名的详细信息
		$ext = $pathinfo['extension'];	//获取文件后缀名
		do{
			$newname = date("YmdHis",time()).rand(1000,9999).".".$ext;	//拼装随机文件名
		}while(file_exists($path.$newname));
		
		//5.执行上传文件的移动
		if(is_uploaded_file($upfile['tmp_name'])){
			
			//判断上传文件移动是否成功
			if(move_uploaded_file($upfile['tmp_name'],$path.$newname)){
				$res['info'] = $newname;
				$res['error'] = true;
				return $res;
			}else{
				$res['info'] = "上传失败！原因：移动上传文件失败！";
				return $res;
			}
			
		}else{
			$res['info'] = "上传失败！原因：不是有效的上传文件！";
			return $res;
		}
	}
	
	
	/**
	 *	图像的等比例缩放函数
	 *	@param string $path 	图片进行缩放之后的存储路径(原图也在这个目录下)
	 *	@param string $picname	图片的名称(你要进行缩放的图片的名称)
	 *	@param int	  $maxw		图片缩放之后的最大宽度
	 *	@param int	  $maxh		图片缩放之后的最大高度
	 *	@param string $pre		图片缩放之后存储的新图片的前缀名
	 *	return bool	  TRUE		图片缩放成功之后返回布尔型真 True
	 */
	function imageResize($path,$picname,$maxw=100,$maxh=100,$pre="s_"){
	//1.准备画布
		//判断是否传入了合法的路径和图片名称
		if(empty($path) || empty($picname)){
			return false;
		}
		
		//格式化一下路径信息
		$path = rtrim($path,"/")."/";
	
		//获取图片的详细信息
		$info = getimagesize($path.$picname);
		
		//判断图片的类型，并生成相应的图片画布
		switch($info[2]){
			case 1:	//gif
				$oldImg = imagecreatefromgif($path.$picname);
			break;
			case 2:	//jpeg
				$oldImg = imagecreatefromjpeg($path.$picname);
			break;
			case 3:	//png
				$oldImg = imagecreatefrompng($path.$picname);
			break;
		}
		
		//获取原图的宽高
		$oldw = imagesx($oldImg);
		$oldh = imagesy($oldImg);
		
		//判断原图的宽高，并进行比例的计算
		if($oldw>$oldh){
			//求得比例
			$bl = $oldw/$maxw;
			//计算缩放之后的宽高
			$neww = $oldw/$bl;
			$newh = $oldh/$bl;
		}else{
			//求得比例
			$bl = $oldh/$maxh;
			//计算缩放之后的宽高
			$neww = $oldw/$bl;
			$newh = $oldh/$bl;
		}
		
		//根据缩放之后的新的宽高，来生成一张新的画布
		$newImg = imagecreatetruecolor($neww,$newh);
	
	//2.开始绘画
		imagecopyresampled($newImg,$oldImg,0,0,0,0,$neww,$newh,$oldw,$oldh);
	
	//3.输出图像
		//判断原图的类型，并执行相应类型的输出
		switch($info[2]){
			case 1:	//gif
				imagegif($newImg,$path.$pre.$picname);
			break;
			case 2:	//jpeg
				imagejpeg($newImg,$path.$pre.$picname);
			break;
			case 3:	//png
				imagepng($newImg,$path.$pre.$picname);
			break;
		}
	
	//4.释放资源
		imagedestroy($oldImg);
		imagedestroy($newImg);
		
		return true;
	}
?>
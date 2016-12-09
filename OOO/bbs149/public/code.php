<?php 
	//绘制验证码的程序
	
	//开启session
	session_start();
	
	//0. 设置响应头
		header("Content-Type:image/png");
		
		//测试函数
		$type = 1;
		$length = 4;
		$code = getCode($type,$length);
		
		//存入session
		$_SESSION['code'] = $code;
	
	//1. 准备画布、画笔、颜料
		//准备画布
		$im = imagecreatetruecolor(20*$length,30);	
		//准备背景色
		$bg = imagecolorallocate($im,230,230,230);
		//准备画笔色
		$hb = imagecolorallocate($im,255,0,0);
		
	//2. 开始绘画
		imagefill($im,0,0,$bg);
		
		//填充文字
		for($i=0;$i<$length;$i++){
			$tc = imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));
			imagettftext($im,20,rand(-30,30),15*$i+10,25,$tc,"./msyh.ttf",$code[$i]);
		}
		
		//绘制像素点
		for($j=1;$j<=100;$j++){
			$pc = imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));
			imagesetpixel($im,rand(0,20*$length),rand(0,30),$pc);
		}
		
		//绘制线条
		for($z=1;$z<=4;$z++){
			$lc = imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));
			imageline($im,rand(0,20*$length),rand(0,30),rand(0,20*$length),rand(0,30),$lc);
		}
		
	//3. 输出图像
		imagepng($im);
		
	//4. 释放资源
		imagedestroy($im); 
		
		
		
	// $str = "abcd";
	// $m = strlen($str)-1;
	// echo $str[rand(0,$m)];
	// echo $m;
	
	/**
	 * 自定义一个随意生成指定长度的验证码函数
	 * @param int $type 	验证码的类型(1:纯数字(默认)；2:数字+小写；3:数字+大小写)
	 * @param int $length 	验证码的长度(1-61位之间，默认为4个长度)
	 * return string $code  函数执行完毕之后返回的验证码
	 */
	function getCode($type=1,$length=4){
		//定义字符源
		$str = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		
		//根据你想要输出的类型，进行了判断
		if($type==1){
			$m = 9;
		}elseif($type==2){
			$m = 35;
		}elseif($type==3){
			$m = strlen($str)-1;
		}
		
		//随机生成4为长度的验证码
		$code = "";
		for($i=1;$i<=$length;$i++){
			$code .= $str[rand(0,$m)];
		}
		
		return $code;
	}
	
	
	
	
	
	
	
	
	
	
	
?>
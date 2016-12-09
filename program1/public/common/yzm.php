<?php
	// 开启session
	session_start();
	
	/*
		定义获取验证码的函数 getCode()
		@param int $len 	验证码的长度
		@param int $type	验证码的类型，1是数字，2是小写字母和数字，3是数字和大小写字母
		return string code	返回生成的验证码
	*/
	function getCode($len=4,$type=3){
		// 准备所有字符串
		$str = '123456789abcdefghijkmnopqrstuvwxyABCDEFGHJKLMNPQRSTUVWXYZ';
		
		// 匹配验证码类型
		switch($type){
			// 全部是数字
			case 1:
				$max = 8;	// 定义字符串的最大值下标
			break;
			// 小写字母和数字
			case 2:
				$max = 32;
			break;
			// 大小写字母 和数字
			case 3:
				$max = 56;
			break;
		}
		
		// 循环产生验证码
		$code = '';
		for($i=0;$i<$len;$i++){
			$code .= $str{mt_rand(0,$max)};
		}
		
		return $code;
	}
	
	$len = 1;
	$type = 3;
	$code = getCode($len,$type);
	// 存储session
	$_SESSION['code'] = $code;
	
	// 将验证码输入到画布中
	$width = $len * 25;
	$height = 30;
	
	// 创建画布
	$im = imagecreatetruecolor($width,$height);
	
	// 分配颜色
	$bgcolor = imagecolorallocate($im,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
	
	imagefill($im,0,0,$bgcolor);
	
	// 将验证码依次输出到画布中
	for($i=0;$i<$len;$i++){
		$color = imagecolorallocate($im,mt_rand(0,150),mt_rand(0,150),mt_rand(0,150));
		
		// 输出字符
		imagettftext($im,18,mt_rand(-15,15),$i*20+5,24,$color,'./msyh.ttf',$code{$i});
	}
	
	header('Content-type:image/png');
	imagepng($im);
	
	imagedestroy($im);
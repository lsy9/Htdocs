<?php 
	//������֤��ĳ���
	
	//����session
	session_start();
	
	//0. ������Ӧͷ
		header("Content-Type:image/png");
		
		//���Ժ���
		$type = 1;
		$length = 4;
		$code = getCode($type,$length);
		
		//����session
		$_SESSION['code'] = $code;
	
	//1. ׼�����������ʡ�����
		//׼������
		$im = imagecreatetruecolor(20*$length,30);	
		//׼������ɫ
		$bg = imagecolorallocate($im,230,230,230);
		//׼������ɫ
		$hb = imagecolorallocate($im,255,0,0);
		
	//2. ��ʼ�滭
		imagefill($im,0,0,$bg);
		
		//�������
		for($i=0;$i<$length;$i++){
			$tc = imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));
			imagettftext($im,20,rand(-30,30),15*$i+10,25,$tc,"./msyh.ttf",$code[$i]);
		}
		
		//�������ص�
		for($j=1;$j<=100;$j++){
			$pc = imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));
			imagesetpixel($im,rand(0,20*$length),rand(0,30),$pc);
		}
		
		//��������
		for($z=1;$z<=4;$z++){
			$lc = imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));
			imageline($im,rand(0,20*$length),rand(0,30),rand(0,20*$length),rand(0,30),$lc);
		}
		
	//3. ���ͼ��
		imagepng($im);
		
	//4. �ͷ���Դ
		imagedestroy($im); 
		
		
		
	// $str = "abcd";
	// $m = strlen($str)-1;
	// echo $str[rand(0,$m)];
	// echo $m;
	
	/**
	 * �Զ���һ����������ָ�����ȵ���֤�뺯��
	 * @param int $type 	��֤�������(1:������(Ĭ��)��2:����+Сд��3:����+��Сд)
	 * @param int $length 	��֤��ĳ���(1-61λ֮�䣬Ĭ��Ϊ4������)
	 * return string $code  ����ִ�����֮�󷵻ص���֤��
	 */
	function getCode($type=1,$length=4){
		//�����ַ�Դ
		$str = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		
		//��������Ҫ��������ͣ��������ж�
		if($type==1){
			$m = 9;
		}elseif($type==2){
			$m = 35;
		}elseif($type==3){
			$m = strlen($str)-1;
		}
		
		//�������4Ϊ���ȵ���֤��
		$code = "";
		for($i=1;$i<=$length;$i++){
			$code .= $str[rand(0,$m)];
		}
		
		return $code;
	}
	
	
	
	
	
	
	
	
	
	
	
?>
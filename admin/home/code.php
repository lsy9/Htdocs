<?php
    
    header('Content-type:img/jpeg');
	session_start();

    $img = imagecreatetruecolor(150,50);

    $backgroundColor = imagecolorallocate($img,rand(126,255),rand(126,255),rand(126,255));
  
    imagefill($img,0,0,$backgroundColor);

    for($i = 1 ; $i <= 500 ; $i++){
  
        $pixColor = imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));
      
        imagesetpixel($img,rand(5,145),rand(5,45),$pixColor);
    }

    $code = '3456789abcdefghijkmnpqrstuvwxy';

	$codes = '';
 
    for($j = 1 ; $j <= 4 ; $j++){
         
        $size = rand(20,25);
   
        $fontColor = imagecolorallocate($img,rand(0,125),rand(0,125),rand(0,125));
    
        $text = $code[rand(0,strlen($code)-1)];
		$codes .= $text;
     
        $x = (100 / 4) * $j;

        $info = imagettfbbox($size,0,'./font/simkai.ttf',$text);
        $y = 50 - abs($info[7] - $info[1]);
      
        imagettftext($img,$size,rand(-20,20),$x,$y,$fontColor,'./font/simkai.ttf',$text);
    }
	$_SESSION['vcode'] = $codes;
  
    imagejpeg($img);

    imagedestroy($img);
?>

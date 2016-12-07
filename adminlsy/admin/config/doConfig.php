<?php
	header('content-type:text/html; charset=utf-8');
     $title = $_POST['TITLE'];
     $keywords = $_POST['KEYWORDS'];
     $banquan = $_POST['BANQUAN'];
     $start = $_POST['START'];
	 
	 $str = "[config]\r\n";
	 $str .= "title={$title}\r\n";
	 $str .= "keywords={$keywords}\r\n";
	 $str .= "banquan={$banquan}\r\n";
	 $str .= "start={$start}\r\n";
    
 //全部放回配置文件
    file_put_contents('./config.ini',$str);
	echo "<script>alert('哎呦喂！！！');window.location.href='./config_list.php'</script>";
	
?>

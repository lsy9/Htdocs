<?php
    header('Content-type:text/html;charset=utf-8');
    session_start();
   $_SESSION=array();
    
    if(isset($COOKIE[session_name()])){
        setcookie(session_name(),'',time()-42000,'/');
    }
    echo '<script> alert ("退出成功！");window.location.href="./index.php"</script>';
	    exit;    

?>

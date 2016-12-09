<?php
    session_start();
    header('Content-type:text/html;charset=utf-8');
    //var_dump($_POST);
    //var_dump($_SESSION);
    $content=$_POST['content'];
    $pid=$_POST['pid'];
    $uid=$_POST['uid'];
    $ctime=time();
    
   // include('../../install/dbconfig.php');
   //连库
	mysql_connect('localhost','root','');
	//选库
	mysql_select_db('lamp111');
	mysql_set_charset('utf8');   
    
    // /* /* //检查是否需要让回复的！ */ */
    $SQLR="select reveal from post where id={$pid}";
    $resr=mysql_query($SQLR);
    $array=mysql_fetch_assoc($resr);
    $reveal=$array['reveal'];
    //echo $SQLR;
    //exit；
    if($reveal==1){

        echo "<script>alert('此贴不准许回复！'); window.location.href='./detail.php?title={$_SESSION['detail']['title']}&pid={$_SESSION['detail']['pid']}&fname={$_SESSION['detail']['fname']}&bname={$_SESSION['detail']['bname']}'</script>";
		exit;
    }else{
        $SQL="insert into reply (uid,pid,ctime,content) values ('{$uid}','{$pid}','{$ctime}','{$content}')";
        //echo $SQL;
        $res=mysql_query($SQL);
        if($res && mysql_affected_rows()>0 ){
            
            //获取当前的积分
            $SQLF="select score from userDetail where id={$uid}";
            $resf=mysql_query($SQLF);
            $arr=mysql_fetch_assoc($resf);
            $score=$arr['score'];
            
            //给积分加1，给session赋值后，再写入数据库；
            $score=$score+1;
            $_SESSION['userDetail']['score']=$score;
            $SQLJ="update userDetail set score='{$score}' where id={$uid}";
            mysql_query($SQLJ);
            mysql_close();
            echo "<script>alert('回复成功！');window.location.href='./detail.php?title={$_SESSION['detail']['title']}&pid={$_SESSION['detail']['pid']}&fname={$_SESSION['detail']['fname']}&bname={$_SESSION['detail']['bname']}'</script>";
        }else{
             echo "<script>alert('回复失败！');window.location.href='./detail.php?title={$_SESSION['detail']['title']}&pid={$_SESSION['detail']['pid']}&fname={$_SESSION['detail']['fname']}&bname={$_SESSION['detail']['bname']}'</script>";
        }       
    }

?>

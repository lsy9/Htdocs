<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	//var_dump($_POST);
	// echo '<pre>';
	// var_dump($_SESSION);
	// echo '</pre>';
	
    $title=$_POST['title'];
    $content=$_POST['content'];
    $uid=$_SESSION['user']['id'];
    $tid=$_POST['tid'];
    $reveal=$_POST['reveal'];
    $ctime=time();
    
	if(empty($title)){
		echo "<script>alert('发帖失恋！');window.location.href='./list.php?pid={$_SESSION['list']['pid']}&id={$_SESSION['list']['id']}&fname={$_SESSION['list']['fname']}&bname={$_SESSION['list']['bname']}&ingName={$_SESSION['list']['ingName']}'</script>";
		exit;
	}
	
    //include('../../install/dbconfig.php');
    //链接数据库
    $link=mysqli_connect('localhost','root','');

    //选择数据库
    mysqli_select_db($link,'test');

    mysqli_set_charset($link,'utf8');
	
	//写SQL语句
    $SQL="insert into post (uid,tid,title,content,ctime,reveal) values ('{$uid}','{$tid}','{$title}','{$content}','{$ctime}','{$reveal}')";
    // echo $SQL;
    //exit;
    mysqli_query($link,$SQL);
	//var_dump(mysql_affected_rows());

    if(mysqli_affected_rows()>0){
        
        //获取当前的积分
        $SQLF="select score from userDetail where id={$uid}";
        $resf=mysqli_query($link,$SQLF);
        $arr=mysqli_fetch_assoc($resf);
        $score=$arr['score'];
        
        //给积分加1，给session赋值后，再写入数据库；
        $score=$score+2;
        $_SESSION['userDetail']['score']=$score;
        $SQLJ="update userDetail set score='{$score}' where id={$uid}";
        mysqli_query($SQLJ);
        
    echo "<script>alert('发帖成功！');window.location.href='./list.php?pid={$_SESSION['list']['pid']}&id={$_SESSION['list']['id']}&fname={$_SESSION['list']['fname']}&bname={$_SESSION['list']['bname']}&ingName={$_SESSION['list']['ingName']}'</script>";
    }
    mysqli_close($link);
?>

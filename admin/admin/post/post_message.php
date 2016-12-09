<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>主要内容区main</title>
<link href="../../public/admin/css/css.css" type="text/css" rel="stylesheet" />
<link href="../../public/admin/css/main.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="../../public/admin/img/main/favicon.ico" />
<style>
body{overflow-x:hidden; background:#f2f0f5; padding:15px 0px 10px 5px;}
#searchmain{ font-size:12px;}
#search{ font-size:12px; background:#548fc9; margin:10px 10px 0 0; display:inline; width:100%; color:#FFF; float:left}
#search form span{height:40px; line-height:40px; padding:0 0px 0 10px; float:left;}
#search form input.text-word{height:24px; line-height:24px; width:180px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
#search form input.text-but{height:24px; line-height:24px; width:55px; background:url(../../public/admin/img/main/list_input.jpg) no-repeat left top; border:none; cursor:pointer; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666; float:left; margin:8px 0 0 6px; display:inline;}
#search a.add{ background:url(../public/../admin/img/main/add.jpg) no-repeat -3px 7px #548fc9; padding:0 10px 0 26px; height:40px; line-height:40px; font-size:14px; font-weight:bold; color:#FFF; float:right}
#search a:hover.add{ text-decoration:underline; color:#d2e9ff;}
#main-tab{ border:1px solid #eaeaea; background:#FFF; font-size:12px;}
#main-tab th{ font-size:12px; background:url(../../public/admin/img/main/list_bg.jpg) repeat-x; height:32px; line-height:32px;}
#main-tab td{ font-size:12px; line-height:40px;}
#main-tab td a{ font-size:12px; color:#548fc9;}
#main-tab td a:hover{color:#565656; text-decoration:underline;}
.bordertop{ border-top:1px solid #ebebeb}
.borderright{ border-right:1px solid #ebebeb}
.borderbottom{ border-bottom:1px solid #ebebeb}
.borderleft{ border-left:1px solid #ebebeb}
.gray{ color:#dbdbdb;}
td.fenye{ padding:10px 0 0 0; text-align:right;}
.bggray{ background:#f9f9f9}
</style>
</head>
<?php
/* 
    //开启SESSION
	session_start();
    //判断是否登陆
    if(!isset($_SESSION['flag'])||($_SESSION['flag']!= md5($_SESSION['id']))){

        header('location:./login.php');
        exit;
    }
	 */
 
  


?>
<body>
<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <td width="99%" align="left" valign="top">您的位置：帖子列表</td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
  		<tr>
   		 <td width="90%" align="left" valign="middle">
	         <form method="get" action="./post_message.php">
	         <span>帖子名：</span>
	         <input type="text" name="title" value="<?php echo empty($_GET['title'])? '': $_GET['title']?>" class="text-word">
	         <input name="" type="submit" value="查询" class="text-but">
	         </form>
         </td>
  		 
  		</tr>
	</table>
    </td>
  </tr>
 
  <tr>
    <td align="left" valign="top">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr>
        <th align="center" valign="middle" class="borderright">编号</th>
        <th align="center" valign="middle" class="borderright">主题</th>
        <th align="center" valign="middle" class="borderright">发帖人</th>
        <th align="center" valign="middle" class="borderright">发帖时间</th>  
        <th align="center" valign="middle" class="borderright">状态</th>
		<th align="center" valign="middle">操作</th>
		
        
      </tr>
	    <?php
      //接收用户输入的内容
       if(empty( $_GET['title'])){//判断是否用户输入了查询内容
	            $where = '';
				$where1 = '';
	   }
	   else{
	         $where = " and title='{$_GET['title']}'";//为sql语句做准备
			 $where1 = "&title=".$_GET['title'];//为传值做准备
	   
	   }
	   // 规定每页显示10条；
	   $page = 10;
	   
	   //判断用户是否选择了页数 默认为第一页
	   $nowPage= isset($_GET['page'])? $_GET['page']:1;
	   
	   //开始的页数
	   $startPage = ($nowPage-1)*$page;
	   //var_dump($nowPage);
	   
	   //为sql语句做准备
	   $limit = "limit {$startPage},{$page}";
	   
	   //连库
	   mysql_connect('localhost','root','');
	   
	   //选库
	   mysql_set_charset('utf8');
	   mysql_select_db('lamp111');
	   
	   //准备sql语句
	   $SQL = " select * from post where recycle=0 {$where} order by id asc {$limit}";
	   
	   //var_dump($SQL);
	   
	   //执行sql语句
	   $num =  $startPage + 1;
	   $result=mysql_query($SQL);
	   while($array=mysql_fetch_assoc($result)){
	      $array1 = array(0=> '普通',1=>'加精');
		  $array2 = array(1=> '普通',0=>'置顶');
		 if($array['recycle'] === '0'){
			$sql = " select * from user where id ={$array['uid']}";
			$result1=mysql_query($sql);
			$arraya=mysql_fetch_assoc($result1);
  ?>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $num;?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $array['title'];?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $arraya['userName'];?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo date('Y-m-d H:i:s',$array['ctime']);?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php  echo $array1[$array['elite']];?>、<?php echo $array2[$array['top']];?></td>
        <td align="center" valign="middle" class="borderbottom">
		<a href="./post_replay.php?recycle=<?php echo $array['recycle'];?>&id=<?php echo $array['id'];?>&title=<?php echo $array['title'];?>&content=<?php echo $array['content'];?>&t=<?php echo $array['ctime'];?>&userName=<?php echo $arraya['userName'];?>" target="mainFrame" onFocus="this.blur()" class="add">查看帖子</a>
		<span class="gray">&nbsp;|&nbsp;</span>
		
		<a href="./post_messageUpdate.php?id=<?php  echo $array['id'];?>&name=<?php echo $array['title'];?>&neirong=<?php echo $array['content'];?>" target="mainFrame" onFocus="this.blur()" class="add">编辑</a>
		<span class="gray">&nbsp;|&nbsp;</span>
		
		<a href="./post_delete.php?id=<?php echo $array['id']?>" target="mainFrame" onFocus="this.blur()" class="add">删除</a>
		<span class="gray">&nbsp;|&nbsp;</span>
		
		<a href="./post_doHuiShouZhan.php?recycle=<?php echo $array['recycle']; ?>&id=<?php echo $array['id'] ?>" target="mainFrame" onFocus="this.blur()" class="add">放入回收站</a>
		<span class="gray">&nbsp;|&nbsp;</span>
		
		<a href="./post_jiajing.php?elite=<?php echo $array['elite'];?>&id=<?php echo $array['id'];?>" target="mainFrame" onFocus="this.blur()" class="add"><?php if($array['elite'] === '0') {echo '加精';} else if ($array['elite'] === '1'){ echo '取消加精';}?></a>
		<span class="gray">&nbsp;|&nbsp;</span>
		
		<a href="./post_top.php?id=<?php echo $array['id'];?>&top=<?php echo $array['top'];?>" target="mainFrame" onFocus="this.blur()" class="add"><?php if( $array['top'] === '0') {echo '置顶';}else if ($array['top'] === '1'){ echo '取消置顶';}?></a>
		<span class="gray">&nbsp;|&nbsp;</span>
		
		<a href="../reply/reply_manage.php?id=<?php echo $array['id'];?>" target="mainFrame" onFocus="this.blur()" class="add">管理回复</a></td>
   <?php
   $num++;
     }
}
     $SQLk = "select count(*) as count from post where recycle=0 ".$where;//查询有多少条数据
	 //echo $SQLk;
	$countpage = mysql_query($SQLk);

		  $arrayt= mysql_fetch_assoc($countpage);
		   $results = $arrayt["count"];
		  //var_dump($results);
		  
		   //总共分的页数
		   $counts = ceil($results/$page);
		  // var_dump($counts);
		  
		   //当请求的页数没有超过总页数时 和超过总页数时 的两种情况
		   if($nowPage < $counts){
		        $endPage = $nowPage +1;
		   }
		   else{
		        $endPage = $nowPage;
		   }
		   
		   //请求的页数不能小于1
		   if( $nowPage >1){
		        $apage = $nowPage -1;
		   
		   }
		   else{
		        $apage = 1;
		   }

?>   
	 

    </table></td>
    </tr>
   <tr>
    <td align="left" valign="top" class="fenye"><?php echo $results;?> 条数据 <?php echo $results;?>
	/<?php echo $nowPage;?> 页&nbsp;&nbsp;<a href="./post_message.php?
	<?php echo $where1;?>&page=1" target="mainFrame" onFocus="this.blur()">首页</a>&nbsp;&nbsp;
	<a href="./post_message.php? page=<?php echo $apage.$where1;?>"target="mainFrame" onFocus="this.blur()">
	上一页</a>&nbsp;&nbsp;<a href="./post_message.php?page=<?php echo $endPage.$where1;?>
	" target="mainFrame" onFocus="this.blur()">下一页</a>&nbsp;&nbsp;
	<a href="./post_message.php?<?php echo $where1;?>&page=<?php echo $counts;?>
	" target="mainFrame" onFocus="this.blur()">尾页</a></td>
  </tr>
</table>
</body>
</html>
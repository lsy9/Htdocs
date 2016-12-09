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
#search form input.text-but{height:24px; line-height:24px; width:55px; background:url(img/main/list_input.jpg) no-repeat left top; border:none; cursor:pointer; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666; float:left; margin:8px 0 0 6px; display:inline;}
#search a.add{ background:url(img/main/add.jpg) no-repeat -3px 7px #548fc9; padding:0 10px 0 26px; height:40px; line-height:40px; font-size:14px; font-weight:bold; color:#FFF; float:right}
#search a:hover.add{ text-decoration:underline; color:#d2e9ff;}
#main-tab{ border:1px solid #eaeaea; background:#FFF; font-size:12px;}
#main-tab th{ font-size:12px; background:url(img/main/list_bg.jpg) repeat-x; height:32px; line-height:32px;}
#main-tab td{ font-size:12px; line-height:40px;}
#main-tab td a{ font-size:12px; color:#548fc9;}
#main-tab td a:hover{color:#565656; text-decoration:underline;}
.bordertop{ border-top:1px solid #ebebeb}
.borderright{ border-right:1px solid #ebebeb }
.borderbottom{ border-bottom:1px solid #ebebeb}
.borderleft{ border-left:1px solid #ebebeb}
.gray{ color:#dbdbdb;}
td.fenye{ padding:10px 0 0 0; text-align:right;}
.bggray{ background:#f9f9f9}
.width{width:200px;}
</style>
</head>
<body>
<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <td width="99%" align="left" valign="top">您的位置：用户管理</td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
  		<tr>
   		 <td width="90%" align="left" valign="middle">
	         <form method="get" action="./user_list.php">
				 <span>管理员：</span>
				 <input type="text" name="userName" value="<?php echo isset($_GET['userName']) ? $_GET['userName'] : '' ; ?>" class="text-word">
				 <input type="submit" value="查询" class="text-but">
	         </form>
         </td>
  		  <td width="10%" align="center" valign="middle" style="text-align:right; width:150px;"><a href="./user_add.php" target="mainFrame" onFocus="this.blur()" class="add">新增用户</a></td>
  		</tr>
	</table>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
    
	<?php
		//var_dump($_GET);
		//每一页显示多少条
		$page = 5;
		
		//当前多少页
		$nowPage = isset($_GET['page']) ?  $_GET['page'] : 1;
		
		//从多少条开始
		$startPage = ($nowPage - 1) * $page;
		
		//limit返回多少行数据   开始页，每页数
        $limit = "limit {$startPage},{$page}";
	?>
	
	
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr>
        <th align="center" valign="middle" class="borderright">编号</th>
        <th align="center" valign="middle" class="borderright">用户名</th>
        <th align="center" valign="middle" class="borderright">权限</th>
        <th align="center" valign="middle" class="borderright">锁定</th>
        <th align="center" valign="middle">操作</th>
      </tr>
	  <?php
		 //来判断用户是否输入,是否要查询
            if(empty($_GET['userName'])){
                //给SQL语句用的
				$where = '';

				//URL地址用的
                $urlWhere = '';

            }else{
                //声明一个变量用来存SQL语句搜索条件
                $where = " where userName like '%{$_GET['userName']}%'";
				
				//给URL地址用的
                $urlWhere = "&userName=".$_GET['userName'];

            }
	
	  
		//连库
		$link=mysqli_connect('localhost','root','');
		
		//选库
		mysqli_select_db($link,'test');
		
		mysqli_set_charset($link,'utf8');
		
		// 写SQL语句
		$sql = "select id,userName,auth,status from user ".$where." order by id asc ".$limit;
		
		
		//执行MySQL
		$result = mysqli_query($link,$sql);
		
		// 处理结果集
		$num = $startPage + 1;
		
		// 定义数组管理权限
		$auth = array(0=>'普通用户',1=>'管理员');
		$status = array(0=>'禁用',1=>'开启');
		
		//处理结果集
		while($array = mysqli_fetch_assoc($result)){
			if($array['status'] == 1){
				$status1 = $status[0];
				$statusNum = 0;
			}
			else{
				$status1 = $status[0];
				$statusNum = 1;
			}
		
	?>		
		
	
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="center" valign="middle" class="borderright borderbottom" ><?php echo $num ?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $array['userName'] ?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $auth[$array['auth']] ?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $status[$array['status']] ?></td>
        <td align="center" valign="middle" class="borderbottom">
			<a href="./user_update.php?userName=<?php echo $array['userName']  ?>" target="mainFrame" onFocus="this.blur()" class="add">编辑</a>
			<span class="gray">&nbsp;|&nbsp;</span><a href="user_del.php?uid=<?php echo $array['id'] ?>" target="mainFrame" onFocus="this.blur()" class="add">删除</a>
			<span class="gray">&nbsp;|&nbsp;</span><a href="user_forbidden.php?uid=
			<?php echo $array['id'] ?>&userName=<?php echo empty($_GET['userName']) ? '' : $_GET['userName'] ?>
			&status=<?php echo $statusNum; ?>" target="mainFrame" onFocus="this.blur()" class="add">
			<?php echo $array['status']==0 ? '开启' : '禁用' ?></a></td>
      </tr>
	<?php
			$num++;
		}
		
		
		//根据情况来选择上一页和下一页
		//判断上一页，最小的页数是一
		if($nowPage > 1){
			$prevPage = $nowPage - 1;
		}
		else{
			$prevPage = 1;
		}
		
		
		//判断下一页，最大的页数是多少    //要判断最大页数我要先知道有多少页
		$countPage = "select count(id) as count from user ".$where;
		
		//执行语句
		$countResult = mysqli_query($link,$countPage);

		//总数   每次执行一行
		$counts = mysqli_fetch_assoc($countResult)['count'];
		
		//算出最大有多少页
		$totalPage = ceil($counts / $page);
		
	
		
		//计算下一页 页码   
		//如果当前页  小于  最大页数
		if($nowPage < $totalPage){
			$nextPage = $nowPage + 1;
		}
		else{
			$nextPage = $totalPage;
		}
		
  ?>  
 <tr>
    <td align="left" valign="top" class="fenye">
		<?php echo $counts ?> 条数据<?php echo $nowPage.'/'.$totalPage ?>页&nbsp;&nbsp;
		<a href="user_list.php?page=1<?php echo $urlWhere; ?>" target="mainFrame" onFocus="this.blur()">首页</a>
		&nbsp;&nbsp;
		<a href="user_list.php?page=<?php echo $prevPage.$urlWhere ?>" target="mainFrame" onFocus="this.blur()">上一页</a>
		&nbsp;&nbsp;
		<a href="user_list.php?page=<?php echo $nextPage.$urlWhere ?>" target="mainFrame" onFocus="this.blur()">下一页</a>
		&nbsp;&nbsp;
		<a href="user_list.php?page=<?php echo $totalPage.$urlWhere ?>" target="mainFrame" onFocus="this.blur()">尾页</a>
	</td>
  </tr>
</table>
</body>
</html>
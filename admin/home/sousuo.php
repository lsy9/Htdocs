<?php session_start();  ?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			帖子搜索结果页
		</title>
		<meta charset="utf-8"/>
        <link href="./css/sousuo.css" rel="stylesheet" type="text/css"/>
        <style>
            .shen{
                margin:20px 0px 20px 0px;
                width:1010px;
                height:50px;
                background-color:white;
            }
            .huifutietouxia {
                float:left;
                width:980px;
                margin-left:15px;
                margin-top:5px;
                border-bottom:1px dotted #dddddd;
                font-size:13px;
                font-weight:bold; 
                color:#5f665f;    
            }
            .huifutietouxia1{
                float:left;
                width:500;
                line-height:30px;
            }
            .huifutietouxia a{
                text-decoration:none;
            }
            .huifutietouxia2{
                float:right;
                width:400;
            }
            .huifutietouxia2 div{
                float:right;
                width:100px;
            }
        </style>
	</head>
	<body>
		<div id="zuishang">
			<div id="shouhang">
				<div id="sheweishouye"><a href="">设为首页</a>&nbsp;<a href="">收藏LAMP兄弟连</a></div>
				<div id="sousuo">
					<ul>
						<li><a href="">搜索</a></li>
						<li><a href="">统计排行</a></li>
						<li><a href="">会员列表</a></li>
						<li><a href="">社区服务</a></li>
						<li><a href="">精华区</a></li>
						<li><a href="">最新帖子</a></li>
						<li><a href="">社区应用</a></li>
						<li><a href="index.php">返回首页</a></li>
							<li id="bang"><a href="">帮助</a></li>
					</ul>
				</div>
			</div>
		</div>	
    
    
        <div>
			<div id="hang1">
                <div id="hang1a">
                    
                    <a href="./index.php"><img src="./img/logo.png"></a>
				</div>
				<div id="hang1b"><img src="./img/wxdbjc.gif">
				</div>
				<div id="hang1c"><img src="./img/qqdenglu.jpg">
				</div>
			    <div id='hang1d'>
                     <?php
                //var_dump($_SESSION);
                 if((!isset($_SESSION['flag'])) || ($_SESSION['flag'] != md5($_SESSION['user']['userName']))){

                     echo "<form method='post' action='dologin1.php'>
                            <input type='text' name='userName' shuru='输入用户名'/>&nbsp;
                            
                            <input type='password' name='password' shuru='密码' id='dd'/>&nbsp;
                            <div>
                                <input type='img' src='./img/denglu1.jpg'/ '></a>
                                <a href='./register.php'><img src='./img/zhuce1.jpg'/></a>
                            </div>
                            </from>";

                        }else{
                            $allauth=array(0=>'普通用户',1=>'管理员');
                ?>
                     
					 <span style="position:relative;top:5px;">欢迎您，尊贵的会员：<?php echo $_SESSION['userDetail']['nickName']; ?></span><img src="./imgs/2015-04-25_213725.jpg" style="float:right;width:50;height:50px;"><br/>
                      <span style="position:relative;top:8px;"><a href="./usercenter.php?id=<?php echo $_SESSION['user']['id']; ?>">个人中心</a> | <a href="./exit.php">退出</a> | <a href="./register.php">注册 </a> | <a href="../admin/index.php">后台管理</a></span><br/>
                      <span style="position:relative;top:10px;">身份：<?php echo $allauth[$_SESSION['user']['auth']]; ?>  积分：<?php echo $_SESSION['userDetail']['score']; ?></span>

                <?php
                     }
                  ?>
                </div>
			</div>
		</div>
 <?php
            date_default_timezone_set('PRC');
            //var_dump($_POST);

            //获得title的get传值；
            if($_GET){
                if(!empty($_GET['title'])){
                    $title=$_GET['title'];
                }
            }            
            //获得title的post传值
            if($_POST){
                if(!empty($_POST['title'])){
                    $title=$_POST['title'];
                }
            }   
?>
        <div id="zhucaidan">
			<div id="nei">
				<ul>
					<li><a href="">培训课堂</a></li>
					<li><a href="">论坛</a></li>
					<li><a href="">兄弟连云课堂</a></li>
					<li><a href="">PHP视频</a></li>
					<li><a href="">Android视频</a></li>
					<li><a href="">Lunux视频</a></li>
					<li><a href="">Cocos视频</a></li>
					<li><a href="">战地日记</a></li>
					<li><a href="">在线自测</a></li>
					<li>
						<select id="kuai" name="kuaijietongdao">
							<option value="0">
							快捷通道
							</option>
						</select>
					</li>
				</ul>
			</div>
        </div>
        <div id="body">
        
        <div id="hang2">
            <div id="hang2a">
                <img src="./img/ssss.jpg">
                <form action="./sousuo.php" method="post">
                    <input type="text" name="title" value='<?php echo $title ?>' id="search">
                    <select name="" id="tie">
                        <option value="0">
                            帖子
                        </option>
                    </select>
                    <input type="image" src="./img/sousuoa.jpg" name="sousuo" id="sou">
                </form>
            </div>
			<div id="hang2b">热搜：<a href="">php</a>&nbsp;<a href="">php视频</a>&nbsp;<a href="">php教程</a></div>
			<div id="hang2c"><img src="./img/tu1.png"/></div>
        </div>
        <?php
  


            $pagesize= 3;//每页所包含的条数；   
            $pagenum = 1;//第一次默认页面所显示第几页；
            
            //获取当前显示的页数；   
                if($_GET){            
	                if(!empty($_GET['pagenum'])){
		                $pagenum=$_GET ["pagenum"];
	                }
                }

            
            //链接数据库
			mysql_connect('localhost','root','');
 
			//选择数据库
			mysql_select_db('lamp111');

			mysql_set_charset('utf8');
            
            $SSQL="select count(*) as total from post where recycle=0 and title like '%".$title."%'";
          
			$sres=mysql_query($SSQL);     
            $sarr=mysql_fetch_assoc($sres);
            $totals=$sarr['total'];
            //echo $totals;  

            //获得总显示页数
            if($totals%$pagesize==0){
                $totalpage=$totals/$pagesize;
            }else{
                $totalpage=ceil($totals/$pagesize);
            }
                
            //获取当前请求页的url地址；
            $url=$_SERVER['REQUEST_URI'];
            $url=parse_url($url);
            $url=$url['path'];                                     
            
            //遍历搜索项
            $SQL="select * from post where recycle=0 and title like '%".$title."%' limit ".($pagenum-1)*$pagesize.','.$pagesize;
           
			$res=mysql_query($SQL);
            
            if($res && mysql_num_rows($res)>0 ){
                
                while($arr=mysql_fetch_assoc($res)){
                    
                    //找到每个贴子的发帖人的账户名
                        $USQL="select user.userName,userDetail.nickName from user,userDetail where user.id=userDetail.id and user.id=".$arr['uid'];
                       
					
					    $ures=mysql_query($USQL);
                        $uarr=mysql_fetch_assoc($ures);
                        
                    //找到帖子所在的版块的信息；
                        $BSQL="select type.name,type.pid from type,post where type.id=post.tid and post.tid=".$arr['tid'];
                        $bres=mysql_query($BSQL);
                        $barr=mysql_fetch_assoc($bres);
                        
                    //找到帖子所在的分区的信息；
                        $FSQL="select name from type where id=pid and id=".$barr['pid'];
                        $fres=mysql_query($FSQL);
                        $farr=mysql_fetch_assoc($fres);
        ?>
            <div class='shen'>
                <div class="huifutietouxia">
                    <div class="huifutietouxia1">
                    <?php 

						$img = '<img src="./img/topicnew.gif">';
                        if($arr['elite']==1){
                            $img = '<img src="./img/topichot.jpg">';
                        }
						if($arr['top']==1){
                            $img = '<img src="./img/shangjiantou.jpg">';
                        }
						echo $img;
                    ?>
						&nbsp;<a href="./reply/detail.php?title=<?php echo $arr['title']; ?>&fname=<?php echo $farr['name']; ?>&bname=<?php echo $barr['name']; ?>&pid=<?php echo $arr['id']; ?> "><?php echo $arr['title']; ?></a>
						&nbsp;<img src="./img/img.jpg">
                    </div>
                    <div class="huifutietouxia2"> 
                    <div><?php echo $uarr['userName']; ?> </br>03-17</div>
                        <div>101/40376</div>
                        <div><?php echo $uarr['userName']; ?><br/><?php echo date('Y-m-d',$arr['ctime']); ?>
                        </div>
                    </div>        
                </div>
            </div>
        <?php
             }
             mysql_close();  }
        ?>

        <?php echo "[共".$totals."条数据]"; ?>&nbsp;&nbsp;<?php echo $pagenum."/".$totalpage."页" ?>&nbsp;&nbsp;

        <?php 
            if($pagenum > 1){
                echo "[<a href='{$url}?pagenum=1&title={$title}'>首页</a>]&nbsp;[<a href='{$url}?pagenum=".($pagenum-1)."&title={$title}'>上一页</a>]";
            }else{
                echo "[首页]&nbsp;[上一页]";    
            } 
            
            if($pagenum < $totalpage){
                echo '[<a href="'.$url.'?pagenum='.($pagenum+1).'&title='.$title.'">下一页</a>]&nbsp;[<a href="'.$url.'?pagenum='.$totalpage.'&title='.$title.'">尾页</a>]';   
            }else{
                echo "[下一页]&nbsp;[尾页]"; 
            }
?>              


        <div id="foot">
            <div id="foot2">
                 <p>联系我们|无图版|手机浏览|清除Cookies </p>
				<p>Powered by phpwind v8.7 Certificate Copyright Time now is:03-20 15:09<br/>
					@2006-2015 LAMP兄弟连 版权所有Gzip disabled 京ICP备11018177号 Total 0.022546(s) query 0,
				<img src="./img/pic.gif" /></p>
            </div>
        </form>
	</body>
</html>











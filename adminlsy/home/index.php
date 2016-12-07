<?php
	header('content-type:text/html; charset=utf-8;');
	session_start();
	
	$config = parse_ini_file('../admin/config/config.ini');
	
	$title = $config['title'];
	$keywords = $config['keywords'];
	$banquan = $config['banquan'];
	$start = $config['start'];
	
	
	if($start == 0){
		header('location:./index1.php');
	}
?>



<!DOCTYPE html>
<html>
	<head>
		<title>
			<?php echo $title ?>
		</title>
		<meta charset="utf-8"/>
        <link href="./css/index.css" rel="stylesheet" type="text/css"/>
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
						<li><a href="">推广链接</a></li>
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
				<div id="hang1c"><img src="./img/QQdenglu.jpg">
                </div>
                
                <div id='hang1d'>
                <?php
                //var_dump($_SESSION);
                 if((!isset($_SESSION['flag'])) || ($_SESSION['flag'] != md5($_SESSION['user']['userName']))){
                   ?>
						<form method='post' action='./dologin1.php'>
                            <input type='text' name='userName' shuru='输入用户名'/>&nbsp;
                            <input type='checkbox' name='status' value='1' checked/>记住密码&nbsp;<!--<a href='#'>找回密码</a>-->
                            <input type='password' name='password' shuru='密码' id='dd'/>&nbsp;
                            <div>
                                <input type='image' src='./img/denglu1.jpg' />
                                <a href='./register.php'><img src='./img/zhuce1.jpg'/></a>
                            </div>
                            </form>
				<?php

                        }else{
                                 $allauth=array(0=>'普通用户',1=>'管理员');
                                ?>
									<span style="position:relative;top:5px;">欢迎您，尊贵的会员：<?php echo $_SESSION['userDetail']['nickName']; ?></span><img src="./img/<?php echo $_SESSION['userDetail']['photo']; ?>" width='50px' height='50px' style="float:right;"><br/>
									<span style="position:relative;top:8px;"><a href="./usercenter.php?id=<?php echo $_SESSION['user']['id']; ?>">个人中心</a> | <a href="./exit.php">退出</a> | <a href="./register.php">注册 </a> | <a href="../admin/index.php">后台管理</a></span><br/>
									<span style="position:relative;top:10px;">身份：<?php echo $allauth[$_SESSION['user']['auth']]; ?> 积分：<?php echo $_SESSION['userDetail']['score']; ?></span>
                            
                        <?php
                     }
                  ?>
                </div>
                
			</div>
		</div>
		<div id="zhucaidan">
            <div id='nei'>
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
						
                </ul>
                <select id="kuai" name="kuaijietongdao">
					<option value="0">
					    快捷通道
					</option>
				</select>
			</div>
        </div>
        <div id="body">
		<div id="hang2">
            <div id="hang2a">
                <form action="./sousuo.php" method="get">
					<input type="text" name="title" value=''>
					<select name="" id="tie">
                        <option value="0">帖子</option>
                    </select> 			 					
					<input type="image" src="./img/sousuo.jpg" name="sousuo" id="sou"/ >
                </form>
            </div>
			<div id="hang2b">热搜：<a href="#">php</a>&nbsp;<a href="#">php视频</a>&nbsp;<a href="#">php教程</a></div>
			<div id="hang2c"><img src="./img/tu1.png"/></div>
		</div>
		<div id="tu">
			<img id="tu1" src="./img/main.png">
			<img id="tu2" src="./img/right_top_left.png">
            <img id="tu3" src="./img/right_top_right.png">
            <img id="tu5" src="./img/right_bottom_right.png">
			<img id="tu4" src="./img/right_bottom_left.png">
			
		</div>
		<div id="tuxia">
			<div id="tuxia1">
				<a href="#" id="tuxia1a"><img src="./img/anc.jpg">[视频教程]兄弟连2015版视频发布声明</a>
				<a href="#" id="tuxia1b">《明哥聊求职》无节操震撼首发！</a>
				<a href="#" id="tuxia1c">兄弟连强势入驻广州</a>
				<a href="#" id="tuxia1d">[在线课]兄弟连CTO训练营火热报名中！</a>
			</div>			
			<div id="tuxiazuo">
				<ul>
					<li><a href="#">今日：151</a></li>
					<li><a href="#">昨日：198</a></li>
					<li><a href="#">最高日：116787</a></li>
					<li><a href="#">帖子：1347970</a></li>
					<li><a href="#">会员：333140</a></li>
					<li><a id="xin" href="">新会员：aycgs027</a></li>
				</ul>
			</div>			
			<div id="tuxiayou">
                <img src="./img/tubiao.jpg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div><a href="">新帖</a> &nbsp;<a href="">精华</a></div>
			</div>
        </div>
        <?php
            
            //链接数据库
			$link=mysqli_connect('localhost','root','');
 
			//选择数据库
			mysqli_select_db($link,'test');

			mysqli_set_charset($link,'utf8');
			
            $sql="select name,id from type where pid=0";
			//echo $sql;
			//$sql="select id,name from type where pid=0 and status=1 order by id ";
            $result=mysqli_query($link,$sql);
           // if($result&&mysql_num_rows($result)>0){
                while($array=mysqli_fetch_assoc($result)){
                     
        ?>
        <div class="neirong">
        <div class="neironga"><span>.:::<?php echo $array['name']; ?>:::.</span><img src="./img/cate_fold.gif"></div>
            <div class="neirongb">
            <?php
				$sql1="select id,name,ingName from type where status=1 and pid='{$array['id']}' order by id desc ";
							/* //$sql1 = "select * from type pid={$array['id']}";
							//$res = mysql_fetch_assoc($sql1); */
				//echo $sql1;
				$res1 = mysqli_query($link,$sql1);
				//if($res1 && mysql_num_rows($res1)>0){
					while($arr1 = mysqli_fetch_assoc($link,$res1)){
						
						//获得版块下的所有非禁用主题数目
						$sql2="select count(*) as total from post where recycle=1 and tid='{$arr1['id']}'";
						//echo $sql2;
						
						$res2=mysqli_query($link,$sql2);
						$arr2=mysqli_fetch_assoc($res2);

						 //获得版块下可看的所有回复的条数
						$sql3="select count(*) as tot from post,reply where post.id=reply.pid and post.recycle=1 and post.tid='{$arr1['id']}'";
						
						//echo $sql3;
						$res3=mysqli_query($link,$sql3);
						$arr3=mysqli_fetch_assoc($res3);

						//获得今天版块下可看的所有回复的条数
						$time=strtotime(date('Y-m-d'));
						$jtime=strtotime(date('Y-m-d'))+24*60*60;
						$sql5="select count(*) as tots from post,reply where post.id=reply.pid and post.recycle=1 and post.tid={$arr1['id']} and reply.ctime>{$time} and reply.ctime<{$jtime}";
						$res5=mysqli_query($link,$sql5);
						$arr5=mysqli_fetch_assoc($res5);
						//获得版块下的最后一条回复的发布时间
						$sql4="select reply.ctime from post,reply where post.id=reply.pid and post.recycle=1 and post.tid='{$arr1['id']}' order by reply.ctime desc limit 1";
						$res4=mysqli_query($link,$sql4);
						$arr4=mysqli_fetch_assoc($res4);  
            ?>
                <div><img src="./img1/imgtype<?php echo $arr1['id']; ?>.png" style="width:57px;height:57px;">
				<span><a class="lianjie" 
					href="./post/list.php?id=<?php echo $arr1['id'] ?>&pid=<?php echo $arr1['id']; ?>&fname=aaa<?php echo $arr1['name']?>&bname=<?php echo $arr1['name']; ?>&ingName=<?php echo $arr1['ingName']; ?> "><?php echo $arr1['name'] ?></a>&nbsp;
				<div style="color:#FF6109;width:70px;float:right;margin-top:15px;">
				今日（<?php echo $arr5['tots']; ?>）</div><br/>             
                主题：<?php echo $arr2['total']; ?>&nbsp;
				帖子：<?php echo $arr3['tot']; ?><br/>
                最后发帖：<?php echo date('Y-m-d H:i',$arr4['ctime']); ?></span>
                    
                </div>
            <?php
                    }
				
                ?>                      
            </div>  
        </div>
        <?php
                } 
           // }
        
        ?>

        <div id="neirong5">
            <div id="neirong5a"><span style="float:left;">友情链接</span><span style="float:right;width:80px;"><a class="zhu" href="./config/youqing.php">申请链接</a></span></div>
            <div id="neirong5b">
                <img src="./img/bbs_n.jpg"><br/>
                <?php
                    //便利出友情链接的所有链接
                    $sqlL="select * from youqing where stutas=2";
                    $resl=mysqli_query($link,$sqlL);
                    if($resl && mysqli_num_rows($link,$resl)>0){
                       echo "<div>"; 
                        while($arrl=mysqli_fetch_assoc($resl)){
                            echo "<span style='float:left;'><a href='{$arrl['path']}'>{$arrl['name']}</a>&nbsp;</span>";
                        }
                       echo "</div>";
                    }
                ?>    
            </div>
        </div>
            <?php mysqli_close($link); ?>


        <div id="neirong6">
            <div id="neirong6a"><span>在线用户-共2661人在线,45位会员,2616位访客,最多4931人发生在2015-07-16&nbsp;05:37</span>
            </div>
            <div id="neirong6b">
                <div>
                    <a href=""><img src="./img/3.jpg"><span>司令(管理员)</span></a>&nbsp;&nbsp;
                    <a href=""><img src="./img/4.jpg"><span>连长(超版)</span></a>&nbsp;&nbsp;
                    <a href=""><img src="./img/5.jpg"><span>排长(版主)</span></a>&nbsp;&nbsp;
                    <a href=""><img src="./img/18.jpg"><span>教官</span></a>&nbsp;&nbsp;
                    <a href=""><img src="./img/10.jpg"><span>新兵</span></a>&nbsp;&nbsp;
                    <a href=""><img src="./img/6.jpg"><span>普通会员</span></a>&nbsp;&nbsp;
                    <span><a href="">[打开在线列表]</a></span></div>
            </div>
        </div> 
        <div id="foot">
			<div id="foot2">     
			<p>联系我们|无图版|手机浏览|清除Cookies </p>
				<p>Powered by phpwind v8.7 Certificate Copyright Time now is:<?php echo date('m-d H:i:s',time()); ?><br/>
					@2006-2015 <?php echo $banquan ?> 版权所有Gzip disabled 京ICP备11018177号 Total 0.022546(s) query 0,
				<img src="./img/pic.gif" /></p>
			</div>
        </div>      
        </div>    
</body>
</html>
